<?php

session_start();
if (isset($_SESSION["user"])) {
       $user=$_SESSION["user"];
       $user_id=$_SESSION["user"]["id"];

      //  var_dump($user);
       
   }else {
      //  header("Location:./authen.php");
   }

$article_id = $_GET['article_id'];
// $article_id = 1;




require_once '../Model/tag.php';
require_once '../Model/theme.php';
require_once '../Model/Article.php';
require_once '../Model/Favorit.php';

$article =new Article();
$article = $article->getElementById($article_id);
$tag = new Tag();
$tags = $tag->readAllById($article_id);
$favorit =new Favorit();
$is_favorit = $favorit->getFavoritById($article_id ,$user_id);

// if (empty($is_favorit)) {
//   echo "this article is not favorete .";
// } else {
//   echo "this article is favirit: ";
//   print_r($is_favorit);
// }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Read More - Article</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Header Section -->
<header class="bg-[#003A66] text-white py-4 px-6 flex justify-between items-center">
  <h1 class="text-2xl font-bold">Blog</h1>
  
  <!-- Navigation Links -->
  <nav class="flex gap-6 items-center">
    <a href="/" class="text-white hover:text-gray-200">Home</a>
    <div class="relative">
      <button class="text-white hover:text-gray-200">Categories</button>
      <div class="absolute top-6 left-0 hidden bg-white shadow-md rounded-md w-48 mt-2 text-black">
        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Tech</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Development</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Programming</a>
      </div>
    </div>
    <a href="/contact" class="text-white hover:text-gray-200">Contact</a>

    <!-- Search Button -->
    <button class="bg-[#E02454] text-white px-4 py-2 rounded-md hover:bg-[#E02454]">Search</button>

    <!-- User Account / Login - Conditionally displayed -->
    <div class="flex gap-4 items-center">
      <!-- Conditionally show Login or User Profile -->
      <a href="/login" class="text-white hover:text-gray-200">Login</a>
      <!-- If the user is logged in, show user avatar or profile link -->
      <a href="/profile" class="text-white hover:text-gray-200">Profile</a>
    </div>
  </nav>
</header>




  <!-- Article Section -->
  <section class="py-6 px-6 max-w-3xl mx-auto">
    <!-- Article Content -->
    <div class="bg-white shadow-lg rounded-md p-6">
      <img src="./img/<?= $article['image'] ?>" alt="Article Image" class="w-full h-60 object-cover rounded-md mb-4">
      <h2 class="text-3xl font-semibold mb-4"><?= $article['article_title'] ?></h2>
      <p class="text-lg text-gray-700 mb-4"><?= $article['content'] ?>.</p>
      <p class="text-lg text-gray-700">Duis malesuada dui non justo vehicula, ac tincidunt nunc dapibus. Integer sit amet lectus ut ipsum lobortis posuere. Sed volutpat vel libero et sollicitudin. Curabitur vitae tortor erat. Integer at scelerisque magna. Nulla condimentum metus ac velit cursus, sed consequat felis laoreet.</p>
    </div>

<!-- Tags Section -->
<section class="mt-8">
  <h3 class="text-2xl font-semibold mb-4">Tags</h3>
  <div class="flex flex-wrap gap-3">
  <?php foreach ($tags as $tag): ?>
        <span class="inline-block rounded-md px-2 py-1 bg-<?= htmlspecialchars($tag['tag_color']) ?>-100 ">#<?= htmlspecialchars($tag['tag_title']) ?></span>
  <?php endforeach; ?> 
   
  </div>
</section>




    <!-- Add to Favorites Button -->
    <?php if (empty($is_favorit)) { ?>
    <button class="group relative mt-6 bg-white border-2 border-amber-400 px-6 py-2 rounded-full transition-all duration-300 hover:bg-amber-50">
        <span class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-amber-400 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            <a href="../Controller/addToFavorits.php?id=<?= $article_id ?>">
            <span class="font-medium text-gray-700">Add to Favorites</span>

            </a>
        </span>
    </button>
<?php } else { ?>
    <div class="mt-6 flex items-center space-x-2 text-green-600">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span class="font-medium">Added to Favorites</span>
    </div>
<?php } ?>
   

    <!-- Comments Section -->
    <div class="mt-6">
      <h3 class="text-2xl font-semibold mb-4">Comments</h3>
      <div id="commentsList" class="space-y-4">
        <!-- Mock Comment 1 -->
        <div class="bg-white p-4 rounded-md shadow">
          <p><strong>John Doe</strong> <span class="text-sm text-gray-500">- 2 days ago</span></p>
          <p class="mt-2 text-gray-700">This is a great article! I loved reading about the tips and tricks shared here.</p>
        </div>
        <!-- Mock Comment 2 -->
        <div class="bg-white p-4 rounded-md shadow">
          <p><strong>Jane Smith</strong> <span class="text-sm text-gray-500">- 3 days ago</span></p>
          <p class="mt-2 text-gray-700">Really helpful information. Thanks for sharing your insights!</p>
        </div>
      </div>

      <!-- Add New Comment -->
      <div class="mt-6">
        <h4 class="text-xl font-semibold mb-4">Leave a Comment</h4>
        <textarea id="commentInput" class="w-full p-4 border rounded-md text-gray-700 mb-4" placeholder="Write your comment here..." rows="4"></textarea>
        <button id="submitCommentButton" class="bg-[#003A66] text-white px-6 py-2 rounded-md">Submit Comment</button>
      </div>
    </div>


 <!-- Modal for Updating Comments -->
