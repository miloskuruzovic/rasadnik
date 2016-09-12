<?php
class HomeController extends Controller{
	public function index(){
		$kategorije = Kategorije::getAll();
		$filter = "WHERE status = 1 AND akcija = '1' ORDER BY RAND() LIMIT 6";
		$sadnice = Sadnice::getAll($filter);
		$title = "Akcija";
		self::view('index', $title, $sadnice, $kategorije);
	}
	public function contact(){
		$kategorije = Kategorije::getAll();
		$title = "Kontakt";
		$response = null;
		if(isset($_POST['send'])){
		  if(!empty($_POST['email']) && !empty($_POST['ime'])){
		      if(!empty($_POST['poruka'])){

		        $ime = $_POST['ime'];
		        $email = $_POST['email'];
		        $poruka = $_POST['poruka'];
		        require_once 'classes/PHPMailerAutoload.php';
		        $mail = new PHPMailer;
		        $mail->SMTPDebug = false;
		        $mail->isSMTP();
		        $mail->Host = "smtp.live.com";
		        $mail->SMTPAuth = true;
		        $mail->Username = "rasadnik@hotmail.com";
		        $mail->Password = "zavrsni2016";
		        $mail->SMTPSecure = "tls";
		        $mail->Port = 587;
		        $mail->From = $email;
		        $mail->FromName = $ime;
		        $mail->addAddress("miloskuruzovic@gmail.com", "Rasadnik");
		        $mail->isHTML(true);
		        $mail->Subject = "Poruka sa sajta.";
		        $mail->Body = $poruka . "<br> Ime: " . $ime . "<br> Email: " . $email;
		        $mail->AltBody = $poruka . " Ime: " . $ime . " Email: " . $email;

		        $response = $mail->send();
		      }
		    }
		}
		self::view('contact', $title, $response, $kategorije);
	}
	public function sadnice($params){
		$kategorije = Kategorije::getAll();
		$title = "Sadnice";
		$sadnice = null;
		if (isset($params[0])) {
  			$naziv_kategorije = $params[0];
  			$filter = "WHERE status = 1 AND naziv_kategorije = '" . $naziv_kategorije ."'";
  			$kategorija = Kategorije::getAll($filter)[0];
  			$filter = "WHERE status = 1 AND kategorija = $kategorija->kategorija_id ORDER BY akcija DESC";
  			$sadnice = Sadnice::getAll($filter);
  		}
		self::view('products', $title, $sadnice, $kategorije);
	}
	public function pretraga(){
		$kategorije = Kategorije::getAll();
		$title = "Pretraga";
		$sadnice = null;
		if (isset($_POST['search'])) {
			$unos = trim($_POST['search']);
			if (!empty($unos)) {
				$reci = explode(" ", $unos);
				$filter = "WHERE status = 1";
				foreach ($reci as $rec) {
      				$filter .= " AND naziv LIKE '%$rec%'";
    			}
      			$sadnice = Sadnice::getAll($filter);
			}
		}
		self::view('search', $title, $sadnice, $kategorije);
	}
	public function register(){
		$kategorije = Kategorije::getAll();
		$title = "Registracija";
		$response = null;
		if(isset(
		  $_POST['email'],
		  $_POST['password'], 
		  $_POST['ime'], 
		  $_POST['prezime'], 
		  $_POST['adresa'], 
		  $_POST['p_broj'], 
		  $_POST['grad'], 
		  $_POST['ip'])){
		    $email = trim($_POST['email']);
		    $lozinka = trim($_POST['password']);
		    $ime = trim($_POST['ime']);
		    $prezime = trim($_POST['prezime']);
		    $adresa = trim($_POST['adresa']);
		    $p_broj = trim($_POST['p_broj']);
		    $grad = trim($_POST['grad']);
		    $ip = trim($_POST['ip']);
		    if(
		      !empty($email)
		      &&
		      !empty($lozinka)
		      &&
		      !empty($ime)
		      &&
		      !empty($prezime)
		      &&
		      !empty($adresa)
		      &&
		      !empty($p_broj)
		      &&
		      !empty($grad)
		      &&
		      !empty($ip)
		      ){
      			require_once 'core/init.php';
      			$response = User::register($email, $lozinka, $ime, $prezime, $adresa, $p_broj, $grad, $ip);
    		}
		}
		self::view('register', $title, $response, $kategorije);
	}
	public function sadnica($params){
		$kategorije = Kategorije::getAll();
		$title = "";
		$sadnica = null;
		$komentari = null;
		if(isset($params[0])){
			$sadnica_id = (!empty($params[0]))?$params[0]:'';
			$sadnica = Sadnice::get($sadnica_id);
			if($sadnica)
			$title = $sadnica->naziv;
			else
			  header('Location: ' . Config::get('home'));
			$filter = "JOIN korisnici ON komentari.korisnik = korisnici.korisnik_id WHERE komentari.status = 1 AND komentari.sadnica = $sadnica_id ORDER BY vreme DESC LIMIT 5";
			$komentari = Comments::getAll($filter);
			if (isset($_POST['add_comment'])) {
			if(isset($_POST['komentar']) && !empty($_POST['komentar'])) {
				$komentar = new Comments;
				$komentar->korisnik = $_SESSION['korisnik_id'];
				$komentar->sadnica = $sadnica_id;
				$komentar->komentar = $_POST['komentar'];
				$komentar->ip = $_SERVER['REMOTE_ADDR'];

				$komentar->insert();
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}

		}

		self::view('product', $title, $sadnica, $kategorije, $komentari);
	}
	public function korpa(){
		$kategorije = Kategorije::getAll();
		$title = "Korpa";
		$narudzbenice = null;
		if(isset($_SESSION['korisnik_id'])){
			$korisnik = $_SESSION['korisnik_id'];
			$filter = "WHERE status = 1 AND korisnik = $korisnik AND n_status = 1";
			$narudzbenice = Narudzbenice::getAll($filter);
		}
		if (isset($_POST['buy_btn'])) {
			foreach ($narudzbenice as $narudzbenica) {
				Narudzbenice::update($narudzbenica->narudzbenica_id, array('n_status' => 2));
			}
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		self::view('cart', $title, $narudzbenice, $kategorije);
	}
	public function profile($params){
		$kategorije = Kategorije::getAll();
		$title = "Porudzbine";
		$narudzbenice = null;
		if(isset($params[0])){
			$korisnik = $params[0];
			if(!isset($_SESSION['korisnik_id'])){
  				header('Location: ' . Config::get('home'));
			}else if($_SESSION['korisnik_id'] != $korisnik){
    			header('Location: ' . Config::get('home'));
  			}
  			$filter = "WHERE status = 1 AND korisnik = $korisnik AND n_status != 1";
  			$narudzbenice = Narudzbenice::getAll($filter);
		}
		self::view('profile', $title, $narudzbenice, $kategorije);
	}

}