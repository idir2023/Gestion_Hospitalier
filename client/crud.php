<?php
include 'sessionP.php';
include_once('../connDB.php');
if (isset($_POST['modifier'])) {
    $id = $_GET['update'];
    $email = $_POST["email"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $photo = $_POST["photo"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $stmt = $pdo->prepare("UPDATE utilisateur u ,patient p SET p.nom_p=?, p.prenom_p=?, u.email=? ,u.mot_de_passe=?,p.photo=? WHERE u.id=?");
    $stmt->execute([$nom, $prenom, $email, $mot_de_passe, $photo, $id]);

    if ($stmt->rowCount() > 0) {
        echo '<script> alert("Les données ont été mises à jour avec succès dans la base de données."); window.location="Patient.php"; </script>';
    } else {
        echo '<div class="alert alert-danger">Une erreur s\'est produite lors de la mise à jour des données dans la base de données.</div>';
    }
}
?>
<html>
<head>
    <title>Dashboard - Gestion de l'hôpital</title>
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
        <?php include('headerC.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <?php
                    if (isset($_GET['update'])) {
                        $id = $_GET['update'];
                        // Préparer la requête de sélection de l'utilisateur à modifier
                        $stmt = $pdo->prepare("SELECT * FROM utilisateur,patient WHERE utilisateur.id=patient.id_user and patient.id_user=?");
                        // Exécuter la requête de sélection avec l'identifiant correspondant
                        $stmt->execute([$id]);
                        // Récupérer les résultats de la requête
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    } ?>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <div class="doctor-card">
                                <img src="../images/<?php echo $result['photo']; ?>" alt="Photo de profil">
                            </div>
                            <input type="file" class="form-control" id="photo" name="photo" value="<?php echo $result['photo']; ?>">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $result['nom_p']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $result['prenom_p']; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mot_de_passe">Mot de passe</label>
                                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" value="<?php echo $result['mot_de_passe']; ?>">
                            </div>
                        </div>
                        <button type="submit" name="modifier" class="btn btn-primary">Enregistrer les modifications</button>
                        <a href="Patient.php" class="btn btn-secondary">Annuler</a>
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
</body>
</html>