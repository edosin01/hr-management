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
                    <form action="./validate.php" method="post">
                        <label for="username">USERNAME</label>
                        <input value="" type="text" id="username" name="username" class="input-field">
                        <span><?php if(isset($username_error))  echo $username_error ?></span>
                        <label for="password">PASSWORD</label>
                        <input value="" type="password" id="password" name="password" class="input-field">
                        <span><?php if(isset($password_error)) echo $password_error ?></span>
                        <input type="checkbox" name="checkbox" id="checkbox" class="check-box">
                        <p class="check-box">Remember Me</p>
                        <button id="submit" type="submit" name="submit">Submit</button>
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