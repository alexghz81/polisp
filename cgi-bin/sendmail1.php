<?php
//	ini_set('display_errors',0);
//	error_reporting(E_ALL ^E_NOTICE);
//	error_reporting(E_ALL);
		
	$name = "";  													# name
	$phone = "";													# phone	
	$policy = "";  													# type of policy
	$email ="zaglushka@polisp.ru"; 									# email  это заглушка для корректной работы функции mail()
	$subject = "Заявка на полис с сайта polisp.ru";        
	$to = "info@polisp.ru";
			
			
	if (isset($_POST['submit'])) 
	{
		$name = substr(htmlspecialchars(stripslashes(trim($_POST['name']))), 0, 150); # убираем пробелы,экранирование, проверяем на спецсимволы и переполнение буфера (MAX=150 символов)
				
	    $phone = substr(htmlspecialchars(stripslashes(trim($_POST['phone']))), 0, 20); 	 # убираем пробелы,экранирование,проверяем на спецсимволы и переполнение буфера (MAX=20 символов) 
		
		$policy = substr(htmlspecialchars(stripslashes(trim($_POST['policy']))), 0, 100); # убираем пробелы,экранирование, проверяем на спецсимволы и переполнение буфера (MAX=100 символов) 
				
				
		if((!empty($name)) && (!empty($phone)))
		{					
			switch($policy){
				
				case "auto":
				$policy = "полис автострахования";
				break;
				
				case "property":
				$policy = "страхование имущества";
				break;
				
				case "med":
				$policy = "медицинское страхование";
				break;
				
				case "commission":
				$policy = "комиссионное оформление";
				break;
				
				case "event":
				$policy = "страховой случай";
				break;
				
				case "check":
				$policy = "проверка полиса ОСАГО";
				break;
			}
			
			$head = "MIME-Version: 1.0\n";
    		$head .= "Content-Type: text/plain; charset=UTF-8\n";
    		$head .= "From: ". $name . " <" . $email. ">";
			
			$text = "Заявка на полис с сайта polisp.ru от:\n";
			$text .= "Имя: ". $name . "\n";
			$text .= "Контактный телефон: " . $phone . "\n";
			$text .= "Причина обращения: " . $policy . "\n\n\n";
					
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