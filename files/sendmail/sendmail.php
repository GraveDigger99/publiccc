<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	/*
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'user@example.com';                     //SMTP username
	$mail->Password   = 'secret';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	*/

	//От кого письмо
	$mail->setFrom('from@gmail.com', 'Зайцев.ru'); // Указать нужный E-mail
	//Кому отправить
	$mail->addAddress('ibrahimovaydin@mail.ru'); // Указать нужный E-mail


	//Тема письма
	$mail->Subject = 'Зайцев.ru';

	//Тело письма
	$body = '<h1>письмо!</h1>';

	//if(trim(!empty($_POST['email']))){
		//$body.=$_POST['email'];
	//}	
	if(trim(!empty($_POST['username']))){
		$body.='<p><strong>имя:</strong>'.$_POST['username']. '</p>';
	}	
	if(trim(!empty($_POST['usermail']))){
		$body.='<p><strong>почта пользователя:</strong>'.$_POST['usermail']. '</p>';
	}	
	if(trim(!empty($_POST['userphone']))){
		$body.='<p><strong>телефон пользователя:</strong>'.$_POST['userphone']. '</p>';
	}	
	if(trim(!empty($_POST['userposition']))){
		$body.='<p><strong>Должность:</strong>'.$_POST['userposition']. '</p>';
	}	
	if(trim(!empty($_POST['field']))){
		$body.='<p><strong>Сфера деятельности:</strong>'.$_POST['field']. '</p>';
	}	
	/*
	//Прикрепить файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//путь загрузки файла
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузим файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото в приложении</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Данные отправлены!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>