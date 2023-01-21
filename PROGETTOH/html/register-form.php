<!DOCTYPE html>
<html lang = "it">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="../css/login-style.css" />
    </head>
    <body>
        <main>
            <h1>Registrati</h1>
            <?php if(isset($templateParams["erroreRegistrazione"])): ?>
            <p><?php echo $templateParams["erroreRegistrazione"]; ?></p>
            <?php endif; ?>
            <form action="#" method="POST">             
                <div>
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Inserisci Username" name="uname" id="uname" required>
                    
                    <label for="email"><b>E-mail</b></label>
                    <input type="text" placeholder="Inserisci E-mail" name="email" id="email" required>
                
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Inserisci Password" name="psw" id="psw" required>

                    <label for="cpsw"><b>Conferma Password</b></label>
                    <input type="password" placeholder="Conferma Password" name="cpsw" id="cpsw" required>
                        
                    <div>
                        <button type="submit">Registrati</button>
                        <p>oppure</p>
                        <button type="button" onclick="document.location='../php/login.php'">Accedi</button>
                    </div>
                </div>
            </form>
        </main>
    </body>
</html>