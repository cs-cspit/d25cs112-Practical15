<?php
	session_start(); // Start the session to access session variables

	require("food_items.php");
	require("menu.php");

	// Check if user is logged in
	if (!isset($_SESSION['username'])) {
		// Redirect user to login page if not logged in
		header("Location: login.php");
		exit(); // Stop further execution
	}

	// Retrieve user information from session variables
	$r1 = $_SESSION['username'];
	$r2 = $_SESSION['mobile'];
	$r3 = $_SESSION['email'];

	if (isset($_POST['add'])){
		/// print_r($_POST['product_id']);
		if(isset($_SESSION['cart'])){
	
			$item_array_id = array_column($_SESSION['cart'], "product_id");
	
			if(in_array($_POST['product_id'], $item_array_id)){
				echo "<script>alert('Product is already added in the cart..!')</script>";
				echo "<script>window.location = 'index.php'</script>";
			}else{
	
				$count = count($_SESSION['cart']);
				$item_array = array(
					'product_id' => $_POST['product_id']
				);
	
				$_SESSION['cart'][$count] = $item_array;
			}
	
		}else{
	
			$item_array = array(
					'product_id' => $_POST['product_id']
			);
	
			// Create new session variable
			$_SESSION['cart'][0] = $item_array;
			print_r($_SESSION['cart']);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Foodies</title>
	<link rel="stylesheet" href="bootstrap-5.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<style>
		.imgeffect:hover
		{
    		transform: scale(0.9);
		}
		.imgeffect
		{
			transition: transform .5s;
		}
		#btneffect:hover
		{
   			transform: scale(1.1);
		}
		#btneffect
		{
   			transition: transform .5s;	
		}
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family:Arial;	
}
.modal-body h3 {
            padding: 20px;
            text-transform: none; /* Ensure normal text casing */
        }
#feedback{
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: #dacccc;
}
.wrapper{
  background: #f6f6f6;
  max-width: 360px;
  width: 100%;
  border-radius: 10px;
  box-shadow: 0px 10px 15px rgba(0,0,0,0.1);
}
.wrapper .content{
  padding: 30px;
  display: flex;
  align-items: center;
  flex-direction: column;
}
.wrapper .outer{
  height: 135px;
  width: 135px;
  overflow: hidden;
}
.outer .emojis{
  height: 500%;
  display: flex;
  flex-direction: column;
}
.outer .emojis li{
  height: 20%;
  width: 100%;
  list-style: none;
  transition: all 0.3s ease;
}
.outer li img{
  height: 100%;
  width: 100%;
}
#star-2:checked ~ .content .emojis .slideImg{
  margin-top: -135px;
}
#star-3:checked ~ .content .emojis .slideImg{
  margin-top: -270px;
}
#star-4:checked ~ .content .emojis .slideImg{
  margin-top: -405px;
}
#star-5:checked ~ .content .emojis .slideImg{
  margin-top: -540px;
}
.wrapper .stars{
  margin-top: 30px;
}
.stars label{
  font-size: 30px;
  margin: 0 3px;
  color: #ccc;
}
#star-1:hover ~ .content .stars .star-1,
#star-1:checked ~ .content .stars .star-1,

#star-2:hover ~ .content .stars .star-1,
#star-2:hover ~ .content .stars .star-2,
#star-2:checked ~ .content .stars .star-1,
#star-2:checked ~ .content .stars .star-2,

#star-3:hover ~ .content .stars .star-1,
#star-3:hover ~ .content .stars .star-2,
#star-3:hover ~ .content .stars .star-3,
#star-3:checked ~ .content .stars .star-1,
#star-3:checked ~ .content .stars .star-2,
#star-3:checked ~ .content .stars .star-3,

#star-4:hover ~ .content .stars .star-1,
#star-4:hover ~ .content .stars .star-2,
#star-4:hover ~ .content .stars .star-3,
#star-4:hover ~ .content .stars .star-4,
#star-4:checked ~ .content .stars .star-1,
#star-4:checked ~ .content .stars .star-2,
#star-4:checked ~ .content .stars .star-3,
#star-4:checked ~ .content .stars .star-4,

