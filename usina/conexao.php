<?php
   $con = mysqli_connect('localhost','nome do banco','senha','tabela');
   
   if(mysqli_connect_errno())
   {
    echo "Servido não conectado!";
    exit;
   }
?>
