<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/RecipeLogo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="../css/hca_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Express Eat</title>
    <script></script>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="header">
        <nav class="nav-bar">
            <img src="../img/Logo.png" class="brand-name">
            <a href="#" class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
            <div class="menu-bar">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="../insert_recipe.html">Modify</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </nav>
        <!-- Search Bar -->
        <br>
        <div class="title" style="margin-bottom: -20px;">Find a Recipe</div>
        <div class="search-wrapper">
            <div class="fa fa-search"></div>
            <input type="text" name=""  id="search" placeholder="What do you want to eat?" onkeyup="searchRecipe(this.value)">
            <div class="fa fa-times" onclick="clearInput()" ></div>
        </div>
    </div>

    <!-- Search Results -->
    <div class="result" style="height: fit-content;">
        <br>
    </div>

    <!-- Main Content -->
    <div class="card-grid" >
        <div class="food-list" id="food-list">
        <?php
        // Database connection code here
        $conn = mysqli_connect("localhost", "root", "", "wp");
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = " SELECT * FROM recipes WHERE dishName LIKE '%$searchTerm%' ORDER BY recipe_id DESC ";
        $result = mysqli_query($conn, $sql);
        while($rows=$result->fetch_assoc()){
            print('<div class="card card-shadow">');
                print('<div class="card-header card-image">');
                print("<img src='../img/" . $rows['file1'] . "' alt='Recipe Image'>");
                print('</div>');
                print('<div class="card-body" >');
                print('<h3>' . $rows['dishName'] . '</h3>');
print('</div>');
                print('<div class="card-footer">');
                print('<button class="btn" onclick="getRecipe01(' . $rows['recipe_id'] . ')">Get Recipe</button>');
                print('</div>');
            print("</div>");
        }
        // Close database connection
        mysqli_close($conn);
        ?>
        </div> 

    </div>

    <!-- Recipe Details Container -->
    <div class="recipe-details" id="recipe-details">
        <!-- Recipe Details -->
    </div>

    <!--Footer-->
    <div class="footer">
        <div class="social-btn">
            <a href="https://www.facebook.com/Cmedsss" target="_blank" ><i class="	fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/tiaanmeds/" target="_blank" ><i class="	fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com/in/tianmeds/" target="_blank"><i class="	fab fa-linkedin"></i></a>
            <a href="https://github.com/TianMeds" target="_blank" "><i class="	fab fa-github"></i></a>
        </div>
        <div class="quick-bar">
            <a href="home.html">Home</a>
            <a href="/insert_recipe.html">Modify</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
        </div>
        <p>Copyright &copy; 2022 Christian Medallada. All right reserved</p>  
    </div>

    <!--Ending of Footer-->

<!--Script for Javascript-->
<script src="../js/index.js"></script>
<script>
function isUserLoggedIn(){
    const isLoggedIn = checkLoginStatus();

    // If the user is not logged in, redirect to login.html
    if (!isLoggedIn) {
        document.getElementById("loginButton").addEventListener("click", function() {
            window.location.href = "login.html";
        });
    }
    else{ window.location.href = "login.html";}
}
function checkLoginStatus() {
    // Check if the user has a valid session token
    const sessionToken = localStorage.getItem("sessionToken");
    if (!sessionToken) {
        return false;
    }

    // Check if the session token is still valid
    const response = fetch("/api/validate-token", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${sessionToken}`
        }
    });

    if (!response.ok) {
        return false;
    }

    return true;
}

function searchRecipe(searchTerm) {
  const recipes = document.querySelectorAll('.card');
  recipes.forEach((recipe) => {
    const title = recipe.querySelector('h3').textContent.toLowerCase();
    if (title.includes(searchTerm.toLowerCase())) {
      recipe.style.display = 'block';
    } else {
      recipe.style.display = 'none';
    }
  });
}

function getRecipe01(recipeId) {
  // Make an AJAX request to fetch the recipe details
  fetch(`recipe-details.php?recipe_id=${recipeId}`)
    .then((response) => response.json())
    .then((data) => {
      // Display the recipe details
      const recipeDetails = document.querySelector('#recipe-details');
      recipeDetails.innerHTML = `
        <h2>${data.dishName}</h2>
        <img src="../img/${data.file1}" alt="${data.dishName}">
        <p>Ingredients: ${data.ingredients}</p>
        <p>Instructions: ${data.instructions}</p>
      `;
    });
}
</script>
</body>
</html>