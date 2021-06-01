<?php include('header.php'); ?>
<main id="ResultsPage">
		
		<?php
			if( empty($_POST['fltr']) ){
				echo '<div class="section">';
				echo '<p>Не сте въвели продукти!</p>';
				echo '<a class="button" href="https://usp.jordanov.web-arts.bg/recipes">Върни се обратно</a>';
				echo '</div>';
				die();
			}
			global $myDB;
			$toSelect = "SELECT * FROM `RecipeIngredient` WHERE ingredient_id IN(". implode(',', $_POST['fltr']) .") ORDER BY recipe_id";
			$fetch = $myDB->query($toSelect);
			$results = $fetch->fetchAll(PDO::FETCH_OBJ);
			$entries = array();
			$filterSize = count($_POST['fltr']);
			
			if(is_array($results)){
				foreach($results as $res){
					$entries[$res->recipe_id][] = $res->ingredient_id;
				}
				
				echo '<section class="section grid dark">';
					echo '<h3 class="title">Всички посочени продукти участваат в следните рецепти:</h3>';
					$found = false;
					foreach($entries as $key => $entry){
						if(count($entry) ==  $filterSize){
							$found = true;
							$recipe = getDBEntryByValue('Recipe', 'id', $key);
							include('./recipeSection.php');
						}
					}
					if(!$found){
						echo '<p>Няма рецепти за показване</p>';
					}
				echo '</section>';
				echo '<section class="section grid dark">';
					echo '<h3 class="title">Почти всички посочени продукти участваат в следните рецепти:</h3>';
					$found = false;
					foreach($entries as $key => $entry){
						if(count($entry) ==  $filterSize - 1){
							$found = true;
							$recipe = getDBEntryByValue('Recipe', 'id', $key);
							include('./recipeSection.php');
						}
					}
					if(!$found){
						echo '<p>Няма рецепти за показване</p>';
					}
				echo '</section>';
				echo '<section class="section grid dark">';
					echo '<h3 class="title">Не ви достига повече от 1 продукт за следните рецепти:</h3>';
					$found = false;
					foreach($entries as $key => $entry){
						if(count($entry) < $filterSize - 1){
							$found = true;
							$recipe = getDBEntryByValue('Recipe', 'id', $key);
							include('./recipeSection.php');
						}
						
					}
					if(!$found){
						echo '<p>Няма рецепти за показване</p>';
					}
				echo '</section>';
				
			}
			?>

		</section>
	</main>
<?php include('footer.php'); ?>