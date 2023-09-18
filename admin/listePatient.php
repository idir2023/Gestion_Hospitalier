<?php
include '../session.php';

// Supprimer un projet
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM patient WHERE id_user=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $sql = "DELETE FROM utilisateur WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    if ($stmt) {
        echo "<script>alert('Patient supprimé avec succès.');
        window.location.href='listePatient.php';
        </script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression du Patient.');</script>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Liste des patients</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->
    <style>
.doctor-card img {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 30%;
  margin-bottom: 5px;
}
</style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barre de navigation -->
        <?php include('headerA.php'); ?>
        <!-- Container -->
        <div class="container-fluid mt-3">
            <!-- Header -->
            <div class="table-responsive">
                <?php
                include_once('../connDB.php');
                try {
                    $stmt = $pdo->prepare("SELECT * FROM patient,utilisateur WHERE patient.id_user=utilisateur.id;");
                    // Exécuter la requête
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
                ?>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                  <tr><a href="PatientCrud.php" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus"></i>Ajouter</a></tr>  
                        <tr>
                            <th>Photo</th>
                            <th>CIN</th>
                            <th>Nom et prénom</th>
                            <th>Sexe</th>
                            <th>Date de naissance</th>
                            <th>Email </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td> <div class="doctor-card">
                                <img src="../images/<?php echo $result['photo'];?>" alt="Photo de profil">
                                 </div></td>
                                <td><?php echo $result['cin']; ?> </td>
                                <td><?php echo $result['nom_p'] . ' ' . $result['prenom_p']; ?> </td>
                                <td><?php echo $result['sexe'] ?> </td>
                                <td><?php echo $result['date_de_naissance'] ?> </td>
                                <td><?php echo $result['email'] ?> </td>
                                <td>
                                    <a href="PatientCrud.php?update=<?php echo $result['id_user']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Modifier</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $result['id_user']; ?>"><i class="fas fa-trash"></i> Supprimer</button>
                                    <!-- Modal de confirmation de suppression -->
                                    <div class="modal fade" id="deleteModal<?php echo $result['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $result['id_user']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel<?php echo $result['id']; ?>">Confirmation de suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer <?php echo $result['nom_p'] . ' ' . $result['prenom_p']; ?> de la liste des patients ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <a href="?delete=<?php echo $result['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</a>
                                                </div>
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
    </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
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