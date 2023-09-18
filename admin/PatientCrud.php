<?php
include '../session.php';
include '../connDB.php';
// Ajouter un projet
if (isset($_POST['ajouter'])) {
    $photo = $_POST['photo'];
    $cin = $_POST['cin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $email = $_POST['email'];
    $date_naissance = $_POST['date'];

         $sql = "INSERT INTO utilisateur  (email,role)
        VALUES (?,'patient')"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user_id = $pdo->lastInsertId(); 
        $sql = "INSERT INTO patient  (nom_p, prenom_p,photo,cin,sexe,date_de_naissance,id_user)
                VALUES (?, ?, ?, ?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $photo, $cin,$sexe,$date_naissance,$user_id]);

        if($stmt){
        echo "<script>alert('Patient ajouté avec succès.');
              window.location.href='listePatient.php';</script>";}
else{
        echo "<script>alert('Erreur lors de l\'ajout du Patient.');</script>";
} }
if (isset($_POST['modifier'])) {
    $id = $_GET['update'];
    $photo = $_POST['photo'];
    $cin = $_POST['cin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date'];

    // Met à jour les données utilisateur et patient
    $sql = "UPDATE patient p,utilisateur u
    SET p.photo=?,p.cin=?, p.nom_p=?, p.prenom_p=?, p.sexe=?, p.date_de_naissance=? ,u.email=?
    WHERE u.id=p.id_user and p.id_user=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$photo,$cin, $nom, $prenom, $sexe, $date_naissance,$email, $id]);

    // Redirige vers la liste des patients avec un message de succès
    if ($stmt) {
        echo "<script>alert('Patient modifié avec succès.');
        window.location.href='listePatient.php';
        </script>";

    } else {
        echo "<script>alert('Erreur lors de la modification du Patient.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout d'un patient</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barre de navigation -->
        <?php include('headerA.php'); ?>
        <div class="container">
            <div class="row">
                <?php
                if (isset($_GET["update"])) {
                    $id = $_GET['update'];
                    $sql = "SELECT * FROM patient,utilisateur WHERE utilisateur.id=patient.id_user and patient.id_user=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$id]);
                    $row = $stmt->fetch();
                ?>
                    <form method="post" action="" class="col-md-6 mx-auto">
                    <div class="mb-3">
                            <?php if ($row["photo"]) { ?>
                                <img src="../images/<?php echo $row["photo"]; ?>" alt="Photo de profil">
                            <?php } ?>
                            <input type="file" class="form-control" id="photo" name="photo" value="<?php echo $row["photo"]; ?>">
                        </div>
                        <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="cin" class="form-label">Cin:</label>
                            <input type="text" class="form-control" id="cin" name="cin" value="<?php echo $row["cin"]; ?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="sexe" class="form-label">Sexe:</label>
                            <select class="form-control" id="sexe" name="sexe">
                                <option value="Femme" <?php if ($row["sexe"] == "Femme") {
                                                            echo " selected";
                                                        } ?>>Femme</option>
                                <option value="Homme" <?php if ($row["sexe"] == "Homme") {
                                                            echo " selected";
                                                        } ?>>Homme </option>
                            </select>
                        </div>
                        </div>

                        <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nom" class="form-label">Nom:</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row["nom_p"]; ?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="prenom" class="form-label">Prenom:</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $row["prenom_p"]; ?>">
                        </div>
                        </div>
                        <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="date_naissance" class="form-label">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="date_naissance" class="form-label">Date de naissance:</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $row["date_de_naissance"]; ?>">
                        </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="modifier">Modifier</button>
                    </form>
                <?php } else { ?>
                    <form method="post" action="" class="col-md-6 mx-auto">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo:</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="cin" class="form-label">Cin:</label>
                            <input type="text" class="form-control" id="cin" name="cin">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label for="sexe" class="form-label">Sexe:</label>
                            <select class="form-control" id="sexe" name="sexe">
                                <option value="">Select votre choix</option>
                                <option value="Femme">Femme</option>
                                <option value="Homme">Homme</option>
                            </select>
                        </div>
                </div>
                <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nom" class="form-label">Nom:</label>
                            <input type="text" class="form-control" id="nom" name="nom">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="prenom" class="form-label">Prenom:</label>
                            <input type="text" class="form-control" id="prenom" name="prenom">
                        </div>
                </div>
                <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="date_naissance" class="form-label">Date de naissance:</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="date_naissance" class="form-label">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" ">
                        </div>
                </div>
                        <input type="submit" class="btn btn-primary" value="Ajouter" name="ajouter">
                    </form>
                <?php } ?>

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