
<html lang="en">
<head>
    <title>Faculty Page</title>
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
echo "\r\n";
echo "Course Content";
echo "\r\n";

$class = $_POST["ClassID"];
$username = $_SESSION['username'];


$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}
$query = "SELECT ClassNum, ClassName, Semester, cyear, TFname as InstructorFName, TLname as InstructorLName
FROM Class c inner join Instructor i on c.InstructorID = i.TeacherID
where c.InstructorID = '$username' and c.ClassID = '$class'";
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
        $_SESSION[$key] = $value;
        print ("<td>" . $value . "</td>"); # One item in row
    }
    print ("</tr>\n");   # End row of HTML table

}

echo "\r\n";
?>
    Enter New Assignment
    <form method = "POST" action = "NewAssignment.php">
        <div class = "form_input">
            <input type = "text" name = "AName" class = "txtbox" placeholder="Enter The assignment name "> <br>
        </div>
        <div class = "form_input">
            <input type = "text" name = "AText" class = "txtbox" placeholder="Enter The Text for Assignment "> <br>
        </div>
        <div class = "form_input">
            <input type = "text" name = "ADate" class = "txtbox" placeholder="Enter The Due Date for the assignment "> <br>
        </div>
        <div class = "form_input">
            <input type = "text" name = "APoints" class = "txtbox" placeholder="Enter the full points for the assignment "> <br>
        </div>
        <input type = "submit" name = "assign" value = "Assign" class = "btn"/>
    </form>
    <br />


    <?php

print( "Student Assignment Score" );
# Assignment Score
$query = "SELECT * FROM Class c inner join Score s on c.ClassID = s.ClassID 
where c.InstructorID = '$username' and c.ClassID = '$class'";

print("<pre><code>");
print("</code></pre>");
# execute the query
if (!( $result = mysqli_query($conn, $query))){
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
}
print("<div><table class=\"table table-striped\"\n");
$header = false;
$marks = array("ClassID","InstructorID","ClassName", "Semester", "cyear", "AssignmentID","CID");
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
    $_SESSION["ClassID"] = $class;

    mysqli_free_result($result);
    mysqli_close($conn);
print("</table></div>\n");

?>
    Change Assignment Grade
    <form method = "POST", action="AssignmentGrade.php">
        <div class = "form_input">
            <input type = "text" name = "StudentID"  placeholder="Enter The Student's ID "> <br>
        </div>
        Please input a number between 1 to 10
        <div class = "form_input">
            <input type = "number"  id="quantity" name = "AssignmentName" min="1" max="10" class = "txtbox" placeholder="1-10"> <br>
        </div>
        <div class = "form_input">
            <input type = "number" step="1" name = "AssignmentGrade"  placeholder="Enter The Grade for student "> <br>
        </div>
        <input type = "submit" name = "assign" value = "Assign" class = "btn"/>
    </form>

    Assign Final Grade
    <form method = "POST" action="InstructorFinalGrade.php">
        <div class = "form_input">
            <input type = "text" name = "StudentID" class = "txtbox" placeholder="Enter The Student's ID "> <br>
        </div>
        <div class = "form_input">
            <input type = "text" name = "Grade" class = "txtbox" placeholder="Enter The Final Grade "> <br>
        </div>
        <input type = "submit" name = "assign" value = "Assign" class = "btn"/>
    </form>


    <p>
        ** the QA link, click GO Q&A <br>
    </p>
    <form method = "POST", action="QA.php">
        <input type = "submit" name = "submit" value = "GO Q&A" class = "btn"/>
    </form>

</div>
</body>
</html>


