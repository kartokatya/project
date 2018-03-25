<?php	
	if(isset($_SESSION['id'])){	
    include "action.php";	
	echo "<script type='text/javascript'>document.getElementById('log').style.display = 'none';</script>";
}
?>