<div id="insert" class="container-fluid wrap">
	<h5 class="container">Vous n'avez pas de compte ? Inscrivez-vous gratuitement pour d&eacute;bloquer toutes les fonctionnalit&eacute;s !</h5>
	<?=validation_errors('<div class="alert alert-danger container">', '</div>'); ?>
 	<?=form_open('welcome/register', 'class="insert container justify-content-center" onsubmit="return form_verif(this);" onreset="form_clean(this);"'); ?>
		<h2>S'inscrire</h2>
		<input type="text" name="nom" placeholder="Nom" pattern="[a-zA-Z]{2,30}">
		<input type="text" name="prenom" placeholder="Prenom" pattern="[a-zA-Z]{2,30}">
		<input type="text" name="login" placeholder="Login" pattern="[0-9a-zA-Z-\.#£€@]{2,15}">
		<input type="email" name="mail" placeholder="Adresse mail">
		<input type="password" name="password" placeholder="Mot de passe" maxlength="20">
		<input type="password" name="passconf" placeholder="Confirmation" maxlength="20">
		<button type="submit" <?=$focus ?>>Cr&eacute;er votre compte</button>
		<button type="reset">Rafra&icirc;chir le formulaire</button>
	</form>
</div>