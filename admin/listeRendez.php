<?php
include '../session.php';
include_once('../connDB.php');
if (isset($_GET['delete'])) {
        // Retrieve the ID of the appointment to be deleted
        $appointment_id = $_GET['delete'];
        // Prepare and execute the DELETE query
        $sql = "DELETE FROM rendez_vous WHERE id_rv = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$appointment_id]);
        if ($stmt) {
                echo "<script>alert('Appointment deleted successfully.')
                              window.location.href='listeRendez.php';
                        </script>";
                exit();
        }
}
if (isset($_GET['Accepter'])) {
        // Récupérer l'identifiant du rendez-vous depuis le formulaire
        $id_rdv = $_GET['Accepter'];
        // Mettre à jour le statut du rendez-vous dans la base de données
        try {
                $stmt = $pdo->prepare("UPDATE rendez_vous SET status_rv = 'Accepté' WHERE id_rv = :id_rdv");
                $stmt->bindParam(':id_rdv', $id_rdv);
                $stmt->execute();
                header('location:listeRendez.php');
                exit(); // Ajout de exit() pour arrêter l'exécution du script après la redirection
        } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
        }
        // Fermer la connexion à la base de données
        $pdo = null;
}
if (isset($_GET['Annuler'])) {
        // Récupérer l'identifiant du rendez-vous depuis le formulaire
        $id_rd = $_GET['Annuler'];
        // Mettre à jour le statut du rendez-vous dans la base de données
        try {
                $stmt = $pdo->prepare("UPDATE rendez_vous SET status_rv = 'inacceptable' WHERE id_rv= :id_rd");
                $stmt->bindParam(':id_rd', $id_rd);
                $stmt->execute();
                header('location:listeRendez.php');
                exit(); // Ajout de exit() pour arrêter l'exécution du script après la redirection
        } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
        }
        // Fermer la connexion à la base de données
        $pdo = null;
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
                <div class="container-fluid">
                <div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title"><i class="far fa-check-circle"></i> Rendez-vous acceptés</h5>
            </div>
            <div class="card-body">
                <?php
                try {
                    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM rendez_vous WHERE status_rv = 'Accepté'");
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo "<h2 class='card-text'>" . $result['count'] . "</h2>";
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="card-title"><i class="far fa-times-circle"></i> Rendez-vous refusés</h5>
            </div>
            <div class="card-body">
                <?php
                try {
                    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM rendez_vous WHERE status_rv = 'inacceptable'");
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo "<h2 class='card-text'>" . $result['count'] . "</h2>";
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title"><i class="far fa-window-close"></i> Rendez-vous annulés</h5>
            </div>
            <div class="card-body">
                <?php
                try {
                    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM rendez_vous WHERE status_rv = 'Annulé'");
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo "<h2 class='card-text'>" . $result['count'] . "</h2>";
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>
</div>
                        <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                        <tr>
                                                <th>#</th>
                                                <th><i class="far fa-calendar-alt"></i>Date</th>
                                                <th><i class="far fa-clock"></i>Heure</th>
                                                <th><i class="fas fa-user"></i>Patient</th>
                                                <th><i class="fas fa-user-md"></i>Médecin</th>
                                                <th><i class="far fa-check-circle"></i>Status</th>
                                                <th><i class="fas fa-cog text text-center"></i> Action</th>
                                                <!-- Nouvelle colonne pour les boutons d'action -->
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        include_once('../connDB.php');
                                        try {
                                                $stmt = $pdo->prepare("SELECT * FROM rendez_vous;");
                                                // Exécuter la requête
                                                $stmt->execute();
                                                $d = 1;
                                                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        $id_d = $result['id_doctor'];

                                                        $stmt_doctor = $pdo->prepare("SELECT * FROM doctor WHERE
                                                        doctor.id=$id_d;");
                                                        $stmt_doctor->execute();
                                                        $result_doctor = $stmt_doctor->fetch(PDO::FETCH_ASSOC);
                                                        $id_p = $result['id_patient'];
                                                        $stmt_patient = $pdo->prepare("SELECT * FROM patient WHERE
                                                        patient.id=$id_p;");
                                                        $stmt_patient->execute();
                                                        $result_patient = $stmt_patient->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                                        <tr>
                                                                <th><?php echo $d++; ?></th>
                                                                <td><?php echo $result['date']; ?> </td>
                                                                <td><?php echo $result['heure']; ?> </td>
                                                                <td><?php echo $result_patient['nom_p'] . ' ' .  $result_patient['prenom_p']  ?> </td>
                                                                <td><?php echo $result_doctor['nom_d'] . ' ' . $result_doctor['prenom_d'] ?> </td>
                                                                <td style="color:<?php echo $result['status_rv'] === 'inacceptable' ? 'red' : 'green'; ?>;">
                                                                        <?php echo $result['status_rv']; ?>
                                                                </td>
                                                                <div class="btn-group">
                                                                        <td>
                                                                                <!-- Bouton d'annulation -->
                                                                                <a href="ModifierRA.php?update=<?php echo $result['id_rv']; ?>" class="btn btn-primary">
                                                                                        <i class="fas fa-edit"></i> Modifier
                                                                                </a>
                                                                                <a href="?Accepter=<?php echo $result['id_rv']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir accepter ce rendez-vous ?')" class="btn btn-success">
                                                                                        <i class="fas fa-check"></i> Accepter
                                                                                </a>
                                                                                <br>
                                                                                <a href="?delete=<?php echo $result['id_rv']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir Supprimer ce rendez-vous ?')" class="btn btn-danger">
                                                                                        <i class="fas fa-trash"></i> Supprimer
                                                                                </a>
                                                                                <a href="?Annuler=<?php echo $result['id_rv']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir Refuser ce rendez-vous ?')" class="btn bg-black">
                                                                                        <i class="fas fa-times"></i> Refuser
                                                                                </a>

                                                                        </td>
                                                        </tr>
                                        <?php
                                                }
                                        } catch (PDOException $e) {
                                                echo "Erreur : " . $e->getMessage();
                                        }
                                        // Fermer la connexion à la base de données
                                        $conn = null;
                                        ?>
                                </tbody>
                        </table>
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