<?php
require_once '../Model/tag.php';
require_once '../Model/theme.php';
require_once '../Model/Article.php';
require_once '../Controller/articleController.php';


if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if (isset($_GET['itemsPerPage'])) {
    $itemsPerPage = $_GET['itemsPerPage'];
} else {
    $itemsPerPage = 1;
}


$articleController = new ArticleController();
  
$nbr_pages=ceil($articleController ->totalArticles() /$itemsPerPage) ;
$paginnationArticles= $articleController ->paginationArticles($page ,$itemsPerPage , 2);
// var_dump($paginnationArticles);
$Articles_1= $articleController ->getThemeArticlesWithTags(3);
$Articles_2= $articleController ->getThemeArticlesWithTags(4);
$Articles_3= $articleController ->getThemeArticlesWithTags(5);
foreach ($paginnationArticles as $item) {
//    var_dump($item['article']);
   var_dump(htmlspecialchars($item['article']["image"]));
    echo"<br>";
    echo"<br>";
    echo"<br>";
    echo"<br>";
    // echo"$value";
    break;
}






$theme = new Theme();
$themes = $theme->readAll();

$tag = new Tag();
$tags = $tag->readAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Interface</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-[#003366] p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">Blog</h1>
            <div class="flex gap-4">
                <div class="container mx-auto  flex justify-center ">
                    <label for="itemsPerPage" class="text-gray-300 mr-2">Items per page:</label>
                    <select onchange="window.location.href=this.value" id="itemsPerPage" class="px-4 py-2 bg-red-500 text-white rounded-md border">
                        <option value="./blog.php?itemsPerPage=1" <?= $itemsPerPage == 1 ? 'selected' : '' ?>>1</option>
                        <option value="./blog.php?itemsPerPage=2" <?= $itemsPerPage == 2 ? 'selected' : '' ?>>2</option>
                        <option value="./blog.php?itemsPerPage=3" <?= $itemsPerPage == 3 ? 'selected' : '' ?>>3</option>
                    </select>
                </div>
                <input id="searchTitle" type="text" placeholder="Search articles..." class="px-4 py-1.5 rounded-md border-0 focus:ring-2 focus:ring-blue-500">
                <select id="tagFilter" class="px-4 py-1.5 rounded-md border-0 focus:ring-2 focus:ring-blue-500">
                    <option value="">Filter by Tag</option>

                    <?php foreach ($tags as $tag): ?>
                        <option class="p-1 bg-<?= htmlspecialchars($tag['tag_color']) ?>-100 "  value="<?= $tag['tag_id'] ?>">#<?= htmlspecialchars($tag['tag_title']) ?></option>
                    <?php endforeach; ?> 
                </select>
                <button class="bg-[#E4234F] text-white px-6 py-1.5 rounded-md hover:bg-[#c81e43] transition-colors">
                    Search
                </button>
            </div>
        </div>
    </nav>



        <!-- Article Form (Hidden by default) -->
    <div id="articleForm" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-2xl">
            <h2 class="text-2xl font-bold mb-4">Add New Article</h2>
            <form class="space-y-4" enctype="multipart/form-data" method="POST"  action="../controller/addArticle.php">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" name="article_title" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter article title">
                </div>
            
                <div>
                    <label class="block text-sm font-medium mb-1">Theme</label>
                    <select name="theme_id" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Select a Theme</option>
                       <?php foreach ($themes as $theme): ?>
                         <option value="<?= $theme['theme_id'] ?>"><?= htmlspecialchars($theme['theme_name']) ?></option>
                       <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Tags</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 border rounded-md p-4">
                        <?php foreach ($tags as $tag): ?>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="tags[]" value="<?= $tag['tag_id'] ?>" class="rounded text-[#003366]">
                                <span class="rounded-md px-2 py-1 bg-<?= htmlspecialchars($tag['tag_color']) ?>-100 ">#<?= htmlspecialchars($tag['tag_title']) ?></span>
                            </label>
                        <?php endforeach; ?> 
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Content</label>
                    <textarea name="content" class="w-full px-4 py-2  border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" rows="4" placeholder="Write your article content..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Image</label>
                    <input type="file"  name="image" accept="image/*" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" onclick="toggleForm()" class="px-6 py-2 border rounded-md hover:bg-gray-100">Cancel</button>
                    <button type="submit" class="px-6 py-2 bg-[#003366] text-white rounded-md hover:bg-[#002347]">Submit</button>
                </div>
            </form>
        </div>
    </div>


<section id="mainContainer" class="">
        <!-- Theme Navigation -->
        <div class="container mx-auto mt-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Explore Themes</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <button onclick="showTheme('travel')" class="theme-btn bg-white p-8 rounded-lg shadow hover:shadow-lg transition-all text-center">
                    <span class="block text-lg font-medium text-gray-700">Dream Routes</span>
                </button>
                <button onclick="showTheme('tech')" class="theme-btn bg-white p-8 rounded-lg shadow hover:shadow-lg transition-all text-center">
                    <span class="block text-lg font-medium text-gray-700">On-the-Go Life</span>
                </button>
                <button onclick="showTheme('lifestyle')" class="theme-btn bg-white p-8 rounded-lg shadow hover:shadow-lg transition-all text-center">
                    <span class="block text-lg font-medium text-gray-700">Hidden Roads</span>
                </button>
                <button onclick="showTheme('food')" class="theme-btn bg-white p-8 rounded-lg shadow hover:shadow-lg transition-all text-center">
                    <span class="block text-lg font-medium text-gray-700">Wheel Tales</span>
                </button>
            </div>
        </div>

    <!-- Add Article Button -->
    <div class="container mx-auto mt-8 flex justify-end">
        <button onclick="toggleForm()" class="bg-[#E4234F] text-white px-6 py-2 rounded-md hover:bg-[#c81e43] transition-colors">
            + Add Article
        </button>
    </div>


    <!-- Articles Sections -->
    <div class="container mx-auto mt-8">
        <h2 class="text-xl font-semibold mb-4">Articles</h2>

        <div id="travel" class="theme-section " >
            <div class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    
                <?php if (!empty($paginnationArticles)) { ?>
                    <?php foreach ($paginnationArticles as $item) { ?>
                        <article class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-all">
                        <img src="./img/<?= htmlspecialchars($item['article']["image"]) ?>"  alt="Travel" class="w-full h-48 object-cover">
    
                           
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2 text-gray-800">
                                    <?= htmlspecialchars($item['article']["image"]) ?>
                                </h3>
                                <p class="text-gray-600 mb-4">
                                    <?= htmlspecialchars($item['article']['content']) ?>
                                </p>
                                <!-- Tags -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <?php foreach ($item['tags'] as $tag) { ?>
                                        <span class="px-3 py-1 bg-<?= htmlspecialchars($tag['tag_color']) ?>-100 text-<?= htmlspecialchars($tag['tag_color']) ?>-800 rounded-full text-sm">#<?= htmlspecialchars($tag['tag_title']) ?></span>
                                    <?php } ?>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        By <?= htmlspecialchars($item['article']['username'] ?? 'Unknown') ?>
                                    </span>
                                    <a href="./articlePage.php?article_id=<?= htmlspecialchars($item['article']['article_id']) ?>" class="text-[#003366] hover:text-[#002347] font-medium">Read More</a>
                                </div>
                            </div>
                        </article>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-gray-500 text-center">No articles found.</p>
                <?php } ?>
    
            </div>
    
                    <!-- Pagination -->
            <div class="container mx-auto mt-8 mb-8 flex justify-center gap-2">
                <!-- Previous Button -->
                <?php if ($page > 1): ?>
                    <a href="./blog.php?itemsPerPage=<?= $itemsPerPage ?>&page=<?= $page - 1 ?>" 
                       class="px-4 py-2 rounded-md border hover:bg-gray-100">
                        Previous
                    </a>
                <?php else: ?>
                    <span class="px-4 py-2 rounded-md border bg-gray-200 cursor-not-allowed">Previous</span>
                <?php endif; ?>
            
                <!-- Page Numbers -->
                <?php for ($i = 1; $i <= $nbr_pages; $i++): ?>
                    <a href="./blog.php?itemsPerPage=<?= $itemsPerPage ?>&page=<?= $i ?>" 
                       class="px-4 py-2 rounded-md <?= ($i == $page) ? 'bg-[#003366] text-white' : 'border hover:bg-gray-100' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            
                <!-- Next Button -->
                <?php if ($page < $nbr_pages): ?>
                    <a href="./blog.php?itemsPerPage=<?= $itemsPerPage ?>&page=<?= $page + 1 ?>" 
                       class="px-4 py-2 rounded-md border hover:bg-gray-100">
                        Next
                    </a>
                <?php else: ?>
                    <span class="px-4 py-2 rounded-md border bg-gray-200 cursor-not-allowed">Next</span>
                <?php endif; ?>
            </div>


        </div>
        
        <!-- Travel Articles -->


        <!-- Tech Articles -->
        <div id="tech" class="theme-section hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
             <?php if (!empty($Articles_1)) { ?>
                <?php foreach ($Articles_1 as $item) { ?>
                    <article class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-all">
                    <img src="./img/<?= htmlspecialchars($item['article']["image"]) ?>"  alt="Travel" class="w-full h-48 object-cover">

                       
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2 text-gray-800">
                                <?= htmlspecialchars($item['article']['article_title']) ?>
                            </h3>
                            <p class="text-gray-600 mb-4">
                                <?= htmlspecialchars($item['article']['content']) ?>
                            </p>
                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <?php foreach ($item['tags'] as $tag) { ?>
                                    <span class="px-3 py-1 bg-<?= htmlspecialchars($tag['tag_color']) ?>-100 text-<?= htmlspecialchars($tag['tag_color']) ?>-800 rounded-full text-sm">#<?= htmlspecialchars($tag['tag_title']) ?></span>
                                <?php } ?>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    By <?= htmlspecialchars($item['article']['username'] ?? 'Unknown') ?>
                                </span>
                                <a href="./articlePage.php?article_id=<?= htmlspecialchars($item['article']['article_id']) ?>" class="text-[#003366] hover:text-[#002347] font-medium">Read More</a>
                            </div>
                        </div>
                    </article>
                <?php } ?>
            <?php } else { ?>
                <p class="text-gray-500 text-center">No articles found.</p>
            <?php } ?>



           
        </div>

        <!-- Lifestyle Articles -->
        <div id="lifestyle" class="theme-section hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php if (!empty($Articles_2)) { ?>
                <?php foreach ($Articles_2 as $item) { ?>
                    <article class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-all">
                    <img src="./img/<?= htmlspecialchars($item['article']["image"]) ?>"  alt="Travel" class="w-full h-48 object-cover">

                       
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2 text-gray-800">
                                <?= htmlspecialchars($item['article']['article_title']) ?>
                            </h3>
                            <p class="text-gray-600 mb-4">
                                <?= htmlspecialchars($item['article']['content']) ?>
                            </p>
                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <?php foreach ($item['tags'] as $tag) { ?>
                                    <span class="px-3 py-1 bg-<?= htmlspecialchars($tag['tag_color']) ?>-100 text-<?= htmlspecialchars($tag['tag_color']) ?>-800 rounded-full text-sm">#<?= htmlspecialchars($tag['tag_title']) ?></span>
                                <?php } ?>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    By <?= htmlspecialchars($item['article']['username'] ?? 'Unknown') ?>
                                </span>
                                <a href="./articlePage.php?article_id=<?= htmlspecialchars($item['article']['article_id']) ?>" class="text-[#003366] hover:text-[#002347] font-medium">Read More</a>
                            </div>
                        </div>
                    </article>
                <?php } ?>
            <?php } else { ?>
                <p class="text-gray-500 text-center">No articles found.</p>
            <?php } ?>
        </div>

        <!-- Food Articles -->
        <div id="food" class="theme-section hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($Articles_3)) { ?>
                <?php foreach ($Articles_3 as $item) { ?>
                    <article class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-all">
                    <img src="./img/<?= $item['article']['image'] ?>" alt="Travel" class="w-full h-48 object-cover">

                       
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2 text-gray-800">
                                <?= htmlspecialchars($item['article']['article_title']) ?>
                            </h3>
                            <p class="text-gray-600 mb-4">
                                <?= htmlspecialchars($item['article']['content']) ?>
                            </p>
                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <?php foreach ($item['tags'] as $tag) { ?>
                                    <span class="px-3 py-1 bg-<?= htmlspecialchars($tag['tag_color']) ?>-100 text-<?= htmlspecialchars($tag['tag_color']) ?>-800 rounded-full text-sm">#<?= htmlspecialchars($tag['tag_title']) ?></span>
                                <?php } ?>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    By <?= htmlspecialchars($item['article']['username'] ?? 'Unknown') ?>
                                </span>
                                <a href="./articlePage.php?article_id=<?= htmlspecialchars($item['article']['article_id']) ?>" class="text-[#003366] hover:text-[#002347] font-medium">Read More</a>
                            </div>
                        </div>
                    </article>
                <?php } ?>
            <?php } else { ?>
                <p class="text-gray-500 text-center">No articles found.</p>
            <?php } ?>
           
        </div>
    </div>

 
