<?php

class Sadnice extends Entity {
  public static $tableName = 'sadnice';
  public static $keyColumn = 'sadnica_id';

  public function render($korpa = false){
      echo '<div class="col-sm-4">';
          echo '<div class="proizvod panel panel-';
          echo ($this->akcija == 0)?'success">':'warning">';
          echo '<div class="panel-heading">' . $this->naziv . '</div>';
          echo '<div class="panel-body"><img src="img/plants/' . $this->sadnica_id . '.jpg" class="img-responsive" style="width:100%" alt="' . $this->naziv .'"></div>';
          echo ($korpa)?'':'<div class="panel-footer buy"><a href="Home/Sadnica/' . $this->sadnica_id . '">Detaljnjije...</a></div>';
          echo '<div class="panel-footer">';
          echo '<div class="row">';
          echo '<div class="col-sm-6 left">'. $this->cena. ' din.</div>';
          echo ($korpa)?'':'<div class="col-sm-6 right buy"><a href="Home/Sadnica/' . $this->sadnica_id . '">Dodaj u korpu <i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>';
          echo '</div></div>';
        echo '</div></div>';
  }

  public static function updateStanje($narudzbenica_id){

    $narudzbenica = Narudzbenice::get($narudzbenica_id);
    $sadnica = Sadnice::get($narudzbenica->sadnica);
    $novo_stanje = $sadnica->stanje - $narudzbenica->kolicina;

    $db = Connect::getInstance();
    $db->beginTransaction();

    $db->query("UPDATE sadnice SET stanje = {$novo_stanje} WHERE sadnica_id = $sadnica->sadnica_id");

    if ($novo_stanje >= 0) {
      $db->commit();
    }else{
      $db->rollback();
    }
  }
}