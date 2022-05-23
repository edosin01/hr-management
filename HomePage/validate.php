<?php 
    include 'config.php';


    // $username = $_POST['username'];
    // $password = $_POST['password'];

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    
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
    
    if(!empty($_POST['username']) && !empty($_POST['password'] && isset($_POST['submit'])))   
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `taikhoan` where `username` = '$username' and `password` = '$password'";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
            header("Location: ./index.php");
        else
            {
                $login_error = "Sai tài khoản hoặc mật khẩu!";
                include 'login.php';
            }
    }
?>