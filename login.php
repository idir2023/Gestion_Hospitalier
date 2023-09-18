<?php
session_start();
include 'connDB.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    // Vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM `utilisateur` WHERE email ='$email' and mot_de_passe='$mot_de_passe';";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        // Authentification réussie, stocker l'ID de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['email'] = $user['email'];
        // Vérifier si le mot de passe correspond
        if ($stmt) {
            // Rediriger vers la page correspondante en fonction du rôle de l'utilisateur
            if ($user['role'] == 'patient') {
                header("Location: ./client/Patient.php");
                exit();
            } elseif ($user['role'] == 'medecin') {
                header("Location: ./doctor/doctor.php");
                exit();
            } elseif ($user['role'] == 'admin') {
                header("Location: ./admin/admin.php");
                exit();
            }
        } else {
            echo "<script> alert('Email ou mot de passe incorrect.') </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
  #contact {
    background-color: #007bff;
    padding: 50px;
}

.container.grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    align-items: center;
}

.contact-left img {
    width: 100%;
    max-width: 600px;
    height: auto;
    border: 0;
}

.contact-right {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
}

.card-header {
    background-color: #dc3545;
    padding: 20px;
    border-radius: 5px;
}

.card-header h3 {
    margin: 0;
    color: #fff;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #000;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

#submit {
    background-color: blue;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

#submit:hover {
    background-color: #0056b3;
}

#idir {
    color: blue;
    text-decoration: none;
}

.text-dark {
    color: #000;
}

.text-dark a {
    color: #007bff;
    text-decoration: none;
}

.text-dark a:hover {
    text-decoration: underline;
}

    /* Header styles */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f8f9fa;
        padding: 10px;
    }

    .header img {
        height: 50px;
    }

    .header a {
        font-size: 20px;
        color: #007bff;
        text-decoration: none;
    }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include 'header.php'; ?>
    <!-- Main content -->
    <section id="contact" class="contact py">
        <div class="container grid">
            <div class="contact-left">
                <img src="images/header.png" width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy"></img>
            </div>
            <div class="contact-right text-white text-center bg-blue">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-white text-center">
                            <h3 class="mt-3 text-danger">Connexion Utilisateurs</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="mot_de_passe">Mot de passe :</label>
                                    <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Se connecter</button>
                                </div>
                                <div class="text-center">
                                    <p class="text text-dark">Si vous n'avez pas de compte? <a href="inscrit.php" id="idir">S'inscrire</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <!-- Ajout des scripts JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
