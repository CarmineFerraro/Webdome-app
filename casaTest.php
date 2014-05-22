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
session_start();
if (!isset($_SESSION['autorizzato'])) {
  echo '<script language=javascript>document.location.href="accessonegato.html"</script>';
  die;
}
?>
<!DOCTYPE html>
<html>
   
<head>
    <link href="stile.css" type="text/css" rel="stylesheet">
    <link href="buttons/buttons.css" type="text/css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="RGraph/libraries/RGraph.common.core.js" ></script>
    <script src="RGraph/libraries/RGraph.common.dynamic.js" ></script>
    <script src="RGraph/libraries/RGraph.common.tooltips.js" ></script>
    <script src="RGraph/libraries/RGraph.thermometer.js" ></script>
       <script src="RGraph/libraries/RGraph.fuel.js" ></script>
    <script type="text/javascript">



function btnBagno()
{
   var strVal = "bon";
   ajaxF(strVal,stateChangedl);
}
function btnPorta()
{
   var strVal = "Pon";
   ajaxF(strVal,porta);
   
}
function btnSoggiorno()
{
   var strVal = "son";
  ajaxF(strVal,stateChangedl);
}
function btnCamera()
{
   var strVal = "con";
   ajaxF(strVal,stateChangedl);
}
function btnCond()
{
   var strVal = "condon";
   ajaxF(strVal,stateChangedl);
 
}
function btnWebcam(){
    if(document.getElementById("webcam").style.visibility ==="visible")
        document.getElementById("webcam").style.visibility = "hidden";
    else
        document.getElementById("webcam").style.visibility = "visible";
}
var xlmHttp;
function ajaxF(strVal,handler)
{
   if (strVal.length > 0)
   {
      var url = "client.php?req=" + strVal;
      xmlHttp = CreateXmlHttpObject(handler)     
      if (xmlHttp === null)
	return;
      xmlHttp.open("GET", url , true)
      xmlHttp.send(null)
   }
   else
	alert("errore!");
}

function CreateXmlHttpObject(handler)
{
   var objXmlHttp = null;

   if (navigator.userAgent.indexOf("MSIE") >= 0)
   { 
	var strName = "Msxml2.XMLHTTP"
	if (navigator.appVersion.indexOf("MSIE 5.5") >= 0)
	   strName = "Microsoft.XMLHTTP";

	try
	{
	   objXmlHttp = new ActiveXObject(strName);
	   objXmlHttp.onreadystatechange = handler;
	}
	catch(e)
	{
	   alert("Error: Your Browser don't support the app!");
	   objXmlHttp = null;
	}
   }
   else
   {
	try
	{
	   objXmlHttp = new XMLHttpRequest();
	   objXmlHttp.onload = handler;
	   objXmlHttp.onerror = handler;
	}
	catch(e)
	{
	   alert("Error: Your Browser don't support the app!");
	   objXmlHttp = null;
	} 
   }

   return objXmlHttp;
}

function stateChangedl() 
{ 
   if (xmlHttp.readyState===4 || xmlHttp.readyState ==="complete")
            document.getElementById("imgH").src=xmlHttp.responseText; 
            
}
function porta() 
{ 
   if (xmlHttp.readyState===4 || xmlHttp.readyState ==="complete")
            {  var Resp= xmlHttp.responseText;
                document.getElementById("imgH").src=Resp;
                if (Resp.search('O')>=0)
            { 
            document.getElementById("webcam").style.visibility = "visible";
            document.getElementById("btnP").style.visibility = "visible";
            document.getElementById("btnVideo").value="Hidden video";
            }
                else
                    {
                  document.getElementById("webcam").style.visibility = "hidden";
                  document.getElementById("btnP").style.visibility = "hidden";
                  document.getElementById("btnVideo").value="Show video";
                    }
            }
}
   
    $('document').ready(function(){
    $('#webcam').draggable();
    $('#btnVideo').bind('click',cambiaV);
    function cambiaV(){
        if($('#btnVideo').val()=== 'Show video')
            $('#btnVideo').val('Hidden video');
        else
            $('#btnVideo').val('Show video');
    }
    $('#nascondit').bind('click',nascondit);
    function nascondit(){
        if($('#nascondit').val() === 'Hidden Temperatures')
        {
        $('#id2').slideUp(1000);
        $('#id3').slideUp(1000);
        $('#id4').slideUp(1000); 
        $('#nascondit').val('Show temperatures');
        }
        else{
        $('#id2').slideDown(1000);
        $('#id3').slideDown(1000);
        $('#id4').slideDown(1000); 
        $('#nascondit').val('Hidden Temperatures');
        }
        
        
    }
    $('#nascondil').bind('click',nascondil);
    function nascondil(){
        if($('#nascondil').val() ==="Hidden brightness")
            {
                $('#id8').slideUp(1000);
                $('#nascondil').val("Show brightness");
            }
            else
            {
                $('#id8').slideDown(1000);
                $('#nascondil').val("Hidden brightness");
            }
        
    }
   $('#cond').bind('click',cambianome);
   function cambianome(){
       if($('#cond').val()=== "Turn on conditioner")
       {$('#cond').val('Turn off conditioner');
       document.getElementById('ventilatore').style.visibility = "visible";}
       else
          { $('#cond').val('Turn on conditioner'); 
       document.getElementById('ventilatore').style.visibility = "hidden";
          }}
   
    });
    
   </script>
   
  
   
   <script>
       
    window.onload = function ()
        {
           
           var luce= "<?php echo file_get_contents($hostlocale.'/client.php?req=lux1'); ?>";
            var fuel = new RGraph.Fuel('idi5', 0, 1024, luce);
            fuel.Set('chart.needle.color', 'blue');
            fuel.Set('chart.colors', ['Gradient(blue:red)']);
            fuel.Set('chart.text.color','white');
            fuel.Set('chart.labels.empty', 'Dark');
            fuel.Set('chart.labels.full', 'Light');
            if(luce < 100)
            {
                fuel.Set('chart.icon', 'images/luna.gif');
            }
            else
                {
                fuel.Set('chart.icon', 'images/sole.gif');  
                }
            fuel.Draw();
           
           var temp= "<?php echo file_get_contents($hostlocale.'/client.php?req=temp1'); ?>";
            temp = parseFloat(temp);        
            var thermometer = new RGraph.Thermometer('idi2', 0,50,temp);
            var grad = thermometer.context.createLinearGradient(15,0,70,0);
            grad.addColorStop(0,'blue');
            grad.addColorStop(0.5,'red');
            grad.addColorStop(1,'yellow');
            thermometer.Set('chart.colors',[grad]);
            thermometer.Set('chart.adjustable',false);
            thermometer.Draw();
            
            var thermometer2 = new RGraph.Thermometer('idi3', 0,50,temp);
            var grad = thermometer2.context.createLinearGradient(15,0,70,0);
            grad.addColorStop(0,'blue');
            grad.addColorStop(0.5,'red');
            grad.addColorStop(1,'yellow');
            thermometer2.Set('chart.colors',[grad]);
            thermometer2.Set('chart.adjustable',false);
            thermometer2.Draw();
            
            var thermometer3 = new RGraph.Thermometer('idi4', 0,50,temp);
            var grad = thermometer3.context.createLinearGradient(15,0,70,0);
            grad.addColorStop(0,'blue');
            grad.addColorStop(0.5,'red');
            grad.addColorStop(1,'yellow');
            thermometer3.Set('chart.colors',[grad]);
            thermometer3.Set('chart.adjustable',false);
            thermometer3.Draw();
        };
        
        
 </script>
