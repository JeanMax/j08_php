<?php

session_start();





echo "<meta charset='utf8'>";

class Bateau { 
	public $weapon = array('1' => "pistolet", '2' => 'fusil', '3' => 'bazooka');
	public $nb_pp = 9;

	public $is_still = true;
}

$black_pearl = new Bateau;

function form_order($vessel) {
	

	echo "	<div>
				<link rel='stylesheet' type='text/css' href='form.css'>
				<form class='formulaire' action='form.mv.php' method='POST'>";


				if ($_POST['check_pp'] === false)
				{
					echo "Le nombre de PP n\'est pas infini";
					$_POST['check_pp'] == true;
				}


			echo	"	<input type='number' min='0' max='$vessel->nb_pp' name='pp_speed' placeholder='PP'>&nbsp PP attribué(s) à la vitesse</br>
					<input type='number' min='0' name='pp_shield' placeholder='PP'>&nbsp PP attribué(s) au bouclier</br>";

	$i = 0;
	foreach ($vessel->weapon as $weapon) {
		echo "<input type='number' min='0' name='pp_gun[".$i."]' placeholder='PP'>&nbsp PP attribué(s) à l'arme ".$weapon."</br>";
		$i++;
	}

	if ($vessel->is_still) {
		echo "<input type='number' min='0' name='pp_repair' placeholder='PP'>&nbsp PP attribué(s) à la réparation</br>";
	}
		echo "<input type='submit' name='valider' value='Valider'>";
	echo "</form></div>";
}

form_order($black_pearl);

?>