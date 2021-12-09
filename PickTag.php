<html lang="en">
<head>
    <title>Q&A Tag</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container">

<?php

session_start();
$class = $_SESSION['ClassID'];
$tag = $_POST['tag'];

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
$class = validate($class);
$tag = validate($tag);

$query = "SELECT p.QuestionID,p.PostTag1, p.PostTag2, p.PostTitle, p.PostDate, p.PostText, r.ResponseText, r.ResponseDate from Post p 
    inner join Reply r on p.QuestionID = r.QuestionID  
where p.ClassID = '$class' and (p.PostTag1 = '$tag' or p.PostTag2 = '$tag')";



print("<pre><code>");
print("</code></pre>");
# execute the query
$result = mysqli_query($conn, $query);
if (!$result){
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
}
echo "here2";
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

mysqli_free_result($result);
mysqli_close($conn);

?>
</div>
</body>
</html>

