<?php
session_start();

$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}
$class = $_SESSION["ClassNum"];
$sem = $_SESSION["Semester"];
$year = $_SESSION["cyear"];
$classID = strval($_SESSION["ClassID"]);

$grade= intval($_POST["AssignmentGrade"]);
$num = $_POST["AssignmentName"];
$num = strval($num);
$a = 'Assignment';
$name = $a . $num;
$a = 'Grade';
$name = $name . $a;
$name = strval($name);
$student = strval($_POST["StudentID"]);


$update= "UPDATE Score SET $name = '$grade' where StudentID = '$student' and ClassID = '$classID'";
if ($conn->query($update) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "                     failure input\r\n";
    echo "Error updating record: " . $conn->error;
}
mysqli_close($conn);


?>