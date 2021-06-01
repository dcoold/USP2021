<?php include('header.php'); ?>
<main id="RecipesPage">
		
		<form id="filters" class="section" method="POST" action="results">
			<h3 class="title underline">Търсене по продукти</h3>
			<div class="grid">
			<?php
				$ingredients = getAll('Ingredient');
				for($i=0; $i<6; $i++){				
					echo '<select class="field child msr" name="fltr['. $i .']">';
						echo '<option disabled selected>Избери продукт</option>';
						foreach($ingredients as $ingr) echo '<option value="'. $ingr->id.'">'. $ingr->name.'</option>'; 
					echo '</select>';
				}
			?>
			</div>
			<input class="button" type="submit" name="submit" value="Търси" />
		</form>
		<section class="recipesGrid grid section dark">
		<?php
			$recipes = getAll('Recipe');
			if ( $recipes ) :
				foreach($recipes as $recipe){
					include('./recipeSection.php');
				}
			else :
				echo 'Няма рецепти за показване';
			endif;
			?>	
		</section>
	</main>
<?php include('footer.php'); ?>