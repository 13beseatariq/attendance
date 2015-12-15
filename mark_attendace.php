<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mark Attendance</title>
</head>

<body>
<?php
$class = $_GET['class_id'];
	$db = mysql_connect("localhost", "root", "");
	mysql_select_db("attendance_db",$db);
	$result= mysql_query("SELECT * FROM user where class='$class' AND role='student'", $db);
	//echo ("SELECT * FROM user where class='$class' AND role='student'");
	echo ("<form action='' method='post' onSubmit='sumit()'>");
	echo ("<pre><b> ID              Name                     Email                  Present? </b></pre>");
	$id_array = array();
	if (mysql_num_rows($result)>0)
	{
		for($i = 0; $i < mysql_num_rows($result); $i++)
		{
			$id= mysql_result($result, $i, "id");
			array_push($id_array, $id);
			$name = mysql_result($result, $i, "fullname");
			$email=mysql_result($result, $i, "email");
			echo ("<pre> $id              $name               $email          <input type='checkbox' name='$id'></pre>");
		}
		echo ("<input type='submit' name='submit'>");
		echo ("</form>");
		if(isset($_POST['submit']))
		{
			sumit($id_array,$class);
			echo ("<script>alert ('Attendance Submitted!') </script>");
		} 	
	}
	function sumit($arr,$cl)
	{
		$db = mysql_connect("localhost", "root", "");
		mysql_select_db("attendance_db",$db);
		for ($i=0; $i<count($arr); $i++)
		{
			if (isset($_POST[''.$arr[$i]]))
				mysql_query("INSERT INTO `attendance_db`.`attendance`(`classid`, `studentid`, `isPresent`, `comments`) VALUES ('$cl', '$arr[$i]', '1', 'nothing');", $db);						
			else
				mysql_query("INSERT INTO `attendance_db`.`attendance`(`classid`, `studentid`, `isPresent`, `comments`) VALUES ('$cl', '$arr[$i]', '0', 'nothing');", $db);						
		}
		
	}
?>
</body>
</html>