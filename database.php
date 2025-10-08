<?php
// database.php - Complete Auto-setup with proper cleanup
$servername = "localhost";
$username = "root";
$password = "";
$database = "foodies";

// First, connect without selecting database to create it if needed
$con_temp = mysqli_connect($servername, $username, $password);

if (!$con_temp) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$create_db = "CREATE DATABASE IF NOT EXISTS $database";
mysqli_query($con_temp, $create_db);

// Close temporary connection
mysqli_close($con_temp);

// Now connect to the specific database
$con = mysqli_connect($servername, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if setup is needed by checking if both tables exist and have data
$check_users = "SHOW TABLES LIKE 'users'";
$check_food = "SHOW TABLES LIKE 'food_items'";
$users_exist = mysqli_query($con, $check_users);
$food_exist = mysqli_query($con, $check_food);

// Only run setup if BOTH tables don't exist OR are empty
if (mysqli_num_rows($users_exist) == 0 || mysqli_num_rows($food_exist) == 0) {
    
    // Drop existing tables to avoid conflicts
    mysqli_query($con, "DROP TABLE IF EXISTS users");
    mysqli_query($con, "DROP TABLE IF EXISTS food_items");
    
    // Create users table
    $users_table = "CREATE TABLE users (
        Name VARCHAR(100) NOT NULL,
        Password VARCHAR(255) NOT NULL,
        Mobile_no VARCHAR(15) NOT NULL,
        Email_id VARCHAR(255) NOT NULL,
        PRIMARY KEY (Name)
    ) ENGINE=InnoDB";
    
    mysqli_query($con, $users_table);

    // Create food_items table
    $food_items_table = "CREATE TABLE food_items (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(255) NOT NULL,
        Price DECIMAL(10,2) NOT NULL,
        Image VARCHAR(500) NOT NULL
    ) ENGINE=InnoDB";
    
    mysqli_query($con, $food_items_table);

    // Insert default test users
    $default_user = "INSERT INTO users (Name, Password, Mobile_no, Email_id) VALUES 
    ('admin', 'admin123', '9999999999', 'admin@foodies.com'),
    ('testuser', 'test123', '1234567890', 'test@foodies.com')";
    
    mysqli_query($con, $default_user);

    // Insert all 57 food items
    $food_items_sql = "INSERT INTO food_items (Id, Name, Image, Price) VALUES
    (1, 'NOODLES', './Images/noodles.jpg', 100),
    (2, 'SPRING ROLLS', './Images/Spring-Rolls.jpg', 120),
    (3, 'MANCHURIAN', './Images/manchurian.jpg', 120),
    (4, 'CHINESE BHEL', './Images/chinese_bhel.avif', 130),
    (5, 'PIZZA', './Images/pizza.jpg', 149),
    (6, 'PASTA', './Images/pasta.jpg', 120),
    (7, 'GARLIC BREAD', './Images/garlic-bread.webp', 120),
    (8, 'TACOS', './Images/tacos.jpg', 140),
    (9, 'NACHOS', './Images/nachos.jpg', 70),
    (10, 'BURRITO', './Images/burrito.jpeg', 150),
    (11, 'SANDWICH', './Images/sandwhich.avif', 100),
    (12, 'MAGGIE', './Images/maggie.jpg', 80),
    (13, 'CHILLI GARLIC MAGGIE', './Images/chili-garlic-maggie.jpg', 100),
    (14, 'PAV BHAJI', './Images/pav_bhaji.jpg', 100),
    (15, 'VADA PAV', './Images/vada_pav.jpeg', 60),
    (16, 'DABELI', './Images/dabeli.jpg', 60),
    (17, 'GUJARATI THALI', './Images/gujurati_thali.jpg', 120),
    (18, 'PANEER BUTTER MASALA', './Images/paneer-butter-masala.webp', 200),
    (19, 'PANEER LABABDAR', './Images/paneer-lababdar.jpg', 220),
    (20, 'PANEER TIKKA MASALA', './Images/paneer-tikka-masala.webp', 230),
    (21, 'KADAI PANEER', './Images/Kadai-Paneer.jpg', 210),
    (22, 'VEG KADAI', './Images/Veg-kadai.jpg', 220),
    (23, 'CHOLE BHATURE', './Images/chole-bhature.jpg', 100),
    (24, 'DAL FRY', './Images/Dal-Fry.jpg', 150),
    (25, 'DAL TADKA', './Images/Dal-Tadka.jpg', 140),
    (26, 'JEERA RICE', './Images/jeera-rice.jpg', 120),
    (27, 'VEG BIRYANI', './Images/VegBiryani.webp', 250),
    (28, 'NAAN', './Images/Naan-Bread.jpg', 40),
    (29, 'BUTTER ROTI', './Images/butter-roti.jpeg', 20),
    (30, 'TANDOORI ROTI', './Images/Tandoori-roti.jpg', 30),
    (31, 'STEAMED MOMOS', './Images/steamed-momos.jpg', 100),
    (32, 'FRIED MOMOS', './Images/Fried-Momos.jpg', 120),
    (33, 'TANDOORI MOMOS', './Images/Tandoori-Momos.jpg', 130),
    (34, 'CHEESE CORN MOMOS', './Images/cheese-corn-momos.jpg', 150),
    (35, 'KURKURE MOMOS', './Images/kurkure-momos.webp', 180),
    (36, 'GULAB JAMUN', './Images/gulab-jamun.jpg', 60),
    (37, 'GAJAR HALWA', './Images/gajar-halwa.jpg', 100),
    (38, 'SHRIKHAND', './Images/shri-khand.webp', 90),
    (39, 'RASGULLA', './Images/Rasgulla.jpg', 100),
    (40, 'MANGO DELIGHT', './Images/mango-delight.jpeg', 70),
    (41, 'CHHAAS', './Images/chaas.jpg', 30),
    (42, 'MASALA CHHAAS', './Images/masala-chass.webp', 40),
    (43, 'SWEET LASSI', './Images/sweet-lassi.jpg', 70),
    (44, 'COCA COLA', './Images/coca-cola.jpg', 30),
    (45, 'THUMSUP', './Images/thumbs-up.jpg', 30),
    (46, 'SPRITE', './Images/sprite.jpg', 30),
    (47, 'GREEN APPLE MOJITO', './Images/Green-Apple-Mojito.png', 160),
    (48, 'BLUE BERRY MOJITO', './Images/blue-berry-mojito.jpg', 170),
    (49, 'STRAWBERRY BASIL MOJITO', './Images/strawberry-mojito.jpg', 160),
    (50, 'WATERMELON MINT MOJITO', './Images/Watermelon-Mocktail.webp', 170),
    (51, 'CHOCO LAVA CAKE', './Images/choco_lava.webp', 120),
    (52, 'BROWNIE WITH ICE CREAM', './Images/brownie-with-ice-cream.jpg', 100),
    (53, 'CHOCOLATE ICE CREAM', './Images/chocolate-ice-cream.png', 100),
    (54, 'VANILLA ICE CREAM', './Images/vanila-ice-cream.webp', 80),
    (55, 'CHEESE CAKE', './Images/cheese-cake.jpeg', 200),
    (56, 'DARK CHOCOLATE WAFFLE', './Images/dark-chocolate-waffel.avif', 270),
    (57, 'BUBBLE WAFFLE', './Images/Bubble-Waffles.jpg', 300)";
    
    mysqli_query($con, $food_items_sql);

    // Create setup completion flag
    file_put_contents('auto_setup_complete.txt', 'Auto-setup completed on ' . date('Y-m-d H:i:s') . "\nDatabase: foodies\nTables: users, food_items\nFood Items: 57\nDefault Users: admin/admin123, testuser/test123");
}

// Set charset for proper encoding
mysqli_set_charset($con, "utf8");
?>
