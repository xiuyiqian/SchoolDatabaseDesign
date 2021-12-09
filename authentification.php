
<?php
$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}
$username = $_GET['username'];
# Student
$url = "StudentCourse.php?username=" . $username;
echo "Hello Student, do you want go to <a href ='$url'>next page</a>";
# TA
echo "<br>";
$query = "SELECT TAIdentityID from TA where TAIdentityID = '$username'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result)>0) {
    $url2 = "InstructorPage.php?username=" . $username;
    echo "Hello TA, do you want to do your job <a href ='$url2'>next page</a>";
}
?>

