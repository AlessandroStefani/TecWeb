<!DOCTYPE html>
<html lang = "it">
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../css/login-style.css" />
    </head>
    <body>
        <main>
            <h1>Accedi</h1>
            <form action="#" method="POST">    
                <?php if(isset($templateParams["errorelogin"])): ?>
                    <p><?php echo $templateParams["errorelogin"]; ?></p>
                <?php endif; ?>         
                <div>
                    <label for="email"><b>E-mail</b></label>
                    <input type="text" placeholder="Inserisci E-mail" name="email" id="email" required>
                
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Inserisci Password" name="psw" id="psw" required>
                    
                    <div>
                        <?php if(isset($_SESSION["locked"])) : ?>
                            <button type="button" onclick="location.reload()">Accedi</button>
                        <?php else: ?>
                            <button type="submit">Accedi</button>
                        <?php endif; ?>
                        <p>oppure</p>
                        <button type="button" onclick="document.location='../php/register.php'">Registrati</button>
                    </div>
                </div>
            </form>
        </main>
    </body>
</html>