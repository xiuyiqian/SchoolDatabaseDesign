<html lang="en">
<head>
    <title>Q&A Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h3>
        Question & Answer Page
    </h3>

    <?php
    session_start();
    $conn = mysqli_connect("localhost",
        "cs377", "ma9BcF@Y", "canvas");
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(1);
    }
    $CID = $_SESSION['ClassID'];

    printf("<p>\nQuestion Listed.\n<P>\n");
    $query = "SELECT p.QuestionID, PostTitle, PostDate, PostText, PostTag1, PostTag2, ResponseText 
from Post p LEFT join Reply r on p.QuestionID = r.QuestionID where p.ClassID = '$CID' order by PostDate,ResponseDate";
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
    mysqli_free_result($result);
    mysqli_close($conn);
    $_SESSION['ClassID'] = $CID;
    ?>
    <br/>
    <br/>
    Pick a tag

    <form method = "POST" action="PickTag.php">
        <div class = "form_input">
            <input type = "text" name = "tag" class = "txtbox" placeholder="Enter The tag name "> <br>
        </div>
        <input type = "submit" name = "assign" value = "Assign" class = "btn"/>
    </form>
    <br>
    <br>
    New Post

    <form method = "POST" action="NewPost.php">
        <div class = "form_input">
            <input type = "text" name = "title" placeholder="Enter the post title "> <br>
        </div>
        <div class = "form_input">
            <input type = "text" name = "content"  placeholder="Enter the post text"> <br>
        </div>
        <div class = "form_input">
            <input type = "text" name = "tag1"  placeholder="Enter the post tag1"> <br>
        </div>
        <br>
        If there is not tag2, input 'X'
        <div class = "form_input">
            <input type = "text" name = "tag2"  placeholder="Enter the post tag2"> <br>
        </div>
        <input type = "submit" name = "p" value = "post" class = "btn"/>
    </form>


    <br/>
    <br/>
    New Reply
    <form method = "POST" action="NewReply.php">
        <div class = "form_input">
            <input type = "text" name = "question" placeholder="Enter the QuestionID You want to reply "> <br>
        </div>
        <div class = "form_input">
            <input type = "text" name = "content"  placeholder="Enter the text"> <br>
        </div>
        <input type = "submit" name = "p" value = "reply" class = "btn"/>
    </form>

</div>
</body>
</html>

