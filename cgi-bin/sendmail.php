<?php
//	ini_set('display_errors',1);
//	error_reporting(E_ALL ^E_NOTICE);
//	error_reporting(E_ALL);
		
	$email ="zaglushka@polisp.ru"; 										# email  это заглушка для корректной работы функции mail()
	$phone = "";														# phone
	$subject = "Заявка на обратный звонок с сайта polisp.ru";
	$message = ""; 														# message          
	$to = "info@polisp.ru";
			
			
	if (isset($_POST['submit'])) 
	{
		
				
	    $phone = substr(htmlspecialchars(stripslashes(trim($_POST['phone']))), 0, 20); 	 # убираем пробелы,экранирование,проверяем на спецсимволы и переполнение буфера (MAX=20 символов) 
		if((!empty($phone)))
		{					
			$head = "MIME-Version: 1.0\n";
    		$head .= "Content-Type: text/plain; charset=UTF-8\n";
    		$head .= "From: ". $phone . " <" . $email . ">\n"  . "X-Mailer: php";
			
			$message = "Заявка на обратный звонок с сайта polisp.ru от:\n";
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