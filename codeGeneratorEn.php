<?php

require "config.php";



 // Check if the form is submitted
if ( isset( $_POST['user'] ) && isset($_POST['phone'])  ) {

    //prepare variables
    $trade = $_POST['trade'];
    $portfolio = $_POST['portfolio'];
    $experience = $_POST['experience'];
    $phone_plus = $_POST['phone'];

    //Sms api keys
	$token = 'da3ZPeqPv8EQB9gpWp7D8mDu';

    //Generate sms code random
	$code = mt_rand(100000, 999999);

    //SMS message
	$message = 'Globtrex:%20'. $code .'%20is%20Your%20verification%20code.';

	//Change phone format for DB
	$phone =str_replace("+", "", $phone_plus);

    //Sms API url 
	$url = 'https://api.imediafile.com/sms?accessToken=' . $token . '&message=' . $message . '&phone=00' . $phone;
	$newUrl = htmlspecialchars_decode($url);

    //Captcha key
    $secret = "6LfcvcMUAAAAAOllfBr5LKGOXIZhHm39hqwlc6Go";
    $response_cap = $_POST["captcha"];

    //Connect Captcha API
    $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response_cap."");
    $captcha_success=json_decode($verify);
    
    //If Captcha success
    if ($captcha_success->success) {

        //Connect to DB
         try {

            $connection = new PDO($dsn, $username, $password, $options);

            $new_user = array(
                "user"      => $_POST['user'],
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

            if ($statement->execute($new_user)){
                $response = file_get_contents($newUrl);
                $response = json_decode($response);
                //print_r($response);

            };

            echo 'true';
            return;



        } catch(PDOException $error) {

            echo $error->getMessage();
            return;
            //echo "<span style='color:#fff'> Email already exists .</span>";

        }

    }else {
      
      echo 'fail';  
       
    }


//}
}

?>