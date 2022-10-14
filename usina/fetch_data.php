<?php

include('conexao.php');

$output= array();
$sql = "SELECT * FROM users ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'username',
	2 => 'email',
	3 => 'mobile',
	4 => 'city',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE username like '%".$search_value."%'";
	$sql .= " OR email like '%".$search_value."%'";
	$sql .= " OR mobile like '%".$search_value."%'";
	$sql .= " OR city like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$subarray = array();
	$subarray[] = $row['id'];
	$subarray[] = $row['username']; 
	$subarray[] = $row['email'];
	$subarray[] = $row['mobile'];
	$subarray[] = $row['city'];
	$subarray[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-sm
   		 btn-info ">Atualizar</a>  <a href="javascript:void();" data-id="_'.$row['id'].'"  
		 class="btn btn-sm btn-danger " >Excluir</a>';
	$data[] = $subarray;
}

$output = array(
	'data'=>$data,
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_all_rows,
	'recordsFiltered'=> $filtered_rows,
);
echo  json_encode($output);

