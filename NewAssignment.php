<?php
session_start();
$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}
$NewID = strval(uniqid());
$name = $_POST['AName'];
$text = $_POST['AText'];
$point = $_POST["APoints"];
$point = intval($point);
$date = $_POST["ADate"];
$class = $_SESSION["ClassNum"];
$sem = $_SESSION["Semester"];
$year = $_SESSION["cyear"];


echo ("Class ".$class." in ".$year." ".$sem." : ".$name." worth at most ".$point." points due ".$date."\r\n");
$SearchClass = "SELECT ClassID from Class c where c.ClassNum = '$class' and c.Semester = '$sem' and c.cyear = '$year' limit 1";
$result = mysqli_query($conn, $SearchClass);
printf("<p>\nSelect returned %d rows.\n<P>\n", mysqli_num_rows($result));
$header = false;
if (mysqli_num_rows($result)){
    while ($row = mysqli_fetch_assoc($result) and !$header) {
        # print the attribute names once!
        $header = true;
        $class = $row['ClassID'];
    }

    $insert = "INSERT INTO Assignment VALUES ('$NewID', '$class', '$name', '$date', '$text', '$point')";
    if ($conn->query($insert) === TRUE) {
        echo "New Assignment created successfully";

    } else {
        echo "Error: " . $insert . "<br>" . $conn->error;

    }
}else{
    echo "   Failure.   wrong input for the class information, try again";
}

mysqli_free_result($result);
mysqli_close($conn);

?>