</section>

<section id="resultContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-24 py-16 hidden">

</section>



    <script>
        // Toggle article form
        function toggleForm() {
            const form = document.getElementById('articleForm');
            form.classList.toggle('hidden');
        }

        // Show/hide theme sections
        function showTheme(theme) {
            // Hide all sections
            document.querySelectorAll('.theme-section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Show selected theme
            document.getElementById(theme).classList.remove('hidden');
            
            // Update active button
            document.querySelectorAll('.theme-btn').forEach(btn => {
                btn.classList.remove('bg-[#003366]', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            });
            
            // Highlight active button
            event.currentTarget.classList.remove('bg-white', 'text-gray-700');
            event.currentTarget.classList.add('bg-[#003366]', 'text-white');
        }


        let mainContainer = document.getElementById('mainContainer');

        let resultContainer = document.getElementById('resultContainer');


        function resultDisplay(opiration, param) {
            const path = opiration === "filter"
                ? `./searchFilterDataArticle.php?tag_id=${param}`
                : `./searchFilterDataArticle.php?article_title=${param}`; 
            fetch(path)
                .then((response) => response.json())
                .then((articles) => {
                    console.log("API Response:", articles);
                    resultContainer.innerHTML = ""; 

                         if (articles.error) {
                             resultContainer.innerHTML = `
                                 <div class="text-gray-500 text-center py-4">
                                     <p>${data.error}</p>
                                 </div>
                             `;

                             resultContainer.classList.remove('hidden'); // Show the result container
                    mainContainer.classList.add('hidden');     // Hide the main container
                
                             return;
                        }

                    articles.forEach(articleData => {
                        const { article, tags } = articleData;
                        const tagsHTML = tags.map(tag => `
                            <span class="px-3 py-1 bg-${tag.tag_color}-100 text-${tag.tag_color}-800 rounded-full text-sm">#${tag.tag_title}</span>
                        `).join("");
                        resultContainer.innerHTML += `
                            <article class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-all">
                                <img src="./img/${article.image}" alt="Travel" class="w-full h-48 object-cover">

                                <div class="p-4">
                                    <h3 class="text-xl font-bold mb-2 text-gray-800">${article.article_title}</h3>
                                    <p class="text-gray-600 mb-4">${article.content || 'No description available...'}</p>
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        ${tagsHTML}
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">By ${article.username || 'Unknown'}</span>
                                        <a href="./articlePage.php?article_id=${article.article_id}" class="text-[#003366] hover:text-[#002347] font-medium">Read More</a>
                                    </div>
                                </div>
                            </article>
                        `;
                    });
        
                    resultContainer.classList.remove('hidden'); // Show the result container
                    mainContainer.classList.add('hidden');     // Hide the main container
                })
                .catch((error) => {

                    resultContainer.innerHTML = ""; 

                             resultContainer.innerHTML = `
                                <article class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-all">

                                 <div class="text-gray-600 text-center py-16">
                                     <p>No articles Found with this title ${param} </p>
                                 </div>
                                </article>

                             `;

                             resultContainer.classList.remove('hidden'); // Show the result container
                    mainContainer.classList.add('hidden');     // Hide the main container
                
                    console.error("Error fetching data:", error);
                    // Swal.fire({
                    //     icon: "error",
                    //     title: "Oops...",
                    //     text: "An error occurred.",
                    // });
                });
        }

        // Select the search input field
        const searchInput = document.getElementById("searchTitle");
        
        // Add an event listener for input changes
        searchInput.addEventListener("input", (event) => {
            const searchValue = event.target.value.trim(); // Get the input value and trim whitespace
        
            // Only call the function if there's a value to avoid unnecessary API calls
            if (searchValue) {
                resultDisplay('search' , searchValue );
            }else {
                resultContainer.classList.add('hidden'); // Show the result container
                mainContainer.classList.remove('hidden');  

            }
        });

        document.getElementById('tagFilter').addEventListener('change', function () {
            const selectedValue = this.value; // Get the selected value
            if (selectedValue) {
               
                resultDisplay('filter', selectedValue);
            } else {
                resultContainer.classList.add('hidden'); 
                mainContainer.classList.remove('hidden');  
                console.log('No tag selected');
            }
        });

        
        
    

    </script>
</body>
</html>