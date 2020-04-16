<?php
include ('functions.php');

$table_name='users';
$primary_key_column_name='user_id';
$search_criteria=array('fname'=>'Rushdi', 'lname'=>'Mohamed');

$data=array('table_name'=>$table_name, 'primary_key_column_name'=>$primary_key_column_name, 'search_criteria'=>$search_criteria );
$res=json_encode($data);

echo check_record_availability($res);
?>
