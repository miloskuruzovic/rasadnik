<?php

class Narudzbenice extends Entity {
	public static $tableName = 'narudzbenice';
	public static $keyColumn = 'narudzbenica_id';

	public function render(){
		echo '<div class="panel panel-default"><div class="panel-body"><div class="row"><div class="col-sm-1">';
		echo '<img src="img/plants/' . $this->sadnica . '.jpg" class="img-responsive"></div>';
  		echo '<div class="col-sm-3">' . $this->naziv_sadnice . '</div>';
  		echo '<div class="col-sm-2">Kolicina: ' . $this->kolicina . '</div>';
  		echo '<div class="col-sm-6 right">Cena: ' . $this->cena . '<br>';
  		echo '<a href="return.php?nid=' . $this->narudzbenica_id . '">Izbaci iz korpe</a>';
  		echo '</div></div></div></div>';
	}

	public function renderTrack(){
		echo '<div class="panel panel-default"><div class="panel-body"><div class="row"><div class="col-sm-1">';
		echo '<img src="img/plants/' . $this->sadnica . '.jpg" class="img-responsive"></div>';
  		echo '<div class="col-sm-3">' . $this->naziv_sadnice . '</div>';
  		echo '<div class="col-sm-2">Kolicina: ' . $this->kolicina . '</div>';
  		echo '<div class="col-sm-6 right">Status porudzbine: ';
  		
  			switch ($this->n_status) {
  				case "2":
  					echo '<span style="color:#7401DF;cursor:default" title="Vasa narudzbina je u procesu obrade">Obradjuje se.<span>';
  					break;
  				case "3":
  					echo '<span style="color:#04B4AE;cursor:default" title="Vasa narudzbina je prihvacena,ceka se na kurirsku sluzbu">Prihvaceno,ceka se na isporuku.<span>';
  					break;
  				case "4":
  					echo '<span style="color:#3ADF00;cursor:default" title="Vasa narudzbina je predata kurirskoj sluzbi">Poslato!<span>';
  					break;
  				case "5":
  					echo '<span style="color:#3A01DF;cursor:default" title="Isporuceno/Placeno">Zatvoreno!<span>';
  					break;
  				
  				default:
  					echo '<span style="color:red">Greska.<span>';
  					break;
  			};
  		echo '</div></div></div></div>';
	}

	public function renderAdmin(){
		echo '<tr><td>'. $this->narudzbenica_id .'</td>';
		echo '<td>'. $this->email .'</td>';	
		echo '<td>'. $this->ime . ' '. $this->prezime .'</td>';
		echo '<td>'. $this->adresa .'</td>';
		echo '<td>'. $this->grad .'</td>';
		echo '<td>'. $this->p_broj .'</td>';
		echo '<td>'. $this->datum_narucivanja .'</td>';
		echo '<td>'. $this->ip .'</td>';
		echo '<td>#'. $this->sadnica . ' - '. $this->naziv_sadnice .'</td>';
		echo '<td>'. $this->kolicina .'</td>';
		echo '<td>'. $this->cena .'</td>';
		switch ($this->n_status) {
				case "1":
  					echo '<td>U korpi</td>';
  					break;
  				case "2":
  					echo '<td>Obrada</td>';
  					break;
  				case "3":
  					echo '<td>Prihvaceno</td>';
  					break;
  				case "4":
  					echo '<td>Poslato</td>';
  					break;
  				case "5":
  					echo '<td>Isporuceno</td>';
  					break;		
  				default:
  					echo '<span style="color:red">Greska.<span>';
  					break;
  			};
  		echo '<td><div class="btn-group">';
  		switch ($this->n_status) {
  			case '1':
  				echo '<a href="admin_manage_orders.php?z_o_id='. $this->narudzbenica_id .'" class="btn btn-default">Zatvori</a>';
  				break;
  			case '2':
  				echo '<a href="admin_manage_orders.php?p_o_id='. $this->narudzbenica_id .'" class="btn btn-default">Prihvati</a>';
  				echo '<a href="admin_manage_orders.php?z_o_id='. $this->narudzbenica_id .'" class="btn btn-default">Zatvori</a>';
  				break;
  			case '3':
  				echo '<a href="admin_manage_orders.php?i_o_id='. $this->narudzbenica_id .'" class="btn btn-default">Isporuci</a>';
  				echo '<a href="admin_manage_orders.php?z_o_id='. $this->narudzbenica_id .'" class="btn btn-default">Zatvori</a>';
  				break;
  			case '4':
  				echo '<a href="admin_manage_orders.php?z_o_id='. $this->narudzbenica_id .'" class="btn btn-default">Zatvori</a>';
  				break;

  			default:
  				# code...
  				break;
  		}
  		echo '</div></td>';
  		echo ($this->stanje < 10)?'<td style="color:red;font-size:1.3em"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td></tr>':'</tr>';
	}

}