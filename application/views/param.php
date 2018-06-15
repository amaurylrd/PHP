<div class="content">
	<div>
      	<a id="cRetour" class="cInvisible" href="#top"></a>
    </div>
	<div class="container wrap">
		<p>Depuis cet onglet, vous avez la possibliti&eacute; de g&eacute;rer vos attributs de compte organis&eacute; autour de trois actions principales : changer de login, changer de mot de passe et supprime son compte<br><br></p>
		<hr class="separator">
	</div>
	<div class="container">
		<h5>Vous avez une m&eacute;moire de poisson rouge <code>(nous compatissons)</code> ? Nous vous donnons le droit de changer !</h5>
		<h2>Changer de Mot de passe</h2>
		<?=form_open('welcome/update/1'); ?>
			<input type="password" name="new_pwd" placeholder="Nouveau" maxlength="20">
			<input type="password" name="new_conf" placeholder="Confirmaion" maxlength="20">
			<button type="submit">Changer !</button>
		</form>
	</div>
	<div class="container wrap">
		<h5>Vous avez changer de sexe il y a peu ? On ne jugera pas, allez-y, changez de login !</h5>
		<h2>Changer de Login</h2>
		<?=form_open('welcome/update/2'); ?>
			<input type="text" name="new_login" placeholder="Nouveau" pattern="[0-9a-zA-Z-\.#£€@]{2,15}">
			<button type="submit">Changer !</button>
		</form>
	</div>
	<div class="container wrap">
		<h5>Si vous souhaitez nous quitter, vous pouvez supprimer votre compte, tous vos sondages seront également supprimés.</h5>
		<h2>Supprimer son compte</h2>
		<?=form_open('welcome/update/3'); ?>
			<label>Êtes-vous certain, cette action est définitive et irrémédiable.</label>
			<input type="checkbox" name="conf">
			<button type="submit">Supprimer !</button>
		</form>
	</div>
</div>