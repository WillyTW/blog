<!DOCTYPE html>
<head>
<title>TheBest | Register</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!-- for sliders-->
<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-georgia.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/coin-slider.min.js"></script>
<!-- for sliders-->
<?php
session_start();
?>
</head>
<body>
<?php
			$dbLink = new mysqli('localhost', 'w0116089', '5RDhPj', 'db0116089');
			if (!$dbLink) 
				{ die('Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error()); }
			$dbLink->query("set names 'utf8'");
			//echo 'Success... <br><br><br>' . mysqli_get_host_info($dbLink) . "\n";
?>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="menu_nav">
        <ul>
          <li><a href="index.php"><span>Home Page</span></a></li>
          <li class="active"><a href="register.php"><span>Register</span></a></li>
          <li><a href="author.php"><span>Author</span></a></li>
          <li><a href="blog.php"><span>Blog</span></a></li>
          <li><a href="signin.php"><span>Sign in</span></a></li>
		  <li><a href="signout.php"><span>Sign out</span></a></li>
        </ul>
      </div>
      <div class="logo">
        <h1><a href="index.php">TheBest</a></h1>
      </div>
      <div class="clr"></div>
      <div class="slider">
        <div id="coin-slider"> 
			<a href="#"><img src="images/slide1.png" width="960px" height="360px" alt="" /> </a> 
			<a href="#"><img src="images/slide2.png" width="960px" height="360px" alt="" /> </a> 
			<a href="#"><img src="images/slide3.png" width="960px" height="360px" alt="" /> </a> 
		</div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
<?php
if(!isset($_SESSION['username']))
{
		  if (isset($_POST['usernameup'])&&isset($_POST['passwordup'])&&isset($_POST['emailup'])&&isset($_POST['birthdayup']) ) 
		  {
			$sq_uid = "SELECT COUNT(*) FROM account ";
			$result = mysqli_query($dbLink,$sq_uid);
			$num = mysqli_fetch_array($result) ;
			$count_uid = $num['COUNT(*)'];
			$usernameup = $_POST['usernameup'];
			$passwordup = $_POST['passwordup'];
			mysqli_query($dbLink,"INSERT INTO account VALUES ($count_uid,'$usernameup','$passwordup',0)");
			echo "<h2>Thank you for signning up. $usernameup</h2>";
			echo "<h3>Enjoy your visiting in TheBest --The world famous blog web.</h3>";
			echo "<br />";
			$_SESSION['username'] = $_POST['usernameup'];
		  }
		  else
		  {
echo <<<EOF
		<h2>Sign up and join TheBest</h2>
		<div class="clr"></div>
		  <form method="post" action="register.php">
			<ol>
              <li>Account :<br><input type="text" name="usernameup" class="text"/></li>
			  <li>Password:<br><input type="password" name="passwordup" class="text"/></li>
			  <li>Email:<br><input type="text" name="emailup" class="text"/></li>
			  <li>Birthday:<br><input type="text" name="birthdayup" class="text"/></li>
			  <br>
		  <input type="submit"/><br/>
		  </form>
EOF;
		  }
}
else
{
	echo "<h2>You've already signed up.</h2>";
	echo "<br>";
}
		  
?>
        </div>
      </div>
    </div>
  </div>
<!------------------------------------------------------------------------------------------------------------------------------>
   <div class="footer">
    <div class="footer_resize">
      <p class="lf">Copyright &copy; 2015 TheBest Inc. All rights reserved. You can still click <a href="http://www.fbi.gov/">here</a> to copy.</p>
      <p class="rf">Design by William Lin</p>
      <div style="clear:both;"></div><!--去除兩邊的float-->
    </div>
  </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------>
</html>
