<?php 
    ob_start();
    session_start();
    include 'dbconfig.php';


    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // $username = filter_input(INPUT_POST, 'username');
        // $password = filter_input(INPUT_POST, 'password');

        if(empty($_POST['username']))
        {
            $username_error = "Please enter your username!";
            include 'login.php';
        }
        if(empty($_POST['password']))
        {
            $password_error = "Please enter your password!";
            include 'login.php';
        }
        if(isset($_POST['remember'])) {
        setcookie("username", $username, time() + (86400), "/");
        setcookie("password", $_POST['password'], time() + (86400), "/");
        }
        if(!empty($_POST['username']) && !empty($_POST['password']))   
        {
        $sql = "SELECT * FROM `taikhoan` where `username` = '$username' and `password` = '$password'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_row($result);
        if($result->num_rows > 0){
            $_SESSION['login'] = $row;
            header("Location: ./index.php");
        }
        else
            {
                $login_error = "Sai tài khoản hoặc mật khẩu!";
                include 'login.php';
            }
        }
    }
    $username="";
    $password="";
    $check = false;
    if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $check = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metaverse</title>
    <link rel="stylesheet" href="./style1.css">
    <link rel="icon" href="../assets/img/metaverse_logo.png" type="image/x-icon">
</head>
<body>
    <section>
        <div class="screen">
            <div class="login">
                <div class="login-form">
                    <h1>Login Now</h1>
                    <form action="" method="post">
                        <label for="username">USERNAME</label>
                        <input value="<?php echo $username ?>" type="text" id="username" name="username" class="input-field">
                        <span><?php if(isset($username_error))  echo $username_error ?></span>
                        <label for="password">PASSWORD</label>
                        <input value="<?php echo $password ?>" type="password" id="password" name="password" class="input-field damm">
                        <span><?php if(isset($password_error)) echo $password_error ?></span>
                        <input type="checkbox" name="remember" id="checkbox" class="check-box" value="1" <?php echo ($check)?"checked":""?>>
                        <p class="check-box">Remember Me</p>
                        <button id="submit" type="submit" name="submit">Sign In</button>
                        <span><?php if(isset($login_error)) echo $login_error ?></span>
                    </form>
                </div>
            </div>
            <div class="hero-banner">
               <div class="description">
                    <h2>Metaverse</h2>
                    <p>Metaverse Inc. Human Resource Management Application.</p>
                    <p>For a better community.</p>
               </div>
            </div>
        </div>
    </section>
</body>
</html>