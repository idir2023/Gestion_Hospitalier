<?php
include '../session.php';
// Supprimer un projet
if (isset($_GET['supprime'])) {
        $id = $_GET['supprime'];
        $sql = "DELETE FROM salle WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$id]);
        if ($result) {
                echo "<script>alert('la salle supprimé avec succès.');</script>";
        } else {
                echo "<script>alert('Erreur lors de la suppression du salle.');</script>";
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
        <?php include('headerA.php'); ?>
        <!-- Container -->
        <div class="container-fluid mt-3">
                <!-- Header -->
                <a href="salleCrud.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Ajoute une salle</a>
                <div class="table-responsive">
                      

                        <table class="table table-bordered table-striped">
                                <thead>
                                        <tr>
                                                <th>nom</th>
                                                <th>Capacite</th>
                                                <th>description</th>
                                                <th>status</th>
                                                <th>Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php
                        include_once('../connDB.php');
                        try {

                                $stmt = $pdo->prepare("SELECT * FROM salle;");
                                // Exécuter la requête
                                $stmt->execute();
                        } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                        }
                        // Fermer la connexion à la base de données
                        $pdo = null;
                         while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <tr>
                                                        <td><?php echo $result['nom_salle']; ?> </td>
                                                        <td><?php echo $result['capacite'] ?> </td>
                                                        <td><?php echo $result['description'] ?> </td>
                                                        <td><?php echo $result['status'] ?> </td>
                                                        <td>
                                                                <a href="salleCrud.php?updat=<?php echo $result['id']; ?>" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> Modifier</a>
                                                                <a href="?supprime=<?php echo $result['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Supprimer</a>
                                                        </td>
                                                </tr>
                                        <?php } ?>
                                </tbody>
                        </table>
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