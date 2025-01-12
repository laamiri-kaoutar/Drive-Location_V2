<?php
   session_start();


   // if (isset($_SESSION["user"])) {
   //     $user=$_SESSION["user"];
   //     var_dump($user);
   // }else {
   //     header("Location:./authen.php");
   // }
require_once '../Model/statistics.php';
require_once '../Model/Vehicule.php';
require_once '../Model/categorie.php';
require_once '../Model/Reservation.php';
require_once '../Model/Avis.php';
require_once '../Model/tag.php';
require_once '../Model/theme.php';
require_once '../Model/Comment.php';
require_once '../Model/Article.php';



$theme = new Theme();
$themes = $theme->readAll();

$article = new Article();
$articles =$article->readAll();





$tag = new Tag();
$tags = $tag->readAll();



$categorie = new Categorie();
$categories =$categorie->readAll();

$vehicule = new Vehicule();

$vehicules =$vehicule->readAll();

$statistics = new Statistics();
$mostrented=$statistics->mostRented();
$mostRated=$statistics->mostRated();

$reservation = new Reservation();
$reservations = $reservation->readAll();

$avis = new Avis();
$aviss = $avis->readAll();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Rent - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#003A66',
                        secondary: '#E02454',
                        'secondary-dark': '#C21E44',
                    },
                    fontFamily: {
                        'title': ['Poppins', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-gray-50 text-gray-700 font-title">
    <!-- Main Container -->
    <div class="flex min-h-screen">
      
        <aside class="w-64 bg-primary text-white" id="sidebar">
    <div class="p-6 flex flex-col">
        <!-- Login Sign -->
        <div class="flex items-center space-x-2 mb-6">
            <img src="profile-picture.jpg" alt="User Avatar" class="w-10 h-10 rounded-full">
            <span class="font-bold">John Doe</span>
        </div>
        <h1 class="text-xl font-bold mb-4">Go Rent</h1>
    </div>
    <nav class="p-6">
        <ul class="space-y-4">
            <li><button data-section="clients" class="dashboard-link w-full text-left flex items-center space-x-2 p-2 hover:bg-gray-200 rounded">
                <i class="ri-user-line"></i><span>Clients</span>
            </button></li>
            <li><button data-section="reservations" class="dashboard-link w-full text-left flex items-center space-x-2 p-2 hover:bg-gray-200 rounded">
                <i class="ri-calendar-line"></i><span>Reservations</span>
            </button></li>
            <li><button data-section="vehicules" class="dashboard-link w-full text-left flex items-center space-x-2 p-2 hover:bg-gray-200 rounded">
                <i class="ri-car-line"></i><span>Vehicules</span>
            </button></li>
            <li><button data-section="categories" class="dashboard-link w-full text-left flex items-center space-x-2 p-2 hover:bg-gray-200 rounded">
                <i class="ri-folder-line"></i><span>Categories</span>
            </button></li>
            <li><button data-section="avis" class="dashboard-link w-full text-left flex items-center space-x-2 p-2 hover:bg-gray-200 rounded">
                <i class="ri-comment-line"></i><span>Avis/Opinions</span>
            </button></li>
            <li><button data-section="statistiques" class="dashboard-link w-full text-left flex items-center space-x-2 p-2 hover:bg-gray-200 rounded">
                <i class="ri-bar-chart-line"></i><span>Statistiques</span>
            </button></li>
            
            <!-- Blog Section Dropdown -->
            <li>
                <button id="blogDropdownButton" class="dashboard-link w-full text-left flex items-center space-x-2 p-2 hover:bg-gray-200 rounded">
                    <i class="ri-article-line"></i><span>Blog</span>
                </button>
                <ul id="blogDropdown" class="space-y-2 pl-4 hidden">
                    <li><button data-section="themes" class="dashboard-link w-full text-left p-2 hover:bg-gray-200 rounded">
                        <i class="ri-article-line"></i><span>Themes</span>
                    </button></li>
                    <li><button data-section="articles" class="dashboard-link w-full text-left p-2 hover:bg-gray-200 rounded">
                        <i class="ri-pencil-line"></i><span>Articles</span>
                    </button></li>
                    <li><button data-section="tags" class="dashboard-link w-full text-left p-2 hover:bg-gray-200 rounded">
                        <i class="ri-price-tag-line"></i><span>Tags</span>
                    </button></li>
                    <li><button data-section="comments" class="dashboard-link w-full text-left p-2 hover:bg-gray-200 rounded">
                        <i class="ri-message-line"></i><span>Comments</span>
                    </button></li>
                    <li><button data-section="favorites" class="dashboard-link w-full text-left p-2 hover:bg-gray-200 rounded">
                        <i class="ri-heart-line"></i><span>Favorites</span>
                    </button></li>
                </ul>
            </li>
        </ul>

        <!-- Logout Icon -->
        <div class="p-6 border-t border-gray-400">
            <button onclick="window.location.href='logout.php'" class="dashboard-link w-full text-left flex items-center space-x-2 p-2 hover:bg-red-600 rounded">
                <i class="ri-logout-box-line"></i><span>Logout</span>
            </button>
        </div>
    </nav>
</aside>

<script>
    // Toggle Blog Dropdown
    const blogDropdownButton = document.getElementById('blogDropdownButton');
    const blogDropdown = document.getElementById('blogDropdown');

    blogDropdownButton.addEventListener('click', () => {
        blogDropdown.classList.toggle('hidden');
    });
</script>


        <!-- Content -->
        <main class="flex-1 p-6">
            <!-- Clients Section -->
            <section id="clients" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-primary mb-4">Clients</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2">1</td>
                            <td class="border p-2">John Doe</td>
                            <td class="border p-2">john@example.com</td>
                            <td class="border p-2">+123456789</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <!-- Reservations Section -->
            <section id="reservations" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-primary mb-4">Reservations</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <!-- <th class="border p-2">Reservation ID</th> -->
                            <th class="border p-2">Client Name</th>
                            <th class="border p-2">Vehicle</th>
                            <th class="border p-2">Start Date</th>
                            <th class="border p-2">End Date</th>
                            <th class="border p-2">Location </th>
                            <th class="border p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php foreach ($reservations as $reservation) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2"><?= $reservation['username'] ?></td>
                            <td class="border p-2"><?= $reservation['marque'] ?>  <?= $reservation['modele'] ?></td>
                            <td class="border p-2"><?= $reservation['date_debut'] ?></td>
                            <td class="border p-2"><?= $reservation['date_fin'] ?></td>
                            <td class="border p-2"><?= $reservation['lieu_prise_en_charge'] ?></td>
                            <td class="border p-2  <?= $reservation['status'] === 'pending' ? 'text-yellow-500' : ($reservation['status'] === 'approved' ? 'text-green-500' : 'text-red-500') ?>">
                                    <?= ucfirst($reservation['status']) ?> </td>
                            </tr>

                    <?php } ?>

                    </tbody>
                </table>
            </section>

            <!-- Vehicules Section -->
            <section id="vehicules" class="dashboard-section  bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-primary mb-4">Vehicules</h2>
                <button id="addVehiculeBtn" class="bg-secondary text-white px-4 py-2 rounded mb-4 hover:bg-secondary-dark transition-all duration-300 ease-in-out">Add New Vehicule</button>
                <!-- Vehicule Form Modal -->
                <div id="vehiculeForm" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h3 class="text-2xl font-bold text-primary mb-4">Add Vehicule</h3>
                        <form enctype="multipart/form-data" method="POST" action ="../Controller/addVehicule.php">
                            <!-- Two-column layout for Marque, Modele, Prix par jour, and Disponibilité -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Marque -->
                                <div class="mb-4">
                                    <label for="vehiculeMarque" class="block text-sm font-medium text-gray-700">Marque</label>
                                    <input type="text" id="vehiculeMarque" name="vehiculeMarque" class="w-full border p-2 mt-2" placeholder="Enter Brand">
                                </div>
                
                                <!-- Modele -->
                                <div class="mb-4">
                                    <label for="vehiculeModele" class="block text-sm font-medium text-gray-700">Modele</label>
                                    <input type="text" id="vehiculeModele" name="vehiculeModele" class="w-full border p-2 mt-2" placeholder="Enter Model">
                                </div>
                
                                <!-- Prix par jour -->
                                <div class="mb-4">
                                    <label for="vehiculePrix" class="block text-sm font-medium text-gray-700">Prix par jour</label>
                                    <input type="number" id="vehiculePrix" name="vehiculePrix" class="w-full border p-2 mt-2" placeholder="Enter Price per Day" step="0.01">
                                </div>
                
                                <!-- Disponibilité -->
                                <div class="mb-4">
                                    <label for="vehiculeDisponibilite" class="block text-sm font-medium text-gray-700">Disponibilité</label>
                                    <select id="vehiculeDisponibilite" name="vehiculeDisponibilite" class="w-full border p-2 mt-2">
                                        <option value="1">Disponible</option>
                                        <option value="0">Indisponible</option>
                                    </select>
                                </div>
                            </div>
                
                            <!-- Description (Single-column) -->
                            <div class="mb-4">
                                <label for="vehiculeDescription" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="vehiculeDescription" name="vehiculeDescription" class="w-full border p-2 mt-2" placeholder="Enter Description"></textarea>
                            </div>
                
                            <!-- Image (Single-column) -->
                            <div class="mb-4">
                                <label for="vehiculeImage" class="block text-sm font-medium text-gray-700">Image URL</label>
                                <input type="file" id="vehiculeImage" name="vehiculeImage" class="w-full border p-2 mt-2" placeholder="Enter Image URL">
                            </div>
                
                            <!-- Category (Single-column) -->
                            <div class="mb-4">
                                <label for="vehiculeCategory" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="vehiculeCategory" name="vehiculeCategory" class="w-full border p-2 mt-2">
                                    <!-- Dynamically populated categories -->
                                    <?php foreach ($categories as $category) {?>
                                        <option value=" <?= $category["id_categorie"] ?>"><?= $category["nom_categorie"] ?></option>    
                                    <?php } ?>
                                </select>
                            </div>
                
                            <!-- Form Buttons -->
                            <div class="flex justify-between">
                                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700" onclick="closeVehiculeForm()">Cancel</button>
                                <button type="submit" class="bg-secondary text-white px-4 py-2 rounded hover:bg-secondary-dark">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="updateVehiculeForm" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h3 class="text-2xl font-bold text-primary mb-4">Add Vehicule</h3>
                        <form enctype="multipart/form-data" method="POST" action ="../Controller/updateVehicule.php">
                            <!-- Two-column layout for Marque, Modele, Prix par jour, and Disponibilité -->
                            <div class="grid grid-cols-2 gap-4">
                            <input type="hidden" name="id_vehicule" id="id_vehicule" value="">


                                <!-- Marque -->
                                <div class="mb-4">
                                    <label for="vehiculeMarque" class="block text-sm font-medium text-gray-700">Marque</label>
                                    <input type="text" id="vehicule_Marque" name="vehiculeMarque" class="w-full border p-2 mt-2" placeholder="Enter Brand">
                                </div>
                
                                <!-- Modele -->
                                <div class="mb-4">
                                    <label for="vehiculeModele" class="block text-sm font-medium text-gray-700">Modele</label>
                                    <input type="text" id="vehicule_Modele" name="vehiculeModele" class="w-full border p-2 mt-2" placeholder="Enter Model">
                                </div>
                
                                <!-- Prix par jour -->
                                <div class="mb-4">
                                    <label for="vehiculePrix" class="block text-sm font-medium text-gray-700">Prix par jour</label>
                                    <input type="number" id="vehicule_Prix" name="vehiculePrix" class="w-full border p-2 mt-2" placeholder="Enter Price per Day" step="0.01">
                                </div>
                
                                <!-- Disponibilité -->
                                <div class="mb-4">
                                    <label for="vehiculeDisponibilite" class="block text-sm font-medium text-gray-700">Disponibilité</label>
                                    <select id="vehicule_Disponibilite" name="vehiculeDisponibilite" class="w-full border p-2 mt-2">
                                        <option value="1">Disponible</option>
                                        <option value="0">Indisponible</option>
                                    </select>
                                </div>
                            </div>
                
                            <!-- Description (Single-column) -->
                            <div class="mb-4">
                                <label for="vehiculeDescription" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="vehicule_Description" name="vehiculeDescription" class="w-full border p-2 mt-2" placeholder="Enter Description"></textarea>
                            </div>
                
                            <!-- Image (Single-column) -->
                            <div class="mb-4">
                                <label>Current Image: <span id="vehicule_Image_Label"></span></label>
                                <input type="file" id="vehicule_Image" name="vehiculeImage" class="w-full border p-2 mt-2" placeholder="Enter Image URL">
                            </div>
                
                            <!-- Category (Single-column) -->
                            <div class="mb-4">
                                <label for="vehiculeCategory" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="vehicule_Category" name="vehiculeCategory" class="w-full border p-2 mt-2">
                                    <!-- Dynamically populated categories -->
                                    <?php foreach ($categories as $category) {?>
                                        <option value=" <?= $category["id_categorie"] ?>"><?= $category["nom_categorie"] ?></option>    
                                    <?php } ?>
                                </select>
                            </div>
                
                            <!-- Form Buttons -->
                            <div class="flex justify-between">
                                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700" onclick="closeUpdateVehiculeForm()">Cancel</button>
                                <button type="submit" class="bg-secondary text-white px-4 py-2 rounded hover:bg-secondary-dark">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>



                <table class="w-full border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Marque</th>
                            <th class="border p-2">Modele</th>
                            <th class="border p-2">Prix par jour</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Category</th>
                            <th class="border p-2">Description</th>
                            <th class="border p-2">Image</th>
                            <th class="border p-2">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2">1</td>
                            <td class="border p-2">Toyota</td>
                            <td class="border p-2">Corolla</td>
                            <td class="border p-2">$50/day</td>
                            <td class="border p-2">Disponible</td>
                            <td class="border p-2">Sedan</td>
                            <td class="border p-2">Comfortable and fuel-efficient</td>
                            <td class="border p-2"><img src="car-image.jpg" alt="Car" class="w-20 h-20 object-cover"></td>
                            <td class="border p-2">
                                <div class="flex justify-center items-center space-x-4">
                                    <a href="../Controller/delete.php"> <img src="./img/delete.png" alt="Delete" class="w-6 h-6 cursor-pointer"></a>
                                    <a href="../Controller/update.php">  <img src="./img/update.png" alt="Update" class="w-6 h-6 cursor-pointer"></a>
                                </div>
                            </td>

                        </tr>
                        <?php foreach ($vehicules as $vehicule) {?>
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2"><?= $vehicule["id_vehicule"]?></td>
                                <td class="border p-2"><?= $vehicule["marque"]?></td>
                                <td class="border p-2"><?= $vehicule["modele"]?></td>
                                <td class="border p-2"><?= $vehicule["prix_par_jour"]?>/day</td>
                                <td class="border p-2"><?= $vehicule['disponibilite'] ? 'Available' : 'Not Available' ?></td>
                                <td class="border p-2"><?= $vehicule["nom_categorie"]?></td>
                                <td class="border p-2"><?= $vehicule["description"]?></td>
                                <td class="border p-2"><img src="./img/<?= $vehicule["image"]?>" alt="Car" class="w-20 h-20 object-cover"></td>
                                <td class="border p-2">
                                    <div class="flex justify-center items-center space-x-4">
                                        <a href="../Controller/deleteVehicule.php?carId=<?= $vehicule["id_vehicule"]?>"> <img src="./img/delete.png" alt="Delete" class="w-6 h-6 cursor-pointer"></a>
                                        <button onclick="openUpdateVehiculeForm(<?= $vehicule['id_vehicule']?>)">
                                            <img src="./img/exchange.png" alt="Update" class="w-6 h-6 cursor-pointer">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                             
                        <?php } ?>
                    </tbody>
                </table>

            </section>

            <!-- Categories Section -->
            <section id="categories" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-primary mb-4">Categories</h2>
                <button id="addCategoryBtn" class="bg-secondary text-white px-4 py-2 rounded mb-4 hover:bg-secondary-dark transition-all duration-300 ease-in-out">Add New Categories</button>

                <!-- Categories Form Modal -->
                <div id="categoryForm" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h3 class="text-2xl font-bold text-primary mb-4">Add Categories</h3>
                        <form id="categoryFormContent" method="post" action ="../Controller/addCategories.php">
                            <div id="categoryFields">
                                <div class="mb-4">
                                    <input type="text" class="w-full border p-2" name="name[]" placeholder="Enter Category Name">
                                </div>
                            </div>
                            <button type="button" id="addCategoryInput" class="bg-gray-200 text-primary px-4 py-2 rounded mb-4 hover:bg-gray-300">Add More</button>
                            <div class="flex justify-between">
                                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700" onclick="closeCategoryForm()">Cancel</button>
                                <button type="submit" class="bg-secondary text-white px-4 py-2 rounded hover:bg-secondary-dark">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                       <!-- Categories Form Modal -->
                <div id="updateCategoryForm" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h3 class="text-2xl font-bold text-primary mb-4">Add Categories</h3>
                        <form id="categoryFormContent" method="post" action ="../Controller/updateCategories.php">
                            <div id="categoryFields">
                                <div class="mb-4">
                                    <input type="hidden" name="id_category" id="id_category" value="">

                                    <input type="text" class="w-full border p-2" id="name_category" name="name" placeholder="Enter Category Name">
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700" onclick="closeUpdateCategoryForm()">Cancel</button>
                                <button type="submit" class="bg-secondary text-white px-4 py-2 rounded hover:bg-secondary-dark">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="w-full border-collapse border border-gray-300 mb-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Category Name</th>
                            <th class="border p-2">action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2">1</td>
                            <td class="border p-2">SUV</td>
                        </tr>
                     <?php foreach ($categories as $category) {?>
                         <tr class="hover:bg-gray-50">
                             <td class="border p-2"><?= $category["id_categorie"] ?></td>
                             <td class="border p-2"><?= $category["nom_categorie"] ?></td>
                             <td class="border p-2">
                                    <div class="flex justify-center items-center space-x-4">
                                        <a href="../Controller/deleteCategory.php?id=<?= $category["id_categorie"]?>"> <img src="./img/delete.png" alt="Delete" class="w-6 h-6 cursor-pointer"></a>
                                        <button onclick="openUpdateCategoryForm(<?= $category['id_categorie']?>)">
                                            <img src="./img/exchange.png" alt="Update" class="w-6 h-6 cursor-pointer">
                                        </button>
                                    </div>
                            </td>
                         </tr>
                     <?php } ?>

                    </tbody>
                </table>
            </section>

                  <!-- Reservations Section -->
            <section id="avis" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-primary mb-4">Feed Backs</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Feed Back ID</th>
                            <th class="border p-2">Client Name</th>
                            <th class="border p-2">Vehicle</th>
                            <th class="border p-2">Note</th>
                            <th class="border p-2">Commentaire</th>
                            <th class="border p-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($aviss as $opinion) { ?>

                        <tr class="hover:bg-gray-50">
                            <td class="border p-2"><?= $opinion['id_avis'] ?></td>
                            <td class="border p-2"><?= $opinion['username'] ?></td>
                            <td class="border p-2"><?= $opinion['marque'] ?>  <?= $opinion['modele'] ?></td>
                            <td class="border p-2"><?= $opinion['note'] ?></td>
                            <td class="border p-2"><?= $opinion['commentaire'] ?></td>
                            <td class="border p-2"><?= $opinion['date'] ?></td>

                        </tr>
                <?php } ?>                   

                    </tbody>
                </table>
            </section>




            <!-- Statistiques Section -->
            <section id="statistiques" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-primary mb-4">Statistiques</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-xl font-semibold text-primary">Total Reservations</h3>
                        <p class="text-3xl font-bold mt-2"><?= $statistics->approved() ?></p>
                        <p class="text-sm text-gray-500 mt-1">Approved</p>
                    </div>

                    <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-xl font-semibold text-primary">Total Feedback</h3>
                        <p class="text-3xl font-bold mt-2"><?= $statistics->totalFeedback() ?></p>
                        <p class="text-sm text-gray-500 mt-1">This Year</p>
                    </div>

                    <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-xl font-semibold text-primary">Average rating</h3>
                        <p class="text-3xl font-bold mt-2"><?= $statistics->avrFeedback() ?></p>
                        <p class="text-sm text-gray-500 mt-1">of vehicles</p>
                    </div>

                    <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-xl font-semibold text-primary">Total Vehicles</h3>
                        <p class="text-3xl font-bold mt-2"><?= $statistics->available() ?></p>
                        <p class="text-sm text-gray-500 mt-1">Available for Rent</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-xl font-semibold text-primary">Most Rented Vehicle</h3>
                        <p  class="text-sm text-gray-500 mt-1">
                            <strong class=" font-bold">Category : </strong> <?= $mostrented['nom_categorie'] ?><br>
                            <strong class=" font-bold">marque : </strong> <?= $mostrented['marque']  ?><br>
                            <strong class=" font-bold">modele : </strong> <?= $mostrented['modele']  ?><br>
                            <strong class=" font-bold">Price : </strong>$<?= $mostrented['prix_par_jour'] ?>/day<br>
                            

                        </p>
                        <!-- <p class="text-sm text-gray-500 mt-1">Available for Rent</p> -->
                    </div>

                    <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                        <h3 class="text-xl font-semibold text-primary">Most Rated Vehicle</h3>
                        <p  class="text-sm text-gray-500 mt-1">
                            <strong class=" font-bold">Category : </strong> <?= $mostRated['nom_categorie'] ?><br>
                            <strong class=" font-bold">marque : </strong> <?= $mostRated['marque']  ?><br>
                            <strong class=" font-bold">modele : </strong> <?= $mostRated['modele']  ?><br>
                            <strong class=" font-bold">Price : </strong>$<?= $mostRated['prix_par_jour'] ?>/day<br>
                            

                        </p>
                        </p>
                        <!-- <p class="text-sm text-gray-500 mt-1">Available for Rent</p> -->
                    </div>

                </div>
            </section>
