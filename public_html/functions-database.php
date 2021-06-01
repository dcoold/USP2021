<?php

	$myDB = new PDO('mysql:host=HOST;dbname=DBNAME;charset=utf8', 'USER', 'PASS');
	$myDB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	function getAll($table){
		global $myDB;
		$toSelect = 'SELECT * FROM `'. $table .'`';
		$fetch = $myDB->query($toSelect);
		return $fetch->fetchAll(PDO::FETCH_OBJ);
	}
	
	function getLatest($table){
		global $myDB;
		$toSelect = 'SELECT * FROM `'. $table .'` ORDER BY id ASC LIMIT 16';
		$fetch = $myDB->query($toSelect);
		return $fetch->fetchAll(PDO::FETCH_OBJ);
	}
	
	function getDBEntryByValue($table, $key, $value){
		global $myDB;
		$toSelect = 'SELECT * FROM `'. $table .'` WHERE '. $key .' = "'. $value .'"';
					
		$fetch = $myDB->query($toSelect);
		return $fetch->fetch(PDO::FETCH_OBJ);

	}
	
	function getRecipeByIngredients(){
		global $myDB;
		$toSelect = "SELECT * FROM `RecipeIngredient` WHERE ingredient_id IN(". implode(',', $_POST['fltr']) .") ORDER BY recipe_id";
		$fetch = $myDB->query($toSelect);
		return $fetch->fetchAll(PDO::FETCH_OBJ);
		
	}
?>