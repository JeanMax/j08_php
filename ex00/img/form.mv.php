<<?php 

session_start();
	include('bdd.php');
	is_log();
	$game = unpack_game();
require_once('Dice.trait.php');
echo "<meta charset='utf8'>";



function roll()
    {
        return rand(1, 6);
    }


$black_pearl = new Bateau;


    $_SESSION['pp_gun'] = $_POST['pp_gun'];
function check_order($vessel) {
	
print_r($_POST);


	if ($_POST['check_pp'] === false)
	echo "le nombre de deplacement n\'est pas infinis";

$nb_pp_weapon = 0;
//print_r($_POST);
foreach ($_POST['pp_gun'] as $nb)
	$nb_pp_weapon = $nb_pp_weapon + $nb;
 
//$tab['pp_gun'] = $tab['pp_gun'];


if (($_POST['pp_speed'] + $_POST['pp_shield'] +  $_POST['pp_repair'] + $nb_pp_weapon) > $vessel->_pp) //verfifier la sintaxte pp moteur !!!!
	{
		$_POST['check_pp'] = false; 
		header("location: form.order.php");
	}
else
	$_POST['check_pp'] = true; 	


}


function form_mv($vessel) {


$_SESSION['pp_gun'] = $_POST['pp_gun'];

check_order($vessel);

//use Dice;

$resdice = 0;

$j = 0;

while ($j < $_POST['pp_speed'])
{
	$resdice = $resdice + roll();
	$j++;
}

$speed_max = $vessel->speed + $resdice;
$_POST['speed_max'] = $speed_max;
$_SESSION['speed_max'] = $speed_max;
	echo "	<div>
				<link rel='stylesheet' type='text/css' href='form.css'>
				<form class='formulaire' action='form.shoot.php' method='POST'>";
			

				if ($_POST['check_pp'] == 0)
					echo "le nombre de deplacement est pas infinis";
				echo "
				<p> Mouvemenent maximum <span id='speed_max'>".$speed_max."</span></p>
				<p> Point maneuvre ".$vessel->nb_maneuvre."</p>";

if ($vessel->is_still) {
$i = 0;
echo "	
<select name='maneuvre_free'>
  <option value='none'>None</option>
  <option value='tribord'>Tribord</option>
  <option value='babord'>Babord</option>
</select>&nbsp Maneuvre avant mouvement";
}
	$nb_action_mv = $speed_max / $vessel->nb_maneuvre;
	if ($speed_max % $vessel->nb_maneuvre != 0)
		$i = 1;
	else
		$i = 0;
		while ($i < $nb_action_mv)
		{
			echo "</br><input type='number' min='0' max='$speed_max' name='pp_speed[".$i."]' placeholder='PP'>&nbsp Case de deplacement</br>
					<select name='maneuvre[".$i."]'>
 					<option value='none'>None</option>
  					<option value='tribord'>Tribord</option>
  					<option value='babord'>Babord</option>
					</select>&nbsp Maneuvre
					<br />";
					$i++;	
		}


	echo "<input type='submit' name='valider' value='Valider'>";

	
	echo "</form></div>";
}

form_mv($black_pearl);

	
	pack_game($game);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mouvements</title>
</head>
<body>

</body>
</html>