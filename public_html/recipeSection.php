<?php
		echo '<article class="swiper-slide recipeBox">';
			echo '<div class="image"><img alt="'. $recipe->name .'" src="'. URLBase .'/images/'.$recipe->picture .'"/></div>';
			echo '<div class="info">';
				echo '<h4 class="recipeName">'. $recipe->name .'</h4>';
				echo '<p class="excerpt">'. preg_replace('/\s+?(\S+)?$/', '', substr($recipe->description, 0, 201)) .'...</p>';
				echo '<a class="bigLink" href="'. URLBase .'/recipeSingle?recipeID='. $recipe->id .'"><span class="viewMore">Виж повече</span></a>';
			echo '</div>';
		echo '</article>';
?>