<!-- Tags Section -->
<section id="tags" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
    <h2 class="text-2xl font-bold text-primary mb-4">Tags</h2>
    
    <!-- Button to Open Tag Popup Form -->
    <button id="openTagForm" class="bg-secondary text-white px-4 py-2 rounded mb-4 hover:bg-secondary-dark transition-all duration-300 ease-in-out">Add Tags</button>

    <!-- Pop-up Form for Adding Tags -->
    <div id="tagPopup" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg w-1/2">
            <h3 class="text-xl font-bold text-primary mb-4">Add Tags</h3>
            <form action="../Controller/addTag.php" method="POST" id="tagForm">
                <!-- Multiple Tag Fields Container -->
                <div id="tagFields">
                    <!-- Initial Tag Field -->
                    <div class="mb-4 tagField">
                        <label for="tag_title" class="block mb-2">Tag Title:</label>
                        <input type="text" name="tag_title[]" class="w-full p-2 border rounded mb-2" placeholder="Enter tag title" required>

                        <label for="tag_color" class="block mb-2">Tag Color:</label>
                        <select name="tag_color[]" class="w-full p-2 border rounded mb-4" required>
                            <option value="red">Red</option>
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                            <option value="yellow">Yellow</option>
                            <option value="purple">Purple</option>
                        </select>
                    </div>
                </div>

                <!-- Add More Tags Button -->
                <button type="button" id="addTagField" class="bg-gray-300 text-black p-2 rounded mb-4">Add More Tags</button>

                <button type="submit" class="bg-secondary text-white px-4 py-2 rounded mb-4 hover:bg-secondary-dark transition-all duration-300 ease-in-out">Save</button>
                <button type="button" id="closeTagPopup" class="bg-gray-400 text-white p-2 rounded">Close</button>
            </form>
        </div>
    </div>

      <!-- Pop-up Form for updating Tags -->
      <div id="updateTagPopup" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg w-1/2">
            <h3 class="text-xl font-bold text-primary mb-4">Update Tag</h3>
            <form action="../Controller/updateTag.php" method="POST" id="tagForm">
                <!-- Multiple Tag Fields Container -->
                <div id="tagFields">
                    <!-- Initial Tag Field -->
                    <div class="mb-4 tagField">
                        <input type="hidden" name="id_tag" id="id_tag" value="">

                        <label for="tag_title" class="block mb-2">Tag Title:</label>
                        <input type="text" id="tag_title" name="tag_title" class="w-full p-2 border rounded mb-2" placeholder="Enter tag title" required>

                        <label for="tag_color" class="block mb-2">Tag Color:</label>
                        <select name="tag_color" id="tag_color"  class="w-full p-2 border rounded mb-4" required>
                            <option value="red">Red</option>
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                            <option value="yellow">Yellow</option>
                            <option value="purple">Purple</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="bg-secondary text-white px-4 py-2 rounded mb-4 hover:bg-secondary-dark transition-all duration-300 ease-in-out">Save changes</button>
                <button type="button" id="closeUpdateTag" class="bg-gray-400 text-white p-2 rounded">Close</button>
            </form>
        </div>
    </div>

    <!-- Tags Table -->
    <table class="w-full border-collapse border border-gray-300 mt-6">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Tag Title</th>
                <th class="border p-2">Tag Color</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example Row (PHP will populate this with actual data) -->
            <?php foreach ($tags as $tag): ?>
            <tr>
                <td class="border p-2"><?= htmlspecialchars($tag['tag_title']) ?></td>
                <td class="border p-2" style="background-color: <?= $tag['tag_color']; ?>"><?= ucfirst($tag['tag_color']) ?></td>
                <td class="border p-2">
                    <!-- Add Edit/Delete Actions -->
                    <button class="bg-primary text-white p-1 rounded" onclick="openUpdateTagForm(<?= $tag['tag_id'] ?>)">Edit</button>
                    <a href="../controller/deleteTag.php?id=<?= $tag['tag_id'] ?>">
                        <button  class="bg-red-500 text-white p-1 rounded">Delete</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<!-- Theme Section -->
