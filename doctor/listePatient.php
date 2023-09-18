<?php
include 'sessionM.php';
if (isset($_GET['supprime'])) {
    $id = $_GET['supprime'];

    // Delete rows in the factures table that reference the patient row
    $sql = "DELETE FROM factures WHERE patient_id=?";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$id]);

    // Delete the patient row
    $sql = "DELETE FROM patient ,utilisateur WHERE patient.id_utilisateur=utilisateur.id and id=?";
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
    <style>
        .card-img-top {
            max-height: 300px;
            object-fit: cover;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barre de navigation -->
        <?php include('headerD.php'); ?>
        <!-- Container -->
        <div class="container-fluid mt-3">
            <!-- Header -->
            <div class="row mt-3">
                <?php
                include_once('../connDB.php');
                try {
                    $stmt = $pdo->prepare("SELECT * FROM patient;");
                    // Exécuter la requête
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
                // Fermer la connexion à la base de données
                $conn = null;
                ?>
                <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card">
                        <div class="row">
                        <div class="col-md-3">
                            <img src="../images/<?php echo $result['photo']; ?>" class="img-fluid rounded-circle" alt="Photo de profil">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $result['nom_p'] . ' ' . $result['prenom_p']; ?></h5>
                                <p class="card-text">
                                    <strong>CIN :</strong> <?php echo $result['cin']; ?><br>
                                    <strong>Sexe :</strong> <?php echo $result['sexe']; ?><br>
                                    <strong>Date de naissance :</strong> <?php echo $result['date_de_naissance']; ?><br>
                                    <a class="btn btn-success btn-sm" href="cDossier.php?id=<?php echo $result['id']; ?>">Créer Dossier</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                <?php } ?>
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