<div id="updateCommentModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
  <div class="relative bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
    <!-- Form Heading -->
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Update Comment</h2>
      <!-- Close Button Inside the Form -->
      <button onclick="closeModal()" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Form Content -->
    <form id="updateCommentForm" method ="POST" action="../Controller/updateComment.php">
      <!-- Hidden Input for Comment ID -->
      <input type="hidden" id="commentIdInput" name="commentId">

      <!-- Textarea for Editing Comment -->
      <div class="mb-4">
        <label for="commentText" class="block text-sm font-medium text-gray-700">Comment</label>
        <textarea id="commentText" name="commentText" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"></textarea>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button type="submit" class="bg-[#003A66] text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>
   

    
  </section>

</body>

<script>
  const articleId = <?= json_encode($article_id) ?>;
  const userId = <?= json_encode($user_id) ?>;



function displayComments() {
    fetch(`getComments.php?id=${articleId}`) // Adjust the path to your PHP file for fetching comments
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          const commentsList = document.getElementById('commentsList');
          commentsList.innerHTML = ''; 

          data.comments.forEach((comment) => {
            const commentDate = new Date(comment.created_at); // Convert the created_at string to a Date object
            const formattedDate = commentDate.toLocaleDateString("fr-FR"); // Format the date (change locale if needed)

            // Create a new comment element
            const commentDiv = document.createElement('div');
            // commentDiv.classList.add('bg-white', 'p-4', 'rounded-md', 'shadow');
            commentDiv.classList.add('bg-white', 'p-3', 'rounded-lg', 'shadow-md', 'mb-4', 'border', 'border-gray-200', 'hover:shadow-xl', 'relative');


            // Add the comment content
            commentDiv.innerHTML = `
              <p><strong>${comment.username}</strong> <span class="text-sm text-gray-500">- ${formattedDate}</span></p>
              <p class="mt-2 text-gray-700"  id="comment-${comment.comment_id}"  >${comment.comment}</p>
            `;
         
          
            if (comment.user_id === userId) {
              commentDiv.innerHTML += `
                    <div class="absolute top-2 right-2 flex space-x-2">
                  <!-- Update Button with Icon -->
                  <button class="bg-black text-white px-4 py-2 rounded-full hover:bg-green-800 focus:outline-none transition duration-200" onclick="updateCommentForm(${comment.comment_id})">
                    <i class="fas fa-edit"></i>
                  </button>

                  <!-- Delete Button with Icon -->
                  <button class="bg-black text-white px-4 py-2 rounded-full hover:bg-red-800 focus:outline-none transition duration-200" onclick="confirmDelete(${comment.comment_id})">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
               
              `;
            }

            
            

            // Append the new comment to the list
            commentsList.appendChild(commentDiv);
          });
        } else {
          console.error('Failed to fetch comments.');
        }
      })
      .catch((error) => {
        console.error('Error:', error);
      });
}

  // Initial load of comments when the page loads
  window.onload = displayComments;


  const comment = document.getElementById('commentInput').value.trim();
  console.log('Comment:', comment);
  document.getElementById('submitCommentButton').addEventListener('click', function () {
  const comment = document.getElementById('commentInput').value.trim();
  console.log('Comment:', comment);


  // Validate the input
  if (!comment) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please write a comment before submitting.",
    });
    return;
  }

  // Send the comment to the server
  fetch(`../Controller/addComment.php?id=${articleId}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ comment: comment }), 
  })
    .then((response) => response.json()) 
    .then((data) => {
      if (data.success) {

        Swal.fire({
          icon: "success",
          title: "Oops...",
          text: "Comment submitted successfully!",
          showConfirmButton: false,
          timer: 1500
        });



        document.getElementById('commentInput').value = ''; // Clear the textarea
        displayComments();
      } else {

        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Failed to submit the comment.",
        });
        // alert('Failed to submit the comment.');
      }
    })
    .catch((error) => {
      console.error('Error:', error);
      Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "An error occurred while submitting the comment.",
        });
      // alert('An error occurred while submitting the comment.');
    });
});


function closeModal() {
  document.getElementById('updateCommentModal').classList.add('hidden');
}

function updateCommentForm(commentId) {
  // Get the modal and inputs
  const modal = document.getElementById('updateCommentModal');
  const commentIdInput = document.getElementById('commentIdInput');
  const commentText = document.getElementById('commentText');

  // Populate the form fields
  commentIdInput.value = commentId;
  const existingComment = document.querySelector(`#comment-${commentId}`).textContent.trim();
  commentText.value = existingComment;

  // Show the modal
  modal.classList.remove('hidden');
}

function deleteComment(commentId){


}


function deleteComment(commentId) {
  
  // Send the comment to the server
  fetch(`../Controller/deleteComment.php?id=${commentId}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    } 
  })
    .then((response) => response.json()) 
    .then((data) => {
      if (data.success) {

        Swal.fire({
          icon: "success",
          title: "Oops...",
          text: "Comment deleted successfully!",
          showConfirmButton: false,
          timer: 1500
        });

        document.getElementById('commentInput').value = ''; // Clear the textarea
        displayComments();
      } else {

        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Failed to delete the comment.",
        });
        // alert('Failed to submit the comment.');
      }
    })
    .catch((error) => {
      console.error('Error:', error);
      Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "An error occurred while deleting the comment.",
        });
      // alert('An error occurred while submitting the comment.');
    });
}


function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#E02454',
        cancelButtonColor: '#003A66',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, go back'
    }).then((result) => {
        if (result.isConfirmed) {
          deleteComment(id);
        }
    });
}



</script>
</html>
