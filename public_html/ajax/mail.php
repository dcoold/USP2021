<?php
	header('Content-Type: application/json; charset=UTF-8');
	
	include('../functions.php');
	
	if(isset($_POST['action']) && $_POST['action'] == 'manageMail'){ 
		$userNames = strip_tags(trim($_POST['name'])) != '' ? htmlentities(strip_tags(trim($_POST['name']))) : null;
		$userEmail = strip_tags(trim($_POST['email'])) != '' ? strip_tags(trim($_POST['email'])) : null;
		$userPhone = strip_tags(trim($_POST['phone'])) != '' ? strip_tags(trim($_POST['phone'])) : null;
		$userMsg = strip_tags(trim($_POST['message'])) != '' ? strip_tags(trim($_POST['message'])) : null;
		if(!$userNames) wa_json_error('Въведете Вашите имена!');
		if(!$userEmail) wa_json_error('Посочете валиден имейл адрес за обратна връзка');
		if(!$userMsg) wa_json_error('Вашето запитване е празно.');
		
		$userEmail = filter_var($userEmail, FILTER_SANITIZE_EMAIL);
		if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) wa_json_error('Посоченият имейл е невалиден!');
		
		$to = 'jordanov@web-arts.bg';
		$subject = "Запитване от {$userNames}";
		$message = '<p><b>Име:</b> '. $userNames .'</p>
					<p><b>Еmail:</b> '. $userEmail .'</p>                        
					<p><b>Телефон:</b> '. $userPhone .'</p>                        
					<p><b>Текст:</b> '. $userMsg .'</p>'; 
		$headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
		$headers .= "From: Cooking Master <Contact form>\r\n"; 
		$headers .= "Reply-To: ". $userEmail . "\r\n";
		
		mb_language("uni");
		mb_internal_encoding("UTF-8");
		mb_send_mail($to, $subject, $message, $headers);
		wa_json_success('Благодарим Ви за проявения интерес. Ще се свържем с Вас при първа възможност.');
	}	
	
	wa_json_error('Съобщението не беше изпратено.');
	
	
?>