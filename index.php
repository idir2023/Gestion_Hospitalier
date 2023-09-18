<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- normalize css -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- custom css -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- header -->
    <header class="header bg-blue">
        <?php include 'header.php'; ?>
        <div class="header-inner text-white text-center">
            <div class="container grid">
                <div class="header-inner-left">
                    <h1>votre partenaire santé<br> <span>le plus fiable</span></h1>
                    <p class="lead">les meilleurs services correspondants pour vous</p>
                    <p class="text text-md">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Totam, nulla odit esse necessitatibus corporis voluptatem?</p>
                    <div class="btn-group">
                        <a href="login.php" class="btn btn-light-blue">Se Connecter</a>
                    </div>
                </div>
                <div class="header-inner-right">
                    <img src="images/header.png">
                </div>
            </div>
        </div>
    </header>
    <!-- end of header -->

    <main>
        <!-- about section -->
        <section id="about" class="about py">
            <div class="about-inner">
                <div class="container grid">
                    <div class="about-left text-center">
                        <div class="section-head">
                            <h2>About Us</h2>
                            <div class="border-line"></div>
                        </div>
                        <p class="text text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae molestias delectus facilis, temporibus eum consectetur, a debitis exercitationem quae distinctio aliquid ea ipsam vitae esse amet soluta maxime dolorem? Inventore ut maiores illo ipsum nisi, nulla eligendi unde reiciendis quod voluptas velit sit voluptate perferendis cum pariatur molestiae tenetur repellat!</p>
                        <a href="#" class="btn btn-white">Learn More</a>
                    </div>
                    <div class="about-right flex">
                        <div class="img">
                            <img src="images/about-img.png">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of about section -->

        <!-- banner one -->
        <section id="banner-one" class="banner-one text-center">
            <div class="container text-white">
                <blockquote class="lead"><i class="fas fa-quote-left"></i> When you are young and healthy, it never occurs to you that in a single second your whole life could change. <i class="fas fa-quote-right"></i></blockquote>
                <small class="text text-sm">- Anonim Nano</small>
            </div>
        </section>
        <!-- end of banner one -->

        <!-- services section -->
        <section id="service" class="services py">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="lead">The Best Doctor gives the least medicines</h2>
                    <p class="text text-lg">A perfect way to show your hospital services</p>
                    <div class="line-art flex">
                        <div></div>
                        <img src="images/4-dots.png">
                        <div></div>
                    </div>
                </div>
                <div class="services-inner text-center grid">
                    <article class="service-item">
                        <div class="icon">
                            <img src="images/service-icon-1.png">
                        </div>
                        <h3>Cardio Monitoring</h3>
                        <p class="text text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis possimus doloribus facilis velit, assumenda tempora quas mollitia quos voluptatibus consequatur!</p>
                    </article>

                    <article class="service-item">
                        <div class="icon">
                            <img src="images/service-icon-2.png">
                        </div>
                        <h3>Medical Treatment</h3>
                        <p class="text text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis possimus doloribus facilis velit, assumenda tempora quas mollitia quos voluptatibus consequatur!</p>
                    </article>

                    <article class="service-item">
                        <div class="icon">
                            <img src="images/service-icon-3.png">
                        </div>
                        <h3>Emergency Help</h3>
                        <p class="text text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis possimus doloribus facilis velit, assumenda tempora quas mollitia quos voluptatibus consequatur!</p>
                    </article>

                    <article class="service-item">
                        <div class="icon">
                            <img src="images/service-icon-4.png">
                        </div>
                        <h3>First Aid</h3>
                        <p class="text text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis possimus doloribus facilis velit, assumenda tempora quas mollitia quos voluptatibus consequatur!</p>
                    </article>
                </div>
            </div>
        </section>
        <!-- end of services section -->
        <!-- banner two section -->
        <section id="banner-two" class="banner-two text-center">
            <div class="container grid">
                <div class="banner-two-left">
                    <img src="images/banner-2-img.png">
                </div>
                <div class="banner-two-right">
                    <p class="lead text-white">When you are young and healthy, it never occurs to you that in a single second your whole life could change.</p>
                    <div class="btn-group">
                        <a href="login.php" class="btn btn-light-blue">Se Connecter</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of banner two section -->
        <!-- doctors section -->
        <section id="doctors" class="doc-panel py">
        <div class="container-fluid">
            <div class="row">
       
       <!-- Header -->
           <?php
           include_once('./connDB.php');
           try {

            $sql = "SELECT * FROM doctor";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
               // Exécuter la requête
               $stmt->execute();
           } catch (PDOException $e) {
               echo "Erreur : " . $e->getMessage();
           }

           // Fermer la connexion à la base de données
           $conn = null;
           ?>
