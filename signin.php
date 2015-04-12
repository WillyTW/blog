<!DOCTYPE html>
<head>
<title>TheBest | Sign in</title>
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
          <li><a href="register.php"><span>Register</span></a></li>
          <li><a href="author.php"><span>Author</span></a></li>
          <li><a href="blog.php"><span>Blog</span></a></li>
		  <li class="active"><a href="signin.php"><span>Sign in</span></a></li>
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
<?php
		  if (isset($_POST["username"])&&isset($_POST["password"])) 
		  {
				$sql = "SELECT username FROM account
					WHERE username='". mysqli_real_escape_string($dbLink,$_POST['username'])."' 
					AND password='". mysqli_real_escape_string($dbLink,$_POST['password'])."' ";
				$result=$dbLink->query($sql);
				//$row = mysql_fetch_assoc($result);
				//$login_session =$row['username'];
				//if(mysql_fetch_assoc($result))
				//echo "$result";
				echo "<br />";
				if(($result->num_rows)==1)
				{ //$result = mysqli_query($dbLink, $sql);
					$_SESSION['username']=$_POST['username'];
					$_SESSION['password']=$_POST['password'];
					//echo "@@@@@@@@@@";
				}
				else
				{
					echo "<h2>Wrong username or wrong password.</h2>";
					echo "<h3>Please check.</h3>";
					
				}
		  }
		  if (isset($_POST["deleteusername"]))
		  {
			$deleteuser=$_POST["deleteusername"];
			$deletesql="DELETE FROM account WHERE username='".$deleteuser."'";
			$deletesqlblog="DELETE FROM blog_table WHERE author='".$deleteuser."'";
			$dbLink->query($deletesql);
			$dbLink->query($deletesqlblog);
		  }
?>
		  <div class="article"> 
<?php
		  if (isset($_SESSION['username'])) 
		  {
			$name = $_SESSION['username'];
			echo "<h2>Welcome! $name</h2>";
			echo "<h3>Enjoy your visiting in TheBest --The world famous blog web.</h3>";
			echo "<br />";
			if ($name == "admin")
			{
				
				$sqlaccount = "SELECT * FROM account WHERE isadmin=0 ORDER BY uid DESC";
				$result=$dbLink->query($sqlaccount);
				$rowaccount=mysqli_fetch_array($result);  //第一次抓，抓第一個，而我是DESC的排所以是抓最後一個uid
				$lastuid=$rowaccount['uid'];
				$sqlaccount2 = "SELECT * FROM account WHERE isadmin=0 ORDER BY uid DESC";
				$result2=$dbLink->query($sqlaccount2);
				echo "All user accounts:";
				for($o=1; $o<=$lastuid; $o++){
					if($row=mysqli_fetch_array($result2)){
						echo "<p class='paragraph'>";
						echo $row['username'];
						echo "</p>";
					}
				}
				echo "<br><br><br><br><br>";
				echo "<p class='paragraph'>Delete user accounts:</p>";
echo <<<EOF
<form method="post" action="signin.php">
	Please enter the username:
	<ol>
	<li>username :<br><input type="text" name="deleteusername" class="text"/></li>
	<br>
	</ol>
<input type="submit"/><br/>
</form>
EOF;
				
			}
		  }
		  else
		  {
echo <<<EOF
		<h2>Sign in the Blog</h2>
		<div class="clr"></div>
		  <form method="post" action="signin.php">
			<ol>
              <li>Account :<br><input type="text" name="username" class="text"/></li>
			  <li>Password:<br><input type="password" name="password" class="text"/></li>
			  <br>
			 </ol>
		  <input type="submit"/><br/>
		  </form>
		 <h3>Don't have an account? Click <a href='register.php'>Sign up</a></h3>
EOF;
		  }
		  
?>
        <!-------->
         </div>
      </div> <!--mainbar-->
    </div>  
   </div> <!--content-->
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
