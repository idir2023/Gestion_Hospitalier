<?php
include 'sessionP.php';
include_once('../connDB.php');
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
            <!-- Header -->
            <div class="row">
                <div class="col-sm-12 ">
                <?php
                    $id_p = $_SESSION['user_id'];
                    $stmt = $pdo->prepare("SELECT * FROM utilisateur,patient WHERE utilisateur.id=patient.id_user  AND utilisateur.id = :id");
                    $stmt->bindParam(":id", $id_p);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC); ?>
                    <h2 class="text text-center bg-secondary">Bienvenue <?php echo $result['nom_p']. ' ' . $result['prenom_p']; ?></h2>
                    <hr>
                </div>
            </div>
            <!-- Cards -->
            <div class="table-responsive">
                <?php
                include_once('../connDB.php');
                $id_p = $_SESSION['user_id'];
                try {
                    $stmt = $pdo->prepare("SELECT * FROM utilisateur,patient WHERE utilisateur.id=patient.id_user  AND utilisateur.id = :id");
                    $stmt->bindParam(":id", $id_p);
                    $stmt->execute();
                    $id = 1;
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }

                ?>
                <!-- Card -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">Mon Profil</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="../images/<?php echo $result['photo']; ?>" class="img-fluid rounded-circle" alt="Photo de profil">
                                        </div>
                                        <div class="col-md-8">
                                            <h5 class="card-subtitle mb-2 text-muted">Informations personnelles</h5>
                                            <hr>
                                            <p class="card-text"><strong>Nom:</strong> <?php echo $result['nom_p'] ?></p>
                                            <p class="card-text"><strong>Prénom:</strong> <?php echo $result['prenom_p'] ?></p>
                                            <p class="card-text"><strong>Email:</strong> <?php echo $result['email'] ?></p>
                                            <p class="card-text"><strong>Rôle:</strong> <?php echo $result['role'] ?></p>
                                            <p class="card-text"><strong>Mot de passe:</strong> <?php echo $result['mot_de_passe'] ?></p>
                                            <a href="crud.php?update=<?php echo $result['id_user']; ?>" class="btn btn-primary">Modifier</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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