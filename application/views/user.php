<?php
	$login = $this->session->userdata('login');
?>
<div class="content">
	<div>
      	<a id="cRetour" class="cInvisible" href="#top"></a>
    </div>
	<div class="container wrap">
		<div class="alert alert-success">Bienvenue maître <?=$login ?></div>
	</div>
	<div class="sondage wrap">
		<div class="container-fluid">
			<h5 class="container">C'est ici que la magie opère ! Il ne vous reste plus qu'à créer votre sondage et on s'occupe du reste !</h5>
			<h2>Créer un sondage</h2>
			<?=validation_errors('<div class="alert alert-danger container">', '</div>'); ?>
 			<?=form_open('welcome/sondage', 'id="formSondage" class="insert container justify-content-center"'); ?>
				<input type="text" name="titre"class="form-control" placeholder="Titre" maxlength="30">
				<input type="text" name="lieu"class="form-control" placeholder="Lieu du rendez-vous" maxlength="30">
				<input id="date" type="date" name="date" class="form-control time" value="<?=date('Y-m-d') ?>" min="<?=date('Y-m-d') ?>">
				<div class="btn-ctrl">
					<button type="button" onclick="addHoraire();" name="add" class="d-block btn btn-primary btn-sm">+</button>
					<button type="button" onclick="removeHoraire();" name="remove" class="d-block btn btn-primary btn-sm">-</button>
				</div>
				<input id="time" type="time" name="time" class="form-control time" value="<?=date('G:i') ?>" placeholder="Horaire">
				<textarea id ="description" name="description" placeholder="Description" maxlength="255"class="form-control"></textarea>
				<button type="submit">Cr&eacute;er votre Sondage</button>
			</form>
			
			<h6 class="container">P.S. : Bien sûr vous devrez envoyer votre sondage à vos contacts vous-même.</h6>
		</div>
	</div>

	<!-- vue résultat prend en arg des requetes -->
	<hr class="separator">
	<div class="container wrap">
		<h2>VOS RESULTATS</h2>
		<br><br><br><br><br>
	</div>
</div>

<!-- ALTER TABLE Sondage
ADD FOREIGN KEY Login REFERENCES User.login; -->