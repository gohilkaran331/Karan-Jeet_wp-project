<?php 
// database connection information and functions 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "wp"; 
 
$conn = new mysqli($servername, $username, $password, $dbname); 
 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 
function get_recipe_details($recipe_id) 
{ 
    global $conn; 
    $sql = "SELECT * FROM recipes WHERE id = $recipe_id"; 
    $result = $conn->query($sql); 
 
    $sql = "SELECT COUNT(*) as total FROM recipes"; 
    $result = mysqli_query($conn, $sql); 
    $rows=$result->fetch_assoc(); 
    $totalRows = $rows["total"]; 
 
    if ($result -> num_rows != FALSE) { 
        $recipe = $result->fetch_assoc(); 
        return $recipe; 
    } else { 
        return null; 
    } 
} 
 
// Get the recipe ID from the URL 
$recipe_id = isset($_GET['recipe_id']) ? intval($_GET['recipe_id']) : null; 
 
// Fetch the recipe details 
$recipe = get_recipe_details($recipe_id); 
 
// Display the recipe details 
if ($recipe) { 
    echo " 
    <!DOCTYPE html> 
    <html lang='en'> 
    <head> 
        <meta charset='UTF-8'> 
        <meta http-equiv='X-UA-Compatible' content='IE=edge'> 
       <meta name='viewport' content='width=device-width, initial-scale=1.0'> 
        <link rel='shortcut icon' href='../flavour-fusion-logo.png' type='image/x-icon'> 
        <link rel='stylesheet' href='../css/hca_style.css'> 
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'> 
        <title>Flavour Fusion - Recipe Details</title> 
    </head> 
    <body> 
        <div class='header'> 
            <!-- Navigation Bar --> 
            <!-- ... --> 
        </div> 
 
        <div class='meal-detail'> 
            <!-- recipe close btn --> 
            <button type='button' class='btn recipe-close-btn' id='recipe-close-btn' onclick='closeBtn()'> 
                <i class='fas fa-times'></i> 
            </button> 
 
            <!-- recipe details --> 
            <div class='meal-content'> 
                <h2 class='meal-name'>" . htmlspecialchars($recipe['name']) . "</h2> 
                <div class='meal-about'> 
                    <h3 class='meal-title-about'>About Meal</h3> 
                    <p class='meal-descript-about'>" . htmlspecialchars($recipe['description']) . "</p> 
                </div> 
                <div class='meal-instruct'> 
                    <h3>Ingridients:</h3> 
                    <p>" . htmlspecialchars(str_replace("\n", "<br>", $recipe['ingredients'])) . "</p> 
                    <h3>Instruction:</h3> 
                    <p>" . htmlspecialchars(str_replace("\n", "<br>", $recipe['instructions'])) . "</p> 
                </div> 
                <div class='meal-img'> 
                    <img src='../img/" . htmlspecialchars($recipe['image']) . "' alt=''> 
                </div></div> 
        </div> 
 
        <!--Footer--> 
        <div class='footer'> 
            <!-- ... --> 
        </div> 
 
        <!--Ending of Footer--> 
 
        <!--Script for Javascript--> 
        <script src='../js/index.js'></script> 
    </body> 
    </html> 
    "; 
} else { 
    echo "Recipe not found."; 
} 
 
$conn->close(); 
?>