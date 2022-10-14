<?php
session_start();

include "conexao.php";

require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//CRIANDO O METODO DE IMPORTAÇAO 

if(isset($_POST['import_file_btn']))
{
    $allowed_ext = ['xls', 'csv', 'xlsx'];

    $fileName = $_FILES['import_file']['name'];
    $checking = explode(".",$fileName);
    $file_ext = end($checking);

    if(in_array($file_ext, $allowed_ext))  
    {
        $targetPath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        
        foreach($data as $row)
        
        {
            $id = $row['0'];
            $cavalo = $row['1']; 
            $motorista = $row['2'];
            $carreta1 = $row['3'];
            $carreta2 = $row['4'];
            $vol = $row['5'];

            $checkCavalo = "SELECT id FROM status WHERE id='$id'";
            $checkCavalo_result = mysqli_query($con, $checkCavalo);
            
            if(mysqli_num_rows($checkCavalo_result) > 0)
            {
                $up_query = "UPDATE `status` SET cavalo='$cavalo',motorista='$motorista',carreta1='$carreta1',carreta2='$carreta2',vol='$vol' WHERE id='$id'";
                $up_result = mysqli_query($con, $up_query);
                $msg = 1;
            }
            else
            {
                $in_query = "INSERT INTO `status` (cavalo,motorista,carreta1,carreta2,vol) VALUES ('$cavalo','$motorista','$carreta1','$carreta2','$vol')";
                $in_result = mysqli_query($con, $in_query);
                $msg = 1;
            }

        }
        if(isset($msg))
        {
            $_SESSION['ok'] = "Importado Com Sucesso!";
            header("location: index.php");
        }
        else
        {
            $_SESSION['ok'] = "Erro Na Importação!";
            header("location: index.php");
        }
        }
        
    else
    {
        $_SESSION['ok'] = "Arquivo invalido!";
        header("Location: index.php");
        exit(0);
    }
}    
?>
