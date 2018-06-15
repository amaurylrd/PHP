<div class="content">
	<div>
      	<a id="cRetour" class="cInvisible" href="#top"></a>
    </div>
    <div class="container wrap">
		<!-- <h2><?=$titre?></h2> 
		<h2><?=$lieu?></h2>
		<p><?=$dscrp?></p>
		<table class="table table-striped table-hover table-dark wrap">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Date</th>
					<th scope="col">Heure</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($horaire as $value) {
					echo "<tr>";
					foreach ($value as $key)
						echo "<td>$key</td>";
					echo "</tr>";
				}
			?>
			</tbody>
		</table>-->
		<?=form_open(''); ?>
			<input name="nom" placeholder="Nom" type="text">
			<input name="prenom" placeholder="Prénom" type="text">
			<table class="table table-striped table-hover table-dark wrap">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Date</th>
						<th scope="col">Heure</th>
						<th scope="col">Disponibilités</th>
					</tr>
				</thead>
				<tbody>
					<!-- add les num des sondages -->
					<?php
					for ($i = 0 ; $i < count($horaire) ; $i++) {
						echo "<tr>";
						foreach ($horaire[$i] as $key) {
							echo "<td>$key</td>";
						}
						echo "<td><input name='$i' type='checkbox'></td></tr>";
					}
					echo '<br>';
					?>
				</tbody>
			</table>
			<button type="submit" name="push">Voter</button>
		</form>
	</div>
	<br><br><br><br><br>
</div>