<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/login_register.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>PK How - Logowanie</title>
</head>

<body>
    <div class="container">
        <div class="logo"> 
            <img src="public/img/logo.png">
            <div>
                Wszystko, czego potrzebujesz wiedzieć o studiowaniu na PK w jednym miejscu
            </div>
        </div>
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <div class = "messages">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message)
                        {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <div>Zaloguj się</div>
                <input name="email" type="text" placeholder=" email@email.com">
                <input name="password" type="password" placeholder=" password">
                <button type="submit">Login</button>
                <a class ="logo" href="<?= "http://$_SERVER[HTTP_HOST]/register" ?>">Rejestracja</a>
            </form>
        </div>  
    </div>
</body>