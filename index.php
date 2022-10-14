<?php

//VALIDANDO O HCAPTCHA

// if($_POST){
//     $curl = curl_init();
//     curl_setopt_array($curl, [
//         CURLOPT_URL => 'https://hcaptcha.com/siteverify',
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_CUSTOMREQUEST => 'POST',
//         CURLOPT_POSTFIELDS => [
//             'response' => $_POST[h-captcha-response] ?? '',
//             'secret' => 0x0d8014659B806604AF6EA44A747341cf2c85DfEf
//         ]
//     ]);
//     // EXECUTANDO O CURL
//     $response = curl_exec($curl);
//     curl_close($curl);
    
//     //VALIDANDO O ENVIO
//     $responseArray = json_decode($response,true);
    
//     $sucesso = $responseArray['success'] ?? false;
    
//     echo $sucesso ? "validado" : "invalido";
//     exit;
    
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!--Hcaptcha-->
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
    <script>
        function validarform(){
            //verificando si Hcaptch foi selecionado
            if(hcaptcha.getResponse() != "") return true;
            return false;
        }
    </script>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins' sans-serif;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #B84AA5;
        }
        .container{
            position: relative;
            width: 80vw;
            height: 70vh;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .container::before{
            content: "";
            position: absolute;
            top: 0;
            left: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(-45deg, #df4adf, #520852);
            z-index: 6;
            transform: translateX(100%);
            transition: 1s ease-in-out;
        }
        .telalogin{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            z-index: 5;
        }
        form{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 40%;
            min-width: 238px;
            padding: 0 10px;
        }
        .titulo{
            font-size: 35px;
            color: #961A81;
            margin-bottom: 10px;
        }
        .input-field{
            width: 100%;
            height: 50px;
            background: #f0f0f0;
            margin: 10px 0;
            border: 2px solid #961A81;
            border-radius: 50px;
            display: flex;
            align-items: center;
        }
        .input-field i{
            flex: 1;
            text-align: center;
            color: #666;
            font-size: 18px;
        }
        .input-field input {
            flex: 5;
            background: none;
            border: none;
            outline: none;
            width: 100%;
            font-size: 18px;
            font-weight: 600;
            color: #444;
        }
        .inputs{
            width: 150px;
            height: 50px;
            border: none;
            border-radius: 50px;
            background: #961A81;
            color: #fff;
            font-weight: 600;
            margin: 10px 0;
            text-transform: uppercase;
            cursor: pointer;
        }    
        .inputs:hover{
            background: #c03cc0;
        }
        .paineis-containers{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .painel{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            width: 35%;
            min-width: 238px;
            padding: 0 10px;
            text-align: center;
            z-index: 6;
        }
        .esquerdo{
            pointer-events: none;
        }
        .painel p{
            font-size: 15px;
            padding: 10px 0;
        }
        .image{
            width: 100%;
            transition: 1.1s ease-in-out;
            transition-delay: 0.4s;
        }
        .container.sign-mode::before{
            transform: translateX(0);
        }
        .esquerdo .image,
        .esquerdo .content{
            transform: translateX(-300%);
        }
        .direito .image,
        .direito .content{
            transform: translateX(0);
        }
        .painel h3{
            font-size: 24px;
            font-weight: 600;
        }
        .texto-conta{
            display: none;
        }
        .content{
            color: #fff;
            transition: 1.1s ease-in-out;
            transition-delay: 0.5s;
        }
        .container.sign-mode .direito .image,
        .container.sign-mode .direito .content{
            transform: translateX(220%);
        }
        .container.sign-mode .esquerdo .image,
        .container.sign-mode .esquerdo .content{
            transform: translateX(0);
        }
        .container.sign-mode .direito{
            pointer-events: none;
        }
        .container.sign-mode .esquerdo{
            pointer-events: all;
        }
        /* RESPONSIVIDADES */
        @media (max-width:779px){
            .container {
                width: 100vw;
                height: 100vh;
            }
        }
        @media (max-width: 635px){
            .container::before {
                display: none;
            }
            form{
                width: 80%;
            }
            form.telaentradaform{
                display: none;
            }
            .container.sign-mode1 form.telaentradaform{
                display: flex;
                opacity: 1;
            }
            .container.sign-mode1 form.telaregistroform{
                display: none;
            }
            .paineis-containers{
                display: none;
            }
            .texto-conta{
                display: initial;
                margin-top: 30px;
        }
        }
        @media (max-width:320px){
            form {
                width: 90%;
            }
        }
    </style>
    </style>
    <title>Sistema CEDT</title>
</head>
<body>
    <?php
    require 'usina/conexaouser.php';
    ?>
    <div class="container">
        <div class="telalogin">
            <!-- fomulario de login -->
            <form onsubmit="return validarform()" method="POST" action="validausuario.php" name="login" class="telaentradaform">
                <h2 class="titulo">Login</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="email" name="email" placeholder="E-mail">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <div class="h-captcha" data-sitekey="fedb6b02-93da-4758-8e87-4d7afb8d5c4e"></div> <!--botao hcaptcha-->
                <button type="submit" name="login" class="inputs">Entrar</button>
                <p class="texto-conta">Não tem cadastro? <a href="#" id="login1">Registre-se</a></p>
            </form>
            <!-- formulario de cadastro -->
            <form action="" class="telaregistroform">
                <h2 class="titulo">Não possui cadastro no sistema?</h2><b>
                    <p>Entre em contato com o desenvolvedor para si registrar...</p>
                </b>
                <!-- <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Nome">
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="text" placeholder="E-mail">
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-id-card"></i>
                    <input type="text" placeholder="Matricula">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="text" placeholder="Senha">
                </div>
                <input type="submit" value="Registrar-se" class="inputs"> -->
                <p class="texto-conta">Já tenho uma conta. <a href="#" id="cadastro1">Acessar</a></p>
            </form>
        </div>
        <div class="paineis-containers">
            <div class="painel esquerdo">
                <div class="content">
                    <h3>Faça seu login</h3>
                    <p>Tenha um otima experiência!</p>
                    <button class="inputs" id="login">Login</button>
                </div>
                <img src="signin.svg" alt="" class="image">
            </div>    
            <div class="painel direito">
                <div class="content">
                    <h3>Não possui cadastro?</h3>
                    <button class="inputs" id="cadastro">Registrar-se</button>
                </div>
                <img src="signup.svg" alt="" class="image">
            </div>    
        </div>
    </div>
    <!-- fazendo o movimento da tela -->
    <script>
        const login = document.querySelector("#login");
        const cadastro = document.querySelector("#cadastro");
        const container = document.querySelector('.container');
        const login1 = document.querySelector("#login1");
        const cadastro1 = document.querySelector("#cadastro1");

        cadastro.addEventListener("click", () =>{
            container.classList.add("sign-mode");
        });

        login.addEventListener("click", () =>{
            container.classList.remove("sign-mode");
        });

        cadastro1.addEventListener("click", () =>{
            container.classList.add("sign-mode1");
        });

        login1.addEventListener("click", () =>{
            container.classList.remove("sign-mode1");
        });

    </script>
</body>
</html>