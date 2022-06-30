<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!--CSS-->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;600;700&display=swap" rel="stylesheet"> 

    <title>Manajemen Arsip - Login</title>
</head>
<body class="login-body">
    <div class="login-box">
        <div class="row login-box-inside">
            <div class="col-md-4 login-logo-section">
                <img src="/assets/image/logo_login.png" class="login-logo">
            </div>
            <div class="col-md-8 login-form-section">
                <div class="container">
                    <div class="login-header">
                        <h3>Masuk</h3>
                        <h3>Dashboard Admin</h3>
                    </div>
                    <div class="login-form">
                        <form action="/login" method="POST">
                            <div class="mb-4">
                                <input type="email" class="form-control login-form-box" id="exampleFormControlInput1" placeholder="Email" name="email">
                            </div>
                            <div class="mb-4">
                                <input type="password" class="form-control login-form-box" id="exampleFormControlInput1" placeholder="Password" name="password">
                            </div>
                            <?php if (isset($_SESSION['error'])): ?>
                                <p style="color:red;"><?= $_SESSION['error']; ?></p>
                            <?php endif;?>
                            <button type="submit" class="btn btn-primary mb-3 login-btn">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4" style="text-align:center;">
            <a href="/permintaan" style="color:white">Isi formulir permintaan pembuatan surat disini</a>
        </div>
    </div>
    
    <!--BOOTSTRAP--> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>