<div class="doctors-container col-md-12 col-lg-8">
 <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
   <div class="doctor-card col-md-6 col-lg-4">
     <img src="./images/<?php echo $result['photo'];?>" alt="Photo">
     <h3><?php echo $result['nom_d'] . ' ' . $result['prenom_d']; ?></h3>
     <p class="specialite"><?php echo $result['specialite']; ?></p>
     <p class="cin"><?php echo $result['cin']; ?></p>
     <p class="telephone"><?php echo $result['telephone']; ?></p>
     <a class="btn btn-light-blue" href="contact.php?id=<?php echo $result['id']; ?>">Prendre Rendez-vous</a>
   </div>
 <?php } ?>
</div>
<style>
 .doctors-container {
   display: flex;
   flex-wrap: wrap;
   gap: 20px;
 }
 
 .doctor-card {
   display: flex;
   flex-direction: column;
   align-items: center;
   width: 250px;
   border: 1px solid #ccc;
   border-radius: 10px;
   padding: 20px;
 }
 
 .doctor-card img {
   width: 150px;
   height: 150px;
   object-fit: cover;
   border-radius: 50%;
   margin-bottom: 10px;
 }
 
 .doctor-card h3 {
   font-size: 1.5rem;
   margin-bottom: 10px;
 }
 
 .doctor-card p {
   margin-bottom: 5px;
 }
 
 .doctor-card .specialite {
   font-style: italic;
 }
</style>
   </div>
   </div>
        </section>

        <!-- end of doctors section -->
        <section id="contact" class="contact py">
            <div class="container grid">
                <div class="contact-left">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2384.6268289831164!2d-6.214682984112116!3d53.29621947996855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x486709e0c9c80f8f%3A0x92f408d10f2277c2!2sREVO!5e0!3m2!1sen!2snp!4v1636264848776!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="contact-right text-white text-center bg-blue">
                    <div class="contact-head">
                        <h3 class="lead">Contact Us</h3>
                        <p class="text text-md">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga.</p>
                    </div>
                    <form method="post" action="contact.php">
                        <div class="form-element">
                            <input type="text" class="form-control" name="name" placeholder="Your name">
                        </div>
                        <div class="form-element">
                            <input type="email" class="form-control" name="email" placeholder="Your email">
                        </div>
                        <div class="form-element">
                            <textarea rows="5" placeholder="Your Message" name="message" class="form-control"></textarea>
                        </div>
                        <button type="submit" name="contact" class="btn btn-white btn-submit">
                            <i class="fas fa-arrow-right"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <!-- posts section -->
        <!-- package services section -->
        <section id="services" class="package-service py text-center">
            <div class="container">
                <div class="package-service-head text-white">
                    <h2>Package Service</h2>
                    <p class="text text-lg">Best service package for you</p>
                </div>
                <div class="package-service-inner grid">
                    <div class="package-service-item bg-white">
                        <div class="icon flex">
                            <i class="fas fa-phone fa-2x"></i>
                        </div>
                        <h3>Regular Case</h3>
                        <p class="text text-sm">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur, asperiores. Expedita, reiciendis quos beatae at consequatur voluptatibus fuga iste adipisci.</p>
                        <a href="#" class="btn btn-blue">Read More</a>
                    </div>
                    <div class="package-service-item bg-white">
                        <div class="icon flex">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <h3>Serious Case</h3>
                        <p class="text text-sm">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur, asperiores. Expedita, reiciendis quos beatae at consequatur voluptatibus fuga iste adipisci.</p>
                        <a href="#" class="btn btn-blue">Read More</a>
                    </div>
                    <div class="package-service-item bg-white">
                        <div class="icon flex">
                            <i class="fas fa-comments fa-2x"></i>
                        </div>
                        <h3>Emergency Case</h3>
                        <p class="text text-sm">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur, asperiores. Expedita, reiciendis quos beatae at consequatur voluptatibus fuga iste adipisci.</p>
                        <a href="#" class="btn btn-blue">Read More</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of package services section -->
        <!-- end of contact section -->
    </main>
    <?php include 'footer.php'; ?>
    <!-- custom js -->
    <script src="js/script.js"></script>
</body>

</html>