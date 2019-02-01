<?php

		// $chute = array();
$palpites = explode(",", $_POST['chute']);
// $jogador = $_POST['jogador'];
$numAdversario = explode(",", $_POST['numJogador']);

// $numObjetivo1 = array(3,5,2,6);
// $numObjetivo2 = array(9,3,7,0);

		// $palpites = array(3,2,5,6);
$tiro = 0;
$bomba = 0;


for ($i=0; $i < sizeof($numAdversario); $i++) {
	for ($j=0; $j < sizeof($numAdversario); $j++) {
		if ($numAdversario[$i] == $palpites[$j] && $i == $j) {
				// echo "bomba <br>";
				// echo $palpites[$j]."<br>";
			$bomba++;
		}

		if ($numAdversario[$i] == $palpites[$j] && $i != $j) {
				// echo "tiro <br>";
				// echo $palpites[$j]."<br>";
			$tiro++;
		}
	}
}

$res['tiro'] = $tiro;
$res['bomba'] = $bomba;
$res['chute'] = $palpites;
$res['jogador'] = $_POST['jogador'];

echo json_encode($res);

?>