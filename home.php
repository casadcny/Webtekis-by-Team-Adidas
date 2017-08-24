<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Adidas | Home</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/skin-black-light.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="bootstrap/css/style.css">
    
</head>
<!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->
<body class="hold-transition skin-black-light layout-boxed">
<!-- Site wrapper -->
<div class="wrapper">
       <nav class="navbar navbar-inverse">
  <div class="container-fluid">

    <ul class="nav navbar-nav">
      <li class=""><a href="home.html">Home </a></li>
        <li class=""><a href="friendreq.html">Friend Request </a></li>
         
        <?php
  $connection = mysqli_connect("localhost","root","","socialnetwork");
if (isset($_POST['search'])){
   $search = $_POST['search'];
   

$query = mysqli_query($connection,"select * from user where username like '$search' or firstname like '$search' or lastname like '$search'");

if($query->num_rows > 0){ 
    
    echo 
        "<table>
        <tr>
        <th>Username</th>
        <th>lastname</th>
        <th>firstname</th>
        </tr>
        ";
    
while($row = mysqli_fetch_assoc($query)) {
$fname = $row['firstname'];
$uname = $row['username'];
$lname = $row['lastname'];
         
    echo "<tr>
    
        <td>$uname</td>
        <td>$lname</td>
        <td>$fname</td>
        </tr>";
        
}
    echo "</table>";
}else{
      
    echo 
        "<table>
        <tr>
        <th>Username</th>
        <th>lastname</th>
        <th>firstname</th>
        </tr>
         </table>";
}
}
        
?>
    <form action="home.php" method="post">
    <input type="text" class="form-control" name="search" placeholder="Search">
    <button type="submit"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
    </form>
   
        
        
    <ul class="nav navbar-nav navbar-right">
       <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile</a>
             <ul class="dropdown-menu">
                 <li><a href="profile.html">View Profile</a></li>
                 <li class="divider"></li>
                  <li><a href="logout.php?logout">Log Out</a></li>
          </ul>
      </li>
    </ul>
  </div>
    

        <!-- Main content -->
        <section class="content">      
            <div class="content-wrapper">
                
                  <div class="col-md-4">
      <div class="panel panel-default">
              <div class="panel-body">
                  
                    <article class= "row">
                 <div class="col-md-2 col-sm-2 hidden-xs">
                          <figure class="thumbnail">
                            <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                            <figcaption class="text-center">username</figcaption>
                          </figure>
                        </div>
                
                        <div class="col-md-10 col-sm-10">
                          <div class="panel panel-default arrow left">
                            <div class="panel-body">
                               <input type="email" class="form-control" placeholder="What's on your mind?">
              </div>
                <div class="panel-footer">
                  <div class="btn-group">
                    <button type="button" class="btn btn-link btn-icon"><i class="fa fa-camera"></i></button>
                    <button type="button" class="btn btn-link btn-icon"><i class="fa fa-video-camera"></i></button>
                  </div>
                  
                  <div class="pull-right">
                    <button type="button" class="btn btn-success">Post</button>
                  </div>  
                </div>
            </div>
          </div>
           <div class="post-center">
         <div class="col-md-4">
      
          </div>
          </div>
                  </article>
                            </div>
                          </div>
                        </div>
                
                
        <div class="col-md-4">
      <div class="panel panel-default">
              <div class="panel-body">
                <article class= "row">
                 <div class="col-md-2 col-sm-2 hidden-xs">
                          <figure class="thumbnail">
                            <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                            <figcaption class="text-center">username</figcaption>
                          </figure>
                        </div>
                
                            <div class="col-md-10 col-sm-10">
                          <div class="panel panel-default arrow left">
                            <div class="panel-body">
                              <header class="text-left"> 
                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                              </header>
                              <div class="comment-post">
                                <p>
                                 POST TO NG FRIEND NYA
                                </p>
                            </div>
                
                  <input type="email" class="form-control" placeholder="Comment here"> 
                <div class="btn-group pull-right">
                  &nbsp;
                  <div class="panel-comment">
                <button type="button" class="btn btn-success">Comment</button>
                  </div>
                
                  </div> 
                        </div>
                        </div>  
                        </div>
                  </article>
                           
                          </div>
                        </div>   
                  
          </div>   
            </div>
        </section>
        <!-- Posts -->


        <!-- End Main content -->
    
</div>

<footer class="main-footer">
<strong>Team Adidas &copy; 2017 </strong> All rights reserved.
</footer>


<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
    
</body>
    </html>