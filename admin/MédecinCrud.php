<?php
include '../session.php';
include '../connDB.php';

// Insertion de données
if (isset($_POST["ajouter"])) {
    $cin = $_POST["cin"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $prenom = $_POST["prenom"];
    $specialite = $_POST["specialite"];
    $telephone = $_POST["telephone"];
    $photo = $_FILES['photo']['name'];

    $sql = "INSERT INTO utilisateur  (email,role)
    VALUES (?,'medecin')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user_id = $pdo->lastInsertId();
    $sql = "INSERT INTO doctor (cin, nom_d, prenom_d,photo,specialite,telephone,id_user) VALUES (?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cin, $nom, $prenom,$photo, $specialite, $telephone, $user_id]);

    if ($stmt) {
        echo "<script>alert('Médecin Ajouté avec succès.');
        window.location.href='listeMédecin.php';
        </script>";
    } else {
        echo "<script>alert('Erreur lors de l'ajoute du Médecin.');</script>";
    }
}

// Modification de données
if (isset($_POST['modifier'])) {
    $id = $_GET["update"];
    $cin = $_POST["cin"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $prenom = $_POST["prenom"];
    $specialite = $_POST["specialite"];
    $telephone = $_POST["telephone"];
    $photo = $_POST["photo"];

    // Met à jour les données utilisateur et patient
    // Met à jour les données utilisateur et patient
    $sql = "UPDATE doctor d, utilisateur u SET d.photo=?, d.cin=?, d.nom_d=?, d.prenom_d=?, d.specialite=?, d.telephone=?, u.email=? WHERE d.id_user=u.id AND d.id_user=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$photo, $cin, $nom, $prenom, $specialite, $telephone, $email, $id]);
    // Redirige vers la liste des patients avec un message de succès
    if ($stmt) {
        echo "<script>alert('Médecin modifié avec succès.');
        window.location.href='listeMédecin.php';
        </script>";
    } else {
        echo "<script>alert('Erreur lors de la modification du Médecin.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout d'un Médecin</title>
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
                    $sql = "SELECT * FROM doctor d,utilisateur u WHERE u.id=d.id_user and u.id=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$id]);
                    $row = $stmt->fetch();
                ?>
                    <form method="post" action="" class="col-md-6 mx-auto">
                        <div class="mb-3">
                            <label for="photo" class="form-label ">Photo:</label>
                            <?php if ($row["photo"]) { ?>
                                <img src="<?php echo $row["photo"]; ?>" alt="Photo de profil">
                            <?php } ?>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="cin" class="form-label">Cin:</label>
                                <input type="text" class="form-control" id="cin" name="cin" value="<?php echo $row["cin"]; ?>">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nom" class="form-label">Nom:</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row["nom_d"]; ?>">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="prenom" class="form-label">Prenom:</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $row["prenom_d"]; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="specialite">Specialite</label>
                                <select class="form-control" id="specialite" name="specialite">
                                    <option value="addictologie" <?php if ($row['specialite'] == "addictologie") echo "selected"; ?>>Addictologie</option>
                                    <option value="allergologie" <?php if ($row['specialite'] == "allergologie") echo "selected"; ?>>Allergologie</option>
                                    <option value="anatomie" <?php if ($row['specialite'] == "anatomie") echo "selected"; ?>>Anatomie et cytopathologie</option>
                                    <option value="anesthesie" <?php if ($row['specialite'] == "anesthesie") echo "selected"; ?>>Anesthésie-réanimation</option>
                                    <option value="biologie" <?php if ($row['specialite'] == "biologie") echo "selected"; ?>>Biologie médicale</option>
                                    <option value="dermatologie" <?php if ($row['specialite'] == "dermatologie") echo "selected"; ?>>Dermatologie et vénérologie</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="telephone" class="form-label">Telephone:</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $row["telephone"]; ?>" ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" name="modifier">Modifier</button>
                    </form>
                <?php } else { ?>
                    <form method="post" action="" class="col-md-6 mx-auto" enctype="multipart/form-data"> <!-- Ajout de l'attribut enctype pour gérer les fichiers -->
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
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
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
                                <label for="specialite">Spécialité :</label>
                                <select name="specialite" id="specialite" class="form-control">
                                    <option value="addictologie">Addictologie</option>
                                    <option value="allergologie">Allergologie</option>
                                    <option value="anatomie">Anatomie et cytopathologie</option>
                                    <option value="anesthesie">Anesthésie-réanimation</option>
                                    <option value="biologie">Biologie médicale</option>
                                    <option value="dermatologie">Dermatologie et vénérologie</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="telephone" class="form-label ">Telephone:</label>
                                <input type="text" class="form-control" id="telephone" name="telephone">
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