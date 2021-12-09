<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Course Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<br class="container">
    <h3>
        Course Page
    </h3>

<?php
session_start();
$class = $_POST["ClassID"];
$username = $_SESSION['username'];
$_SESSION['ClassID'] = $class;
$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}

printf("<p>\nCourse Detail.\n<P>\n");
$query = "SELECT c.ClassID, ClassNum, ClassName, Semester, cyear, TFname as InstructorFName, TLname as InstructorLName FROM Class c
inner join Score s on c.ClassID = s.ClassID inner join Instructor i on c.InstructorID = i.TeacherID where s.StudentID = '$username'";
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


print( "Assignment Score and Letter Score" );
# Assignment Score and Letter Score
$marks = array("ClassID", "ClassName", "Semester", "cyear", "StudentID","InstructorID");
$query = "SELECT * FROM Class c inner join Score s on c.ClassID = s.ClassID where s.StudentID = '$username' and c.ClassID = '$class' ";
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
            if(in_array($key, $marks)){
                continue;
            }
            print "<th>" . $key . "</th>";
        }
        print("</tr></thead>\n");
    }
    print("<tr>\n");     # Start row of HTML table
    foreach ($row as $key => $value) {
        if(in_array($key, $marks)){
            continue;
        }
        print ("<td>" . $value . "</td>"); # One item in row
    }
    print ("</tr>\n");   # End row of HTML table
}


print("</table></div>\n");


# Assignment detail
print( "Assignment Detail");
$query = "select Distinct ClassNum, AssignmentName, AssignmentDueDate, AssignmentText, TotalPoints from Assignment a inner join Class c 
    on a.CID = c.ClassID where a.CID in (select Distinct ClassID from Score s where s.StudentID = '$username' and a.CID = '$class')";


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
            if(in_array($key, $marks)){
                continue;
            }
            print "<th>" . $key . "</th>";
        }
        print("</tr></thead>\n");
    }
    print("<tr>\n");     # Start row of HTML table
    foreach ($row as $key => $value) {
        if(in_array($key, $marks)){
            continue;
        }
        print ("<td>" . $value . "</td>"); # One item in row
    }
    print ("</tr>\n");   # End row of HTML table
}
print("</table></div>\n");
mysqli_free_result($result);
mysqli_close($conn);
?>
<br/>

<p>
    ** the QA link, click GO Q&A <br>
</p>
    <form method = "POST", action="QA.php">
        <input type = "submit" name = "submit" value = "GO Q&A" class = "btn"/>
    </form>

</div>
</body>
</html>

