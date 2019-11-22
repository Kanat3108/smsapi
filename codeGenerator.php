<?php

require "config.php";

// Check if the form is submitted
if ( isset( $_POST['user'] ) && isset($_POST['phone'])  ) {


	//set checkboxes
	$trade = $_POST['trade'];
    $portfolio = $_POST['portfolio'];
    $experience = $_POST['experience'];
    $phone_plus = $_POST['phone'];

    //generate code 6 digits
    $code = mt_rand(100000, 999999);

    //prepare for sms API
	$token = 'da3ZPeqPv8EQB9gpWp7D8mDu';

	//prepare phone format
	$phone =str_replace("+", "", $phone_plus);
	
	//sms text
	$message = 'Globtrex:%20'. $code .'%20je%20Váš%20ověřovaci%20kód.';
	
	//url ready
	$url = 'https://api.imediafile.com/sms?accessToken=' . $token . '&message=' . $message . '&phone=00' . $phone;
	$newUrl = htmlspecialchars_decode($url);


	//Captcha keys
	$secret = "6LfcvcMUAAAAAOllfBr5LKGOXIZhHm39hqwlc6Go";
    $response_cap = $_POST["captcha"];

    //Captha url
    $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response_cap."");
    $captcha_success=json_decode($verify);
    
    //If captcha success
    if ($captcha_success->success) {

		//Connection to DB
		try {

		    $connection = new PDO($dsn, $username, $password, $options);

		    $new_user = array(
			  	"user"		=> $_POST['user'],
			  	"phone"     => $phone_plus,
			  	"code"      => $code,
			  	"trade"     => $trade,
			  	"portfolio" => $portfolio,
			  	"experience"=> $experience,
			);

			$sql = sprintf(
	    		"INSERT INTO %s (%s) values (%s)",
	    		"users",
	    		implode(", ", array_keys($new_user)),
	    		":" . implode(", :", array_keys($new_user))
			);

			$statement = $connection->prepare($sql);

			//Connect to API
			if ($statement->execute($new_user)){
				$response = file_get_contents($newUrl);
	  			$response = json_decode($response);
			};

			//return response
			echo 'true';
	        return;

	  	} catch(PDOException $error) {

	    	echo $error->getMessage();
	        return;

	  	}
  	}else{
  		echo 'False';
  		return;
  	}


}

?>