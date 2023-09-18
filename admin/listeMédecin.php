<?php
include '../session.php';

// Supprimer un projet
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM doctor WHERE id_user=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $sql = "DELETE FROM utilisateur WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    if ($stmt) {
        echo "<script>alert('Médecin supprimé avec succès.');</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression du Médecin.');</script>";
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

       
            <a href="MédecinCrud.php" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus"></i>Ajouter un Médecin</a>
            <!-- Header -->
                <?php
                include_once('../connDB.php');
                try {

                    $stmt = $pdo->prepare("SELECT * FROM doctor,utilisateur where utilisateur.id=doctor.id_user;");
                    // Exécuter la requête
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
                // Fermer la connexion à la base de données
                $conn = null;
                ?>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Photo</th>
                            <th>Cin</th>
                            <th>Médecin</th>
                            <th>Spécialité</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                 
                        <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td>
                                <div class="doctor-card">
                                <img src="../images/<?php echo $result['photo']; ?>" alt="Photo de profil">
                                 </div>
                                </td>
                                <td>
                                    <?php echo $result['cin']; ?>
                                </td>
                                <td>
                                    <?php echo $result['nom_d'] . ' ' . $result['prenom_d']; ?>
                                </td>
                                <td>
                                    <?php echo $result['specialite'] ?>
                                </td>
                                <td>
                                    <?php echo $result['telephone'] ?>
                                </td>
                                <td>
                                    <?php echo $result['email'] ?>
                                </td>
                                <td>
                                    <a href="MédecinCrud.php?update=<?php echo $result['id_user']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Modifier</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $result['id_user']; ?>"><i class="fas fa-trash"></i>
                                        Supprimer</button>
                                    <!-- Modal de confirmation de suppression -->
                                    <div class="modal fade" id="deleteModal<?php echo $result['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $result['id_user']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel<?php echo $result['id_user']; ?>">Confirmation de
                                                        suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer
                                                    <?php echo $result['nom_d'] . ' ' . $result['prenom_d']; ?> de la liste
                                                    des Médecins ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <a href="?delete=<?php echo $result['id_user']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
    </footer>
</body>

</html>