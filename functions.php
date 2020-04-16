include ('config.php');
function check_record_availability($data){
	$res=json_decode($data,true);
	$table_name=$res['table_name'];
	$primary_key=$res['primary_key_column_name'];
	$search_criteria=$res['search_criteria'];
	
	$paramTypes="";
	$valuesArray=array();
	$q="";
	if(count($search_criteria)>0){
		$q=" WHERE ";
		$c=0;
		foreach($search_criteria as $k=>$v){
			if(!empty($v)){
				$paramTypes.="s";
				$valuesArray[]="$v";
				$q.="$k=(?) AND ";
			}
		}
	}
	$q=rtrim($q,' AND ');
	$conn=config();
	$query="SELECT $primary_key FROM $table_name $q ";
	
	$inputArray[] = &$paramTypes;
	$j = count($valuesArray);
	for($x=0;$x<$j;$x++){$inputArray[] = &$valuesArray[$x];}
	$stmt = mysqli_prepare($conn,$query);
	if ($stmt) {
		call_user_func_array(array($stmt, 'bind_param'), $inputArray);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $primary_key_val);
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt)>0) {
			$errono=1;$erromsg='Results found';
		}else{
			$errono=0;$erromsg='Results does not exit';
		}
	}else{
		$errono=0;$erromsg='Something wrong with the query';
	}
	mysqli_stmt_close($stmt);
	
	$result['errorno']=$errono;
	$result['errormsg']=$erromsg;
	return (json_encode($result));
	exit();
}
