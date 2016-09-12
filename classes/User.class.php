<?php

class User extends Entity {
	public static $tableName = 'korisnici';
	public static $keyColumn = 'korisnik_id';

	public static function login($email,$lozinka) {
		$db = Connect::getInstance();
		$className = get_called_class();
		$stmtLogin = $db->prepare('CALL user_login(:email, :lozinka)');

		$stmtLogin->bindValue("email", $email);
		$stmtLogin->bindValue("lozinka", $lozinka);

		$stmtLogin->execute();

		if($stmtLogin->rowCount() < 1){
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}else{

		$r = $stmtLogin->fetchObject($className);

		session_start();

		$_SESSION['korisnik_id'] = $r->korisnik_id;
		$_SESSION['email'] = $r->email;
		$_SESSION['ime'] = $r->ime;
		$_SESSION['prezime'] = $r->prezime;
		$_SESSION['status'] = $r->status;
		$_SESSION['w'] = ($r->status == 2)?'adminW':'userW';
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['korpa'] = array();

		}

	}

	public static function register($email, $lozinka, $ime, $prezime, $adresa, $p_broj, $grad, $ip){

		$db = Connect::getInstance();
		$className = get_called_class();
		$stmtRegister = $db->prepare('CALL user_reg(:email, :lozinka, :ime, :prezime, :adresa, :p_broj, :grad, :ip)');

		$stmtRegister->bindValue("email", $email);
		$stmtRegister->bindValue("lozinka", $lozinka);
		$stmtRegister->bindValue("ime", $ime);
		$stmtRegister->bindValue("prezime", $prezime);
		$stmtRegister->bindValue("adresa", $adresa);
		$stmtRegister->bindValue("p_broj", $p_broj);
		$stmtRegister->bindValue("grad", $grad);
		$stmtRegister->bindValue("ip", $ip);

		$stmtRegister->execute();

		$r = $stmtRegister->fetchObject($className);

		if (!isset($r->ODGOVOR)) {
			$hash = md5($email);
			$poruka = "
			<h1>
				Rasadnik
			</h1>
			<hr>
			<p>
			Hvala vam &#353;to ste se registrovali na na&#353;em sajtu.Da biste dovr&#353;ili proces registracije - kliknite <a href=" . Config::get('home') . "aktivacija.php?hash=" . $hash . ">OVDE</a> i nakon toga mo&#382;ete da se ulogujete na sajt!
			</p>
			<hr>";
			require_once 'PHPMailerAutoload.php';
			$mail = new PHPMailer;
			$mail->STMPDebug = false;
			$mail->isSMTP();
			$mail->Host = "smtp.live.com";
			$mail->SMTPAuth = true;
        	$mail->Username = "rasadnik@hotmail.com";
        	$mail->Password = "zavrsni2016";
        	$mail->SMTPSecure = "tls";
        	$mail->Port = 587;
        	$mail->From = "rasadnik@hotmail.com";
        	$mail->FromName = "Rasadnik";
        	$mail->addAddress($email, $ime);
        	$mail->isHTML(true);
        	$mail->Subject = "Dobrodo&#353;li!";
        	$mail->Body = $poruka;
        	$mail->send();

		}

		return (isset($r->ODGOVOR))?"<div class='alert alert-warning'>$r->ODGOVOR</div>":"<div class='alert alert-success'>Uspesna registracija! Aktivacioni mail vam je poslat na email adresu koju ste uneli!</div>";

	}

	public static function activate($hash) {
		$db = Connect::getInstance();
		$q = "UPDATE korisnici SET status = 1 WHERE md5(email) = '{$hash}' LIMIT 1";
		$res = $db->query($q);
		return ($res->rowCount() > 0);
	}

	public function renderTableRow(){
		echo '<tr><td>'. $this->korisnik_id .'</td>';
		echo '<td>'. $this->email .'</td>';	
		echo '<td>'. $this->ime . ' '. $this->prezime .'</td>';
		echo '<td>'. $this->adresa .'</td>';
		echo '<td>'. $this->grad .'</td>';
		echo '<td>'. $this->p_broj .'</td>';
		echo '<td>'. $this->reg_datum .'</td>';
		echo '<td>'. $this->ip .'</td>';
		echo '<td>'. $this->status .'</td>';
		echo '<td>
				<div class="btn-group">
  				<a href="admin_manage_users.php?b_u_id='. $this->korisnik_id .'" class="btn btn-default">0</a>
  				<a href="admin_manage_users.php?a_u_id='. $this->korisnik_id .'" class="btn btn-default">1</a>
  				<a href="admin_manage_users.php?m_u_id='. $this->korisnik_id .'" class="btn btn-default">2</a>
				</div>
			  </td></tr>';
	}

}