<?php
include 'sessionM.php';
include_once('../connDB.php');
if (isset($_POST['Modifier'])) {
		$id = $_GET['update'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$diagnostic = $_POST['diagnostic'];
		$traitement = $_POST['traitement'];

		$stmt = $pdo->prepare("UPDATE dossiers_medicaux d,patient p SET p.nom_p = :nom, p.prenom_p = :prenom, d.diagnostic = :diagnostic, d.traitement = :traitement WHERE
	    d.id_patient=p.id	and d.id = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
		$stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
		$stmt->bindParam(':diagnostic', $diagnostic, PDO::PARAM_STR);
		$stmt->bindParam(':traitement', $traitement, PDO::PARAM_STR);
		if ($stmt->execute()) {
			echo '<script>alert("Le dossier a été modifié avec succès"); window.location = "listeDossier.php";</script>';
		} else {
			echo '<script>alert("Les errur de modification"); window.location = "cDossier.php";</script>';
		}
	}

if (isset($_POST['Ajoute'])) {
		// récupérer les données du formulaire
		$id_patient = $_GET['id'];
		$id_doctor = $_SESSION['user_id'];
		$date = $_POST['date'];
		$diagnostic = $_POST['diagnostic'];
		$traitement = $_POST['traitement'];
		// vérifier si l'id_doctor existe dans la table doctor
	    $stmt = $pdo->prepare("SELECT id FROM doctor WHERE id_user = ?");
	    $stmt->execute([$id_doctor]);
	    $row = $stmt->fetch(pdo::FETCH_ASSOC);
	    $id = $row['id'];
	if (!$row) {
		// si l'id_doctor n'existe pas, afficher une erreur
		echo '<script>
			alert("Erreur : id_doctor inexistant.");
			window.location.href = "cDossier.php";
		</script>';
		exit;
	}
	    // préparer la requête SQL pour insérer les données
	   $query = "INSERT INTO dossiers_medicaux (date, diagnostic, traitement, id_patient, id_doctor) VALUES (?, ?, ?, ?, ?)";
	   $stmt = $pdo->prepare($query);
	   if (!$stmt->execute([$date, $diagnostic, $traitement, $id_patient, $id])) {
		// si l'insertion échoue, afficher une erreur
		echo '<script>
			alert("Erreur lors de l\'insertion des données.");
			window.location.href = "cDossier.php";
		</script>';
		exit;}
	// afficher un message de succès
	    echo '<script>
		alert("Le Dossier a bien été ajouté");
		window.location.href = "listeDossier.php";</script>';
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Créer un dossier médical</title>
	<link rel="stylesheet" href="style2.css">
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Barre de navigation -->
		<?php include('headerD.php'); ?>
		<div class="container">
			<?php if (isset($_GET['update'])) {
				$id = $_GET['update'];
				$stmt = $pdo->prepare("SELECT * FROM dossiers_medicaux,patient WHERE 
				dossiers_medicaux.id_patient=patient.id and dossiers_medicaux.id = ?");
				$stmt->execute([$id]);
				$dossier = $stmt->fetch(PDO::FETCH_ASSOC);
			?>
				<h5 class="text-center text-primary mb-4">Modifier un dossier médical</h5>
				<form method="POST">
				<div class="row">
					<div class="form-group col-md-6">
						<label for="nom">Nom :</label>
						<input type="text" class="form-control" id="nom" name="nom" value="<?php echo $dossier['nom_p']; ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="prenom">Prénom :</label>
						<input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $dossier['prenom_p']; ?>">
					</div>
					</div>
					<div class="form-group">
						<label for="diagnostic">Diagnostic :</label>
						<textarea class="form-control" id="diagnostic" name="diagnostic"><?php echo $dossier['diagnostic']; ?></textarea>
					</div>
					<div class="form-group">
						<label for="traitement">Traitement :</label>
						<textarea class="form-control" id="traitement" name="traitement"><?php echo $dossier['traitement']; ?></textarea>
					</div>
					<input type="hidden" name="id" value="<?php echo $dossier['id']; ?>">
					<button type="submit" name="Modifier" class="btn btn-primary">Modifier</button>
				</form>
			<?php } else { ?>
				<h5 class="text-center text-primary mb-4">Ajouter un dossier médical</h5>
				<form action="" method="post">
					<div class="row">
						<div class="form-group  col-md-6">
							<label for="traitement">Traitement :</label>
							<textarea class="form-control" name="traitement" rows="5"></textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="diagnostic">Diagnostic :</label>
							<textarea class="form-control" name="diagnostic" rows="5"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="date">Date :</label>
							<input type="date" class="form-control" name="date" required>
						</div>
					</div>
					<button type="submit" name="Ajoute" class="btn btn-primary">Enregistrer</button>
				</form>
			<?php } ?>
		</div>

		<!-- Scripts JS de Bootstrap -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</div>
	<footer class="main-footer">
		<div class="float-right d-none d-sm-block">
			<b>Version</b> 1.0.0
		</div>
		<strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
	</footer>
</body>

</html>