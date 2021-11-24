<?php
//	ini_set('display_errors',1);
//	error_reporting(E_ALL ^E_NOTICE);
//	error_reporting(E_ALL);
		
	$name = "";  														# name
	$email ="zaglushka@polisp.ru"; 								        # email  это заглушка для корректной работы функции mail()
	$phone = "";														# phone
	$subject = "Заявка на обратный звонок с сайта";
	$message = ""; 														# message          
	$to = "info@polisp.ru";
			
			
	if (isset($_POST['submit'])) 
	{
		
		$name = substr(htmlspecialchars(stripslashes(trim($_POST['name']))), 0, 150); # убираем пробелы,экранирование, проверяем на спецсимволы и переполнение буфера (MAX=150 символов)
				
	    $phone = substr(htmlspecialchars(stripslashes(trim($_POST['phone']))), 0, 20); 	 # убираем пробелы,экранирование,проверяем на спецсимволы и переполнение буфера (MAX=20 символов) 
		if((!empty($name)) && (!empty($phone)))
		{					
			$head = "MIME-Version: 1.0\n";
    		$head .= "Content-Type: text/plain; charset=UTF-8\n";
    		$head .= "From: ". $name . " <" . $email . ">\n"  . "X-Mailer: php";
			
			$message = "Заявка на обратный звонок с сайта от:\n";
			$message .= "Имя: ". $name . "\n";
			$message .= "Контактный телефон: " . $phone . "\n\n";
			
					
			$result = mail($to, $subject, $message, $head);
			
			
			if($result == FALSE)
			{
				exit("Произошла ошибка при отправке данных");
			}
			else
				{
					header ("Location: ".$_SERVER['HTTP_REFERER']);
				}		
		}
		else
				{
					header ("Location: ".$_SERVER['HTTP_REFERER']);
				}	
		
	}
	else
		{
			exit("Произошла ошибка при обработке формы");
		}	
?>