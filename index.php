<?php
if(isset($_GET['msg']) == 'logout')
{
     echo "<script type=\"text/javascript\">alert(\"Logout effettuato!\"); </script>";
}
else if (isset($_GET['errore']) == 'error')
{
    echo "<script type=\"text/javascript\">alert(\"Username o password errata!\"); </script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> - Webdome - </title>    
<link href="stile.css" type="text/css" rel="stylesheet"> 
<link href="buttons/buttons.css" type="text/css" rel="stylesheet">
</head>
<body>
    <form id="login" action="verifica.php" method="POST">
    <div><img src="images/Webdome.png" style="position:absolute; top:-55%; left:-90%;"></div>
    <div><img src="images/titolo.png" style="position:absolute; top:-50%;"></div>
    <div><img src="images/sottotitolo.png" style="position:absolute; left: -40%; top:110%;"></div>
        <fieldset id="inputs">
            <input id="username" name="username" type="text" placeholder="Username" autofocus required>
            <input id="password" name="password" type="password" placeholder="Password" required>
        </fieldset>
        <fieldset id="actions">
        <input type="submit" class="button big blue" value="Login!!!">
        </fieldset>
        <a href="mailto:carmine.ferraro1@students.uniparthenope.it" > <p align="center"><b><font style="width: 1000px; left:-70%;top:130%;position: absolute;text-decoration: none; color: blue;font-family: Papyrus; font-size:15px; line-height: 20px; letter-spacing: 1">
            WebApp realizzata per l'esame di Tecnologie Web dell'universita' Parthenope di Napoli dal Team SimplyLife <br>-Ferraro Carmine-Colucci Emanuele-De Rosa Fabio-
            <br> Tutto il codice e la documentazione sono Open-Source! </font></b></p></a>
    </form>
</body>
</html>
