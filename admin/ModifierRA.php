<?php
include '../session.php';
include_once('../connDB.php');
if (isset($_POST['Modifier'])) {
    $id = $_POST['id'];
    $heure = $_POST['heure'];
    $date = $_POST['date'];
    try {
        // Mettre à jour la date et la salle du rendez-vous dans la base de données
        $stmt = $pdo->prepare("UPDATE rendez_vous 
    SET heure='$heure', date='$date' WHERE id_rv='$id'");
        $stmt->execute();
        echo '<script>alert("Le rendez-vous a été modifié avec succès.")
         window.location.href="listeRendez.php";
        </script>';
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Erreur : ' . $e->getMessage() . '</div>';
    }
}
?>
<html>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barre de navigation -->
        <?php include('headerA.php'); ?>
        <div class="container">
            <!-- Formulaire de modification -->
            <?php
            if ($_GET['update']) {
                $id = $_GET['update'];
                $stmt = $pdo->prepare("SELECT * FROM rendez_vous WHERE id_rv = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="heure">Heure :</label>
                    <input type="time" class="form-control" name="heure" value="<?php echo $result['heure']; ?>">
                </div>
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input type="date" class="form-control" name="date" value="<?php echo $result['date']; ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $result['id_rv']; ?>">
                <button type="submit" name="Modifier" class="btn btn-success">
                    <i class="fas fa-check"></i> Enregistrer
                </button>
            </form>
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