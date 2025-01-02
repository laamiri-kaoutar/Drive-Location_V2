<?php
session_start();

require_once '../Model/Vehicule.php';
require_once '../Model/Reservation.php';
require_once '../Model/Avis.php';
require_once '../Model/categorie.php';
$categorie = new Categorie();
$categories =$categorie->readAll();



$vehicule = new Vehicule();

$vehicules =$vehicule->readAll();

$reservation = new Reservation();
$user= $_SESSION["user"]["id"];
$reservations = $reservation->readByUser($user);
// var_dump($reservations);

$avis = new Avis();
$aviss = $avis->readByUser($user);
// var_dump($aviss);


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Drive Location</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
            /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Background overlay */
            z-index: 9999; /* Ensure it appears above other content */
            justify-content: center;
            align-items: center;
        }
        
        /* Modal Content (the form itself) */
        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            width: 100%;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        /* Close Button */
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 30px;
            color: #333;
            cursor: pointer;
        }
        
        /* Sub-style and Heading */
        .sub-style {
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 10px;
        }
        
        .sub-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #007bff;
        }
        
        .display-5 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
        }
        
        /* Form Styles */
        .form-floating input, .form-floating textarea {
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 1rem;
        }
        
        .form-floating label {
            font-size: 1rem;
            color: #666;
        }
        
        /* Button Styles */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        </style>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-secondary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid nav-bar p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="display-5 text-secondary m-0"><img src="img/brand-logo.png" class="img-fluid" alt="">Drive</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown"><span class="dropdown-toggle">Pages</span></a>
                            <div class="dropdown-menu m-0">
                            
                        </div> -->

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown"><span class="dropdown-toggle">Filter by Category</span></a>
                            <div class="dropdown-menu m-0" id="categoryDropdown">
                                <a class="dropdown-item" onclick="filterByCategory('All')">All</a>
                                <?php foreach ($categories as $category) { ?>
                                    <a  class="dropdown-item" onclick="filterByCategory('<?= $category['nom_categorie']; ?>')">
                                        <?= $category['nom_categorie']; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <button class="btn btn-primary btn-md-square border-secondary mb-3 mb-md-3 mb-lg-0 me-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button>
                    <a href="" class="btn btn-primary border-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0" >Get A Quote</a>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Carousel Start -->
        <div class="carousel-header">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="img/carousel-1.jpg" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="text-center p-4" style="max-width: 900px;">
                                <h4 class="text-white text-uppercase fw-bold mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.1s">Find the Perfect Car for Every Journey</h4>
                                <h1 class="display-1 text-capitalize text-white mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.3s">Wide Selection of Vehicles!</h1>
                                <p class="text-white mb-4 mb-md-5 fs-5 wow fadeInUp" data-wow-delay="0.5s"> Choose from a wide range of cars for every occasion—economy, family trips, or luxury adventures.
                                </p>
                                <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5 wow fadeInUp" data-wow-delay="0.7s" href="#">Browse Cars</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/carousel-2.jpg" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="text-center p-4" style="max-width: 900px;">
                                <h5 class="text-white text-uppercase fw-bold mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.1s">Convenient Locations</h5>
                                <h1 class="display-1 text-capitalize text-white mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.3s">Explore Our Cars</h1>
                                <p class="text-white mb-4 mb-md-5 fs-5 wow fadeInUp" data-wow-delay="0.5s">Discover our collection of vehicles. Use filters to find the one that suits your needs.
                                    With pagination, you can browse through all available options easily, page by page. 
                                </p>
                                <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5 wow fadeInUp" data-wow-delay="0.7s" href="#">Browse Cars </a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-secondary wow fadeInLeft" data-wow-delay="0.2s" aria-hidden="false"></span>
                    <span class="visually-hidden-focusable">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-secondary wow fadeInRight" data-wow-delay="0.2s" aria-hidden="false"></span>
                    <span class="visually-hidden-focusable">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title text-secondary mb-0" id="exampleModalLabel">Search by keyword</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Vehicules Start -->
        <div class="container-fluid service overflow-hidden pt-5">
            <div class="container py-5">
                <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h5 class="sub-title text-primary px-3">Available Cars</h5>
                    </div>
                    <h1 class="display-5 mb-4">Find the Perfect Car for Your Needs</h1>
                    <p class="mb-0">Explore our wide range of vehicles, from economy to luxury models. Use the filters and pagination to find your ideal car.</p>
                </div>
                <div class="row g-4" id="cars_container">
                     <?php foreach ($vehicules as $vehicule) { ?>
                        <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item">
                                <div class="service-inner">
                                    <div class="service-img">
                                        <img src="./img/<?= $vehicule['image'] ?>" class="img-fluid w-100 rounded" alt="Image">
                                    </div>
                                    <div class="service-title">
                                        <div class="service-title-name">
                                            <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                <a href="#" class="h4 text-white mb-0"><?= $vehicule['marque'] ?></a>
                                            </div>
                                            <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4" onclick="openReservationForm(<?= $vehicule['id_vehicule'] ?>)">Booking</a>
                                        </div>
                                        <div class="service-content pb-4">
                                            <a href="#"><h5 class="text-white mb-4 py-3"><?= $vehicule['marque'] ?>  <?= $vehicule['modele'] ?>  </h5></a>
                                            <div class="px-4">
                                                <p class="mb-4">
                                                    <strong>Category : </strong> <?= $vehicule['nom_categorie'] ?><br>
                                                    <strong>Price : </strong>$<?= $vehicule['prix_par_jour'] ?>/day<br>
                                                    <strong>Availability : </strong> <?= $vehicule['disponibilite'] ? 'Available' : 'Not Available' ?><br>
                                                    <?= $vehicule['description'] ?>
                                                </p>
                                                <a class="btn btn-primary border-secondary rounded-pill py-3 px-5" onclick="openReservationForm(<?= $vehicule['id_vehicule'] ?>)" >Booking</a>
                                                <a class="btn btn-primary border-secondary rounded-pill py-3 px-5" onclick="showAvisForm(<?= $vehicule['id_vehicule'] ?>)" >avis</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     <?php } ?>

                </div>
            </div>
        </div>
        <!-- Vehicules End -->



        <!-- Features Start -->
        <div class="container-fluid features overflow-hidden py-5">
            <div class="container">
                <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h5 class="sub-title text-primary px-3">My Reservations</h5>
                    </div>
                    <h1 class="display-5 mb-4">View and Manage Your Bookings</h1>
                    <!-- <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam necessitatibus saepe in ab? Repellat!</p> -->
                
                </div>
                <div class="row g-4 justify-content-center text-center">
                    <?php foreach ($reservations as $reservation) { ?>
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="feature-item text-center p-4">
                                <div class="feature-icon p-3 mb-4">
                                    <!-- Display the vehicle image -->
                                    <img src="img/<?= $reservation['image'] ?>" class="img-fluid w-100 rounded" alt="Vehicle Image">
                                </div>
                                <div class="feature-content d-flex flex-column">
                                    <!-- Display reservation status -->
                                    <h6 class="mb-3 text-uppercase 
                                        <?= $reservation['status'] === 'pending' ? 'text-warning' : ($reservation['status'] === 'approved' ? 'text-success' : 'text-danger') ?>">
                                        <?= ucfirst($reservation['status']) ?>
                                    </h6>
                                    <p class="mb-3">
                                        <!-- Display reservation details -->
                                        <strong>Start Date:</strong> <?= $reservation['date_debut'] ?><br>
                                        <strong>End Date:</strong> <?= $reservation['date_fin'] ?><br>
                                        <strong>Pick from:</strong> <?= $reservation['lieu_prise_en_charge'] ?><br>
                                        <strong>Vehicle:</strong> <?= $reservation['marque'] ?>  <?= $reservation['modele'] ?><br>
                                    </p>
                                    <div class="flex">
                                        <a class="btn btn-secondary rounded-pill" onclick="openUpdateReservationForm( <?= $reservation['id_reservation'] ?>)"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a class="btn btn-secondary rounded-pill" href="../Controller/cancelReservation.php?id=<?= $reservation['id_reservation'] ?>"  ><i class="fa-regular fa-trash-can"></i></a>
                                    </div>
               
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Features End -->

        <!-- Testimonial Start -->
        <div class="container-fluid testimonial overflow-hidden pb-5">
            <div class="container py-5">
                <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h5 class="sub-title text-primary px-3">My Opinions</h5>
                    </div>
                    <h1 class="display-5 mb-4">Share and Manage Your Feedback</h1>
                    <!-- <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam necessitatibus saepe in ab? Repellat!</p> -->
                </div>
                <div class="owl-carousel testimonial-carousel wow zoomInDown" data-wow-delay="0.2s">
                <?php foreach ($aviss as $opinion) { ?>
                    <div class="testimonial-item">
                        <div class="testimonial-content p-4 mb-5">
                            <p class="fs-5 mb-0">
                                <?= $opinion['commentaire'] ?>
                            </p>
                            <div class="flex">
                                <a class="btn btn-secondary rounded-pill" onclick="openUpdateAvisForm( <?= $opinion['id_avis'] ?>)"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a class="btn btn-secondary rounded-pill" href="../Controller/deleteAvis.php?id=<?= $opinion['id_avis'] ?>"  ><i class="fa-regular fa-trash-can"></i></a>
                            </div>
                            <div class="d-flex justify-content-end">
                                <?php for ($i=0; $i <  $opinion['note'] ; $i++) { ?>
                                    <i class="fas fa-star text-secondary"></i>
                                <?php } ?>
                            </div>
                            </div>
                            <div class="d-flex">
                            <div class="rounded-circle me-4" style="width: 100px; height: 100px;">
                                <img class="img-fluid rounded-circle" src="./img/<?= $opinion['image'] ?>"  alt="img">
                                </div>
                                <div class="my-auto">
                                <h5><?= $opinion['modele'] ?></h5>
                                    <p class="mb-0"><?= $opinion['marque'] ?></p>
                                </div>
                            </div>
                    </div>
                <?php } ?>                   
                </div>
            </div>
        </div>
        <!-- Testimonial End -->



<!-- Modal (Popup) Reservation Form -->
<div id="reservationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeReservationForm()">&times;</span>
        <div class="sub-style">
            <h5 class="sub-title text-primary pe-3">Reserve Your Car</h5>
        </div>
        <h1 class="display-5 mb-4">Confirm Your Reservation</h1>
        <form id="reservationForm" action="../Controller/addReservation.php" method="POST">
            <!-- Hidden Input for Car ID -->
            <input type="hidden" name="id_vehicule" id="id_vehicule" value="">

            <div class="row g-4">
                <!-- Date Debut -->
                <div class="col-lg-12 col-xl-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                        <label for="date_debut">Start Date</label>
                    </div>
                </div>

                <!-- Date Fin -->
                <div class="col-lg-12 col-xl-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                        <label for="date_fin">End Date</label>
                    </div>
                </div>

                <!-- Pickup Location -->
                <div class="col-lg-12 col-xl-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="lieu_prise_en_charge" name="lieu_prise_en_charge" placeholder="Pickup Location" required>
                        <label for="lieu_prise_en_charge">Pickup Location</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 py-3">Confirm Reservation</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Updatte Reservation Form -->
<div id="updateReservationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateReservationForm()">&times;</span>
        <div class="sub-style">
            <h5 class="sub-title text-primary pe-3">Reserve Your Car</h5>
        </div>
        <h1 class="display-5 mb-4">Confirm Your Reservation</h1>
        <form id="reservationForm" action="../Controller/updateReservation.php" method="POST">
            <!-- Hidden Input for Car ID -->
            <input type="hidden" name="id_vehicule" id="U_id_vehicule" value="">
            <input type="hidden" name="id_reservation" id="id_reservation" value="">


            <div class="row g-4">
                <!-- Date Debut -->
                <div class="col-lg-12 col-xl-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="U_date_debut" name="date_debut" required>
                        <label for="date_debut">Start Date</label>
                    </div>
                </div>

                <!-- Date Fin -->
                <div class="col-lg-12 col-xl-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="U_date_fin" name="date_fin" required>
                        <label for="date_fin">End Date</label>
                    </div>
                </div>

                <!-- Pickup Location -->
                <div class="col-lg-12 col-xl-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="U_lieu_prise_en_charge" name="lieu_prise_en_charge" placeholder="Pickup Location" required>
                        <label for="lieu_prise_en_charge">Pickup Location</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 py-3">Update Reservation</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal (Popup) Avis Form -->
<div id="avisModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAvisForm()">&times;</span>
        <div class="sub-style">
            <h5 class="sub-title text-primary pe-3">Give Your Feedback</h5>
        </div>
        <h1 class="display-5 mb-4">Submit Your Review</h1>
        <form id="avisForm" action="../Controller/addAvis.php" method="POST">
            <!-- Hidden Inputs for User ID and Car ID -->
            <input type="hidden" name="id_vehicule" id="id_vehiculeV" value="">

            <div class="row g-4">
                <!-- Commentaire -->
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" id="commentaire" name="commentaire" placeholder="Leave your comment" required></textarea>
                        <label for="commentaire">Your Comment</label>
                    </div>
                </div>

                <!-- Note -->
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-control" id="note" name="note" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label for="note">Rating (1-5)</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 py-3">Submit Review</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="updateAvisModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateAvisForm()">&times;</span>
        <div class="sub-style">
            <h5 class="sub-title text-primary pe-3">Give Your Feedback</h5>
        </div>
        <h1 class="display-5 mb-4">Submit Your Review</h1>
        <form id="avisForm" action="../Controller/updateAvis.php" method="POST">
            <!-- Hidden Inputs for User ID and Car ID -->
            <input type="hidden" name="id_vehicule" id="id_vehiculeU" value="">
            <input type="hidden" name="id_avis" id="id_avis" value="">


            <div class="row g-4">
                <!-- Commentaire -->
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" id="commentaireU" name="commentaire" placeholder="Leave your comment" required></textarea>
                        <label for="commentaire">Your Comment</label>
                    </div>
                </div>

                <!-- Note -->
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-control" id="noteU" name="note" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label for="note">Rating (1-5)</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 py-3">Submit Review</button>
                </div>
            </div>
        </form>
    </div>
</div>




        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-secondary mb-4">Contact Info</h4>
                            <a href=""><i class="fa fa-map-marker-alt me-2"></i> 123 Street, New York, USA</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-secondary me-2"></i>
                                <a class="btn mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn mx-1" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-secondary mb-4">Opening Time</h4>
                            <div class="mb-3">
                                <h6 class="text-muted mb-0">Mon - Friday:</h6>
                                <p class="text-white mb-0">09.00 am to 07.00 pm</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted mb-0">Satday:</h6>
                                <p class="text-white mb-0">10.00 am to 05.00 pm</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted mb-0">Vacation:</h6>
                                <p class="text-white mb-0">All Sunday is our vacation</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-secondary mb-4">Our Services</h4>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Business</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Evaluation</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Migrate</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Study</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Counselling</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Work / Career</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-secondary mb-4">Newsletter</h4>
                            <p class="text-white mb-3">Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <div class="position-relative mx-auto rounded-pill">
                                <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email">
                                <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        
        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                        <span class="text-white"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        // Function to open the reservation form modal
function openReservationForm(carId) {
    // Set the hidden input value to the car ID
    document.getElementById('id_vehicule').value = carId;

    // Display the modal
    document.getElementById('reservationModal').style.display = 'flex';
}

// Function to close the reservation form modal
function closeReservationForm() {
    // Hide the modal
    document.getElementById('reservationModal').style.display = 'none';
}


// update reservationn form is just like the ubove one

function openUpdateReservationForm(id) {
    fetch(`getReservationDate.php?id=${id}`)
                .then((response) => response.json())
                .then((reservation) => {
                    console.log(reservation);

                    document.getElementById('id_reservation').value = reservation.id_reservation;
                    document.getElementById('U_id_vehicule').value = reservation.id_vehicule;
                    document.getElementById('U_date_debut').value = reservation.date_debut;
                    document.getElementById('U_date_fin').value = reservation.date_fin;
                    document.getElementById('U_lieu_prise_en_charge').value = reservation.lieu_prise_en_charge;
                    document.getElementById('updateReservationModal').style.display = 'flex';

                })
                .catch((error) => {
                    console.error("Error fetching category data:", error);
                });
    

}

// Function to close the reservation form modal
function closeUpdateReservationForm() {
    // Hide the modal
    document.getElementById('updateReservationModal').style.display = 'none';
}

    // Show the modal
    function showAvisForm(id) {
        document.getElementById('id_vehiculeV').value = id;
        document.getElementById("avisModal").style.display = "flex";
    }

    // Close the modal
    function closeAvisForm() {
        document.getElementById("avisModal").style.display = "none";
    }

    // Close modal if clicked outside of the modal content
    window.onclick = function(event) {
        if (event.target == document.getElementById("avisModal")) {
            closeAvisForm();
        }
    }

    function openUpdateAvisForm(id) {
        fetch(`getAvisData.php?id=${id}`)
                .then((response) => response.json())
                .then((avis) => {
                    console.log(avis);

                    document.getElementById('commentaireU').value = avis.commentaire;
                    document.getElementById('noteU').value = avis.note;
                    document.getElementById('id_vehiculeU').value = avis.id_vehicule;
                    document.getElementById('id_avis').value = avis.id_avis;
                    document.getElementById("updateAvisModal").style.display = "flex";
                })
                .catch((error) => {
                    console.error("Error fetching category data:", error);
                });

    }

    // Close the modal
    function closeUpdateAvisForm() {
        document.getElementById("updateAvisModal").style.display = "none";
    }

    //  function to fetch and display the filtred data 
    const cars_container = document.getElementById('cars_container');
    console.log(cars_container);
    
    
    function filterByCategory(category) {

        fetch(`getVehiculeData.php?category=${category}`)
                .then((response) => response.json())
                .then((cars) => {
                    cars_container.innerHTML="";

                    console.log(cars);
                    cars.forEach(car => {
                        console.log(car);
                        

                        cars_container.innerHTML +=`
                                       <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item">
                                <div class="service-inner">
                                    <div class="service-img">
                                        <img src="./img/${car.image}" class="img-fluid w-100 rounded" alt="Image">
                                    </div>
                                    <div class="service-title">
                                        <div class="service-title-name">
                                            <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                <a href="#" class="h4 text-white mb-0">${car.marque}</a>
                                            </div>
                                            <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4" onclick="openReservationForm(${car.id_vehicule})">Booking</a>
                                        </div>
                                        <div class="service-content pb-4">
                                            <a href="#"><h5 class="text-white mb-4 py-3">${car.marque}  ${car.modele}  </h5></a>
                                            <div class="px-4">
                                                <p class="mb-4">
                                                    <strong>Category : </strong> ${car.nom_categorie}<br>
                                                    <strong>Price : </strong>$ ${car.prix_par_jour}/day<br>
                                                    <strong>Availability : </strong> ${ car.disponibilite ? 'Available' : 'Not Available' }<br>
                                                    ${car.description}
                                                </p>
                                                <a class="btn btn-primary border-secondary rounded-pill py-3 px-5" onclick="openReservationForm(${car.id_vehicule})" >Booking</a>
                                                <a class="btn btn-primary border-secondary rounded-pill py-3 px-5" onclick="showAvisForm(${car.id_vehicule})" >avis</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        `;


                        console.log(car.prix_par_jour);

                    });
                })
                .catch((error) => {
                    console.error("Error fetching category data:", error);
                });

        
    }
    // displayFetchedData("Sports Car");



    </script>
    
    </body>

</html>