<?php

$post_date = file_get_contents("php://input");
$data = json_decode($post_date);


	$field1_name= "";
    $field2_name= "";
    $field3_name= "";

if (isset($data->name)) 
{

	$field1_name= $data->name;
    $field2_name= $data->username;
    $field3_name= $data->email;




$username="root";
$password="";
$database="sohnim";


mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query = "INSERT INTO users 
VALUES('','$field1_name','$field2_name','$field3_name')";
$result = mysql_query($query);
//echo $result;
mysql_close();
}
?>