<?php
$username = $_GET['username'];
# echo $username;
$url = "InstructorCourse.php?username=" . $username;
echo "Hello Faculty, do you want go to <a href ='$url'>next page</a>";
?>
