<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css"/>
 
    <title>Status</title>
  </head>
  <body>
    <h2 class="text-center">Status Diario</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                <div class="col-md-1"></div>
                    <div class="col-md-9">
                        <form action="import.php" method="POST" enctype="multipart/form-data">
                            <div class="card card-body shadow">    
                                <div class="row">
                                    <div class="col-md-2 my-auto">
                                        <h5>Selecione o Arquivo</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="import_file" class="form_control"/>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" name="import_file_btn" class="btn btn-primary">Importa Status</button>
                                        <a href="../usina/usina.php"><button type="button" class="btn btn-success" data-bs-toggle="modal">E-mail Usinas</button></a>
                                    </div>
                                </div>
                            </div>    
                        </form>
                        <hr>
                        <?php 
                            if(isset($_SESSION['ok']))
                            {
                                echo "<h5>".$_SESSION['ok']."</h5>";
                                unset ($_SESSION['ok']);
                            }
                        ?>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-9">
                        <table id="datatable" class="table">
                            <thead>
                                <th>ID</th>
                                <th>Cavalo</th>
                                <th>Motorista</th>
                                <th>Carreta 1</th>
                                <th>Carreta 2</th>
                                <th>Vol</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     
    <!--Add usuario Modal-->
    <!-- Modal -->

    <script type="text/javascript">
        $(document).ready(function() {
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
                            alert('Registro conclúido!');
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
                            <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
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
                            <label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="_inputMobile" name="_inputMobile">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputCity" class="col-sm-2 col-form-label">City</label>
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
       
  </body>
</html>
