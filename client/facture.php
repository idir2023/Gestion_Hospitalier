<?php include 'sessionP.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Gestion des Factures des Patients</title>
  <!-- Lien vers Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Barre de navigation -->
    <?php include('headerC.php'); ?>
    <?php
    include_once('../connDB.php');

    try {
      $id_user=$_SESSION['user_id'];
      // Requête SQL pour récupérer les données de la facture
      $sql = "SELECT * FROM factures,patient where factures.patient_id=patient.id and patient.id_user=$id_user;";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $facture = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Erreur lors de la récupération des données de la facture : " . $e->getMessage();
    }
    // Fermeture de la connexion
    $conn = null;
    ?>
    <div class="container mt-5">
      <h1 class="text-center mb-3">Facture du Patient</h1>
      <table class="table">
        <tr>
          <th>Patient </th>
          <td id="patient-id"><?php echo $facture['nom_p'] . ' ' . $facture['prenom_p']; ?></td>
        </tr>
        <tr>
          <th>Date Facture</th>
          <td id="date-facture"><?php echo $facture['date_facture']; ?></td>
        </tr>
        <tr>
          <th>Montant</th>
          <td id="montant"><?php echo $facture['montant']; ?></td>
        </tr>
        <tr>
          <th>Assurance</th>
          <td id="assurance"><?php echo $facture['assurance']; ?></td>
        </tr>
      </table>
      <button class="btn btn-primary btn-center" onclick="imprimerFacture()">Imprimer</button>
      <a class="btn btn-success btn-center" href="paiement.php?id=<?php echo $facture['assurance']; ?>">Payé</a>
    </div>
    <!-- Lien vers Bootstrap JS et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script JavaScript pour récupérer les données de facture du patient et les afficher dans le tableau -->
    <script>
      // Exemple de données de facture du patient
      const facture = {
        id: 1,
        patient_id: 101,
        date_facture: "2023-04-18",
        montant: 100.50,
        assurance: "Oui"
      };
      // Mettre à jour les éléments HTML avec les données de facture du patient
      document.getElementById('facture-id').textContent = facture.id;
      document.getElementById('patient-id').textContent = facture.patient_id;
      document.getElementById('date-facture').textContent = facture.date_facture;
      document.getElementById('montant').textContent = facture.montant;
      document.getElementById('assurance').textContent = facture.assurance;
      // Fonction pour imprimer la facture
      function imprimerFacture() {
        window.print();
      }
    </script>
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
  </footer>
</body>

</html>