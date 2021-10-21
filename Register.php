<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="Register.css">
</head>
<body>
    <div id="wrapper">

        <?php
            include_once("connection.php");
            if(isset($_POST['btnReg'])){
                $us = $_POST['txtUsername'];
                $pass1 = $_POST['txtPassword'];
                $pass2 = $_POST['txtConfirmPassword'];
                $fullname = $_POST['txtFullname'];
                $email = $_POST['txtEmail'];

                $fmUsername = "/^[A-Za-z0-9_\.]{6,32}$/";
                $fmPass = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";

                $err = "";

                if($us == "" || $pass1 == "" || $pass2 == "" || $fullname == "" || $email == ""){
                        $err.= "Enter fields with mark (*), please<br/>";
                    }
                if(!preg_match($fmUsername, $us)){
                    $err.= "Username must be greater than 5 characters include at least the format of letters and numbers<br/>";
                }
                if(!preg_match($fmPass, $pass1)){
                    $err.= "Password must have the first character is uppercase, lowercase, numbers and special characters<br/>";
                }
                if($pass1 != $pass2){
                    $err .= "Password and confirm password are the same<br/>";
                }
                if($err != ""){
                    echo $err;
                }
                else{
                    
                    $pass = md5($pass1);
                    $sq = "select * from customer where Username='$us' or email='$email'";
                    $res = pg_query($conn, $sq);
                    
                    if(pg_num_rows($res)==0){
                        pg_query($conn, "INSERT INTO customer (Full_Name, Email, Username, Password) VALUES ('$fullname', '$email', '$us', '$pass1')");
                        echo "You have register successfully<br/>";
                    }
                    else{
                        echo "Username or Email already exists<br/>";
                    }
                }
            }
        ?>
        <form action="" method="POST">
            <div id="register-header">
                <h1>Register</h1>
            </div>
            <div id="username">
                <div id="label">
                    <label>Username:</label><br/>
                </div>
                <input type="text" name="txtUsername" id="usernameInput" placeholder="Enter username">
            </div>
            <div id="username">
                <div id="label">
                    <label>Fullname:</label><br/>
                </div>
                <input type="text" name="txtFullname" id="usernameInput" placeholder="Enter fullname">
            </div>
            <div id="email">
                <div id="label">
                    <label>Email:</label><br/>
                </div>
                <input type="email" name="txtEmail" id="email-txt" placeholder="Enter email">
            </div>
            <div id="password">
                <div id="label">
                    <label>Password:</label><br/>
                </div>
                <input type="password" name="txtPassword" id="passwordInput" placeholder="Enter password">
            </div>
            <div id="confirmPassword">
                <div id="label">
                    <label>Confirm Password:</label><br/>
                </div>
                <input type="password" name="txtConfirmPassword" id="confirmPasswordInput" placeholder="Enter confirm password">
            </div>
            <div id="btnRegister">
                <input type="submit" name="btnReg" value="Register" id="btnReg">
            </div>
        </form>
    </div>
</body>
</html>