<?php

require_once 'include/db1.php';
require_once 'include/functions.php';

/*$captcha = $_POST['g-recaptcha-response'];*/
// Provera ispravnosti CAPTCHA koda
 if(isset($_POST['captcha']) && !empty($_POST['captcha'])){
	$secret = "6LcwwVsUAAAAABYUuccps-m2QgwqA9GQt-gx3n1K";
	//$response = $_POST['g-recaptcha-response'];
	$captcha=$_POST['captcha'];
	/*$captcha=$_POST['g-recaptcha'];*/
	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
	$responseData = json_decode($verifyResponse);

	/*if ($responseData->success) {*/


		$allowed_params = allowed_post_params(['ime','email','broj', 'usluga', 'notes','submit']);
		// niz sadrzi dozvoljene maksimalne duzine za sva polja
		$fields_lengths = ['ime' =>128, 'email' => 128,'broj' => 128, 'usluga'=>256, 'notes'=>1024];
		$ime = $_POST['ime'];
		$email = $_POST['email'];
    $broj = $_POST['broj'];
    $usluga = $_POST['usluga'];
		$notes = $_POST['notes'];


		// provera da li su polja odgovoarajuce duzine
		foreach ($fields_lengths as $field => $length) {
		if (!has_length($_POST[$field], ['min' => 0, 'max' => $length])) {
			header('Location: greska.html');
			die();
		}
		}

		try {
		// Priprema upita za unos podataka u bazu
		$prep = $db->prepare("INSERT INTO usluge (ime, email, broj, usluga, notes) VALUES(:ime, :email, :broj, :usluga, :notes)");
		$prep->bindParam(':ime', $ime);
		$prep->bindParam(':email', $email);
    $prep->bindParam(':broj', $broj);
		$prep->bindParam(':usluga', $usluga);
    $prep->bindParam(':notes', $notes);

		$ime = isset($allowed_params['ime']) ? $allowed_params['ime'] : "";
		$email = isset($allowed_params['email']) ? $allowed_params['email'] : "";
  	$broj = isset($allowed_params['broj']) ? $allowed_params['broj'] : "";
		$usluga = isset($allowed_params['usluga']) ? $allowed_params['usluga'] : "";
    $notes = isset($allowed_params['notes']) ? $allowed_params['notes'] : "";
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
			$email_to = 'office@cryptoinvestment.rs'; // treba da bude  'milicapavlovic0312@gmail.com';
			$subject = "CRYPTOINVESTMENT - Kontakt forma";
			$headers = "From: $emailod\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$email_message = "Poruka " . "<br><br>";
			$email_message .= "Ime: $ime " . "<br>";
      $email_message .= "broj: $broj " . "<br>";
      $email_message .= "Usluga: $usluga " . "<br>";
			$email_message .= "Notes: $notes" . "<br>";



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
