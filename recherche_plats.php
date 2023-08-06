<?php
$plats = array(
	array(
		'nom' => 'Salade de poulet  au fromage   1550RS',
		'ingredients' => array('poulet', 'fromage')
	),
    array(
		'nom' => 'Salade de poulet  au teriyaki   2050RS',
		'ingredients' => array('poulet', 'boeuf')
	),
    array(
		'nom' => 'Salade de poulet  au saumon teriyaki   3000RS',
		'ingredients' => array('poulet', 'saumon')
	),
    array(
		'nom' => 'Salade de poulet  à la crème d avocat   1000RS',
		'ingredients' => array('poulet', 'avocat')
	),
    array(
		'nom' => 'Salade de poulet  à la Loco Moco  1000RS',
		'ingredients' => array('poulet', 'oeuf')
	),
	array(
		'nom' => 'Teriyaki de Bœuf Hawaïen 700 RS',
		'ingredients' => array('boeuf', 'légumes', 'sauce')
	),
	array(
		'nom' => 'Saumon teriyaki 1000 RS',
		'ingredients' => array('saumon')
	),
    array(
		'nom' => 'Saumon Lomi 1000 RS',
		'ingredients' => array('saumon')
	),
	array(
		'nom' => 'Ratatouille',
		'ingredients' => array('légumes', 'sauce')
	),
    array(
		'nom' => 'Loco Moco 200R RS',
		'ingredients' => array('oeuf')
	),
    
    array(
		'nom' => 'Ragoût de boeuf Hawaïen 500 RS',
		'ingredients' => array('boeuf')
	),
    array(
		'nom' => 'Saumon grillé à la crème d avocat 500 RS',
		'ingredients' => array('saumon','avocat')
	),
	array(
		'nom' => 'Raclette Hawaï',
		'ingredients' => array('fromage')
	),
	array(
		'nom' => 'Ragoût de poulet 1110RS',
		'ingredients' => array('poulet')
	)
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['ingredients'])) {
		$ingredients = $_POST['ingredients'];
		$resultats = array();
		foreach ($plats as $plat) {
			$plat_correspond = true;
			foreach ($ingredients as $ingredient) {
				if (!in_array($ingredient, $plat['ingredients'])) {
					$plat_correspond = false;
					break;
				}
			}
			if ($plat_correspond) {
				$resultats[] = $plat;
			}
		}
		echo json_encode($resultats);
	}
}
?>
