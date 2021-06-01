<?php include('header.php');?>
<main id="addRecipePage">
		<div class="form section dark">
			<div id="recipeForm" class="rf formContainer">
				<p class="response"></p>
				<div class="item">
					<label for="name" class="cfMeta">Име *</label>
					<input class="field" name="name" id="name" type="text" placeholder="Мусака" required />
					<label for="desc" class="cfMeta">Описание *</label>
					<textarea class="field" id="desc" name="description" placeholder="Рецептата за..." required></textarea>
					<label for="instr" class="cfMeta">Инструкции *</label>
					<textarea class="field" id="instr" name="instructions" placeholder=" Първата стъпка от рецептата за..." required></textarea>
					<div class="products">
						<div class="row flex" data-nr="0">
							<select class="field child ingr" name="prd[0][ingr]">
								<option disabled selected value="">Избери продукт</option>
								<?php 
								$ingredients = getAll('Ingredient');
								foreach($ingredients as $ingr) 
									echo '<option value="'. $ingr->id.'">'. $ingr->name.'</option>';
								
								
								?>
							</select>
							<input class="field child qnt" name="prd[0][qnt]" type="number" placeholder="Количество" required />
							<select class="field child msr" name="prd[0][msr]">
								<option disabled selected value="">Избери мярка</option>
								<?php 
								$measures = getAll('Measure');
								foreach($measures as $msr)
									echo '<option value="'. $msr->id.'">'. $msr->name.'</option>';
								
								?>
							</select>
						</div>
						<span class="button addProduct">Добави нов продукт</span>
					</div>
				</div>
				<div class="item attention">
					<span class="attention">* Задължителни полета</span>
				</div>
				<input class="submit button" type="submit" value="Изпрати" />
			</div>	
	</div>
</main>
<?php include('footer.php'); ?>