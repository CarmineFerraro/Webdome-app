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
include 'config.php';
$connessione = mysql_connect($hostDB,$db_user,$db_psw);
session_start();
mysql_select_db($db_name,$connessione); 
//variabili POST con anti sql Injection
$username=mysql_real_escape_string($_POST['username']); //faccio l'escape dei caratteri dannosi
$password=mysql_real_escape_string(sha1($_POST['password'])); //sha1 cifra la password anche qui in questo modo corrisponde con quella del db
$query = "SELECT * FROM login WHERE username = '$username' AND password = '$password' ";
$ris = mysql_query($query, $connessione) or die (mysql_error());  
$riga=mysql_fetch_array($ris);   
/*Prelevo l'identificativo dell'utente */
$cod=$riga['username'];
/* Effettuo il controllo */
if ($cod == NULL) $trovato = 0 ;
else $trovato = 1;  
/* Username e password corrette */
if($trovato === 1) {  
 /*Registro la sessione*/
$_SESSION['autorizzato'];
$_SESSION["autorizzato"] = 1;
/*Registro il codice dell'utente e le variabili di sessione globali*/
$_SESSION['cod'] = $cod;
$_SESSION['nome'] = $username;
$_SESSION['hostRasp']= $riga['hostRasp'];
$_SESSION['hostWebcam']=$riga['hostWebcam'];
$_SESSION['superkey']=$riga['superkey'];

 /*Redirect alla pagina riservata*/
echo '<script language=javascript>document.location.href="'.$riga['pagina'].'.php"</script>'; 
} 
else {
/*Username e password errati, redirect alla pagina di login*/ 
 echo '<script language=javascript>document.location.href="index.php?errore=error"</script>';
}
?>
