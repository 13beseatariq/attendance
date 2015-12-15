<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Teacher</title>
</head>

<body>
<?php
		session_start();
		$email =$_SESSION['teacher_email'];
		$db = mysql_connect("localhost", "root", "");
		mysql_select_db("attendance_db",$db);
		$result= mysql_query("SELECT * FROM user where email='$email'", $db);
		$full_name= mysql_result ($result,0,"fullname");
		echo ("<h2>Welcome $full_name!</h2>");
		echo ("<h3> Your classes: </h3>");
		if (mysql_num_rows($result)>0)
		{
			$id= mysql_result($result, 0, "id");	
			$result= mysql_query("SELECT * FROM class where teacherid=$id", $db);	
			if (mysql_num_rows($result)>0)
			{
				for($i = 0; $i < mysql_num_rows($result); $i++)
				{
					$class_id= mysql_result($result, $i, "id");
					$start_time = mysql_result($result, $i, "starttime");
					$end_time=mysql_result($result, $i, "endtime");
					echo ("<pre> <a href='mark_attendace.php?class_id=$class_id'> $class_id </a>          $start_time           $end_time </pre>");
				}
			}
		}
		
		
?>
</body>
</html>