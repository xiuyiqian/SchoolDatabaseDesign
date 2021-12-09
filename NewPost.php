
<?php
echo 'here';
# session_start();
$NewID = strval(uniqid());
$title = $_POST['title'];
$tag1 = $_POST['tag1'];
$tag2 = $_POST["tag2"];
$content = $_POST["content"];
$class = $_SESSION['ClassID'];
$username = $_SESSION['username'];

$zone = 'America/New_York';
date_default_timezone_set($zone);
$now = strval(date("Y-m-d H:i:s"));

$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}

echo '<br/>';

$query = "INSERT INTO Post VALUES ('$NewID', '$class', '$title', '$now', '$content', '$tag1','$tag2','$username')";
echo $query;
echo '<br/>';
if ($conn->query($query) === TRUE) {
    echo "New post created successfully";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
    echo "wrong";
}
mysqli_free_result($result);
mysqli_close($conn);
exit;
?>

