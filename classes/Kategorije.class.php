<?php

class Kategorije extends Entity {
	public static $tableName = 'kategorije';
	public static $keyColumn = 'kategorija_id';

	public function render(){
		echo '<div class="kategorije">';
		echo '<div class="col-sm-4">';
      	echo '<h3 class="kat_h3">' . $this->naziv_kategorije . '</h3>';
      	echo '<a href="Home/Sadnice/' . $this->naziv_kategorije . '">';
      	echo '<img src="img/cat/' . $this->kategorija_id . '.jpg" class="img-responsive img-circle" alt="' . $this->naziv_kategorije .'">';
    	echo '</a></div></div>';
	}
}