<div>
    <a id="cRetour" class="cInvisible" href="#top"></a>
</div>
<div class="contact">
	<div class="container wrap">
   		<form action="" method="POST">
			<h2>Nous contacter</h2>
            <h5>babbapbacap</h5>
            <div class="gender">
                <label for="male">Monsieur</label>
                <input name="gender" value="male" type="radio">
                <label for="female">Madame</label>
                <input name="gender" value="female" type="radio">
            </div>
            <input placeholder="Nom" type="text">
            <input placeholder="Prénom" type="text">
            <input placeholder="Mail" type="text">
            <input placeholder="Téléphone" type="text">
            <input placeholder="Objet" type="text">
            <textarea required="" rows="7" cols="30" placeholder="Message"></textarea>
            <button type="submit">Envoyer</button>
            <button type="reset">Rafraîchir</button>
        </form>
    </div>
</div>
<style>
    .gender {
        display: flex;
        width: 100%;
    }
</style>