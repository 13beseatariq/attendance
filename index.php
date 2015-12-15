<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home Page</title>
</head>

<body>
<div align="center"> 
<h3> Login Here </h3>
<form action="" method="post">
Email: <input type="text" name="id"> <br><br>
Passowrd: <input type="password" name="pass"> <br><br>
<input type="submit">
</form>
</div> 

<?php
if (isset($_POST["id"]) && $_POST["pass"])
{
	session_start();
	$id = $_POST["id"];
	$_SESSION["teacher_email"] = $_POST["id"]; 
	$pass = $_POST["pass"];
	$db = mysql_connect("localhost", "root", "");
	mysql_select_db("attendance_db",$db);
	$result= mysql_query("SELECT * FROM user where email='$id'", $db);
	if (mysql_num_rows($result)==0)
	{
		echo "<script language='javascript'>";
		echo "alert('Nobody Found')";
		echo "</script>";
	}
	else
	{
		$role= mysql_result($result, 0, "role");
		if ($role=="teacher")
		{
			echo "<script language='javascript'>";
			echo "alert('Role: $role')";
			echo "</script>";
			$url = "teacher.php";
			if (headers_sent())
			  die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
			else
			{
			  header('Location: ' . $url);
			  die();
			}    			
		}
		else if ($role=="student")
		{
			echo "<script language='javascript'>";
			echo "alert('Role: $role')";
			echo "</script>";
			$url = "student.php";
			if (headers_sent())
			  die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
			else
			{
			  header('Location: ' . $url);
			  die();
			}
		}
	}//found result if closes here
}//main if closes here
?>
</body>
</html>