<?php
    session_start();
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=pfeolaitan', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    if (isset($_POST['mailsign'], $_POST['passwo']) && !empty($_POST['mailsign']) && !empty($_POST['passwo'])) {
          $requete=$bdd->prepare('SELECT * FROM client WHERE mailo=:mail AND pass=:passo');
          $requete->execute(array('mail'=>$_POST['mailsign'], 'passo'=>$_POST['passwo']));
          if ($lack=$requete->fetch()) {
              $_SESSION['id']=$lack['idclt'];
              $_SESSION['email']=$lack['mailo'];
              $_SESSION['univer']=$lack['university'];
              $_SESSION['pass']=$lack['pass'];
              $_SESSION['fullname']=$lack['name'];
              header('Location: index.php');
           }
    }
    if (isset($_POST['cmpname'], $_POST['mailo'], $_POST['uni'], $_POST['pass']) && !empty($_POST['cmpname']) && !empty($_POST['mailo']) && !empty($_POST['uni']) && !empty($_POST['pass'])) {
      
          $donne=$bdd->prepare('INSERT INTO client(name, mailo, pass, university) VALUES
          (:namo, :mail, :passwor, :univer)');
          $donne->execute(array('namo'=>$_POST['cmpname'], 'mail'=>$_POST['mailo'], 'passwor'=>$_POST['pass'], 'univer'=>$_POST['uni']));
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Olaitan-PFE</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <script src="https://kit.fontawesome.com/3e89b58b4e.js" crossorigin="anonymous"></script>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<!--style="background: url('img/backbody1.jpg'); background-repeat: none; background-attachment: fixed; background-size: cover; height: auto;"-->
<body class="overflowX-hidden">
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row py-2 px-xl-5 top-back">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="" href="" style="color: white;">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="" href="" style="color: white;">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="" href="" style="color: white;">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="https://www.facebook.com/OLaitanBusinessAttitude/">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="https://www.linkedin.com/company/olaitan-organization">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="https://www.instagram.com/olaitan_organization">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-0 pr-xl-5 bg-warning">
            <div class="col-lg-3 d-none d-lg-block p-0 m-0 border-dark">
                    <!--<h1 class="m-0 display-5 font-weight-semi-bold text-dark"><span class="text-yellow font-weight-bold border px-3 mr-1 text-white" style="background: black; color: black; border-radius: 10px; border: 2px solid black;">PFE</span>OLAITAN</h1>-->
                    <a class="navbar-brand p-0 border-0" href="#" style="border: none;">
                      <img src="img/logo_pfe.png" class="p-0" alt="" width="400" height="95">
                    </a>

            </div>
            <div class="col-6 col-lg-6 col-md-0 col-sm-6 text-left">
            </div>
            <div class="col-lg-3 col-6 text-right d-none d-lg-block">
                <?php
                  if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
                      $compter=$bdd->query('SELECT COUNT(idachclt) AS idcmp, idachclt FROM acheter WHERE idachclt='.$_SESSION['id'].'');
                      $compterval=$compter->fetch();
                  }
                ?>
                <a href="" class="btn border-3" style="border-radius: 10px; border-color: black;">
                    <i class="fas fa-shopping-cart text-dark" style="color: black;"></i>
                    <span class="badge text-dark"><?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])){echo $compterval['idcmp'];}?></span>
                </a>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-warning navbar-light py-3 py-lg-0 px-0 d-block d-lg-none">
        <div class="container-fluid pr-3">
                    <a class="navbar-brand d-block d-lg-none position-relative" href="#" style="right: 40px;">
                      <img src="img/logo_pfe.png" class="ml-0" alt="" width="280" height="70">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between text-center" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="" class="nav-item nav-link">Home</a><!--index.html-->
                            <a href="" class="nav-item nav-link">Shop</a><!--shop.html-->
                            <a href="" class="nav-item nav-link">About us</a>
                            <a href="" class="nav-item nav-link position-relative">
                                Inbox
                                  <span class="position-absolute top-10 start-100 translate-middle badge rounded-pill bg-dark">
                                    99
                                  </span>
                            </a><!--detail.html-->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Services</a><!---->
                                <div class="dropdown-menu rounded-0 m-0 text-center bg-warning border-0" style="width: 104%;">
                                    <a href="" class="dropdown-item">Official Website</a><!--cart.html-->
                                    <a href="" class="dropdown-item">Business Model</a>
                                    <a href="" class="dropdown-item">Olaitan Academy</a><!--checkout.html-->
                                </div>
                            </div>
                            <a href="" class="nav-item nav-link">Contact</a>
                            <div class="nav-item dropdown m-0 p-0">
                                <a href="#" class="nav-link dropdown-toggle w-110" data-toggle="dropdown">Category</a><!---->
                                <div class="dropdown-menu rounded-0 m-0 bg-warning border-0" style="width: 104%;">
                                    <div class="dropdown-menu hidde d-flex justify-content-around align-items-center rounded-0 m-0 bg-warning border-0" aria-labelledby="navbarDropdown333">
                                                <div>
                                                    <style type="text/css">
                                                        @media (max-height: 950px) and (max-width: 550px) {
                                                        .dropdown-menu .nav-link{
                                                            font-size: 0.8em;
                                                        }

                                                }
                                                    </style>
                                                    <a href="shop.php?typo=Comptabilite" class="nav-item nav-link"><i class="fa-solid fa-calculator text-dark"></i> Comptabilite</a>
                                                    <a href="shop.php?typo=Fiscalite" class="nav-item nav-link"><i class="fa-solid fa-certificate text-dark"></i> Fiscalite</a>
                                                    <a href="shop.php?typo=Gestion" class="nav-item nav-link"><i class="fa-solid fa-list-check text-dark"></i> Gestion</a>
                                                    <a href="shop.php?typo=Nature" class="nav-item nav-link"><i class="fa-solid fa-leaf text-dark"></i> Nature</a>
                                                </div>
                                                <div>
                                                    <a href="shop.php?typo=Biologie" class="nav-item nav-link"><i class="fa-solid fa-dna text-dark"></i> Biologie</a>
                                                    <a href="shop.php?typo=Physique" class="nav-item nav-link"><i class="fa-solid fa-atom text-dark"></i> Physique</a>
                                                    <a href="shop.php?typo=Technologie" class="nav-item nav-link"><i class="fa-solid fa-microchip text-dark"></i> Technologie</a>
                                                    <a href="shop.php?typo=Religiuos" class="nav-item nav-link"><i class="fa-solid fa-book text-dark"></i> Religiuos</a>
                                                </div>
                                                <div>
                                                    <a href="shop.php?typo=Economie" class="nav-item nav-link"><i class="fa-solid fa-coins text-dark"></i> Economie</a>
                                                    <a href="shop.php?typo=Music" class="nav-item nav-link"><i class="fa-solid fa-music text-dark"></i> Music</a>
                                                    <a href="shop.php?typo=Theatre" class="nav-item nav-link"><i class="fa-solid fa-masks-theater text-dark"></i> Theatre</a>
                                                    <a href="shop.php?typo=Professional" class="nav-item nav-link"><i class="fa-solid fa-user-tie text-dark"></i> Professional</a>
                                                </div>
                                    </div>
                                </div>
                            </div>
                            <!--contact.html-->
                            <!--<div class="nav-item dropdown d-block d-lg-none">
                                <a href="#" class="dropdown-toggle" href="#" id="navbarDropdown333" role="button" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                                <div class="dropdown-menu hidde d-flex justify-content-around align-items-center rounded-0 m-0" aria-labelledby="navbarDropdown333">
                                                <div>
                                                    <style type="text/css">
                                                        @media (max-height: 950px) and (max-width: 550px) {
                                                        .dropdown-menu .nav-link{
                                                            font-size: 0.8em;
                                                        }
                                                }
                                                    </style>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-calculator text-dark"></i> Comptabilite</a>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-certificate text-dark"></i> Fiscalite</a>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-list-check text-dark"></i> Gestion</a>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-leaf text-dark"></i> Nature</a>
                                                </div>
                                                <div>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-dna text-dark"></i> Biologie</a>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-atom text-dark"></i> Physique</a>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-microchip text-dark"></i> Technologie</a>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-book text-dark"></i> Religiuos</a>
                                                </div>
                                                <div>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-coins text-dark"></i> Economie</a>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-music text-dark"></i> Music</a>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-masks-theater text-dark"></i> Theatre</a>
                                                    <a href="" class="nav-item nav-link"><i class="fa-solid fa-user-tie text-dark"></i> Professional</a>
                                                </div>
                                    </div>
                                </div>-->

                            </div>
                             <div class="navbar-nav ml-auto py-0">
                            <button type="button" class="btn btn-white button_affiche" data-toggle="modal" data-target="#monmodal3">
                                Log in
                            </button>
                            <div class="modal" id="monmodal3">
                                <div class="modal-dialog bg-light">
                                    <div class="modal-header" style="font-family: Century Gothic; font-size: 2em;">
                                        <span class="text-dark">Log in</span>
                                        <span class="back_poper about_back"></span>
                                        <span></span>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body d-flex justify-content-around flex-column text-dark" style="z-index: 400;">
                                            <form action="index.php" method="post">
                                                <div class="form-floating mb-3">
                                                  <input type="email" class="form-control inputage" id="floatingInput" name="mailsign" placeholder="name@example.com">
                                                  <label for="floatingInput">Email address</label>
                                                </div>
                                                <div class="form-floating">
                                                  <input type="password" class="form-control inputage inppass" id="floatingPassword" name="passwo" placeholder="Password">
                                                  <label for="floatingPassword">Password</label>
                                                </div>
                                                <div class="envoyeur">
                                                    <button type="submit" class="btn btn-warning mt-3 envoie"style="cursor: pointer;">Submit</button>
                                                    <button type="reset" class="btn btn-warning mt-2 envoie"style="cursor: pointer;">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark text-white fw-bold butona" data-bs-dismiss="modal">Close Tab</button>
                                  </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-white button_affiche" data-toggle="modal" data-target="#monmodal4">
                                Register
                            </button>
                            <div class="modal" id="monmodal4">
                                <div class="modal-dialog bg-light">
                                    <div class="modal-header" style="font-family: Century Gothic; font-size: 2em;">
                                        <span class="text-dark">Register</span>
                                        <span class="back_poper back_reg"></span>
                                        <span></span>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body d-flex justify-content-around flex-column text-dark" style="z-index: 400;">
                                            <form action="index.php" method="post">
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control inputage" id="floatingInput" name="cmpname" placeholder="name@example.com">
                                                  <label for="floatingInput">Full Name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control inputage inppass" id="floatingInput3" name="uni" placeholder="Password">
                                                  <label for="floatingInput3">School Or University Name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                  <input type="email" class="form-control inputage inppass" id="floatingInput2" name="mailo" placeholder="name@example.com">
                                                  <label for="floatingInput2">E-mail</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                  <input type="password" class="form-control inputage inppass" id="floatingPassword2" name="pass" placeholder="Password">
                                                  <label for="floatingPassword2">Password</label>
                                                </div>
                                                <div class="envoyeur">
                                                    <button type="submit" class="btn btn-warning mt-0 envoie"style="cursor: pointer;">Submit</button>
                                                    <button type="reset" class="btn btn-warning mt-2 envoie"style="cursor: pointer;">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark text-white fw-bold butona" data-bs-dismiss="modal">Close Tab</button>
                                  </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
        </div>
                </nav>
    <!-- Topbar End -->

