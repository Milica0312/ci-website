<?php

require_once 'include/db.php';
require_once 'include/functions.php';

/*$captcha = $_POST['g-recaptcha-response'];*/
// Provera ispravnosti CAPTCHA koda
 if(isset($_POST['captcha']) && !empty($_POST['captcha'])){
	$secret = "6LdAJ00UAAAAAERgVF8zZIcNmAv1eRnk2l0Yr4I4";
	//$response = $_POST['g-recaptcha-response'];
	$captcha=$_POST['captcha'];
	/*$captcha=$_POST['g-recaptcha'];*/
	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
	$responseData = json_decode($verifyResponse);

	/*if ($responseData->success) {*/


		$allowed_params = allowed_post_params(['ime','email', 'pitanje','submit']);
		// niz sadrzi dozvoljene maksimalne duzine za sva polja
		$fields_lengths = ['ime' => 64, 'email' => 64, 'pitanje'=>64];
		$ime = $_POST['ime'];
		$email = $_POST['email'];
		$pitanje = $_POST['pitanje'];


		// provera da li su polja odgovoarajuce duzine
		foreach ($fields_lengths as $field => $length) {
		if (!has_length($_POST[$field], ['min' => 0, 'max' => $length])) {
			header('Location: greska.html');
			die();
		}
		}

		try {
		// Priprema upita za unos podataka u bazu
		$prep = $db->prepare("INSERT INTO kontakt_forma (ime, email, pitanje) VALUES(:ime, :email, :pitanje)");
		$prep->bindParam(':ime', $ime);
		$prep->bindParam(':email', $email);
		$prep->bindParam(':pitanje', $pitanje);


		$ime = isset($allowed_params['ime']) ? $allowed_params['ime'] : "";
		$email = isset($allowed_params['email']) ? $allowed_params['email'] : "";
		$pitanje = isset($allowed_params['pitanje']) ? $allowed_params['pitanje'] : "";

		// izvrsavanja upita
		$rez = $prep->execute();
		//header('Location: index.php');
		/*$htmltable = "Hvala na ucescu TEST.";
		echo 'test';*/


		} catch (PDOException $e) {
		echo 'greska kod upita';

		}
		// Ukoliko je upis u bazu uspesan, salje se mejl korisnuku i klijentu o uspesnoj prijavi
		if ($rez) {

			$emailod = "$email";
			$email_to = 'office@uniada.org'; // treba da bude  'milicapavlovic0312@gmail.com';
			$subject = "UNIADA - Kontakt forma";
			$headers = "From: $emailod\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$email_message = "Pitanje " . "<br><br>";
			$email_message .= "Ime: $ime " . "<br>";
			$email_message .= "Pitanje: $pitanje " . "<br>";



			if (mail($email_to, $subject, $email_message, $headers)) {
				//header('Location: index.php');
        $htmltable = "Hvala na postavljenom pitanju. Očekujte odgovor u roku od 24h.";
                echo $htmltable;
			} else {
				echo 'greska kod slanja mail f';
			die();
			}
		} else {
			echo 'greska kod emaila-dva';
			die();
		}



}else{
	echo 'Molimo Vas popunite captcha kod.';
    die();
}


?>
