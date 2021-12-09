<?php
session_start();

$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}

$student = $_POST["StudentID"];
$grade = $_POST["Grade"];

$update= "UPDATE Score SET LetterScore = '$grade' where StudentID = '$student'";
if ($conn->query($update) === TRUE) {
    echo "Record updated successfully";

} else {
    echo "failure input";
    echo "Error updating record: " . $conn->error;

}
mysqli_close($conn);

?>



