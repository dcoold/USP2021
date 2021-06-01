<?php include('header.php'); ?>
<main id="contactPage">
		<div class="form section dark">
			<div id="contactForm" class="cf formContainer">
				<p class="response"></p>
				<div class="item">
					<label for="name" class="cfMeta">Име *</label>
					<input class="field" name="name" id="name" type="text" placeholder="Иван Петров" required />
					<label for="email" class="cfMeta">Имейл *</label>
					<input class="field" name="email" id="email" type="email" placeholder="i.petrov@gmail.com" required />
					<label for="phone" class="cfMeta">Телефон</label>
					<input class="field" name="phone" id="phone" type="tel" pattern="[0-9]{10}" placeholder="0899999999" />
				</div>
				<div class="item">
					<label for="msg" class="cfMeta">Съобщение *</label>
					<textarea class="field" id="msg" name="message" placeholder="Здравейте, искам да попитам за..." required></textarea>
				</div>
				<div class="item">
					<span class="attention">* Задължителни полета</span>
				</div>
				<input class="button" type="submit" value="Изпрати" />
			</div>	
	</div>
</main>
<?php include('footer.php'); ?>