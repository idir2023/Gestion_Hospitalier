<?php include '../session.php';
include_once('../connDB.php'); ?>
<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <title>Liste des dossiers médicaux</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
        <div class="wrapper">
                <!-- Barre de navigation -->
                <?php include('headerA.php'); ?>
                <div class="container mt-5">
                        <h3 class="text text-center">Liste des dossiers médicaux :</h3>
                        <table class="table table-striped">
                                <thead class="thead-dark">
                                        <tr>
                                                <th>Médecin</th>
                                                <th>Patient</th>
                                                <th>Date</th>
                                                <th>Diagnostic</th>
                                                <th>Traitement</th>
                                                <th>Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        include_once('../connDB.php');
                                        // Requête SQL pour récupérer les dossiers médicaux
                                        $sql = "SELECT * FROM dossiers_medicaux ,patient,doctor
                                        where dossiers_medicaux.id_patient=patient.id and
                                        dossiers_medicaux.id_doctor=doctor.id";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        // Afficher les dossiers médicaux dans la page
                                        foreach ($result as $row) {
                                                echo "<tr>";
                                                echo "<td>" . $row['nom_d'] . ' ' . $row['prenom_d'] . "</td>";
                                                echo "<td>" . $row['nom_p'] . ' ' . $row['prenom_p'] . "</td>";
                                                echo "<td>" . $row['date'] . "</td>";
                                                echo "<td>" . $row['diagnostic'] . "</td>";
                                                echo "<td>" . $row['traitement'] . "</td>";
                                                echo "<td>";
                                                echo "<a href='?update=" . $row['id'] . "' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i> Modifier</a>";
                                                echo "<a href='?supprime=" . $row['id'] . "' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i> Supprimer</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                        }
                                        // Fermeture de la connexion à la base de données
                                        $pdo = null;
                                        ?>
                                </tbody>
                        </table>
                </div>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </div>
        <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                        <b>Version</b> 1.0.0
                </div>
                <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
        </footer>
</body>

</html>