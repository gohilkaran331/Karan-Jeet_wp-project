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
</head>
<body>

    <!--- Navigation Bar -->
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
            <input type="text" name=""  id="search" placeholder="What do you want to eat?" onkeyup="searchRecipe()">
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
                    //<p id="none" style="display: none;">Sorry, the food you were looking for was not available.</p>
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = " SELECT * FROM recipes WHERE dishName LIKE '%$searchTerm%' ORDER BY recipe_id DESC ";
            $result = mysqli_query($conn, $sql);
            while($rows=$result->fetch_assoc()){
                print('<div class="card card-shadow">');
                    print('<div class="card-header card-image">');
                    print("<img src='../img/" . $rows['file1'] . "' alt='Recipe Image'>");
                    print('</div>');
                    print('<div class="card-body" >');
                    print('<h2>' . $rows['dishName'] . '</h2>');
                    print('</div>');
                    print('<div class="card-footer">');
                    print('<button class="btn" onclick="get5thRecipe(' . $rows['recipe_id'] . ')">Get Recipe</button>');
                    print('</div>');
                print("</div>");
            }
	
	// Close database connection
	mysqli_close($conn);
	?>
                    <div class="card card-shadow">
                        <div class="card-header card-image">
                            <img src="../img/Sisig.webp">
                        </div>
                        <div class="card-body" >
                        <h3> Sisig </h3>
                        </div>
                        <div class="card-footer">
                            <button class="btn" onclick="getRecipeDetails()">Get Recipe</button>
                        </div>
                    </div>
                    <div class="card card-shadow">
                        <div class="card-header card-image">
                            <img src="../img/Adobo.webp">
                        </div>
                        <div class="card-body" >
                        <h3> Adobo </h3>
                        </div>
                        <div class="card-footer">
                            <button class="btn" onclick="get2ndRecipe()">Get Recipe</button>
                        </div>
                    </div>
                    <div class="card card-shadow">
                        <div class="card-header card-image">
                            <img src="../img/Porkchop.webp">
                        </div>
                        <div class="card-body">
                            <h3>Sizzling Porkchop</h3>
                        </div>
                        <div class="card-footer">
                            <button class="btn" onclick="get3rdRecipe()">Get Recipe</button>
                        </div>
                    </div>
                    <div class="card card-shadow">
                        <div class="card-header card-image">
                            <img src="../img/Omelette.webp">
                        </div>
                        <div class="card-body" >
                            <h3>Omelette</h3>
                        </div>
                        <div class="card-footer">
                            <button class="btn" onclick="get4thRecipe()">Get Recipe</button>
                        </div>
                    </div>
                    <div class="card card-shadow">
                        <div class="card-header card-image">
                            <img style="max-height: 200px; object-position: center;" src="../img/red_dish.jpg">
                        </div>
                        <div class="card-body" >
                        <h3> Add new Recipe </h3>
                        </div>
                        <div class="card-footer">
                            <button class="btn" id="loginButton" onclick="isUserLoggedIn()">Add Recipe</button>
                        </div>
                    </div>
                    
            </div> 

            <!--Ending of Main Content-->

            <!--Recipe Details-->
             
            //Add Recipe
            <div class = "five-meal-detail" id="five-meal-detail">
                //<!-- recipe close btn -->
                <button type = "button" class = "btn recipe-close-btn" id = "recipe-close-btn" onclick="closeBtn()">
                    <i class ="fas fa-times"></i>
                </button>
                <?php
                // Database connection code here
	            $conn = mysqli_connect("localhost", "root", "", "wp");
                $sql = "SELECT COUNT(*) as total FROM recipes";
                $result = mysqli_query($conn, $sql);
                $rows=$result->fetch_assoc();
                $totalRows = $rows["total"];
                for ($i = 1; $i <= $totalRows; $i++) {
                    // Fetch the row data
                    $sql = "SELECT * FROM recipes WHERE recipe_id=$i";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                //$sql = " SELECT * FROM recipes";
                //<!-- recipe details -->
                if ($row) {
                    //echo "<table><tr><th>Column1</th><th>Column2</th></tr>";
                    //for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                    //$row = mysqli_fetch_assoc($result);
                    //}
                    
                print('<div class="meal-content">');
                    print( '<h2 class="meal-name">' . $row['recipe_id'] . '</h2>');
                    print( '<h2 class="meal-name">' . $row['dishName'] . '</h2>');
                    print('<div class = "meal-instruct">');
                        print('<h3>"Ingridients:"</h3>');
                        print('<p>' . $row['ingredients'] . '</p>');
                        print('<h3>"instructions:"</h3>');
                        print('<p>' . $row['instructions'] . '</p>');
                
                    print('</div>');
                    print('<div class = "meal-img">');
                        print("<img src='../img/" . $row['file1'] . "' alt='Recipe Image'>");
                      print('</div>');
                print('</div>');
                
                break;
                }
                }
	
	            // Close database connection
	            mysqli_close($conn);
                ?>
            </div>
        </div>
            <!--Ending of Recipe Details-->

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
</script>
</body>
</html>
