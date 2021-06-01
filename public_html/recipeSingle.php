<?php include('header.php'); ?>
	<main id="singleRecipe">
		<section class="entry section dark">
			<?php $recipe = getDBEntryByValue('Recipe', 'id', $_GET['recipeID']);?>
			<article class="recipeEntry flex">
				<h3 class="title underline"><?php echo $recipe->name ?></h3>
				<!-- BOX -> Snimka vlqvo, vdqsno tablicata sus sustavkite-->
				<div class="image left"><img alt="<?php echo $recipe->name ?>" src="<?php echo URLBase.'/images/'.$recipe->picture?>"/></div>
				<div class="right">
					<h4 class="title underline">Съставки и количества</h4>
					<?php
					global $myDB;
					$toSelect = "SELECT ing.name AS ingredient_name, msr.name AS measure_name, ri.amount FROM `RecipeIngredient` ri JOIN `Ingredient` ing ON ing.id=ri.ingredient_id JOIN `Measure` msr ON ri.measure_id=msr.id WHERE ri.recipe_id=". $_GET['recipeID'];
					$fetch = $myDB->query($toSelect);
					$measures = $fetch->fetchAll(PDO::FETCH_OBJ);
					
					if($measures){
						echo '<table class="measuresTable">';
							echo '<thead clas="tableHead">';
								echo '<tr class="headRow">';
									echo '<th class="headEntry ingredient">Съставка</th>';
									echo '<th class="headEntry ammount">Количество</th>';
									echo '<th class="headEntry measure">Мярка</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
						foreach($measures as $measure){
							echo '<tr class="entryRow">';
								echo '<td class="entryData ingredient">'. $measure->ingredient_name.'</td>';
								echo '<td class="entryData ingredient">'. $measure->amount .'</td>';
								echo '<td class="entryData ingredient">'. $measure->measure_name.'</td>';
								//debug($measure);
							echo '</tr>';
						}
						echo '</tbody>';
						echo '</table>';
					}
					else{
						echo '<p>Информацията липсва!</p>';
					}
					?>
				</div>
				<p class="excerpt"><?php echo $recipe->instructions ?></p>	
			</article>
		</section>  
	</main>
<?php include('footer.php'); ?>