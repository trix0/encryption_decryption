<?php

$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName="exc1";
	// Create connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);

// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

function fnEncrypt($func,$input_message,$secret_key){
	//returns encrypted message as array ;
	$enrypted_message=[];
	$cipher="";


	//return ecb encrypted message;
	if($func=="ecb"){
		array_push($enrypted_message,base64_encode(@mcrypt_encrypt('tripledes',$secret_key,$input_message,'ecb'))); // encrypt and push to array
	}

	//return cbc encrypted message + iv message index 0           iv index 1;
	elseif($func=="cbc"){
		$iv=mcrypt_create_iv(mcrypt_get_iv_size('tripledes','cbc'),MCRYPT_DEV_URANDOM); //create iv
		$cipher_text_cbc=mcrypt_encrypt('tripledes',$secret_key,$input_message,'cbc',$iv); // encrypt
		array_push($enrypted_message,base64_encode($cipher_text_cbc)); // push encoded message to array
		array_push($enrypted_message,$iv); // push iv to array
	}
	//wrong function name;
	else{
		echo("Wrong function name enc");
	}
	return $enrypted_message; // return array 
}

function fnDecrypt($func,$input_message,$secret_key,$iv="base"){
	
	$input_cipher=base64_decode($input_message);
	
	//return ecb decrypted message
		if($func==="ecb"){
			$decrypted_message=mcrypt_decrypt('tripledes',$secret_key,$input_cipher,'ecb');
		}
	

	//return cbc decrypted message
		elseif($func==="cbc"){
			$decrypted_message=mcrypt_decrypt('tripledes',$secret_key,$input_cipher,'cbc',$iv);

		}


	//wrong function name
		else{
			echo("Wrong function name dec");	
		}
		return $decrypted_message;

}

function fnSaveToDb($message,$iv="notset",$conn){

	$stmt = $conn->prepare("INSERT INTO `message`(`message`, `iv`) VALUES (:message,:iv)");
	$stmt->bindParam(':message',$message);
	$stmt->bindParam(':iv', $iv);
	$stmt->execute();
}


function fnSelectFromDb($id,$conn){
	$stmt = $conn->prepare("SELECT * FROM message WHERE message_id = :id");
	$stmt->bindParam(":id", $id);
	$stmt->execute();
	$row  = $stmt -> fetch();
	return $row;
}




$message="Secret message. Do not share";
$secretKey="ThisIsASecretKey12345678";
//$secretKey="12345678";
$cipher=fnEncrypt("cbc",$message,$secretKey);
fnSaveToDb($cipher[0],$cipher[1],$conn);
echo("<br>");
$finall=fnDecrypt("cbc",$cipher[0],$secretKey,$cipher[1]);
echo($finall);
fnSelectFromDb(1,$conn);



