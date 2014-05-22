<!--    This file is part of Webdome.

    Webdome is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Webdome is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Webdome.  If not, see <http://www.gnu.org/licenses/>. -->
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
            Web app create for the Web tecnology's exam of University Parthenope <br>-Ferraro Carmine-Colucci Emanuele-De Rosa Fabio-
            <br> The code is open</font></b></p></a>
    </form>
</body>
</html>
