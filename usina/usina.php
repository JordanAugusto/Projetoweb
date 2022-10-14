<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css"/>
    <link rel="icon" href="icon.png">
     <!--STYLE DO CONTADOR -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script&family=Poppins:ital,wght@1,500&display=swap');
        .countdowncontainer{
            font-family: "poppins",sans-serif;
            min-height: 1.5vh;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }
        .fonttime{
            font-size: 1rem;
            padding: 1rem;
        }
        .day,.hour,.min,.second{
            font-size: 2rem;
            font-weight: bold;
            font-size: 36px;
            line-height: 1;
            margin: 0 0 5px;
        }    
        .countdown{
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-bottom: 2%;
        }
    </style>
    <title>E-mail Usinas</title>
  </head>
  <body>
   
       <!-- RELOGIO INICIO -->
    <section class="countdowncontainer">
        <div>
            <h2 class="fonttime">Estou de férias, volto assim que me encontrar...</h2>
            <div class="countdown">
                <div class="container-day">
                    <h3 class="day">Time</h3>
                    <h3></h3>
                </div>
                <div class="container-hour">
                    <h3 class="hour">Time</h3>
                    <h3></h3>
                </div>
                <div class="container-min">
                    <h3 class="min">Time</h3>
                    <h3></h3>
                </div>
                <div class="container-second">
                    <h3 class="second">Time</h3>
                    <h3></h3>
                </div>
            </div>    
        </div>
   </section>
   <script>
        const countdown = () => {
        // DEFININDO A DATA
        const countDate = new Date("October 23, 2022 00:00:00").getTime();
        const now = new Date().getTime();
        const remainingTime = countDate - now;

        const second = 1000;
        const minute = second * 60;
        const hour = minute * 60;
        const day = hour * 24;

        const textDay = Math.floor(remainingTime / day);
        const textHour = Math.floor((remainingTime % day) / hour);
        const textMinute = Math.floor((remainingTime % hour) / minute);
        const textSecond = Math.floor((remainingTime % minute) / second);

        document.querySelector(".day").innerText = textDay > 0 ? textDay : 0;
        document.querySelector(".hour").innerText = textHour > 0 ? textHour : 0;
        document.querySelector(".min").innerText = textMinute > 0 ? textMinute : 0;
        document.querySelector(".second").innerText = textSecond > 0 ? textSecond : 0;
    };
         setInterval(countdown, 500);  
   </script>
    <h2 class="text-center">E-mail Usinas</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-12">
                        <button type="button" style="margin-bottom: 40px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add Usina</button>
                        <a href="../status/index.php"><button type="button" style="margin-bottom: 40px;" class="btn btn-success" data-bs-toggle="modal">Status Diário</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-12">
                        <table id="datatable" class="table">
                            <thead>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Estado</th>
                                <th>Ações</th> 
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>    
    <!-- Optional JavaScript; choose one of the two! -->
    <?php include ('conexao.php') ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
    <!--Agregando Modal-->
    <!-- Modal Principal -->

    <script type="text/javascript">
        $('#datatable').DataTable({
                'serverSide':true,    
                'processing':true,
                'paging':true,
                'order':[], 
                'ajax':{
                    'url':'fetch_data.php',
                    'type':'post',
                },
                'fnCreatedRow':function(nRow,aData,iDataIndex)
                {
                    $(nRow).attr('id',aData[0]);    
                },
                'columnDefs':[{
                    'target':[0,5],
                    'orderable':false,
                }]
            }); 
    </script>
    <!--Registrando dados-->
    <script type="text/javascript">
        $(document).on('submit','#saveUserForm',function(event){
            event.preventDefault();
            var name = $('#inputUsername').val();
            var email = $('#inputMobile').val();
            var mobile = $('#inputEmail').val();
            var city = $('#inputCity').val();

            //SISTEMA DE REGISTRO DE USINAS
            if(name !='' && email !='' && mobile !='' && city !='')   
            {
                $.ajax({
                    url:"add_user.php",
                    data:{name:name,email:email,mobile:mobile,city:city},
                    type:'post',
                    success:function(data)
                    {
                        var json = JSON.parse(data);
                        status = json.status;
                        if(status=='success')
                        {
                            table = $('#datatable').DataTable();
                            table.draw();
                            alert('Registro Concluído!');
                            $('#inputUsername').val('');
                            $('#inputMobile').val('');
                            $('#inputEmail').val('');
                            $('#inputCity').val('');
                            $('#addUserModal').modal('hide');
                        } 
                    }
                }); 
            }
            else 
            {
                alert("Entre em contato com o desenvolvedor");
            }          
                
        });
        //ABRIANDO CAMPO ATUALIZAR
        $(document).on('click','.editBtn',function(event){
            var id = $(this).data('id');
            var trid = $(this).closest('tr').attr('id');
            $.ajax({
                url:"get_single_user.php",
                data:{id:id},
                type:"post",
                success:function(data)
                {
                    var json = JSON.parse(data);
                    $('#id').val(json.id);
                    $('#trid').val(trid);
                    $('#_inputUsername').val(json.username);
                    $('#_inputMobile').val(json.email);
                    $('#_inputEmail').val(json.mobile);
                    $('#_inputCity').val(json.city);
                    $('#editUserModal').modal('show');
                }
            });
        });
        //ATUALIZANDO
        $(document).on('submit','#updateUserForm',function(){
            var id = $('#id').val();
            var tri = $('#trid').val();
            var username = $('#_inputUsername').val();
            var email = $('#_inputMobile').val();
            var mobile = $('#_inputEmail').val();
            var city = $('#_inputCity').val();
            $.ajax({
                url:"update_user.php",
                data:{id:id,username:username,email:email,mobile:mobile,city:city},
                type:'POST',
                success:function(data)
                {
                    var json=JSON.parse(data);
                    status = json.status;
                    if(status=='success')
                    {
                        table = $('#datatable').DataTable();
                        var button = '<a href="javascript:void();" class="btn btn-sm btn-info" data-id="'+ id +'">Atualizar</a> <a href="javascript:void();" class="btn btn-sm btn-danger" data-id="'+ id +'">Excluir</a>';
                        var row = table.row("[id='" + trid + "']");
                        row.row("[id='" + trid + "']").data([id,username,email,mobile,city,button]); 
                        $('#editUserModal').modal('hide');  
                    }
                    else
                    {
                        alert("Erro ao Atualizar! Entre em contato com o desenvolvedor");
                    }
                }
            });
        });
        //FUNÇAO EXCLUIR
        $(document).on('click','.btnDelete',function(event){
        
            var id = $(this).data('id');
            $.ajax({
                url:"delete.php",
                data:{id:id},
                type: "post",
                success:function(data)
                {
                    var json = JSON.parse(data);
                    var status = json.status;
                    if(status=='success')
                    {
                        $('#' + id).closest('tr').remove();
                    }
                    else
                    {
                        alert('Erro ao excluir! Entre em contato com o desenvolvedor')
                    }
                }
            });
        });
    </script>
    <!--Inicio de Modal-->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Usina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--inicio form-->
                <form id="saveUserForm" action="javascript:void();" method="POST">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="inputUsername" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="inputUsername" id="inputUsername">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputMobile" class="col-sm-2 col-form-label">Tel.</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputMobile" name="inputMobile">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputCity" class="col-sm-2 col-form-label">Estado</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCity" name="inputCity">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>   
                <!--fim form--> 
            </div>
        </div>
    </div>
    <!--Add usuario Modal FIM-->
    <!--Inicio Editi-->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atualizar Usina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--inicio form-->
                <form id="updateUserForm" action="javascript:void();" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id" value="">
                        <input type="hidden" id="trid" name="trid" value="">
                        <div class="mb-3 row">
                            <label for="inputUsername" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="_inputUsername" id="_inputUsername">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="_inputEmail">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputMobile" class="col-sm-2 col-form-label">Tel</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="_inputMobile" name="_inputMobile">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputCity" class="col-sm-2 col-form-label">Estado</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="_inputCity" name="_inputCity">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>   
                <!--fim form--> 
            </div>
        </div>
    </div>
    <footer class="bg-light text-center text-lg-start">
      <!-- Copyright -->
      <div class="text-center p-3" >
        <strong>Copyright &copy; 2022</strong>
        All rights reserved.
        <a class="text-dark" href="https://www.linkedin.com/in/jordan-augusto/">Jordan Toledo</a>
        <b>Version</b> 1.8.0
      </div>
      <!-- Copyright -->
    </footer>
       
  </body>
</html>
