<?php
include '../session.php';
include '../connDB.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hospital Management</title>
  <!-- Inclure les fichiers CSS de Bootstrap et AdminLTE -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Barre de navigation -->
    <?php include('headerA.php'); ?>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <?php
          // Requête pour compter le nombre d'étudiants qui sont geres des administrateurs
          $stmt = $pdo->prepare('SELECT COUNT(*) FROM patient');
          $stmt->execute();
          $count = $stmt->fetchColumn();
          ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $count; ?></h3>
                <p><i class="fas fa-user"></i>Patients</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="listePatient.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php
          // Requête pour compter le nombre d'étudiants qui sont geres des administrateurs
          $stmt = $pdo->prepare('SELECT COUNT(*) FROM doctor');
          $stmt->execute();
          $count1 = $stmt->fetchColumn();
          ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3><?php echo $count1; ?></h3>
                <p><i class="fas fa-user-md"></i>Médecins</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="listeMédecin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php
          // Requête pour compter le nombre d'étudiants qui sont geres des administrateurs
          $stmt = $pdo->prepare('SELECT COUNT(*) FROM dossiers_medicaux');
          $stmt->execute();
          $count2 = $stmt->fetchColumn();
          ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $count2; ?></h3>
                <p><i class="fas fa-folder"></i>Dossier</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="listeDossier.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php
          $stmt = $pdo->prepare('SELECT COUNT(*) FROM rendez_vous');
          $stmt->execute();
          $count3 = $stmt->fetchColumn();
          ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $count3; ?></h3>
                <p><i class="far fa-calendar-alt"></i> Rendez-vous</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="listeRendez.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php
          // Requête pour compter le nombre d'étudiants qui sont geres des administrateurs
          $stmt = $pdo->prepare('SELECT COUNT(*) FROM Factures');
          $stmt->execute();
          $count2 = $stmt->fetchColumn();
          ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $count2; ?></h3>
                <p><i class="fas fa-calculator"></i>Factures</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="listeFact.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php
          // Requête pour compter le nombre d'étudiants qui sont geres des administrateurs
          $stmt = $pdo->prepare('SELECT COUNT(*) FROM salle');
          $stmt->execute();
          $count4 = $stmt->fetchColumn();
          ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $count4; ?></h3>
                <p><i class="fas fa-bed"></i> Salles</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="listeSalle.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php
          // Requête pour compter le nombre d'étudiants qui sont geres des administrateurs
          $stmt = $pdo->prepare('SELECT COUNT(*) FROM equipements_medicaux');
          $stmt->execute();
          $count4 = $stmt->fetchColumn();
          ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gray">
              <div class="inner">
                <h3><?php echo $count4; ?></h3>
                <p><i class="fas fa-medkit"></i>Resource Médicale</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="listeEquipement.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="table-responsive">
    <?php
    include_once('../connDB.php');
    $id_p = $_SESSION['user_id'];
    $role_p = $_SESSION['user_role'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateur,admin WHERE
         utilisateur.id=admin.id_user AND utilisateur.id = :id");
        $stmt->bindParam(":id", $id_p);
        $stmt->execute();
        $id = 1;
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    ?>
        </div>
      </div>
    </div>
    </div>
    </div>
  <!-- /.content-wrapper -->
  <!-- Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
  </footer>
  </div> <!-- /.wrapper -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>