<!--#ffc562-->
    <!-- Navbar Start -->
<div style="background: rgba(255, 255, 255, 0.8); height: auto; overflow-y: hidden; wi100%">
    <div class="container-fluid p-0 mr-0" style="width: 100%;">
        <div class="row border-top p-0 mr-5" style="width: 101.2%;">
            <div class="col-lg-12 p-0 m-0" style="width: 100%;">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 d-none d-lg-block" style="width: 100%;">
                    <a class="navbar-brand p-0 d-block d-lg-none" href="#" style="border: none;">
                      <img src="img/logo_pfe.png" class="p-0" alt="" width="300" height="90">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav py-0">
                            <div>
                                <a class="btn shadow-black d-flex align-items-center justify-content-between bg-white text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px; background: white;">
                    <h6 class="m-0 mr-4">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light position-absolute mt-0" id="navbar-vertical" style="z-index: 400; width: 100%;">
                    <div class="navbar-nav w-100 overflow-hidden d-flex justify-content-around align-items-center" style="height: 200px;">
                            <style type="text/css">
                            .nav-link{
                                color: black;
                            }
                            .nav-link:hover, .nav-link:focus{
                                color: gray;
                            }
                            </style>
                        <div>
                            <a href="shop.php?typo=Comptabilite" class="nav-item nav-link"><i class="fa-solid fa-calculator text-dark mr-2"></i> Comptabilite</a>
                            <a href="shop.php?typo=Fiscalite" class="nav-item nav-link"><i class="fa-solid fa-certificate text-dark mr-2"></i> Fiscalite</a>
                            <a href="shop.php?typo=Gestion" class="nav-item nav-link"><i class="fa-solid fa-list-check text-dark mr-2"></i> Gestion</a>
                            
                        </div>
                        <div>
                            <a href="shop.php?typo=Biologie" class="nav-item nav-link"><i class="fa-solid fa-dna text-dark mr-2"></i> Biologie</a>
                            <a href="shop.php?typo=Physique" class="nav-item nav-link"><i class="fa-solid fa-atom text-dark mr-2"></i> Physique</a>
                            <a href="shop.php?typo=Technologie" class="nav-item nav-link"><i class="fa-solid fa-microchip text-dark mr-2"></i> Technologie</a>
                        </div>
                        <div>
                            <a href="shop.php?typo=Economie" class="nav-item nav-link"><i class="fa-solid fa-coins text-dark mr-2"></i> Economie</a>
                            <a href="shop.php?typo=Music" class="nav-item nav-link"><i class="fa-solid fa-music text-dark mr-2"></i> Music</a>
                            <a href="shop.php?typo=Theatre" class="nav-item nav-link"><i class="fa-solid fa-masks-theater text-dark mr-2"></i> Theatre</a>
                        </div>
                        <div>
                            <a href="shop.php?typo=Nature" class="nav-item nav-link"><i class="fa-solid fa-leaf text-dark mr-2"></i> Nature</a>
                            <a href="shop.php?typo=Religiuos" class="nav-item nav-link"><i class="fa-solid fa-book text-dark mr-2"></i> Religiuos</a>
                            <a href="shop.php?typo=Professional" class="nav-item nav-link"><i class="fa-solid fa-user-tie text-dark mr-2"></i> Professional</a>
                        </div>
                        
                    </div>
                </nav>
                            </div>
                            <a href="" class="nav-item nav-link">Home</a><!--index.html-->
                            <a href="" class="nav-item nav-link">Shop</a><!--shop.html-->
                            <button type="button" class="btn btn-white button_affiche" data-toggle="modal" data-target="#monmodal1">
                                About us
                            </button>
                            <div class="modal" id="monmodal1">
                                <div class="modal-dialog bg-light">
                                    <div class="modal-header" style="font-family: Century Gothic; font-size: 2em;">
                                        <span class="text-dark">About us</span>
                                        <span class="back_poper about_back"></span>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body d-flex justify-content-around flex-column text-dark" style="z-index: 400;">
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                            xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-dark text-white fw-bold butona" data-bs-dismiss="modal" style="cursor: pointer;">Close</button>
                                  </div>
                                </div>
                            </div><!--detail.html-->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Services</a><!---->
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="" class="dropdown-item">Official Website</a><!--cart.html-->
                                    <a href="" class="dropdown-item">Business Model</a>
                                    <a href="" class="dropdown-item">Olaitan Academy</a><!--checkout.html-->
                                </div>
                            </div>
                            <button type="button" class="btn btn-white button_affiche" data-toggle="modal" data-target="#monmodal2">
                                Contact
                            </button>
                            <div class="modal" id="monmodal2">
                                <div class="modal-dialog bg-light">
                                    <div class="modal-header text-dark" style="font-family: Century Gothic; font-size: 2em;">
                                        <span class="text-dark">Contact</span>
                                        <span class="back_poper contact_back"></span>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body d-flex justify-content-around flex-column">
                                            <a href="" class="link_contact">
                                                <img src="img/facebook.png" class="mx-3">Olaitan Organization
                                            </a>
                                            <a href="" class="link_contact">
                                                <img src="img/instagram.png" class="mx-3">Olaitan_Organization
                                            </a>
                                            <a href="" class="link_contact">
                                                <img src="img/linkedin.png" class="mx-3">OLaitan Organization
                                            </a>
                                            <a href="" class="link_contact">
                                                <img src="img/whatsapp.png" class="mx-3">+212 6 23 01 13 84
                                            </a>
                                            <a href="" class="link_contact">
                                                <img src="img/gmail.png" class="mx-3">olaitanorganization@gmail.com
                                            </a>
                                            <a href="" class="link_contact">
                                                <img src="img/world-wide-web.png" class="mx-3">https://www.olaitanorganization.com
                                            </a>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-dark text-white fw-bold butona" data-bs-dismiss="modal" style="cursor: pointer;">Close</button>
                                  </div>
                                </div>
                            </div>
                            <div class="nav-item dropdown d-block d-lg-none">
                                <a href="#" class="nav-link dropdown-toggle d-flex justify-content-around align-items-center" data-toggle="dropdown">Category</a><!---->
                                <div class="dropdown-menu rounded-0 m-0">
                                    <div>
                            <a href="shop.php?typo=Comptabilite" class="nav-item nav-link"><i class="fa-solid fa-calculator text-dark mr-2"></i> Comptabilite</a>
                            <a href="shop.php?typo=Fiscalite" class="nav-item nav-link"><i class="fa-solid fa-certificate text-dark mr-2"></i> Fiscalite</a>
                            <a href="shop.php?typo=Gestion" class="nav-item nav-link"><i class="fa-solid fa-list-check text-dark mr-2"></i> Gestion</a>
                            
                        </div>
                        <div>
                            <a href="shop.php?typo=Biologie" class="nav-item nav-link"><i class="fa-solid fa-dna text-dark mr-2"></i> Biologie</a>
                            <a href="shop.php?typo=Physique" class="nav-item nav-link"><i class="fa-solid fa-atom text-dark mr-2"></i> Physique</a>
                            <a href="shop.php?typo=Technologie" class="nav-item nav-link"><i class="fa-solid fa-microchip text-dark mr-2"></i> Technologie</a>
                        </div>
                        <div>
                            <a href="shop.php?typo=Economie" class="nav-item nav-link"><i class="fa-solid fa-coins text-dark mr-2"></i> Economie</a>
                            <a href="shop.php?typo=Music" class="nav-item nav-link"><i class="fa-solid fa-music text-dark mr-2"></i> Music</a>
                            <a href="shop.php?typo=Theatre" class="nav-item nav-link"><i class="fa-solid fa-masks-theater text-dark mr-2"></i> Theatre</a>
                        </div>
                        <div>
                            <a href="shop.php?typo=Nature" class="nav-item nav-link"><i class="fa-solid fa-leaf text-dark mr-2"></i> Nature</a>
                            <a href="shop.php?typo=Religiuos" class="nav-item nav-link"><i class="fa-solid fa-book text-dark mr-2"></i> Religiuos</a>
                            <a href="shop.php?typo=Professional" class="nav-item nav-link"><i class="fa-solid fa-user-tie text-dark mr-2"></i> Professional</a>
                        </div>

                                </div>
                            </div>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <!--<a href="" class="nav-item nav-link">Login</a>-->
                            <button type="button" class="btn btn-white button_affiche" data-toggle="modal" data-target="#monmodal33">
                                Log in
                            </button>
                            <div class="modal" id="monmodal33">
                                <div class="modal-dialog bg-light">
                                    <div class="modal-header" style="font-family: Century Gothic; font-size: 2em;">
                                        <span class="text-dark">Log in</span>
                                        <span class="back_poper about_back"></span>
                                        <span></span>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body d-flex justify-content-around flex-column text-dark" style="z-index: 400;">
                                            <form action="index.php" method="post">
                                                <div class="form-floating mb-3">
                                                  <input type="email" class="form-control inputage" id="floatingInput" name="mailsign" placeholder="name@example.com">
                                                  <label for="floatingInput">Email address</label>
                                                </div>
                                                <div class="form-floating">
                                                  <input type="password" class="form-control inputage inppass" id="floatingPassword" name="passwo" placeholder="Password">
                                                  <label for="floatingPassword">Password</label>
                                                </div>
                                                <div class="envoyeur">
                                                    <button type="submit" class="btn btn-warning mt-3 envoie"style="cursor: pointer;">Submit</button>
                                                    <button type="reset" class="btn btn-warning mt-2 envoie"style="cursor: pointer;">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark text-white fw-bold butona" data-bs-dismiss="modal">Close Tab</button>
                                  </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-white button_affiche" data-toggle="modal" data-target="#monmodal44">
                                Register
                            </button>
                            <div class="modal" id="monmodal44">
                                <div class="modal-dialog bg-light">
                                    <div class="modal-header" style="font-family: Century Gothic; font-size: 2em;">
                                        <span class="text-dark">Register</span>
                                        <span class="back_poper back_reg"></span>
                                        <span></span>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body d-flex justify-content-around flex-column text-dark" style="z-index: 400;">
                                            <form action="index.php" method="post">
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control inputage" id="floatingInput" name="cmpname" placeholder="name@example.com">
                                                  <label for="floatingInput">Full Name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control inputage inppass" id="floatingInput3" name="uni" placeholder="Password">
                                                  <label for="floatingInput3">School Or University Name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                  <input type="email" class="form-control inputage inppass" id="floatingInput2" name="mailo" placeholder="name@example.com">
                                                  <label for="floatingInput2">E-mail</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                  <input type="password" class="form-control inputage inppass" id="floatingPassword2" name="pass" placeholder="Password">
                                                  <label for="floatingPassword2">Password</label>
                                                </div>
                                                <div class="envoyeur">
                                                    <button type="submit" class="btn btn-warning mt-0 envoie"style="cursor: pointer;">Submit</button>
                                                    <button type="reset" class="btn btn-warning mt-2 envoie"style="cursor: pointer;">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark text-white fw-bold butona" data-bs-dismiss="modal">Close Tab</button>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid mt-0 bottomage">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="header-carousel" class="carousel slide border-dark" data-ride="carousel" style="width: 101.2%; min-width: 101.2%;">
                                <div class="carousel-inner adapter bg-warning">
                                    <div class="carousel-item active imageo" style="height: 550px;">
                                        <img class="img-fluid" src="https://th.bing.com/th/id/R.65c9663e31e1b4c113810227cc1c0b12?rik=0eiGF4AxpnRPBA&pid=ImgRaw&r=0" alt="Image">
                                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                            <div class="p-3" style="max-width: 700px;">
                                                <h4 class="text-light text-uppercase font-weight-medium mb-3">Design your Career</h4>
                                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">50% discount on your PHD design</h3>
                                                <a href="" class="btn btn-light py-2 px-3 bg-warning border-dark">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item imageo" style="height: 550px;">
                                        <img class="img-fluid" src="https://www.reading.ac.uk/typography/-/media/project/uor-main/schools-departments/typography/phd/edits/collections-based-study.jpg?h=675&la=en&w=1200&hash=FC090D2F847E1B1186FBB5FF84C24914" alt="Image">
                                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                            <div class="p-3" style="max-width: 700px;">
                                                <h4 class="text-light text-uppercase font-weight-medium mb-3">We help you</h4>
                                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Find The Best Design With The Best Price</h3>
                                                <a href="" class="btn btn-light py-2 px-3 bg-warning border-dark">Find Out</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item imageo" style="height: 550px;">
                                        <img class="img-fluid" src="https://www.iade.europeia.pt/hs-fs/hubfs/IADE-SITE/doutoramentos/unidcom.jpg?t=1537197569522&width=2190&height=1287&name=unidcom.jpg" alt="Image">
                                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="
                                        ">
                                        <style type="text/css">
                                            .carousel-caption{
                                                background: linear-gradient(rgba(0, 0, 0, 0.4) 60%, rgba(255, 193, 7, 1));
                                            }
                                        </style>
                                            <div class="p-3" style="max-width: 700px;">
                                                <h4 class="text-light text-uppercase font-weight-medium mb-3">Dicover our</h4>
                                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Recent Unique Designes</h3>
                                                <a href="" class="btn btn-light py-2 px-3 bg-warning border-dark">Discover Now</a>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-prev-icon mb-n2"></span>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-next-icon mb-n2"></span>
                            </div>
                        </a>
                    </div>
                     <div class="shapedividers_com-275 text-white position-relative"></div>
                </div>
                <style type="text/css">
                    .shapedividers_com-275{
                    overflow:hidden;
                    position:relative;
                    width: 101.2%;
                    min-width: 101.2%;
                    height: 100px;
                    }
                    .shapedividers_com-275::before{ 
                    content:'';
                    font-family:'shape divider from ShapeDividers.com';
                    position: absolute;
                    z-index: 3;
                    pointer-events: none;
                    background-repeat: no-repeat;
                    bottom: -0.1vw;
                    left: -0.1vw;
                    right: -0.1vw;
                    top: -0.1vw; 
                    background-size: 100% 90px;
                    background-position: 50% 0%;  background-image: url('data:image/svg+xml;charset=utf8, <svg preserveAspectRatio="xMidYMax slice" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 73"><g fill="%23ffc107"><path d="M2000 0v14c-6 0-11 2-16 6a48 48 0 00-4 7 46 46 0 01-3 3c-3 4-6 6-10 6l-12-3c-4 0-6 4-8 7s-5 7-8 8c-4 1-8-1-12-3l-2-2a23 23 0 00-14-2 29 29 0 00-14 6l-3 2-12 15-12-15c-5-4-11-7-17-8a23 23 0 00-13 2c-5 3-10 7-15 5-3-1-6-5-8-8s-4-7-8-7-8 3-11 3c-5 0-8-2-11-6l-1-1-6-9c-5-5-11-6-18-6a26 26 0 01-5-1 27 27 0 01-6 1c-6 0-13 1-17 6l-6 8-2 2c-2 4-6 6-10 6s-7-3-11-3-7 4-9 7-4 7-8 8a10 10 0 01-6-1l-8-4a23 23 0 00-13-2 29 29 0 00-13 5 38 38 0 00-4 3l-13 15-12-15c-5-4-10-7-17-8a23 23 0 00-13 2c-5 3-9 7-14 5-4-1-6-4-8-8s-5-7-9-7-7 3-11 3-8-2-11-6l-1-1-6-9c-5-5-11-6-18-6a26 26 0 01-5-1 27 27 0 01-6 1c-6 0-13 1-17 6a52 52 0 00-5 7l-2 3c-3 4-7 6-11 6s-7-3-11-3-7 4-9 7-4 7-8 8-8-2-12-4l-2-1a23 23 0 00-13-2 30 30 0 00-15 7l-2 1-12 15-13-15c-5-4-10-7-17-8a23 23 0 00-13 2l-1 1c-4 2-8 5-13 4-4-1-6-5-8-8s-5-7-9-7-7 3-11 3-8-2-10-6l-1-1-7-9c-4-5-11-6-17-6a26 26 0 01-6-1 27 27 0 01-5 1c-7 0-13 1-18 6l-6 9-1 1c-3 4-7 6-11 6-3 0-7-3-11-3s-6 4-8 7-5 7-8 8-6 0-9-1l-6-4a23 23 0 00-13-2 29 29 0 00-14 6 41 41 0 00-3 2l-12 15-12-15h-1c-4-4-10-7-16-8a23 23 0 00-10 1 22 22 0 00-4 1c-4 3-9 7-14 5-3-1-6-5-8-8s-5-7-8-7l-11 3c-5 0-8-2-11-6l-2-2a70 70 0 00-5-8c-5-5-11-6-18-6a26 26 0 01-5-1 27 27 0 01-6 1c-7 0-13 1-18 6a62 62 0 00-5 8l-2 2c-2 4-6 6-10 6s-8-3-11-3-7 4-9 7-4 7-8 8c-5 2-10-2-14-5h-2a23 23 0 00-12-2 30 30 0 00-17 8l-12 15-12-15-2-2a30 30 0 00-15-6 23 23 0 00-13 2l-4 2c-4 2-7 4-10 3-4-1-6-5-9-8s-4-7-8-7-7 3-11 3-8-2-11-6l-1-1-6-9c-5-5-11-6-18-6a26 26 0 01-5-1 27 27 0 01-6 1c-6 0-13 1-17 6l-6 9-2 1c-2 4-6 6-10 6s-7-3-11-3-7 4-9 7-4 7-8 8-7-1-11-3l-3-2a23 23 0 00-13-2 30 30 0 00-16 7l-1 1-12 15-13-15-1-1c-5-4-10-7-16-7a23 23 0 00-13 2c-5 3-9 7-14 5-4-1-6-4-8-8s-5-7-9-7-7 3-11 3-8-2-10-6l-3-2a58 58 0 00-5-8c-4-5-11-6-17-6a26 26 0 01-6-1 27 27 0 01-5 1c-7 0-13 1-18 6a56 56 0 00-5 7l-2 3c-3 4-7 6-11 6s-7-3-11-3-6 4-8 7-5 7-9 8-9-2-14-5a23 23 0 00-13-2 30 30 0 00-15 7l-2 1-12 15-12-15-2-1c-4-4-10-7-15-7a23 23 0 00-14 2l-2 1c-4 3-8 5-12 4s-6-5-8-8-5-7-9-7-7 3-11 3-8-2-10-6l-1-1-6-9c-5-5-11-6-18-6a26 26 0 01-6-1 27 27 0 01-5 1c-7 0-13 1-18 6l-6 9-1 1c-3 4-6 6-10 6l-12-3c-4 0-6 4-8 7s-4 7-8 8-7 0-10-2l-4-3a23 23 0 00-14-2 29 29 0 00-14 6l-3 2-12 15-12-15h-1c-5-4-10-7-16-8a23 23 0 00-11 1l-2 1c-5 2-10 6-15 5-3-1-6-5-8-8s-4-7-8-7-8 3-11 3c-4 0-8-2-11-6l-2-2a65 65 0 00-5-8c-5-5-11-6-18-6l-7-1V0z"/><path d="M1287 64l8-6-3-9h-10l-4 9 9 6zM1255 53l13-9-5-16h-17l-5 16 14 9zM1539 64l8-6-3-9h-10l-3 9 8 6zM1411 70l11-7-4-13h-13l-4 13 10 7zM1507 53l13-9-5-16h-16l-6 16 14 9zM1789 68l8-6-3-10h-11l-3 10 9 6zM1667 69l8-6-3-9h-10l-3 9 8 6zM1757 57l13-10-5-16h-17l-5 16 14 10zM1853 70l9-6-4-10h-10l-3 10 8 6zM1912 73l12-8-5-14h-14l-5 14 12 8zM1062 72l-8-6 3-10h10l3 10-8 6zM1005 42l-10-7 4-12h12l4 12-10 7zM955 61l-7-5 3-8h9l2 8-7 5zM1097 71l-11-9 4-13h14l5 13-12 9zM726 62l-9-6 4-9h10l3 9-8 6zM850 69l-8-6 3-10h10l3 10-8 6zM753 47l-11-9 4-13h14l5 13-12 9zM474 65l-8-6 3-10h11l3 10-9 6zM598 71l-8-6 3-10h10l3 10-8 6zM502 49l-11-8 4-13h14l5 13-12 8zM281 66l8-6-3-10h-10l-3 10 8 6zM253 50l12-8-5-14h-14l-4 14 11 8zM97 70l7-4-3-8h-8l-3 8 7 4zM49 62l9-7-3-11H43l-3 11 9 7z"/></g></svg>'); 
                    }

                    @media (min-width:2100px){
                    .shapedividers_com-275::before{
                    background-size: 100% calc(2vw + 90px);
                    }
                    }
                    @media (max-height: 950px) and (max-width: 550px) {
                                            .shapedividers_com-275{
                                                margin: 0px;
                                                width: 107.5%;
                                            }
                                    }
                </style>
                </div>
                <style type="text/css">
                    .container-fluid{
                        overflow: hidden;
                    }
                    body{
                        overflow-x: hidden;
                    }
                </style>
                <div class="container-fluid text-dark hilling">
                    <div class="text-center mb-4">
                    </div>
                    <div class="row justify-content-around align-items-center">
                        <div class="col-sm-12 col-lg-6 text-dark nono justify-content-around asmae" data-aos="flip-left" data-aos-duration="1000">
                            <img src="img/personne.png" class="imagique from-left ml-lg-5" width="80%">  
                        </div>
                        <style type="text/css">
                            .hilling{
                                overflow-x: hidden;
                            }
                            .asmae{
                                overflow-y: hidden;
                            }
                            .imagique, .nono{
                                /*border: 2px solid red;*/
                            }
                        </style>
                        <div class="col-sm-12 col-lg-6 text-dark text-center" data-aos="flip-right" data-aos-duration="1000">
                            <h2 class="section-title px-5 fs-sm-3 fs-1 text-dark hi">
                                <span class="px-2 text-dark display-8 fst-italic hello" style="font-family: verdana;"><span class="bg-warning p-2 rounded-2">What</span> we offer ?</span>
                            </h2>
                            <p class="text-dark my-3 fs-4 justifiacation hi px-lg-5 lh-lg">
                                <span class="premierlettre"><span class="fs-1 text-dark position-relative" style="z-index: 200;">W</span></span>ith <span class="shadow-sm px-2 py-1 rounded fw-bold" style="background: #F1E784;">PFE-OLAITAN</span> customize and download adorable final projects templates to make stunning designs with our impressive designs. Start picking your design to support your knowledge and effort with a touch of creativity...
                            </p>
                            <style type="text/css">
                                .justifiacation{
                                    text-align: right;
                                    line-height: 40px;
                                    font-family: Century Gothic;
                                }
                                /*.premierlettre::before{
                                    content: '';
                                    border: 2px solid #ffc107;
                                    width: 45px;
                                    height: 45px;
                                    border-radius: 50%;
                                    position: absolute;
                                    left: 30px;
                                    top: 92px;
                                    background: #ffc107;
                                    z-index: 10;
                                    box-shadow: 0px 5px 20px gray;
                                }*/
                                 @media (max-height: 950px) and (max-width: 550px) {
                                    .hi{
                                        margin-left: 30px;
                                    }
                                    .imagique{
                                        margin-left: 50px;
                                        margin-bottom: 40px;
                                    }
                                    .hello{
                                        font-size: .7em;
                                    }
                                }
                            </style>
                        </div>
                    </div>
                </div>
                <div class="container-fluid text-dark hilling" data-aos="fade-left" data-aos-duration="1000">
                    <div class="text-center mb-4">
                    </div>
                    <div class="row justify-content-around align-items-center pl-lg-5">
                        <div class="col-sm-12 col-lg-6 text-dark nono justify-content-around d-block d-lg-none" data-aos="flip-right" data-aos-duration="1000">
                            <img src="img/pc.png" class="imagique" width="80%">  
                        </div>
                        <div class="col-sm-12 col-lg-6 text-dark text-center" data-aos="flip-left" data-aos-duration="1000">
                            <h2 class="section-title px-5 fs-sm-3 fs-1 text-dark hi">
                                <span class="px-2 text-dark display-8 fst-italic hello" style="font-family: verdana;"><span class="bg-warning p-2 rounded-2">Shop</span> Olaitan</span>
                            </h2>
                            <p class="text-dark my-3 fs-4 text-left hi px-lg-5 lh-lg">
                                <span class="premierlettre"><span class="fs-1 text-dark position-relative" style="z-index: 200;">W</span></span>ith <span class="shadow-sm px-2 py-1 rounded fw-bold" style="background: #F1E784;">PFE-OLAITAN</span> customize and download adorable final projects templates to make stunning designs with our impressive designs. Start picking your design to support your knowledge and effort with a touch of creativity...
                            </p>
                            <style type="text/css">
                                /*.justifiacation{
                                    text-align: justify;
                                    line-height: 40px;
                                    font-family: Century Gothic;
                                }
                                .premierlettre::before{
                                    content: '';
                                    border: 2px solid #ffc107;
                                    width: 45px;
                                    height: 45px;
                                    border-radius: 50%;
                                    position: absolute;
                                    left: 30px;
                                    top: 92px;
                                    background: #ffc107;
                                    z-index: 10;
                                    box-shadow: 0px 5px 20px gray;
                                }
                                 @media (max-height: 950px) and (max-width: 550px) {
                                    .hi{
                                        margin-left: 30px;
                                    }
                                    .imagique{
                                        margin-left: 50px;
                                        margin-bottom: 40px;
                                    }
                                    .hello{
                                        font-size: .7em;
                                    }
                                }*/
                            </style>
                        </div>
                        <div class="col-sm-12 col-lg-6 text-dark nono justify-content-around d-none d-lg-block" data-aos="flip-right" data-aos-duration="1000">
                            <img src="img/pc.png" class="imagique" width="80%">  
                        </div>
                    </div>
                </div>
                </style>
                <div class="secoffer">
                    <div class="shapedividers_com-3098"></div>
                <style type="text/css">
                    .shapedividers_com-3098{
                    overflow:hidden;
                    position:relative;
                    top: 1px;
                    height: 200px;
                    }
                    .shapedividers_com-3098::before{ 
                    content:'';
                    font-family:'shape divider from ShapeDividers.com';
                    position: absolute;
                    z-index: 3;
                    pointer-events: none;
                    background-repeat: no-repeat;
                    bottom: -0.1vw;
                    left: -0.1vw;
                    right: -0.1vw;
                    top: -0.1vw; 
                    background-size: 100% 90px;
                    background-position: 50% 100%;  background-image: url('data:image/svg+xml;charset=utf8, <svg preserveAspectRatio="xMidYMin slice" xmlns="http://www.w3.org/2000/svg" viewBox="0 -0.2 2000.4 84.2"><g fill="%23ffc107"><circle cx="1334.4" cy="40.4" r="14"/><circle cx="1867.7" cy="40" r="14"/><path d="M1748 30l6-11-6-11h-13l-7 11 7 11h13zM1628 23l4-6-4-7h-7l-4 7 4 6h7zM1978 18l5-8-5-8h-8l-5 8 5 8h8zM1412 23l6-9-6-10h-11l-5 10 5 9h11zM783 52a9 9 0 10-9-9 9 9 0 009 9zM1160 26l7-11-7-12h-13l-6 12 6 11h13zM1040 19l4-6-4-7h-7l-4 7 4 6h7zM825 19l5-9-5-10h-11l-6 10 6 9h11zM697 16l4-6-4-7h-7l-4 7 4 6h7z"/><path d="M83 84h1917V35c-10-8-25-12-40-10a32 32 0 00-11-3c-12-1-15 1-18 2-18 4-24 19-38 32-9 7-17 15-28 15-13 1-24-9-31-20s-11-24-20-33-24-15-34-7c-12 9-10 30-23 37a15 15 0 01-1 1c-6 2-13 1-19-1a58 58 0 01-8-5l-10-6a93 93 0 00-46-14c-6 0-13 0-19 5a12 12 0 00-4 11c1 4 4 8 6 11a11 11 0 011 9 17 17 0 01-15 12h-1c-13 1-24-9-31-20s-11-24-20-33-24-15-34-7c-11 9-10 28-21 36a16 16 0 01-2 1c-6 3-14 3-20 0a50 50 0 01-6-3l-12-8a93 93 0 00-46-14c-5 0-11 0-15 3-5 2-8 6-8 11a35 35 0 00-7 1 44 44 0 00-13 4c-19 10-19 16-35 23-12 5-27 4-40 4s-28 1-41-4c-15-7-16-13-35-23a44 44 0 00-13-4 35 35 0 00-7-1c0-5-3-9-7-11-5-3-11-3-16-3a93 93 0 00-45 14l-13 8a50 50 0 01-6 3c-6 3-14 3-20 0a16 16 0 01-2-1c-10-8-9-27-20-36-10-8-26-3-35 7s-13 22-20 33-18 21-31 20a17 17 0 01-15-12 11 11 0 011-9c2-3 5-7 5-11a12 12 0 00-4-11c-5-5-12-5-19-5a93 93 0 00-46 14l-9 6a58 58 0 01-9 5c-6 2-13 3-18 1a15 15 0 01-2-1c-13-7-11-28-22-37-11-8-26-3-35 7s-13 22-20 33-18 21-31 20a24 24 0 01-4 0c-9-3-16-9-23-15-14-12-21-28-39-32l-4-1-3 1c-18 4-25 20-39 32-7 6-14 12-23 15a24 24 0 01-4 0c-13 1-24-9-31-20s-11-24-20-33-25-15-35-7c-11 9-10 30-22 37a15 15 0 01-2 1c-6 2-13 1-19-1a58 58 0 01-8-5l-10-6a93 93 0 00-45-14c-7 0-14 0-19 5a12 12 0 00-5 11c1 4 4 8 6 11a11 11 0 011 9 17 17 0 01-15 12c-13 1-24-9-31-20s-11-24-20-33-25-15-35-7c-11 9-10 28-21 36a16 16 0 01-1 1c-6 3-14 3-21 0a50 50 0 01-5-3l-13-8a93 93 0 00-45-14c-6 0-11 0-16 3-4 2-8 6-8 11a35 35 0 00-7 1 44 44 0 00-12 4c-19 10-20 16-35 23-13 5-27 4-41 4s-28 1-40-4c-16-7-17-13-35-23a44 44 0 00-13-4 35 35 0 00-7-1c0-5-4-9-8-11-5-3-10-3-16-3H0v61z"/><circle cx="125.9" cy="40.4" r="14"/><circle cx="659.1" cy="40" r="14"/><path d="M539 30l7-11-7-11h-13l-6 11 6 11h13zM42 21l5-8-6-8h-9l-5 9 6 8 9-1zM770 18l4-8-4-8h-9l-4 8 4 8h9zM927 30l4-8-4-7h-9l-5 7 5 8h9zM204 23l5-9-5-10h-11l-6 10 6 9h11z"/></g></svg>'); 
                    }

                    @media (min-width:2100px){
                    .shapedividers_com-3098::before{
                    background-size: 100% calc(2vw + 90px);
                    }
                    }
                </style>
                <!--<div class="container-fluid bg-warning py-3">
                    <div class="row">
                        <div class="col-sm-12 col-lg-4 d-flex justify-content-around align-items-center sos">
                            <div class="card text-center w-75 shadow-lg mb-5 bg-body rounded">
                                  <div class="card-header text-dark fs-1" style="background: #F1E784;">
                                    <i class="fa-solid fa-business-time text-dark"></i>
                                  </div>
                                  <div class="card-body text-dark">
                                    <p class="card-text text-dark">With supporting text below as a natural lead-in to additional content.</p>
                                    <p class="num text-dark fs-1" data-goal="50">0</p>
                                  </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 d-flex justify-content-around align-items-center sos">
                            <div class="card text-center w-75 shadow-lg mb-5 bg-body rounded">
                                  <div class="card-header text-dark fs-1" style="background: #F1E784;">
                                    <i class="fa-solid fa-paintbrush text-dark"></i>
                                  </div>
                                  <div class="card-body text-dark">
                                    <p class="card-text text-dark">With supporting text below as a natural lead-in to additional content.</p>
                                    <p class="num text-dark fs-1" data-goal="50">0</p>
                                  </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 d-flex justify-content-around align-items-center sos">
                            <div class="card text-center w-75 shadow-lg mb-5 bg-body rounded">
                                  <div class="card-header text-dark fs-1" style="background: #F1E784;">
                                    <i class="fa-solid fa-desktop text-dark"></i>
                                  </div>
                                  <div class="card-body text-dark">
                                    <p class="card-text text-dark">With supporting text below as a natural lead-in to additional content.</p>
                                    <p class="num text-dark fs-1" data-goal="50">0</p>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="container-fluid bg-warning py-4">
                    <div class="row three">
                        <div class="col-md-3 col-sm-6" data-aos="flip-right" data-aos-duration="1000">
                            <div class="counter">
                                <div class="counter-content">
                                    <div class="counter-icon">
                                        <i class="fa-solid fa-face-smile"></i>
                                    </div>
                                    <h3>Satisfied<br>Client</h3>
                                </div>
                                <span class="counter-value" data-goal="137">0</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6" data-aos="flip-right" data-aos-duration="1000">
                            <div class="counter green">
                                <div class="counter-content">
                                    <div class="counter-icon">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                    <h3>Product<br>Purshased</h3>
                                </div>
                                <span class="counter-value" data-goal="239">0</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6" data-aos="flip-left" data-aos-duration="1000">
                            <div class="counter blue">
                                <div class="counter-content">
                                    <div class="counter-icon">
                                        <i class="fa fa-rocket"></i>
                                    </div>
                                    <h3>Web Development</h3>
                                </div>
                                <span class="counter-value" data-goal="124">0</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6" data-aos="flip-left" data-aos-duration="1000">
                            <div class="counter black">
                                <div class="counter-content">
                                    <div class="counter-icon">
                                        <i class="fa-solid fa-gift"></i>
                                    </div>
                                    <h3>Existing<br>Designes</h3>
                                </div>
                                <span class="counter-value" data-goal="124">0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shapedividers_com-2053"></div>
                    <style type="text/css">
                                                    
                    .shapedividers_com-2053{
                    overflow:hidden;
                    position:relative;
                    bottom: 1px;
                    height: 200px;
                    }
                    .shapedividers_com-2053::before{ 
                    content:'';
                    font-family:'shape divider from ShapeDividers.com';
                    position: absolute;
                    z-index: 3;
                    pointer-events: none;
                    background-repeat: no-repeat;
                    bottom: -0.1vw;
                    left: -0.1vw;
                    right: -0.1vw;
                    top: -0.1vw; 
                    background-size: 100% 90px;
                    background-position: 50% 0%;  background-image: url('data:image/svg+xml;charset=utf8, <svg preserveAspectRatio="xMidYMax slice" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000.4 84.2"><g fill="%23ffc107"><circle cx="666" cy="43.7" r="14"/><circle cx="132.7" cy="44.1" r="14"/><path d="M253 54l-7 12 7 11h12l7-11-7-12h-12zM372 61l-3 6 3 7h8l4-7-4-6h-8zM22 67l-4 7 4 8h9l4-8-4-7h-9zM588 61l-6 10 6 9h11l6-9-6-10h-11zM1217 33a9 9 0 109 8 9 9 0 00-9-8zM840 58l-6 12 6 11h13l6-11-6-12h-13zM960 65l-4 7 4 6h7l4-6-4-7h-7zM1175 65l-5 10 5 9h12l5-9-5-10h-12zM1303 68l-4 7 4 6h7l4-6-4-7h-7z"/><path d="M1918 0H0v49c10 8 26 12 40 10a32 32 0 0011 3c13 1 15-1 18-1 18-5 25-20 39-32 8-7 16-15 27-16 13-1 24 9 31 20s11 24 20 33 25 15 35 7c11-9 9-29 22-37a15 15 0 012-1c6-2 13-1 18 1a58 58 0 019 5l10 6a93 93 0 0045 14c7 0 14 0 19-5a12 12 0 004-11c0-4-3-7-5-11a11 11 0 01-1-9 17 17 0 0115-12c13-1 24 9 31 20s11 24 20 33 25 15 35 7c11-9 10-28 21-36a16 16 0 011-1c6-3 14-2 21 0a50 50 0 015 3l13 8a93 93 0 0045 14c5 0 11 0 16-3 4-2 7-6 8-11a35 35 0 006 0 44 44 0 0013-5c19-10 20-16 35-22 13-6 27-5 41-5s28-1 40 5c16 6 17 12 35 22a44 44 0 0013 5 35 35 0 007 0c0 5 3 9 8 11 5 3 10 3 16 3a93 93 0 0045-14l12-8a50 50 0 016-3c6-2 14-3 20 0a16 16 0 012 1c11 8 10 27 21 36 10 8 26 3 34-7s14-22 21-33 17-21 30-20h1a17 17 0 0115 12 11 11 0 01-1 9c-2 4-5 7-6 11a12 12 0 004 11c6 5 13 5 20 5a93 93 0 0045-14l10-6a58 58 0 018-5c6-2 13-3 19-1a15 15 0 011 1c13 8 11 28 23 37 10 8 26 3 35-7s13-22 20-33 17-21 30-20a24 24 0 015 1c8 2 16 9 23 15 14 12 21 27 38 32l4 1 4-1c18-5 24-20 38-32 7-6 15-13 24-15a24 24 0 014-1c13-1 24 9 30 20s12 24 21 33 24 15 34 7c12-9 10-29 23-37a15 15 0 011-1c6-2 13-1 19 1a58 58 0 018 5l10 6a93 93 0 0045 14c7 0 14 0 20-5a12 12 0 004-11c-1-4-4-7-6-11a11 11 0 01-1-9 17 17 0 0115-12h1c13-1 24 9 31 20s11 24 20 33 24 15 34 7c11-9 10-28 21-36a16 16 0 012-1c6-3 14-2 20 0a50 50 0 016 3l12 8a93 93 0 0046 14c5 0 11 0 15-3 5-2 8-6 8-11a35 35 0 007 0 44 44 0 0013-5c18-10 19-16 35-22 12-6 26-5 40-5s28-1 41 5c15 6 16 12 35 22a44 44 0 0013 5 35 35 0 006 0c1 5 4 9 8 11 5 3 11 3 16 3h3V0z"/><circle cx="1874.5" cy="43.7" r="14"/><circle cx="1341.3" cy="44.1" r="14"/><path d="M1461 54l-6 12 6 11h13l6-11-6-12h-13zM1958 63l-4 8 5 8h10l4-9-5-8-10 1zM1231 67l-5 7 5 8h8l5-8-5-7h-8zM1074 54l-5 8 5 8h9l4-8-4-8h-9zM1796 61l-5 10 5 9h12l5-9-5-10h-12z"/></g></svg>'); 
                    }

                    @media (min-width:2100px){
                    .shapedividers_com-2053::before{
                    background-size: 100% calc(2vw + 90px);
                    }
                    }
                </style>
                </style>
            </div>
                </div>
            </div>
                    </div>
                </div>
                
        </div>
    </div>
