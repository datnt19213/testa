<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
</head>

<body>
    <div id="wrapper">
        <?php
            if(isset($_POST['btnLog']))
            {
                $us = $_POST['txtUsername'];
                $pa = $_POST['txtPass'];

                $err = "";
                if($us == ""){
                    $err .= "Enter Username, please <br/>";
                }
                if($pa == ""){
                    $err .= "Enter Password, please <br/>";
                }
                if($err != ""){
                    echo $err;
                }
                else{
                    include_once("connection.php");
                    $pass = md5($pa);
                    $res = pg_query($conn, "SELECT Username, Password, Full_Name FROM customer WHERE Username='$us' AND Password='$pa'");
                    if(!$res){echo "error ($conn)";}
                    $ad = pg_query($conn, "SELECT AdminName, Admin_Password FROM admin_account WHERE AdminName = '$us' and Admin_Password = '$pa'");
                    if(!$ad){echo "error ($conn)";}

                    if(pg_num_rows($res)==1)
                    {
                        $usCheck = pg_fetch_assoc($res);
                        echo "Welcome " .$usCheck['Full_Name']. ". You have logged in successfully";
                        $_SESSION['us']=$us;
                        echo '<meta http-equiv="refresh" content="0;URL=Admin_Page.php"/>';
                    }
                    elseif(pg_num_rows($ad)==1)
                    {
                        $adCheck = pg_fetch_assoc($ad);
                        echo "ADMIN IS ACCESS";
                        $_SESSION['ad']= "ADMIN " .$us. " IS ACCESS";
                        echo '<meta http-equiv="refresh" content="0;URL=Admin_Page.php"/>';
                    }
                    else{
                        echo "You logged is fail";
                    }
                }
            }
        ?>
        <form action="" autocomplete="off" method="POST">
            <div id="header-login">
                <h1>Login</h1>
            </div>
            <div id="username">
                <div id="label">
                    <label>Username:</label><br/>
                </div>
                <input type="text" name="txtUsername" id="usernameInput" placeholder="Enter username">
            </div>
            <div id="password">
                <div id="label">
                    <label>Password:</label><br/>
                </div>
                <input type="password" name="txtPass" id="passwordInput" placeholder="Enter password">
            </div>
            <div id="btnLogin">
                    <input type="submit" name="btnLog" value="Login" id="btnLog">
            </div>
            <div id="more">
                <p>You have not the account? <a href="?page=register" id="new-account">Create one?</a></p>
            </div>
        </form>
    </div>
</body>
</html>