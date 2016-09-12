<?php
class AdminController extends Controller{

	public function index(){
		$title = "Administracija";
		self::view('admin', $title);
	}

	public function korisnici($params){
		$title = "korisnici";
		if(isset($params[0])) {
			switch ($params[0]) {
				case 'Blokirani':
					$filter = "WHERE status = 0";
					break;
				case 'Aktivni':
					$filter = "WHERE status = 1";
					break;
				case 'Administratori':
					$filter = "WHERE status = 2";
					break;
				default:
					$filter = "";
					break;
			}
			$users = User::getAll($filter);
		}else{
			$users = User::getAll();
		}
		self::view('admin_users', $title, $users);
	}

	public function porudzbine($params){
		$title = "Porudzbine";
		$filter = "join korisnici on narudzbenice.korisnik = korisnici.korisnik_id join sadnice on narudzbenice.sadnica = sadnice.sadnica_id where narudzbenice.status = 1";
		if (isset($params[0])) {
			switch ($params[0]) {
				case 'Korpe':
					$filter .= " AND n_status = 1";
					break;
				case 'Obrada':
					$filter .= " AND n_status = 2";
					break;
				case 'Prihvacene':
					$filter .= " AND n_status = 3";
					break;
				case 'Poslate':
					$filter .= " AND n_status = 4";
					break;
				case 'Zatvorene':
					$filter .= " AND n_status = 5";
					break;
				default:
					$filter .= "";
					break;
			}
			$orders = Narudzbenice::getAll($filter);
		}else{
			$orders = Narudzbenice::getAll($filter);
		}
		self::view('admin_orders', $title, $orders);
	}

	public function proizvodi($params){
		$title = "Proizvodi";
		$kategorije = Kategorije::getAll();
		$filter = "WHERE status = 1 ORDER BY naziv";
		$sadnice = Sadnice::getAll($filter);
		$sadnica = null;
		if (isset($params[0]) && ($params[0] > 0)) {
			$sadnica = Sadnice::get($params[0]);
		}
		self::view('admin_products', $title, $sadnice, $kategorije, $sadnica);
	}
}