<section id="themes" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
    <h2 class="text-2xl font-bold text-primary mb-4">Themes</h2>
    
    <!-- Button to Open Theme Popup Form -->
    <button id="openThemeForm" class="bg-primary text-white p-2 rounded mb-4">Add Theme</button>

<!-- Pop-up Form for Adding Theme -->
<div id="themePopup" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h3 class="text-xl font-bold text-primary mb-4">Add Theme</h3>
        <form action="../controller/addTheme.php" method="POST" id="themeForm">
            <div class="mb-4">
                <label for="theme_name" class="block mb-2">Theme Name:</label>
                <input type="text" name="theme_name"  class="w-full p-2 border rounded mb-2" placeholder="Enter theme name" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2">Description:</label>
                <textarea name="description" id="description" class="w-full p-2 border rounded mb-4" placeholder="Enter theme description" rows="4" required></textarea>
            </div>

            <button type="submit" class="bg-primary text-white p-2 rounded mr-2">Save</button>
            <button type="button" id="closeThemePopup" class="bg-gray-400 text-white p-2 rounded">Close</button>
        </form>
    </div>
</div>


<div id="updateTheme" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h3 class="text-xl font-bold text-primary mb-4">Update Theme</h3>
        <form action="../controller/updateTheme.php" method="POST" id="updateThemeForm">
            <!-- Hidden input for Theme ID -->
            <input type="hidden" name="theme_id" id="theme_id" value="">

            <div class="mb-4">
                <label for="theme_name" class="block mb-2">Theme Name:</label>
                <input type="text" name="theme_name" id="theme_name" class="w-full p-2 border rounded mb-2" placeholder="Enter theme name" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2">Description:</label>
                <textarea name="description" id="theme_description" class="w-full p-2 border rounded mb-4" placeholder="Enter theme description" rows="4" required></textarea>
            </div>

            <button type="submit" class="bg-primary text-white p-2 rounded mr-2">Save</button>
            <button type="button" id="closeUpdateTheme" class="bg-gray-400 text-white p-2 rounded">Close</button>
        </form>
    </div>
