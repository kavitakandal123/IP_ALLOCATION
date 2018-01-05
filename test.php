<?php
//echo preg_match('/^[0-9][0-9][0-9].[0-9][0-9][0-9].[0-9][0-9][0-9].[0-9][0-9][0-9]*$/','980.999.909.987');
 echo date_format(date_create(),'d/m/Y');


?>

<!--<input type="text" name="aa" value="bb" style="border:0px solid white"/> &emsp; <div name="IP_div" id="IP_div" > </div>
<input type="submit" name="submit" value="submit" onclick="load()"/>
<script type="text/javascript">
                 function load() {
                   if(window.XMLHttpRequest) {
                   xmlhttp=new XMLHttpRequest();
                   } else{
                   xmlhttp=new ActiveXObject(Microsoft.XMLHTTP);
                   }

                   xmlhttp.onreadystatechange=function(){
                   if(xmlhttp.readyState==4 && xmlhttp.Status==200) {
                    document.getElementById('IP_div').innerHTML=xmlhttp.responseText;
                   }
                  }
                  xmlhttp.open("GET","hello",true);
                  xmlhttp.sent();
                 }
                 </sript>   --!>