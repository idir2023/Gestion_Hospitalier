<?php
include '../session.php';
include '../connDB.php'; // Inclure le fichier de connexion à la base de données
if (isset($_GET['id'])) { // Vérifier si l'ID de la ressource médicale est passé en paramètre dans l'URL
    $id = $_GET['id'];

    // Requête SQL pour supprimer la ressource médicale avec l'ID spécifié
    $sql = "DELETE FROM equipements_medicaux WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirection vers la page d'affichage des ressources médicales après la suppression
    header('Location: listeEquipement.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Liste des Ressources Médicales</title>
    <link rel="stylesheet" href="styles.css"> <!-- Fichier CSS pour personnaliser le style -->
    <!-- Ajout de la bibliothèque Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Ajout des icônes FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
.doctor-card img {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 30%;
  margin-bottom: 5px;
}
</style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barre de navigation -->
        <?php include('headerA.php'); ?>
        <div class="container">
            <h4 class="text text-center text-danger">Liste des Ressources Médicales</h4>
            <a href="equipement.php" class="btn btn-sm btn-primary mr-2">
                <i class="fas fa-plus"></i> Ajouter une Ressource
            </a>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-photo"></i> Photo</th>
                        <th><i class="fas fa-font"></i> Nom</th> <!-- Utilisation de l'icône de la police -->
                        <th><i class="fas fa-file-alt"></i> Description</th> <!-- Utilisation de l'icône de fichier -->
                        <th><i class="fas fa-map-marker-alt"></i> Emplacement</th> <!-- Utilisation de l'icône de marqueur de carte -->
                        <th><i class="fas fa-check-circle"></i> État</th> <!-- Utilisation de l'icône de cercle de vérification -->
                        <th><i class="fas fa-cog"></i> Actions</th> <!-- Utilisation de l'icône d'engrenage -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../connDB.php';

                    // Requête SQL pour récupérer les ressources médicales
                    $sql = "SELECT * FROM equipements_medicaux";
                    $result = $pdo->prepare($sql);
                    $result->execute();
                    $id1 = 1;
                    // Boucle sur les résultats de la requête pour afficher les informations de chaque ressource médicale
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <th><?php echo $id1++; ?></th>
                            <td>
                                <div class="doctor-card">
                                    <img src="../images/<?php echo $row['photo']; ?>" alt="Photo de profil">
                                </div>
                            </td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['emplacement']; ?></td>
                            <td><?php echo $row['etat']; ?></td>
                            <td>
                                <!-- Liens pour les actions de modification et de suppression avec des icônes -->
                                <a href="equipement.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary mr-2">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <a href="?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Scripts Bootstrap et FontAwesome -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
    </footer>
</body>

</html>