</div>


    <!-- Themes Table -->
    <table class="w-full border-collapse border border-gray-300 mt-6">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Theme Name</th>
                <th class="border p-2">Description</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example Row (PHP will populate this with actual data) -->
            <?php foreach ($themes as $theme): ?>
            <tr>
                <td class="border p-2"><?= htmlspecialchars($theme['theme_name']) ?></td>
                <td class="border p-2"><?= nl2br(htmlspecialchars($theme['description'])) ?></td>
                <td class="border p-2">
                    <!-- Add Edit/Delete Actions -->
                    <button class="bg-primary text-white p-1 rounded" onclick="openUpdateThemeForm(<?= $theme['theme_id'] ?>)">Edit</button>
                        <a href="../controller/deleteTheme.php?id=<?= $theme['theme_id'] ?>">
                            <button  class="bg-red-500 text-white p-1 rounded">Delete</button>
                        </a>
     
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</section>

<!-- Articles Section -->
<section id="articles" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
    <h2 class="text-2xl font-bold text-primary mb-4">Articles</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Article Title</th>
                <th class="border p-2">Theme</th>
                <th class="border p-2">User</th>
                <th class="border p-2">Content</th>
                <th class="border p-2">Image</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example article data -->
            
            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td class="border p-2"><?= htmlspecialchars($article["article_title"]) ?></td>
                    <td class="border p-2"> <?= htmlspecialchars($article["theme_name"]) ?></td>
                    <td class="border p-2"><?= htmlspecialchars($article["username"]) ?></td>
                    <td class="border p-2"><?= htmlspecialchars($article["content"]) ?></td>
                    <td class="border p-2">
                        <img class="h-24" src="./img/<?= htmlspecialchars($article["image"]) ?>" alt="">
                    </td>
                    <td class="border p-2">
                        <button class="bg-secondary text-white px-4 py-2 rounded mb-4 hover:bg-secondary-dark transition-all duration-300 ease-in-out">Approve</button>
                    </td>
                </tr>
            <?php endforeach ?>
            
        </tbody>
    </table>
