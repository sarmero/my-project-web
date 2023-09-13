<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academy</title>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="container">
        <form action="./services/auth.php" method="post">
            <div class="login-reg-panel">

                <div class="register-info-box">
                    <img src="/Academy/image/udenar.png" class="logo">
                    <p></p>

                </div>

                <div class="white-panel">
                    <div class="login-show">
                        <form action="./services/auth.php" method="post">
                            <h2>LOGIN</h2>
                            <input type="text" name="usr" class="form-control" id="staticUser" placeholder="User name">
                            <input type="password" name="pwd" class="form-control" id="inputPassword"
                                placeholder="Password">
                            <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
                            <a href="">¿Has olvidado tu contraseña?</a>

                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>