<?php
include '../session.php';
include_once('../connDB.php');
if (isset($_POST['Ajoute'])) {
    // récupérer les données du formulaire
    $id_patient = $_POST['id_patient'];
    $id_doctor = $_POST['id_doctor'];
    $date = $_POST['date'];
    $diagnostic = $_POST['diagnostic'];
    $traitement = $_POST['traitement'];
    // préparer la requête SQL pour insérer les données
    $query = "INSERT INTO dossiers_medicaux (id_patient, id_doctor, date, diagnostic, traitement) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_patient, $id_doctor, $date, $diagnostic, $traitement]);
    // rediriger vers la page d'accueil ou afficher un message de confirmation
    header('Location: listeDossier.php');
}
// Connexion à la base de données
// Récupération de la liste des patients
$stmt_patients = $pdo->query("SELECT id, nom_p, prenom_p FROM patient");
$patients = $stmt_patients->fetchAll(PDO::FETCH_ASSOC);
// Récupération de la liste des médecins
$stmt_medecins = $pdo->query("SELECT id, nom_d, prenom_d FROM doctor");
$medecins = $stmt_medecins->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Créer un dossier médical</title>
    <link rel="stylesheet" href="path/to/adminlte.css">
<script src="path/to/adminlte.js"></script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <?php include_once('headerA.php') ?>
	<div class="container">
		<h3 class="text text-center text-primary">Créer un dossier médical</h3>
		<form action="" method="post">
			<div class="form-group">
				<label for="id_patient">Nom du patient :</label>
				<select class="form-control" name="id_patient" required>
					<?php foreach ($patients as $patient) { ?>
						<option value="<?php echo $patient['id']; ?>"><?php echo $patient['nom_p'] . ' ' . $patient['prenom_p']; ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label for="id_doctor">Nom du médecin :</label>
				<select class="form-control" name="id_doctor" required>
					<?php foreach ($medecins as $medecin) { ?>
						<option value="<?php echo $medecin['id']; ?>"><?php echo $medecin['nom_d'] . ' ' . $medecin['prenom_d']; ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label for="date">Date :</label>
				<input type="date" class="form-control" name="date" required>
			</div>

			<div class="form-group">
				<label for="diagnostic">Diagnostic :</label>
				<input class="form-control" name="diagnostic" id="diagnostic">
			</div>

			<div class="form-group">
				<label for="traitement">Traitement :</label>
				<input class="form-control" name="traitement" id="traitement">
			</div>

			<button type="submit" name="Ajoute" class="btn btn-primary">Enregistrer</button>
		</form>
	</div>
</div>
<footer class="main-footer">
   <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
   </div>
   <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
</footer>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
