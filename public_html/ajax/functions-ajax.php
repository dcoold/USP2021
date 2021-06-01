<?php
	header('Content-Type: application/json; charset=UTF-8');
		
	include('../functions.php');
	
	if(isset($_POST['action'])){
		switch($_POST['action']) :
			case 'addRecipe' : addRecipe(); 
				break;
		endswitch;
	}
	
	/* Manage Entry Basics */
	function addRecipe(){
		global $myDB;
		
		$saveVars = array('name', 'description', 'instructions');
		foreach($saveVars as $var) $$var = array_key_exists($var, $_POST) ? strip_tags(trim($_POST[$var])) : null;
		
		if(!$name) wa_json_error('Въведете име на рецептата!');
		if(!$description) wa_json_error('Липсва описание на рецептата.');
		if(!$instructions) wa_json_error('Рецептата трябва да има инструкции за приготвяне.');
		
		$prodVars = array_key_exists('prd', $_POST) ? $_POST['prd'] : null;
		if(!is_array($prodVars)) wa_json_error('Не са посочени продукти към Вашата рецепта.');
		
		if($prodVars[0]['ingr'] == '' && $prodVars[0]['qnt'] == '' && $prodVars[0]['msr'] == '') wa_json_error('Не са посочени продукти към Вашата рецепта.');
		
		foreach($prodVars as $prodRow){
			
			if($prodRow['ingr'] == '' || $prodRow['qnt'] == '' || $prodRow['msr'] == '') wa_json_error('Имате непълна информация в даден ред съставки.');
		}
		
		$sql = 'INSERT INTO Recipe (name, description, instructions) 
				VALUES (:name, :description, :instructions)';
						
		$stmt = $myDB->quote($sql); 	
		$stmt = $myDB->prepare($sql);
		
		foreach($saveVars as $var) $stmt->bindParam(':'. $var, $$var, PDO::PARAM_STR);
	
		
		$execute = $stmt->execute();
		
		$lastID = $myDB->lastInsertId();
			
		$sql = 'INSERT INTO RecipeIngredient (recipe_id, ingredient_id, measure_id, amount) VALUES (?,?,?,?)';
							
		$stmt = $myDB->quote($sql); 	
		$stmt = $myDB->prepare($sql);
		
		foreach($prodVars as $prdRow) 
			$execute2 = $stmt->execute([$lastID, $prdRow['ingr'], $prdRow['msr'], $prdRow['qnt']]);				
			
			
		if(!$execute || !$execute2) wa_json_error('Рецептата не беше запазена в базата данни.'); 
		
		wa_json_success('Вашата рецепта беше запазена успешно.');

	}		
?>
