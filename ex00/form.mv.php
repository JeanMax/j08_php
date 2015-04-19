<?php 

session_start();
	include('bdd.php');
require_once('Dice.trait.php');
require_once("Player.class.php");
require_once("Zone.class.php");
require_once("Laser.class.php");
require_once("Destroyer.class.php");
require_once("Vaisseau_mere.class.php");


	is_log();
	if (($game = unpack_game()) == false)
	{
		$s1 = New Vaisseau_mere();
    $s2 = New Destroyer();
    $s3 = New Vaisseau_mere();
    $s4 = New Destroyer();
        $s1->setXMin(142);
    $s1->setXMax(148);
    $s1->setYMin(95);
    $s1->setYMax(97);
    $s1->setActivated(true);
    $s1->setSprite("img/vaisseau_mereLEFT.png");

    $s2->setXMin(138);
    $s2->setXMax(148);
    $s2->setYMin(90);
    $s2->setYMax(92);
    $s2->setSprite("img/destroyerLEFT.png");


    $s3->setXMin(1);
    $s3->setXMax(7);
    $s3->setYMin(2);
    $s3->setYMax(4);



    $p1 = New player([$s1, $s2]);
    $p2 = New player([$s3, $s4]);

    $game = new zone(array("p1" => $p1,
                        "p2" => $p2));
    	pack_game($game);
	}



   



function roll()
    {
        return rand(1, 6);
    }

$name = $_GET['id']; 
$joueur = $_GET['joueur']; 
if ($joueur == 1)
	$ship = $game->getP1()->getShips();
else
	$ship = $game->getP2()->getShips();
foreach ($ship as $key => $value) {
	if ($value->name == $name)
		$black_pearl = $value;
}




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
<meta charset='utf8'>
	<title>Mouvements</title>
</head>
<body>

</body>
</html>