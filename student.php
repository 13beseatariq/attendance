<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Attendance</title>
</head>

<body>

<?php
	session_start();
	$email = $_SESSION['teacher_email'];
	$db = mysql_connect("localhost", "root", "");
	mysql_select_db("attendance_db",$db);
	$result= mysql_query("SELECT * FROM user where email='$email'", $db);
	$full_name= mysql_result($result, 0, "fullname");
	echo ("<h2> Weclome $full_name! </h2>");
	$classes = array ();
	for($i = 0; $i < mysql_num_rows($result); $i++)
	{
		$class_id= mysql_result($result, $i, "class");
		$id= mysql_result($result, $i, "id");
		array_push($classes, $class_id);
		//echo ($class_id);
		show_attendance($class_id, $id);
	}
	function show_attendance($class_id, $id)
	{
		$db = mysql_connect("localhost", "root", "");
		mysql_select_db("attendance_db",$db);
		$total= mysql_query("SELECT * FROM attendance where classid=$class_id AND studentid=$id", $db);
		//echo ("$class_id: ".mysql_num_rows($total)."<br>");
		$t = mysql_num_rows($total);
		$attendance= mysql_query("SELECT * FROM attendance where classid=$class_id AND studentid=$id AND isPresent=1", $db);
		//echo ("$class_id: ".mysql_num_rows($attendance)."<br>");
		$a=mysql_num_rows($attendance);
		if ($a!=0 && $t!=0)
		{
			$avg = ($a/$t)*100;
			if ($avg<75)
				echo ("<p style='color:red; font-weight:bold;'>Your attendance in class $class_id: $avg%</p><br>");
			else if ($avg<85)
				echo ("<p style='color:yellow; font-weight:bold;'>Your attendance in class $class_id: $avg%</p><br>");
			else
 				echo ("<p style='color:green; font-weight:bold;'>Your attendance in class $class_id: $avg%</p><br>");
		}
		else
			echo ("<p style='color:red; font-weight:bold;'>Your attendance in class $class_id: 0%</p><br>");
	}
?>
</body>
</html>