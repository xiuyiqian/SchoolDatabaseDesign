<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="LoginStyle.css"/>
</head>
<body>
<div class = "start">
    <form method = "POST" action = "config1.php">
        <h1 Login Page> </h1>
        <?php if (isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php }?>
        <div class = "form_input">
            <input type = "text" name = "username"  class = "txtbox" placeholder="Enter Your Identity Number"> <br>
        </div>
        <div class = "form_input">
            <input type = "text" name = "password" class = "txtbox" placeholder="Enter Your Password"> <br>
        </div>
        <input type = "submit" name = "submit" value = "LOGIN" class = "btn"/>
    </form>
</div>
</body>
</html>
