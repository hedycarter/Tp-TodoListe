<?php require_once("back_end.php");
$lignes = $liaison->lignes;
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Todo liste</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
   
	<div class="heading">
		<h2>Mon application TODO LISTE</h2>
	</div>

	<form method="get" action="back_end.php" class="input_form">
		<input placeholder="rensigner une tâcehe ici" type="text" name="tache" class="tache_input">
		<input type="hidden" name="addTache">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Ajouter une</button>
    </form>
    
    </form>

    </form>

<table>
	<thead>
		<tr>
			<th>N°</th>
			<th>Tâches</th>
			<th style="width: 50% -50%;">Statut</th>
			<th>Supression</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($liaison->lignes as $ligne): ?>
		<tr>
			<td><?= $ligne["id_todo"]; ?></td>
			<td><?= $ligne["nom"]; ?></td>
			<td style="width: 50% -50%;">
				<form id="statut<?= $ligne['id_todo']; ?>" action="back_end.php" method="get">
					<input onclick="soumettre('statut<?= $ligne["id_todo"]; ?>');" type="checkbox" name="statut" id="" <?php if($ligne["statut"]==1){echo "checked";} ?> />
					<input type="hidden" name="idStatut" value="<?= $ligne['id_todo']; ?>">
				</form>
			</td>
			<td>
				<form action="back_end.php" method="get">
					<input type="hidden" name="deleteid" value="<?= $ligne['id_todo']; ?>">
					<button type="submit">supprimer</button>
				</form>
			</td>
		</tr>
		<?php endforeach ;?>
	</tbody>
</table>

	<script src="index.js"></script>
</body>
</html>