<?php
include 'config.php';
function jsonstato($host,$keys)
{
    $stat=  file_get_contents('http://'.$host.'/server.php?richiesta=stato&key='.$keys);
    return $stat;
}


function statoimg($stato){
    if($stato[4]=="0" && $stato[5]=="0" && $stato[6]=="0"&& $stato[7]=="0")
 {
     return $statusluce = "images/alloff.png";
 }
 else  if($stato[4]=="1" && $stato[5]=="1" && $stato[6]=="1"&& $stato[7]=="0")
 {
     return $statusluce = "images/allon.png";
 }
 else  if($stato[4]=="1" && $stato[5]=="0" && $stato[6]=="1"&& $stato[7]=="0")
 {
     return $statusluce = "images/sbon.png";
 }
 else if($stato[4]=="1" && $stato[5]=="1" && $stato[6]=="0"&& $stato[7]=="0")
 {
     return $statusluce = "images/scon.png";
 }
 else  if($stato[4]=="0" && $stato[5]=="1" && $stato[6]=="1"&& $stato[7]=="0")
 {
     return $statusluce = "images/cbon.png";
 }
 else  if($stato[4]=="1" && $stato[5]=="0" && $stato[6]=="0"&& $stato[7]=="0")
 {
     return $statusluce = "images/son.png";
 }
 else  if($stato[4]=="0" && $stato[5]=="1" && $stato[6]=="0"&& $stato[7]=="0")
 {
     return $statusluce = "images/con.png";
 }
 else  if($stato[4]=="0" && $stato[5]=="0" && $stato[6]=="1"&& $stato[7]=="0")
 {
     return $statusluce = "images/bon.png";
 }else if($stato[4]=="0" && $stato[5]=="0" && $stato[6]=="0"&& $stato[7]=="1")
 {
     return $statusluce = "images/alloffO.png";
 }
 else  if($stato[4]=="1" && $stato[5]=="1" && $stato[6]=="1"&& $stato[7]=="1")
 {
     return $statusluce = "images/allonO.png";
 }
 else  if($stato[4]=="1" && $stato[5]=="0" && $stato[6]=="1"&& $stato[7]=="1")
 {
     return $statusluce = "images/sbonO.png";
 }
 else if($stato[4]=="1" && $stato[5]=="1" && $stato[6]=="0"&& $stato[7]=="1")
 {
     return $statusluce = "images/sconO.png";
 }
 else  if($stato[4]=="0" && $stato[5]=="1" && $stato[6]=="1"&& $stato[7]=="1")
 {
     return $statusluce = "images/cbonO.png";
 }
 else  if($stato[4]=="1" && $stato[5]=="0" && $stato[6]=="0"&& $stato[7]=="1")
 {
     return $statusluce = "images/sonO.png";
 }
 else  if($stato[4]=="0" && $stato[5]=="1" && $stato[6]=="0"&& $stato[7]=="1")
 {
     return $statusluce = "images/conO.png";
 }
 else  if($stato[4]=="0" && $stato[5]=="0" && $stato[6]=="1"&& $stato[7]=="1")
 {
     return $statusluce = "images/bonO.png";
 }   
}

function statotemp1($status)
{
    $as= json_decode($status);
    $req= $as->{'temp1'};
    return $req;
}
function statolux1($status)
{
    $as= json_decode($status);
    $req= $as->{'lux1'};
    return $req;
}

function statotemp2($status)
{
    $as= json_decode($status);
    $req= $as->{'temp2'};
    return $req;
}
function statotemp3($status)
{
    $as= json_decode($status);
    $req= $as->{'temp3'};
    return $req;
}
function aggiornastatoimg($status)
{
   
    $as= json_decode($status);
    $req= $as->{'state'};
    $qq=  explode('.', $req);
    $ss=statoimg($qq);
    return $ss; 
}

function statonum($status)
{
    $as= json_decode($status);
    $req= $as->{'state'};
    $qq=  explode('.', $req);
    return $qq;
}
$status= jsonstato($host,$key);

$statoimg=aggiornastatoimg($status);

$stato=statonum($status);

if($_GET['req']=="temp1"){
    $temper1 = statotemp1($status);
    echo $temper1;
} 
if($_GET['req']=="lux1"){
    $lux1 = statolux1($status);
    echo $lux1;
} 

if($_GET['req']=="state"){
    echo $statoimg;
} 
if($_GET['req']=="condon"){
   if($stato[2]=="0")
    {
      $req="3on";
    }
    else
    {
    $req="3off";
    }
    file_get_contents('http://'.$host.'/server.php?richiesta='.$req.'&key='.$key);
     $status=jsonstato($host,$key);
     echo aggiornastatoimg($status);
} 
if($_GET['req']=="Pon"){
    $status=jsonstato($host,$key);
   if($stato[7]=="0")
    {
      $req="portaO";
    }
    else
    {
    $req="portaC";
    }
    file_get_contents('http://'.$host.'/server.php?richiesta='.$req.'&key='.$key);
     $status=jsonstato($host,$key);
     echo aggiornastatoimg($status);
    }
 

if($_GET['req']=="son")
{  
    
    if($stato[4]=="0")
        {
       $req="5on";
        }
     else
        {
         $req="5off";
        }   
        file_get_contents('http://'.$host.'/server.php?richiesta='.$req.'&key='.$key);
        $status=jsonstato($host,$key);
        echo aggiornastatoimg($status);
}
else if ($_GET['req']=="con")
{
    
    if($stato[5]=="0")
        {
       $req="6on";
        }
     else
        {
         $req="6off";
        }      
    file_get_contents('http://'.$host.'/server.php?richiesta='.$req.'&key='.$key);  
    $status=jsonstato($host,$key);
    echo aggiornastatoimg($status);
}
else if($_GET['req']=="bon")
{
    if($stato[6]=="0")
        {
       $req="7on";
        }
     else
        {
         $req="7off";
        }   
    file_get_contents('http://'.$host.'/server.php?richiesta='.$req.'&key='.$key);   
    $status=jsonstato($host,$key);
    echo aggiornastatoimg($status);
}

?>