</section>

<!-- Comments Section -->
<section id="comments" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
    <h2 class="text-2xl font-bold text-primary mb-4">Comments</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Article Title</th>
                <th class="border p-2">User</th>
                <th class="border p-2">Comment</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example comment data -->
            <tr>
                <td class="border p-2">Example Article 1</td>
                <td class="border p-2">User 1</td>
                <td class="border p-2">This is a comment</td>
                <td class="border p-2">
                    <button class="bg-secondary text-white px-4 py-2 rounded mb-4 hover:bg-secondary-dark transition-all duration-300 ease-in-out">Approve</button>
                    <button class="bg-danger text-white px-4 py-2 rounded mb-4 hover:bg-danger-dark transition-all duration-300 ease-in-out">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Favorites Section -->
<section id="favorites" class="dashboard-section hidden bg-white shadow-lg rounded-lg p-6 mb-6">
    <h2 class="text-2xl font-bold text-primary mb-4">Favorites</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Article Title</th>
                <th class="border p-2">User</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example favorite data -->
            <tr>
                <td class="border p-2">Example Article 1</td>
                <td class="border p-2">User 1</td>
            </tr>
        </tbody>
    </table>
</section>


            
        </main>

    </div>

    <script>
        // Toggle Dashboard Sections
        const dashboardLinks = document.querySelectorAll('.dashboard-link');
        // console.log(dashboardLinks);
        
        const sections = document.querySelectorAll('.dashboard-section');

        dashboardLinks.forEach(link => {
            link.addEventListener('click', () => {
                const section = link.getAttribute('data-section');
                sections.forEach(sec => {
                    if (sec.id === section) {
                        sec.classList.remove('hidden');
                    } else {
                        sec.classList.add('hidden');
                    }
                });
            });
        });

        // Show Vehicule Form
        const addVehiculeBtn = document.getElementById('addVehiculeBtn');
        const vehiculeForm = document.getElementById('vehiculeForm');
        const updateVehiculeForm = document.getElementById('updateVehiculeForm');



        addVehiculeBtn.addEventListener('click', () => {
            vehiculeForm.classList.remove('hidden');
        });

        // Close Vehicule Form
        function closeVehiculeForm() {
            vehiculeForm.classList.add('hidden');
        }

    

        function openUpdateVehiculeForm(carId) {
            fetch(`getCarData.php?carId=${carId}`)
                .then((response) => response.json())
                .then((car) => {
                    console.log(car);
                    
                    document.getElementById('id_vehicule').value = car.id_vehicule;
                    document.getElementById('vehicule_Marque').value = car.marque;
                    document.getElementById('vehicule_Modele').value = car.modele;
                    document.getElementById('vehicule_Prix').value = car.prix_par_jour;
                    document.getElementById('vehicule_Disponibilite').value = car.disponibilite;
                    document.getElementById('vehicule_Description').value = car.description;
                    // document.getElementById('vehicule_Category').value = car.id_categorie;
                    document.getElementById('vehicule_Image_Label').innerText = car.image; 
                    window.onload = function () {
                        document.getElementById('vehicule_Category').value = car.id_categorie;
                    };

                    updateVehiculeForm.classList.remove('hidden');
                })
                .catch((error) => {
                    console.error("Error fetching car data:", error);
                });
        }
 
        function closeUpdateVehiculeForm() {
            updateVehiculeForm.classList.add('hidden');
        }

        // Show Category Form
        const addCategoryBtn = document.getElementById('addCategoryBtn');
        const categoryForm = document.getElementById('categoryForm');
        addCategoryBtn.addEventListener('click', () => {
            categoryForm.classList.remove('hidden');
        });

        // Close Category Form
        function closeCategoryForm() {
            categoryForm.classList.add('hidden');
        }

        const updateCategoryForm = document.getElementById('updateCategoryForm');

        function openUpdateCategoryForm(id) {

            fetch(`getCategoryData.php?id=${id}`)
                .then((response) => response.json())
                .then((category) => {
                    console.log(category);
                    
                    document.getElementById('id_category').value = category.id_categorie;
                    document.getElementById('name_category').value = category.nom_categorie;
                    updateCategoryForm.classList.remove('hidden');
                })
                .catch((error) => {
                    console.error("Error fetching category data:", error);
                });

            
        }

        function closeUpdateCategoryForm() {
            updateCategoryForm.classList.add('hidden');
        }


        // Add More Category Fields
        const addCategoryInput = document.getElementById('addCategoryInput');
        addCategoryInput.addEventListener('click', () => {
            const categoryFields = document.getElementById('categoryFields');
            const newInput = document.createElement('div');
            newInput.classList.add('mb-4');
            newInput.innerHTML = '<input type="text" name="name[]" class="w-full border p-2" placeholder="Enter Category Name">';
            categoryFields.appendChild(newInput);
        });



