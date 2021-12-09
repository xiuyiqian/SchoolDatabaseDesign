
<?php
session_start();
$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$NewID = strval(uniqid());
$zone = 'America/New_York';
date_default_timezone_set($zone);
$time = strval(date("Y-m-d H:i:s"));
$content = $_POST["content"];
$qid = $_POST['question'];
$qid = validate($qid);
$username = validate($_SESSION['username']);
echo "current time        ";
echo $time;
echo "<br/>";

$query = "INSERT INTO Reply VALUES ('$NewID', '$qid', '$time', '$content', '$username')";
echo $query;
echo '<br/>';
if ($conn->query($query) === TRUE) {
    echo "New reply created successfully";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
    echo "wrong";
}
mysqli_free_result($result);
mysqli_close($conn);
exit;
?>