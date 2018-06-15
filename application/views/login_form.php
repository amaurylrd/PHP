<div id="log" class="container-fluid wrap" style='background-image: url('<?=base_url().'assets/lvlup.png' ?>')'>
	<h5 class="container">Bien que les comptes utilisateurs soient facultatifs pour r&eacute;pondre &agrave; un sondage, ils sont recommand&eacute;s...</h5>
	<?=form_open('welcome/login', 'class="log container justify-content-center" onsubmit="return form_verif2(this);"'); ?>
  		<h2>Acc&eacute;der &agrave; son compte</h2>
  		<input type="text" name="login" placeholder="Login" maxlength="15">
  		<input type="password" name="password" placeholder="Mot de passe" maxlength="20">
  		<button type="submit" name="push">Connexion</button>
	</form>
</div>