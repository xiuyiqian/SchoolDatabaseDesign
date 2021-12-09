
<?php
# establish the connection
$conn = mysqli_connect("localhost",
    "cs377", "ma9BcF@Y", "canvas");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(1);
}
$username = '';
$password = '';
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    if (empty($username)) {
        header("Location: Login.php?error=UserName is required");
        exit();
    } else if (empty($password)) {
        header("Location: Login.php?error=Password is required");
        exit();
    } else {
        # echo "Correct ID and Password";
        $query = "SELECT * FROM Instructor where TeacherID = '$username'
             AND TLoginID = '$password' limit 1";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result)) {
            print( "Welcome Instructor. correct ID and Password");
            $url = "authentification2.php?username=". $username;
            header('Location: '.$url);
        } else {
            $query2 = "SELECT * FROM Student where IdentityID = '$username'
                AND LoginID = '$password' limit 1";
            $result2 = mysqli_query($conn, $query2);
            if (mysqli_num_rows($result2)) {
                print( "Welcome Student. correct ID and Password");
                $url = "authentification.php?username=". $username;
                header('Location: '.$url);
                exit();
            }
                else{
                    print( "Wrong Password or ID. try again");
                }
            }
        }
    }else{
        header("Location: Login.php");
        exit();
}
mysqli_close($conn);
?>