</div>
<style type="text/css">
body {
  font-family: "Trebuchet MS", "Lucida Sans Unicode", sans-serif;
  margin: 0;
}
section {
  min-height: 50vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
.nums{
    border: 2px solid red;
    width: 70%;
    height: 40vh;
}
.three .col-lg-4{
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
                <div class="container-fluid mt-5">
                        <div class="row">
                            <div class="col-lg-6 col-md-3 col-sm-6 d-flex justify-content-left pl-lg-5 align-items-center d-none d-lg-block">
                                <img src="img/biblio.png" class="d-none d-lg-block" width="400">
                            </div>
                            <div class="col-md-3 col-sm-12">
                            <div class="d-block d-lg-none d-flex justify-content-around align-items-center">
                                    <button class="btn btn-white border-3 border-dark fs-1 text-white p-5 bg-dark rounded-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                      <p style="font-size: 4em;"><i class="fa-solid fa-book-open text-white"></i></p><br>Press to see categories
                                    </button>

                                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                                      <div class="offcanvas-header">
                                        <h5 class="offcanvas-title display-4" id="offcanvasExampleLabel">Categories</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                      </div>
                                      <div class="offcanvas-body">
                                        <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-calculator text-dark mr-2"></i> Accountant</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-certificate text-dark mr-2"></i> Fiscalite</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-list-check text-dark mr-2"></i> Gestion</a>
                                                
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-dna text-dark mr-2"></i> Biologie</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-atom text-dark mr-2"></i> Physique</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-microchip text-dark mr-2"></i> Technologie</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-coins text-dark mr-2"></i> Economie</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-music text-dark mr-2"></i> Music</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-masks-theater text-dark mr-2"></i> Theatre</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-leaf text-dark mr-2"></i> Nature</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-book text-dark mr-2"></i> Religiuos</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-user-tie text-dark mr-2"></i> Professional</a>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-6 d-none d-lg-block pr-lg-5">
                                    <div class="row gx-5" style="width: 650%;">
                                        <h2 class="section-title px-5 fs-sm-3 fs-1 text-dark hi">
                                            <span class="px-2 text-dark display-8 fst-italic hello" style="font-family: verdana;"><span class="bg-warning p-2 rounded-2">Cate</span> gories</span>
                                        </h2>
                                            <div class="col-lg-3">
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-calculator text-dark mr-2"></i> Accountant</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-certificate text-dark mr-2"></i> Fiscalite</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-list-check text-dark mr-2"></i> Gestion</a>
                                                
                                            </div>
                                            <div class="col-lg-3">
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-dna text-dark mr-2"></i> Biologie</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-atom text-dark mr-2"></i> Physique</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-microchip text-dark mr-2"></i> Technologie</a>
                                            </div>
                                            <div class="col-lg-3">
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-coins text-dark mr-2"></i> Economie</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-music text-dark mr-2"></i> Music</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-masks-theater text-dark mr-2"></i> Theatre</a>
                                            </div>
                                            <div class="col-lg-3">
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-leaf text-dark mr-2"></i> Nature</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-book text-dark mr-2"></i> Religiuos</a>
                                                <a href="" class="categories shadow p-3 mb-5 bg-body rounded"><i class="fa-solid fa-user-tie text-dark mr-2"></i> Professional</a>
                                            </div>
                                    </div>
                                    <style type="text/css">
                                        .categories{
                                            display: block;
                                            text-align: center;
                                            color: black;
                                            width: 160px;
                                            height: 50px;
                                            margin-top: 30px;
                                            padding: 10px 10px;
                                            text-align: left;
                                            transition: all 0.3s ease-in-out;
                                        }
                                        .categories:hover{
                                            position: relative;
                                            z-index: 300;
                                            transform: scale(1.15);
                                        }
                                    </style>
                            </div>
                                </div>
                            </div> 
                            </div>
                    </div>
    <div class="shapedividers_com-8466"></div>
    <footer>
   <div class="content">
     <div class="left box">
       <div class="upper">
         <div class="topic">About us</div>
         <p>We are designers team passion of making creative designes & looking for client happiness with speacial touch</p>
       </div>
       <div class="lower">
         <div class="topic">Contact us</div>
         <div class="phone">
           <a href="#"><i class="fas fa-phone-volume"></i>+2126 2301 1384</a>
         </div>
         <div class="email">
           <a href="#"><i class="fas fa-envelope"></i>olaitanorganization@gmail.com</a>
         </div>
       </div>
     </div>
     <div class="middle box">
       <div class="topic">Our Services</div>
       <div><a href="#">Web Design, Development</a></div>
       <div><a href="#">Business Model</a></div>
       <div><a href="#">Professional Courses</a></div>
       <div><a href="#">Technical assistance service in transport & logistics</a></div>
       <div><a href="#">Study office in business strategies in management, audit and architecture</a></div>
       <div><a href="#">Real estate and student assistance</a></div>
     </div>
     <div class="right box">
       <div class="topic">RoadMap for you</div>
       <p>
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3308.8145638868273!2d-6.852013985524991!3d33.97160542942405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76df796441487%3A0xcfc9cb09bc3740c4!2sOLAITAN%20ORGANIZATION!5e0!3m2!1sen!2sma!4v1656321533902!5m2!1sen!2sma" width="100%" height="180" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         <div class="media-icons">
           <a href="https://www.facebook.com/OLaitanBusinessAttitude/"><i class="fab fa-facebook-f"></i></a>
           <a href="https://www.instagram.com/olaitan_organization"><i class="fab fa-instagram"></i></a>
           <a href="https://www.youtube.com/channel/UCGvv-EsEhYaSWDaP82rF2XQ"><i class="fab fa-youtube"></i></a>
           <a href="https://www.linkedin.com/company/olaitan-organization"><i class="fab fa-linkedin-in"></i></a>
         </div>
       </p>
     </div>
   </div>
   <div class="bottom">
     <p>Copyright © 2022 <a href="#">Olaitan Organization</a> All rights reserved</p>
   </div>
 </footer>
 <style type="text/css">
     @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
  text-decoration: none;
}
footer{
  width: 100%;
  background: #111;
}
footer .content{
  max-width: 1350px;
  margin: auto;
  padding: 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}
footer .content p,a{
  color: #fff;
}
footer .content .box{
  width: 33%;
  transition: all 0.4s ease;
}
footer .content .topic{
  font-size: 22px;
  font-weight: 600;
  color: #fff;
  margin-bottom: 16px;

}
footer .content p{
  text-align: justify;
}
footer .content .lower .topic{
  margin: 24px 0 5px 0;
}
footer .content .lower i{
  padding-right: 16px;
}
footer .content .middle{
  padding-left: 80px;
}
footer .content .middle a{
  line-height: 32px;
}
footer .content .right input[type="text"]{
  height: 45px;
  width: 100%;
  outline: none;
  color: #d9d9d9;
  background: #000;
  border-radius: 5px;
  padding-left: 10px;
  font-size: 17px;
  border: 2px solid #222222;
}
footer .content .right input[type="submit"]{
  height: 42px;
  width: 100%;
  font-size: 18px;
  color: #d9d9d9;
  background: #eb2f06;
  outline: none;
  border-radius: 5px;
  letter-spacing: 1px;
  cursor: pointer;
  margin-top: 12px;
  border: 2px solid #eb2f06;
  transition: all 0.3s ease-in-out;
}
.content .right input[type="submit"]:hover{
  background: none;
  color:  #eb2f06;
}
footer .content .media-icons a{
  font-size: 16px;
  height: 45px;
  width: 45px;
  display: inline-block;
  text-align: center;
  line-height: 43px;
  border-radius: 5px;
  border: 2px solid #222222;
  margin: 30px 5px 0 0;
  transition: all 0.3s ease;
}
.content .media-icons a:hover{
  border-color: #ffc107;
  background: #ffc107;
}
footer .bottom{
  width: 100%;
  text-align: right;
  color: #d9d9d9;
  padding: 0 40px 5px 0;
}
footer .bottom a{
  color: #ffc107;
}
footer a{
  transition: all 0.3s ease;
}
footer a:hover{
  color: #ffc107;
}
@media (max-width:1100px) {
  footer .content .middle{
    padding-left: 50px;
  }
}
@media (max-width:950px){
  footer .content .box{
    width: 50%;
  }
  .content .right{
    margin-top: 40px;
  }
}
@media (max-width:560px){
  footer{
    position: relative;
  }
  footer .content .box{
    width: 100%;
    margin-top: 30px;
  }
  footer .content .middle{
    padding-left: 0;
  }
}
 </style>
<!--<section class="three">
  <div class="nums">
    <div class="num" data-goal="50">0</div>
    <div class="num" data-goal="40">0</div>
    <div class="num" data-goal="60">0</div>
  </div>
</section>-->
<!-- Footer Start -->
    
    <!-- Footer End -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
            AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
