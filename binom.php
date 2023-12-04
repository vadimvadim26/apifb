<?php

$a = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(floatval($_GET['revenue']) > 0 && !empty($_GET['revenue'])){
   $a = str_replace("binom.php","sale.php",$a);
}else{
   $a = str_replace("binom.php","lead.php",$a);
}
echo file_get_contents($a);