// Open the popup form for adding tags
document.getElementById('openTagForm').addEventListener('click', function() {
    document.getElementById('tagPopup').classList.remove('hidden');
});

// Close the popup form for tags
document.getElementById('closeTagPopup').addEventListener('click', function() {
    document.getElementById('tagPopup').classList.add('hidden');
});

// Open the popup form for adding theme
document.getElementById('openThemeForm').addEventListener('click', function() {
    document.getElementById('themePopup').classList.remove('hidden');
});

// Close the popup form for theme
document.getElementById('closeThemePopup').addEventListener('click', function() {
    document.getElementById('themePopup').classList.add('hidden');
});

// Add More Tags functionality
document.getElementById('addTagField').addEventListener('click', function() {
    const tagFieldsContainer = document.getElementById('tagFields');
    const newTagField = document.createElement('div');
    newTagField.classList.add('mb-4', 'tagField');
    newTagField.innerHTML = `
        <label for="tag_title" class="block mb-2">Tag Title:</label>
        <input type="text" name="tag_title[]" class="w-full p-2 border rounded mb-2" placeholder="Enter tag title" required>

        <label for="tag_color" class="block mb-2">Tag Color:</label>
        <select name="tag_color[]" class="w-full p-2 border rounded mb-4" required>
            <option value="red">Red</option>
            <option value="blue">Blue</option>
            <option value="green">Green</option>
            <option value="yellow">Yellow</option>
            <option value="purple">Purple</option>
        </select>
    `;
    
    tagFieldsContainer.appendChild(newTagField);
});

