<?php
   $con = mysqli_connect('localhost','','','');
   
   if(mysqli_connect_errno())
   {
    echo "Servido não conectado!";
    exit;
   }
?>
