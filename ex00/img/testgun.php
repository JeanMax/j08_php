<?php  
  
session_start();

//print_r($_SESSION['pp_gun']);

function check_pp_gun($tab) {
print_r($_POST);

	$pp_gun = 0;
	foreach ($_POST['weapon'][$i++] as $value) {

		$pp_gun = $pp_gun + $value;
	}
	echo "pp_gun";
	echo $pp_gun;
	$session_gun = 0;
	foreach ($_SESSION as $value) {
		$session_gun = $session_gun + $value;
	}
	if ($pp_gun > $session_gun)
	{
		$_POST['check_pp'] = 0;
		header("location: form.shoot.php");
	}


}


$tab_shout = $_POST;

//nom de la fonction

check_pp_gun($_POST);

?>