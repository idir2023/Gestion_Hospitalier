<?php
include 'sessionP.php';
include_once('../connDB.php');
// Vérifier si le formulaire a été soumis
if (isset($_POST['ajoute'])) {
    // Récupérer les valeurs des champs
    $date = $_POST["date"];
    $heure = $_POST["heure"];
    $patient = $_SESSION['user_id'];
    $id = null;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "select * from doctor where doctor.id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    $sql = "select * from patient where patient.id_user = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$patient]);
    $row1 = $stmt->fetch(PDO::FETCH_ASSOC);

    // Requête d'insertion des données dans la base de données
    if ($stmt) {
        $id_doctor = $row['id'];
        $id_patient=$row1['id'];
        // Préparer et exécuter la requête SQL
        $sql = "INSERT INTO rendez_vous (date, heure,id_patient, id_doctor,status_rv)
            VALUES (?,?,?,?,'En Cours')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$date, $heure, $id_patient, $id_doctor]);
        if ($stmt) {
            // Afficher un message de succès
            echo "<script>alert('Le rendez-vous a été créé avec succès.')
        window.location.href='listeR.php'</script>";;
        } else {
            // Afficher un message d'erreur si la requête a échoué
            echo "Erreur lors de la création du rendez-vous.";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Gestion de l'hôpital</title>
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
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="mb-4">Créer un rendez-vous</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="date">Date :</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="heure">Heure :</label>
                            <input type="time" class="form-control" id="heure" name="heure" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="ajoute">Créer un rendez-vous</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
    </footer>

    <body>