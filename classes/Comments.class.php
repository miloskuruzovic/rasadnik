<?php


class Comments extends Entity {
	public static $tableName = 'komentari';
	public static $keyColumn = 'komentar_id';

	public function render() {
		echo '<div id="comment_container" class="panel panel-default">';
        echo $this->komentar;
        echo '<br><br><div class="right"><i >'.$this->ime.' '.$this->prezime.', '.$this->vreme.'</i></div>';
        echo (isset($_SESSION['status']) && ($_SESSION['status'] == 2))?
        '<br><br>
        <a href="admin_remove_comment.php?c_id='.$this->komentar_id.'"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>'
        :'</div>';
      
	}
	
}