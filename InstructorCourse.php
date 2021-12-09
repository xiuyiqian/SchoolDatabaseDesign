<!DOCTYPE html>
<html lang="en">
<head>
    <title>Instructor Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h3>
        Instructor/TA Page
    </h3>

<?php
session_start();
$username = $_GET['username'];
$_SESSION['username'] = $username;

$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}
$query = "SELECT ClassID, ClassNum, ClassName, Semester, cyear
FROM Class c inner join Instructor i on c.InstructorID = i.TeacherID where c.InstructorID = '$username'";
print("<pre><code>");
print("</code></pre>");
# execute the query
if (!( $result = mysqli_query($conn, $query))){
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
}
print("<div><table class=\"table table-striped\"\n");
$header = false;
while ($row = mysqli_fetch_assoc($result)) {
# print the attribute names once!
    if (!$header) {
        print("<!-- print header once -->");
        $header = true;
        # specify the header to be dark class
        print("<thead class=\"table-dark\"><tr>\n");
        foreach ($row as $key => $value) {
            print "<th>" . $key . "</th>";
        }
        print("</tr></thead>\n");
    }
    print("<tr>\n");     # Start row of HTML table
    foreach ($row as $key => $value) {
        print ("<td>" . $value . "</td>"); # One item in row
    }
    print ("</tr>\n");   # End row of HTML table

}

?>

    <p></p>
    ** the ClassId are listed
    <form method = "POST", action="InstructorPage.php">
        <div class = "form_input">
            <input type = "text" name = "ClassID" class = "txtbox" placeholder="Enter The Class ID "> <br>
        </div>
        <input type = "submit" name = "submit" value = "Choose" class = "btn"/>
    </form>

</div>
</body>
</html>

