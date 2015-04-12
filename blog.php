<!DOCTYPE html>
<head>
<title>TheBest | Blog</title>
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
          <li class="active"><a href="blog.php"><span>Blog</span></a></li>
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
if (isset($_SESSION['username'])) 
{
	if(isset($_GET['title'])&&isset($_GET['text']))
	{
		$number = "SELECT COUNT(*) FROM blog_table ";
		$result = mysqli_query($dbLink,$number);
		$row = mysqli_fetch_array($result) ;
		$num = $row['COUNT(*)']+1;
		$title = $_GET['title'];
		$text = $_GET['text'];
		$author = $_SESSION['username'];
		mysqli_query($dbLink,"INSERT INTO blog_table VALUES ($num,'$author','$title','$text',now())");
	}
	$user = $_SESSION['username'];
	$sq = "SELECT COUNT(*) FROM blog_table WHERE author='".$user."'";
	$result = mysqli_query($dbLink,$sq);    //開通
	$num = mysqli_fetch_array($result) ;    //抓他
	$count = $num['COUNT(*)'];              //才可用它
	echo "<br>";
	$sqlad = "SELECT * FROM blog_table WHERE author='".$user."' ORDER BY modtime DESC";//DESC遞減排列，排出修改時間前五個
	$resultad=mysqli_query($dbLink,$sqlad);

	for($i=1; $i<=$count; $i++)
	{
		if($row=mysqli_fetch_array($resultad))
		{
			echo "<div class=\"article\">";
			echo "<h2>".$row['title']."</h2>";
			echo "<div class=\"clr\"></div>";
			echo "<div class=\"post_content\">";
			echo "<h3>".$row['modtime']."</h3>";
			echo "<p class=\"paragraph\">";
			echo "".$row['text']."<br>";
			echo "</p>";
			echo "</div>";
			echo "<div class=\"clr\"></div>";
			echo "</div>";
		}
	}
echo <<<EOF
	<div class="article">
          <h2>Write a blog.</h2>
          <div class="clr"></div>
          <form method="get" action="blog.php">
		  <ol>
              <li>title :<br><input type="text" name="title" class="text"/></li>
			  <li>
                text :<br>
                <textarea id="text" name="text" rows="8" cols="50"></textarea>
              </li>
			  <br>
			 </ol>
		  <input type="submit"/><br/>
		  </form>
	</div>
            
EOF;
}
else
{
			echo "<h2>You haven't signed in yet.</h2>";
			echo "<p class='paragraph'>Please <a href='signin.php'>log in</a> first in order to use the blog.</p>";
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