// Open the popup form for adding tags
 function openUpdateTagForm(tagId) {
    fetch(`getTagData.php?tagId=${tagId}`)
                .then((response) => response.json())
                .then((tag) => {
                    console.log(tag);
                    
                    document.getElementById('id_tag').value = tag.tag_id;
                    document.getElementById('tag_title').value = tag.tag_title;
                    document.getElementById('tag_color').value = tag.tag_color;

                    document.getElementById('updateTagPopup').classList.remove('hidden');
                })
                .catch((error) => {
                    console.error("Error fetching car data:", error);
                });

    
}

// Close the popup form for tags
document.getElementById('closeUpdateTag').addEventListener('click', function() {
    document.getElementById('updateTagPopup').classList.add('hidden');
});

// Open the popup form for adding theme
function openUpdateThemeForm(id) {
    fetch(`getThemeData.php?idtheme=${id}`)
                .then((response) => response.json())
                .then((theme) => {
                    console.log(theme);
                    
                    document.getElementById('theme_id').value = theme.theme_id;
                    document.getElementById('theme_name').value = theme.theme_name;
                    document.getElementById('theme_description').value = theme.description;
                    document.getElementById('updateTheme').classList.remove('hidden');
                })
                .catch((error) => {
                    console.error("Error fetching car data:", error);
                });

    
}

// Close the popup form for theme
document.getElementById('closeUpdateTheme').addEventListener('click', function() {
    document.getElementById('updateTheme').classList.add('hidden');
});

        
    </script>
</body>



</html>
