<?php
include '../connDB.php';
// Vérifier si le formulaire a été soumis
if (isset($_POST['ajouter'])) {

    // Get data submitted by user
    $patient_id = $_POST['patient_id'];
    $date_facture = $_POST['date_facture'];
    $montant = $_POST['montant'];
    $statut = 'non payé'; // Default value for status
    $assurance = $_POST['assurance'];

    // SQL query for insertion
    $sql = "INSERT INTO factures (patient_id, date_facture, montant, statut, assurance) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare SQL statement
    $stmt = $pdo->prepare($sql);
    // Execute statement and check for errors
    $stmt->execute(array($patient_id,$date_facture,$montant,$statut,$assurance));
    if ($stmt) {
        echo "<script>alert('Facteur ajouté avec succès.');
        window.location.href='listeFact.php';
        </script>";
        exit(); // Terminate script to prevent further execution
    } else {
        echo "<script>alert('Erreur d'insertion de la facture:');
        window.location.href='listeFact.php';
        </script>";
    }
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['Modifier'])) {
    // Récupérer les données soumises par l'utilisateur
    $id = $_GET['id'];
    $date_facture = $_POST['date_facture'];
    $montant = $_POST['montant'];
    $assurance = $_POST['assurance'];
    // Requête SQL de mise à jour
    $sql = "UPDATE factures SET date_facture = '$date_facture', montant = '$montant', assurance = '$assurance' WHERE id= $id";
    // Préparer la requête SQL avec PDO
    $stmt = $pdo->prepare($sql);
    // Exécuter la requête SQL
    if ($stmt->execute()) {
        echo "<script>alert('Facteur Modifié avec succès.');
        window.location.href='listeFact.php';
        </script>";
    } else {
        echo "Erreur lors de la modification de la facture: " . $pdo->errorInfo()[2];
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Ajouter une facture</title>
    <!-- Inclure les fichiers CSS de Bootstrap -->
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barre de navigation -->
        <?php include('headerA.php'); ?>
        <div class="container">
            <?php
            if (isset($_GET['id'])) {
                include '../connDB.php';
                $id = $_GET['id'];
                $sql = "select * FROM factures WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            ?> <h1>Modifier une facture</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="date_facture">Date de la facture :</label>
                        <input type="date" class="form-control" id="date_facture" name="date_facture" value="<?php echo $row['date_facture'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="montant">Montant :</label>
                        <input type="number" class="form-control" id="montant" name="montant" value="<?php echo $row['montant'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="assurance">Assurance :</label>
                        <input type="text" class="form-control" id="assurance" name="assurance" value="<?php echo $row['assurance'] ?>">
                    </div>
                    <button type="submit" name="Modifier" class="btn btn-primary">Modifier la facture</button>

                </form>

            <?php } else { ?>
                <h1>Ajouter une facture</h1>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="patient">Patient:</label>
                        <select class="form-control" name="patient_id" required>
                            <?php
                            include '../connDB.php';
                            // Requête pour récupérer la liste des patients
                            $sql = "SELECT *FROM patient";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            // Boucle sur les résultats de la requête pour afficher la liste des patients dans le formulaire
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['nom_p'] . ' ' . $row['prenom_p'] . '</option>';
                                echo $row['id'];
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_facture">Date de la facture :</label>
                        <input type="date" class="form-control" id="date_facture" name="date_facture">
                    </div>
                    <div class="form-group">
                        <label for="montant">Montant :</label>
                        <input type="number" class="form-control" id="montant" name="montant">
                    </div>
                    <div class="form-group">
                        <label for="assurance">Assurance :</label>
                        <input type="text" class="form-control" id="assurance" name="assurance">
                    </div>
                    <button type="submit" name="ajouter" class="btn btn-primary">Ajouter la facture</button>
                </form>
            <?php } ?>
        </div>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
    </footer>
    <!-- Inclure les fichiers JavaScript de Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>