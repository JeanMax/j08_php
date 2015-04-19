<<?php 

session_start();

echo "<meta charset='utf8'>";


	include('bdd.php');
	is_log();
	$game = unpack_game();

$black_pearl = new Bateau;
function check_mv($tab/*$_POST*/, $vessel/*le ship selectionn3é*/) 
{

	$i = 1;
	print_r($_POST);
	foreach ($_POST['maneuvre'] as $nb)
	{
		if ($nb != 'none')
		{
			if ($_POST['pp_speed'][$i] < $vessel->nb_maneuvre)
			{
				$_POST['check_pp'] = 0;
				header("location: form.mv.php");
			}
		}	
		$i++;
	}
	foreach ($_POST['pp_speed'] as $nb)
	{
		$nb_pp_speed = $nb_pp_speed + $nb;
	}
	echo "speeeeeed";
	echo $nb_pp_speed;
	echo "ojsdoskj";
	echo $_SESSION['speed_max'];
	if ($vessel->is_still != true && $nb_pp_speed < $vessel->nb_maneuvre)
	{
		$_POST['check_pp'] = 0;
		header("location: form.mv.php");
	}

	if ($nb_pp_speed > $_SESSION['speed_max'])
	{
		$_POST['check_pp'] = 0;
		header("location: form.mv.php");
	}
	else
		$_POST['check_pp'] = true; 	
	}
//}

$tabmvt = $_POST;
//print_r($_POST);


// a pas oublier 
//$vessel->moves($tabmvt, $game); // checker le nom  de la calsse vaisseau !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function check_pp_gun($tab) {
	print_r($_SESSION['pp_gun']);
	$pp_gun = 0;
	foreach ($_SESSION['pp_gun'] as $key => $value) {

		$pp_gun = $pp_gun + $value;
	}
//	if ($pp_gun > $_SESSION[])
}



function form_shoot($vessel) {

	check_mv($_POST, $vessel);
	check_pp_gun($_POST);
	echo "<div> 
				<link rel='stylesheet' type='text/css' href='form.css'>
				<form class='formulaire' action='testgun.php' method='POST'>";
	$i = 0;
	//$vessel->weapon['pistolet'] = [1,2,3];
	foreach ($vessel->weapon as $weapon) {
		echo "<p> PP attribué(s) à l'arme ".$weapon."</p></br>";
			echo "<input type='number' min='0' name='weapon[".$i."][1]' placeholder='pp'>&nbsp porte_courte<br />";
				 echo "<input type='number' min='0' name='weapon[".$i."][2]' placeholder='pp'>&nbsp porte_moyenne<br />";
			 		echo "<input type='number' min='0' name='weapon[".$i."][3]' placeholder='pp'>&nbsp porte_longue<br />";
		$i++;
		}

	echo "<input type='submit' name='valider' value='Valider'>";
		echo "</form></div>";

}

form_shoot($black_pearl);


	
	pack_game($game);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Shoots</title>
</head>
<body>

</body>
</html>