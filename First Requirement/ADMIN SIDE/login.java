package com.finalproject.servlets;

import com.finalproject.beans.UserAccount;
import com.finalproject.db.UserAccountRepository;
import com.finalproject.exceptions.NoRoleException;
import com.finalproject.exceptions.UserPasswordException;
import com.finalproject.util.LogoutUtils;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.Properties;


@WebServlet(name = "login", urlPatterns = {"/login"})
public class Login extends HttpServlet {

    public static final String MODULE_PROP = "modules.properties";

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {

        RequestDispatcher rd = req.getRequestDispatcher("WEB-INF/pages/login.jsp");
        rd.forward(req, resp);
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
 
        String username = req.getParameter("username");
        String password = req.getParameter("password");


        List<String> errors = new ArrayList<>();

        if (username == null || username.isEmpty()) {
            errors.add("your username should not be empty");
        }

        if (password == null || password.isEmpty()) {
            errors.add("your password should not be empty");
        }

        if (!errors.isEmpty()) {
            doDispatch(errors, req, resp);
            return;
        }

        UserAccount user = null;
        try {
            user = UserAccountRepository.fetchUser(username, password);
        } catch (UserPasswordException e) {
            doDispatch(Arrays.asList(e.getMessage()), req, resp);
        } catch (NoRoleException e) {
            doDispatch(Arrays.asList(e.getMessage()), req, resp);
        }

        if (user == null) {
            doDispatch(Arrays.asList("the account you are requesting does not exist"), req, resp);
            return;
        }

        if (user.getRoleId() != 1) {
            ServletContext context = req.getServletContext();
            String fullPath = context.getRealPath("/WEB-INF/" + MODULE_PROP);
            Properties prop = loadServerIps(fullPath);
            sendPost(user.getRoleId(), username, password, prop, resp);
            //postss(user.getRoleId(), username, password, prop,req, resp);
            return;
        }


        req.getSession().setAttribute("activeUser", user);
        resp.sendRedirect("dashboard");
    }

    private void doDispatch(List<String> errors, HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        req.setAttribute("errors", errors);
        RequestDispatcher rd = req.getRequestDispatcher("WEB-INF/pages/login.jsp");
        rd.forward(req, resp);
        return;
    }

    private Properties loadServerIps(String path) {
        Properties prop = new Properties();
        InputStream input = null;

        try {
            input = new FileInputStream(path);
            prop.load(input);

        } catch (IOException ex) {
            ex.printStackTrace();
        } finally {
            if (input != null) {
                try {
                    input.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }

        return prop;
    }


    public void sendPost(Integer roleId, String username, String password, Properties prop, HttpServletResponse response) {

        response.setStatus(HttpServletResponse.SC_MOVED_PERMANENTLY);

        String urlFormat = "http://%s/%s?%s=%s&%s=%s";

        String url = "";
        if (roleId == 2) {
            url = String.format(urlFormat, prop.getProperty("php"), "login.php", "username", username, "password", password);
            url+= "&submit=Submit";
        } else if (roleId == 3) {
            url = String.format(urlFormat, prop.getProperty("nodejs"), "login", "usernames", username, "passwords", password);
        } else {
            throw new NullPointerException("your user role data inside database is inconsistent");
        }

        response.setCharacterEncoding("UTF-8");
        response.setHeader("Location", url);

    }
}
