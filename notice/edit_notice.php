<?php 
 if(isset($_GET['id'])) {
	 $id = (isset($_GET['id'] && !empty($_GET['id']))? $_GET['id'] : null;
 } 
?>