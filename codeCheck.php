<?php

require "config.php";

if ( isset( $_POST['code'] ) ) {

	$code = $_POST['code'];
	$phone = $_POST['phone'];
	$user = $_POST['user'];

	$connection = new PDO($dsn, $username, $password, $options);

	$sql = "SELECT phone, code
		FROM users 
		WHERE (phone=:phone
		AND code=:code)";


  	$statement = $connection->prepare($sql);
  	$statement->execute(array(
  		':phone' => $phone,
  		':code'  => $code,
  	));



    //print_r($statement);
  	if($statement->rowCount() > 0){
    	//echo json_encode([result => true]);	
  		echo '1';

  		
	} else{
		echo '0';
		//echo json_encode([result => false]);
		
	}

	






}