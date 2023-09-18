<?php
include 'sessionP.php';
include_once('../connDB.php');

if (isset($_GET['Annuler'])) {
    $id_rdv = $_GET['Annuler'];
    $stmt = $pdo->prepare("UPDATE rendez_vous SET status_rv='Annulé' WHERE id_rv=:id_rdv");
    $stmt->bindParam(':id_rdv', $id_rdv);
    $stmt->execute();

    if ($stmt) {
        header('Location: listeR.php');
        exit();
    }
}

$idr = $_SESSION['user_id'];
$sql = "select * from patient where patient.id_user = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idr]);
if($row1 = $stmt->fetch(PDO::FETCH_ASSOC)){
$id=$row1['id'];
// Récupérer la liste des rendez-vous pour l'utilisateur connecté
$stmt = $pdo->prepare("SELECT *FROM rendez_vous,doctor
WHERE rendez_vous.id_doctor = doctor.id
and rendez_vous.id_patient=$id");
$stmt->execute();
$rdv_list = $stmt->fetchAll(PDO::FETCH_ASSOC);}
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
        <div class="container-fluid">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-user-md"></i> Nom de Médecin</th>
                        <th><i class="fas fa-calendar-alt"></i> Date</th>
                        <th><i class="fas fa-clock"></i> Heure</th>
                        <th><i class="fas fa-hospital"></i> Statut</th>
                        <th><i class="fas fa-cog"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $id = 1;
                    foreach ($rdv_list as $rdv) { ?>
                        <tr>
                            <th><?= $id++ ?></td>
                            <td><?= $rdv['nom_d'] . ' ' . $rdv['prenom_d'] ?></td>
                            <td><?= $rdv['date'] ?></td>
                            <td><?= $rdv['heure'] ?></td>
                            <td><?= $rdv['status_rv'] ?></td>
                            <td>
                            <a href="?Annuler=<?php echo $rdv['id_rv'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')">Annuler</a>
                            </td>
                            <?php } ?>
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