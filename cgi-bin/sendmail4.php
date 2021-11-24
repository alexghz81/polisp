<?php
//	ini_set('display_errors',0);
//	error_reporting(E_ALL ^E_NOTICE);
//	error_reporting(E_ALL);
		
	$name = "";  														# name
	$email =""; 														# email  
	$phone = "";														# phone 	
	$message = "";  													# message 
	$subject = "Заявка с формы обратной связи polisp.ru";       
	$to = "info@polisp.ru";
	$bademail = "";
	$emailintext = "";
			
			
	if (isset($_POST['submit'])) 
	{
		$name = substr(htmlspecialchars(stripslashes(trim($_POST['name']))), 0, 150); # убираем пробелы,экранирование, проверяем на спецсимволы и переполнение буфера (MAX=150 символов)
				
	    $phone = substr(htmlspecialchars(stripslashes(trim($_POST['phone']))), 0, 20); 	 # убираем пробелы,экранирование,проверяем на спецсимволы и переполнение буфера (MAX=20 символов) 
		
		$email = substr(htmlspecialchars(stripslashes(trim($_POST['email']))), 0, 50);  # убираем пробелы, проверяем на спецсимволы и переполнение буфера (MAX=50 символов)

				

		$send = preg_match("/^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$/i", $email);
		if($send == 0)
		{
			$bademail = $email;
			$emailintext =  "Контактный e-mail: " . $bademail . "\n\n";
			$email="zaglushka@polisp.ru";     // если введенный e-mail не прошел проверку, то подставляем заглушку для корректной работы функции mail()
		}
		else
		{
			$emailintext = "Контактный e-mail: " . $email . "\n\n";
		}
				
		if((!empty($name)) && (!empty($phone)) && (!empty($email)))
		{					
			$head = "MIME-Version: 1.0\n";
    		$head .= "Content-Type: text/plain; charset=UTF-8\n";
    		$head .= "From: ". $name . " <" . $email. ">";
			
			$message = "Сообщение с формы обратной связи сайта polisp.ru от:\n";
			$message .= "Имя: ". $name . "\n";
			$message .= "Контактный телефон: " . $phone . "\n";
			$message .= $emailintext;
			
					
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
		
	}
	else
		{
			exit("Произошла ошибка при обработке формы");
		}	
?>