#star-5:hover ~ .content .stars .star-1,
#star-5:hover ~ .content .stars .star-2,
#star-5:hover ~ .content .stars .star-3,
#star-5:hover ~ .content .stars .star-4,
#star-5:hover ~ .content .stars .star-5,
#star-5:checked ~ .content .stars .star-1,
#star-5:checked ~ .content .stars .star-2,
#star-5:checked ~ .content .stars .star-3,
#star-5:checked ~ .content .stars .star-4,
#star-5:checked ~ .content .stars .star-5{
  color: #fd4;
}
.wrapper .footer{
  border-top: 1px solid #ccc;
  background: #f2f2f2;
  width: 100%;
  height: 55px;
  padding: 0 20px;
  border-radius: 0 0 10px 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.footer span{
  font-size: 17px;
  font-weight: 400;
}
.footer .text::before{
  content: "Rate your experience";
}
.footer .numb::before{
  content: "0 out of 5";
}
#star-1:checked ~ .footer .text::before{
  content: "I just hate it";
}
#star-1:checked ~ .footer .numb::before{
  content: "1 out of 5";
}
#star-2:checked ~ .footer .text::before{
  content: "I don't like it";
}
#star-2:checked ~ .footer .numb::before{
  content: "2 out of 5";
}
#star-3:checked ~ .footer .text::before{
  content: "This is awesome";
}
#star-3:checked ~ .footer .numb::before{
  content: "3 out of 5";
}
#star-4:checked ~ .footer .text::before{
  content: "I just like it";
}
#star-4:checked ~ .footer .numb::before{
  content: "4 out of 5";
}
#star-5:checked ~ .footer .text::before{
  content: "I just love it";
}
#star-5:checked ~ .footer .numb::before{
  content: "5 out of 5";
}
input[type="radio"]{
  display: none;
}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-sm fixed-top" id="navigtn">
	<div class="container">
		<a class="navbar-brand" href="#home" style="color: white; font-family:'Brush Script';">Foodies 
			<img src="Images\logo_1-transformed.png" alt="logo" class="logo">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" style="filter: invert(1);">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="mynavbar">
			<ul class="navbar-nav ms-auto">
				<li class="nav-item">
					<a class="nav-link" href="#home">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#menu">Menu</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#aboutus">About Us</a>
				</li>
				<li class="nav-item">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target = "#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            			<span class="navbar-toggler-icon"></span>
        			</button>
        			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            			<div class="navbar-nav">
                			<a href="cart.php" class="nav-item nav-link text-white active">
                    			<h5 class="px-5 cart">
                        			<i class="fas fa-shopping-cart"></i> Cart
                        			<?php
                        				if (isset($_SESSION['cart']))
										{
                            				$count = count($_SESSION['cart']);
                            				echo "<span id=\"cart_count\" class=\"text-white\">$count</span>";
                        				}
										else
										{
                            				echo "<span id=\"cart_count\" class=\"text-white\">0</span>";
                        				}
                        			?>
                    			</h5>
                			</a>
            			</div>
        			</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#profile" data-bs-toggle="modal"><i class="fa-regular fa-user"></i></a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<section id="home" class="bg-image"></section>

<section class="container">
	<div class="modal fade" id="profile">
		<div class="modal-dialog">
			<div class="modal-content" style="background-color:rgba(0,0,0,0.6);">
				<div class="modal-header">
					<h3 style="text-align:center;padding-left:180px; color:white;">Profile</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal"  style="filter:invert(1);"></button>
				</div>
				<div class="modal-body" style="color:white;">
				<h3 style="padding: 20px;"><i class="fas fa-user"></i> : <?php echo $r1 ?></h3>
				<h3 style="padding: 20px;"><i class="fas fa-phone"></i> : <?php echo $r2 ?></h3>
				<h3 style="padding: 20px;"><i class="fas fa-envelope"></i> : <?php echo $r3 ?></h3>
					<button class="btn" onclick="location.href='logout.php';">Logout</button>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="aboutus">
	<center><h1 id="section">About Us</h1></center>
	<div id="about_row">
		<div class="about_col">
			<p>
				Welcome to Foodies, where passion for food meets exceptional dining experience.
				At The Foodies Restaurant, we believe that food is not just about sustenance; it's an experience, a journey that tantalizes the taste buds, ignites the senses, and brings people together. Our story began 64 years ago with a simple yet profound idea: to create a culinary haven where exquisite flavors, impeccable service, and a warm ambiance converge to create unforgettable memories . At the heart of our philosophy is a commitment to excellence in everything we do. From sourcing the finest ingredients to crafting each dish with precision and care, we spare no effort in ensuring that every meal is a masterpiece . Behind every great meal is a team of passionate individuals dedicated to their craft. Our chefs are culinary virtuosos, constantly pushing the boundaries of flavor and creativity. Our staff is more than just service professionals; they are your hosts, here to ensure that your dining experience is nothing short of extraordinary . Our mission is simple: to delight our guests with exceptional food, impeccable service, and a warm, welcoming atmosphere. Whether you're joining us for a casual meal or a special celebration, we promise to exceed your expectations every time you visit . At The FOODIES Restaurant, we believe in giving back to the community that has given us so much. That's why we are committed to supporting local farmers and producers, reducing food waste, and being environmentally responsible in everything we do . We invite you to join us on a culinary journey like no other. Whether you're a seasoned foodie or just looking for a delicious meal, we promise an experience that will tantalize your taste buds and leave you craving more.
			</p>
		</div>
		<div class="about_col">
			<div id="about_img">
				<img src="Images/about.png">
			</div>
		</div>
	</div>
</section>

		<section id="menu">
    		<div class="container">
        		<div class="row text-center py-5">
            		<?php
                		$result = getData($con);
                		while ($row = mysqli_fetch_assoc($result)){
                    	component($row['Name'], $row['Price'], $row['Image'], $row['Id']);
                		}
            		?>
        		</div>
			</div>
		</section>

		<section id="feedback">
	<div class="wrapper">
    <input type="radio" name="rate" id="star-1">
    <input type="radio" name="rate" id="star-2">
    <input type="radio" name="rate" id="star-3">
    <input type="radio" name="rate" id="star-4">
    <input type="radio" name="rate" id="star-5">
    <div class="content">
      <div class="outer">
        <div class="emojis">
          <li class="slideImg"><img src="Images/emoji-1.png" alt=""></li>
          <li><img src="Images/emoji-2.png" alt=""></li>
          <li><img src="Images/emoji-3.png" alt=""></li>
          <li><img src="Images/emoji-4.png" alt=""></li>
          <li><img src="Images/emoji-5.png" alt=""></li>
        </div>
      </div>
      <div class="stars">
        <label for="star-1" class="star-1 fas fa-star"></label>
        <label for="star-2" class="star-2 fas fa-star"></label>
        <label for="star-3" class="star-3 fas fa-star"></label>
        <label for="star-4" class="star-4 fas fa-star"></label>
        <label for="star-5" class="star-5 fas fa-star"></label>
      </div>
    </div>
    <div class="footer">
      <span class="text"></span>
      <span class="numb"></span>
    </div>
  </div>
					</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>
<script src="Script.js"></script>
</body>
</html>
