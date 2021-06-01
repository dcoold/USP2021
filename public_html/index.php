<?php include('header.php'); ?>
	<main id="frontPage">
		<section id="about" class="section light">
			<article class="column left">
				<h3 class="title underline">За нас</h3>
				<p class="desc">Cooking Master е сайт тип "Готварска книга". От нашия сайт можете бързо, лесно и вкусно да приготвяте ястия, които дори не сте подозирали, че можете да направите.<br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			</article>
			<div class="column right">
				<?php echo '<span class="image" style="background-image: url('. getImage('images/logo', 'svg') .')"></span>'; ?>
			</div>
		</section>
		<section class="recipesNewest section dark">
			<h3 class="title underline">Последно добавени рецепти</h3>
			<section class="recipeBar">
			<?php
			$recipes = getLatest('Recipe');
			if ( $recipes ) :
				echo '<div class="swiperbar">';
					echo '<div class="swiper-container recipeContainer">';
						echo '<div class="swiper-wrapper recipes">';
							foreach($recipes as $recipe){
								include('./recipeSection.php');
							}
						echo '</div>';
					echo '</div>';
					echo '<div class="post-pagination bullets swiper-pagination"></div>';
					echo '<div class="post-next swiper-button-next"></div>';
					echo '<div class="post-prev swiper-button-prev"></div>';
				echo '</div>';
			echo '<a class="button" href="'. URLBase .'/recipes">Виж всички</a>';
		else :
			echo 'Няма рецепти за показване';
		endif;
			?>
		</section>  
	</main>
<?php include('footer.php'); ?>