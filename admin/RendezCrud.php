<?php
include '../session.php';
include_once('../connDB.php');
// Vérifier si le formulaire a été soumis
if (isset($_POST['ajoute'])) {
    // Récupérer les valeurs des champs
    $date = $_POST["date"];
    $heure = $_POST["heure"];
    $patient = $_POST['nom'];
    $id_doctor = $_POST["id_doctor"];
    $id_salle = $_POST["id_salle"];
    // Préparer et exécuter la requête SQL
    $sql = "INSERT INTO rendez_vous (date, heure, nom_p, id_doctor, id_salle)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$date, $heure, $patient, $id_doctor, $id_salle]);
    if ($stmt) {
        // Afficher un message de succès
        echo "<script>alert('Le rendez-vous a été créé avec succès.')
        window.location.href='listeR.php'</script>";;
    } else {
        // Afficher un message d'erreur si la requête a échoué
        echo "Erreur lors de la création du rendez-vous.";
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
        <?php include('headerA.php'); ?>
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
                        <div class="form-group">
                            <label for="Nom">Nom Patinet :</label>
                            <input type="text" class="form-control" id="Nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="id_doctor">Médecin :</label>
                            <select class="form-control" id="id_doctor" name="id_doctor" required>
                                <option value="">Sélectionner un médecin</option>
                                <?php
                                // Requête pour récupérer les médecins
                                $sql = "SELECT *FROM doctor";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                // Boucle sur les résultats de la requête pour créer des options
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['nom_d'] .' '. $row['prenom_d']. '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                           <label for="id_salle">Salle :</label>
                             <select class="form-control" id="id_salle" name="id_salle" required>
                             <option value="">Sélectionner une salle</option>
                             <?php
        // Requête pour récupérer les salles
        $sql = "SELECT * FROM salle";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        // Boucle sur les résultats de la requête pour créer des options
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['id'] . '">' . $row['nom_salle'] . '</option>';
        }
        ?>
      
                                    </select>
    <?php if(isset($_POST['submit']) && empty($_POST['id_salle'])) { ?>
        <span style="color:red;">Veuillez sélectionner une salle.</span>
    <?php } ?>
</div>
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

</html>