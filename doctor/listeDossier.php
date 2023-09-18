<?php 
include '../connDB.php';
include 'sessionM.php';
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

      $sql = "DELETE FROM `dossiers_medicaux` WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$id]);
      if ($stmt->rowCount() > 0) {
        alert("Dossier supprimé avec succès");
      } else {
        alert("Aucun dossier n'a été supprimé");
      }
  
  }
  // Fonction alert() pour afficher un message d'alerte
  function alert($message) {
    echo "<script>alert('$message');</script>";
  }
  
// Récupérer tous les dossiers médicaux de la base de données
$stmt = $pdo->prepare("SELECT dossiers_medicaux.id,dossiers_medicaux.diagnostic,dossiers_medicaux.traitement
,patient.nom_p as nom, patient.prenom_p as prenom, dossiers_medicaux.date 
FROM dossiers_medicaux, patient
WHERE dossiers_medicaux.id_patient = patient.id");
$stmt->execute();
$dossiers = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-lfp0sVT6UdA6Ujbn6z1CC6gk3MLUIsbhKKgszCfjOclxJFZgR9mmiziqz8+yMF/LaOJyR0bojEwvLCxMb07W8g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barre de navigation -->
     <?php include('headerD.php'); ?>
     <div class="container">
  <h5 class="text-center text-primary mb-4">Liste des dossiers médicaux</h5>
  <div class="row">
    <?php foreach($dossiers as $dossier): ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted"><?php echo ''.$dossier['date']; ?></h6>
            <h5 class="card-title"><?php echo '<strong>Patient :</strong>'.$dossier['nom'].' '.$dossier['prenom']; ?></h5>
            <p class="card-text"><?php echo '<strong>Diagnostic :</strong> '.$dossier['diagnostic']; ?></p>
            <p class="card-text"><?php echo '<strong>Traitement :</strong> '.$dossier['traitement']; ?></p>
            <a href="cDossier.php?update=<?php echo $dossier['id']; ?>" class="card-link"><i class="fas fa-edit"></i> Modifier</a>
            <a href="?delete=<?php echo $dossier['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce dossier ?');" class="card-link text-danger"><i class="fas fa-trash"></i> Supprimer</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
</div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
    </footer>
</body>
</html>