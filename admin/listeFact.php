<?php
include '../session.php';
include '../connDB.php';
// Suppression d'une facture
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM factures WHERE id =?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$id])) {
        // Redirection vers la page actuelle pour actualiser la liste de factures
        echo "<script>alert('facture Supprimer avec succès.');
        window.location.href='listeFact.php';
        </script>";
        exit();
    }
}
// Modification d'une facture

?>
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
            <h3 class="text-center text-primary">Liste des Factures</h3>
            <a href="facteurCrud.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Ajouter une Facture</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom du Patient</th>
                        <th>Date de Facture</th>
                        <th>Montant</th>
                        <th>Assurance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../connDB.php';
                    // Requête pour récupérer les factures du patient
                    $sql = 'SELECT f.id, p.nom_p, p.prenom_p, f.date_facture, f.montant, f.assurance 
                   FROM factures f 
                   INNER JOIN patient p ON f.patient_id = p.id 
                   ';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $id = 1;
                    // Boucle sur les résultats de la requête pour afficher les factures dans le tableau
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        echo '<tr>
                                <th>' . $id++ . '</th>
                                <td>' . $row['nom_p'] . ' ' . $row['prenom_p'] . '</td>
                                <td>' . $row['date_facture'] . '</td>
                                <td>' . $row['montant'] . '</td>
                                <td>' . $row['assurance'] . '</td>
                                <td>
                                    <a href="facteurCrud.php?id=' . $row['id'] . '" class="btn btn-primary"><i class="fas fa-edit"></i> Modifier</a>
                                    <a href="?id=' . $row['id'] . '" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</a>
                                </td>
                              </tr>';
                    }
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