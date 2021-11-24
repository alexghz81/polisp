<?php
//	ini_set('display_errors',0);
//	error_reporting(E_ALL ^E_NOTICE);
//	error_reporting(E_ALL);
		
	$name = "";  													# name
	$phone = "";													# phone	
	$message = "";  												# message
	$email ="zaglushka@polisp.ru"; 									# email  это заглушка для корректной работы функции mail()
	$subject = "Письмо с сайта polisp.ru";        
	$to = "info@polisp.ru";
			
			
	if (isset($_POST['submit'])) 
	{
		$name = substr(htmlspecialchars(stripslashes(trim($_POST['name']))), 0, 150); # убираем пробелы,экранирование, проверяем на спецсимволы и переполнение буфера (MAX=150 символов)
				
	    $phone = substr(htmlspecialchars(stripslashes(trim($_POST['phone']))), 0, 20); 	 # убираем пробелы,экранирование,проверяем на спецсимволы и переполнение буфера (MAX=20 символов) 
		
		$message = substr(htmlspecialchars(stripslashes(trim($_POST['message']))), 0, 2000); # убираем пробелы,экранирование, проверяем на спецсимволы и переполнение буфера (MAX=2000 символов) 
				
				
		if((!empty($name)) && (!empty($phone)))
		{					
			$head = "MIME-Version: 1.0\n";
    		$head .= "Content-Type: text/plain; charset=UTF-8\n";
    		$head .= "From: ". $name . " <" . $email. ">";
			
			$text = "Письмо с сайта polisp.ru от:\n";
			$text .= "Имя: ". $name . "\n";
			$text .= "Контактный телефон: " . $phone . "\n\n\n";
			$text .= "Сообщение: " . $message . "\n";
					
			$result = mail($to, $subject, $text, $head);
			
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