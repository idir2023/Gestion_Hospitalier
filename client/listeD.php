<?php
include 'sessionP.php';
// Supprimer un projet
if (isset($_GET['supprime'])) {
    $id = $_GET['supprime'];
    $sql = "DELETE FROM patient WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$id]);

    if ($result) {
        echo "<script>alert('Patient supprimé avec succès.');</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression du Patient.');</script>";
    }
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Barre de navigation -->
    <?php include('headerC.php'); ?>
    <!-- Container -->
    <div class="container-fluid mt-3">
       
        <!-- Header -->
            <?php
            include_once('../connDB.php');
            try {

                $stmt = $pdo->prepare("SELECT * FROM doctor ;");
                // Exécuter la requête
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }

            // Fermer la connexion à la base de données
            $conn = null;
            ?>
<div class="doctors-container">
  <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="doctor-card">
      <img src="../images/<?php echo $result['photo'];?>" alt="Photo">
      <h3><?php echo $result['nom_d'] . ' ' . $result['prenom_d']; ?></h3>
      <p class="specialite"><?php echo $result['specialite']; ?></p>
      <p class="cin"><?php echo $result['cin']; ?></p>
      <p class="telephone"><?php echo $result['telephone']; ?></p>
      <a class="btn btn-success btn-sm" href="rendez_vous.php?id=<?php echo $result['id']; ?>">Prendre Rendez-vous</a>
    </div>
  <?php } ?>
</div>

<style>
  .doctors-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }
  
  .doctor-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
  }
  
  .doctor-card img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 10px;
  }
  
  .doctor-card h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
  }
  
  .doctor-card p {
    margin-bottom: 5px;
  }
  
  .doctor-card .specialite {
    font-style: italic;
  }
</style>
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