</head>
<body>
    <div><a href="logout.php" ><img src="images/Webdome.png" heigth="140px" width="140px"style="position:absolute;"></a>
        <label style="top:25%; position: absolute;"> Welcome </label>
        <label style="top:27%; position: absolute; left:5%; color: blue; font-size: 120%"> <?php echo $_SESSION['nome']; ?></label>
<input type="button" class="button small blue ronded" id="inputid" value="Logout" onclick="top.location.href='logout.php'">
<input type="button" class="button small blue ronded" id="inputid2" value="Profile" onclick="top.location.href='logout.php'">        
    </div>
    <script> ajaxF("state",stateChangedl);</script>
    <div id="all"> 
        <div id="id1"><img id="imgH" widht="500" height="500" > </div>
    <div id="id2"><canvas id="idi2" width="70" height="150"> </canvas></div>
     <div id="id3"><canvas id="idi3" width="70" height="150"> </canvas> </div>
     <div id="id4"><canvas id="idi4" width="70" height="150"> </canvas> </div>
     <div id="id8"><canvas id="idi5" width="300" height="150"> </canvas> </div>

       <div id="pul1">
         <input type="button"name="b1" id="b1" onClick="javascript:btnSoggiorno();">
       </div>
       <div id="pul2">
         <input type="button"name="b2" id="b2" onClick="javascript:btnCamera();" > 
       </div>
       <div id="pul3">
         <input type="button" name="b3"  id="b3" onClick="javascript:btnBagno();"> 
       </div>
      <div id="pul4">
         <input type="button" name="b4"  id="b4" onClick="javascript:btnPorta();"> 
      </div>
     <div>
         <img id="btnP" src="images/pericolo.gif" />
       </div>
     <div>
         <img id="ventilatore" src="images/ventilatore.gif" />
       </div>
     <div id="box" style="z-index: 8; left:360px; top:470px; position:absolute; width: 800px;">
        
         <input type="button" id="nascondit" style="width:150px ; height: 30px;"class="button small blue rounded" value="Hidden Temperatures">
         <input type="button" id="nascondil" style="width:150px ; height: 30px;"class="button small blue rounded" value="Hidden brightness">
         <input type="button" id="btnVideo" style="width:150px ; height: 30px;"class="button small blue rounded" value="Show video" onClick="javascript:btnWebcam();">
     </div>
     <div> <input type="button" class="button small blue rounded"id="cond" style="position: absolute;width:150px ; height: 30px;" value="Turn on conditioner" onClick="javascript:btnCond();"></div>
    <div id="webcam"> <img src="<?php echo $_SESSION['hostWebcam']; ?>"/></div>
 <a href="mailto:carmine.ferraro1@students.uniparthenope.it" > <p align="center"><b><font style="width: 1000px; top:105%;left: -20%;position: absolute;text-decoration: none; color: blue;font-family: Papyrus; font-size:15px; line-height: 20px; letter-spacing: 1">
            Web App created for the Web tecnology's exam of University Parthenope  <br>-Ferraro Carmine-Colucci Emanuele-De Rosa Fabio-
            <br> The code is open </font></b></p></a>   
 </div>
</body>
</html>
