<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion Hopital </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-warning">
    <!-- Logo -->
    <a href="#" class="navbar-brand">
        <i class="fas fa-hospital"></i>
        <span class="brand-text font-weight-light">Hospital Management</span>
    </a>
    <!-- Liens de la barre de navigation -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="../deconnexion.php">
                <i class="fas fa-power-off"></i> Déconnexion
            </a>
        </li>
    </ul>
</nav>
<!-- Barre latérale -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo de la barre latérale -->
    <a href="patient.php" class="brand-link">
        <img src="../images/a10.jpg" alt="Hospital Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Patient</span>
    </a>
    <!-- Menu de la barre latérale -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="Patient.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Mon Profil</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="listeR.php" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Rendez-vous</p>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a href="listeD.php" class="nav-link">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Les médecins</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="voirDossier.php" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Dossier</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="facture.php" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Facture</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- Contenu de la page -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" style="font-family: Arial, sans-serif; font-size: 28px;">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="font-family: Arial, sans-serif; font-size: 18px; color: #555;">
                        <li class="breadcrumb-item active"><a href="Patient.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-chart-bar"></i> Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>