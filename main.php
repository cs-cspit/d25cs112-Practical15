<?php
include('login.php');
include('signup.php'); 
include('database.php');

if (isset($_GET['status']) && $_GET['status'] == 'denied') {
    echo "<script>alert('Invalid credentials, please try again.');</script>";
}
?>
<!DOCTYPE html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Foodies</title>
		<link rel="stylesheet" href="bootstrap-5.3.1-dist/css/bootstrap.css">
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
		</style>
<script>
    document.addEventListener('DOMContentLoaded', function()
	{
        document.getElementById('signupForm').addEventListener('submit', function(event)
		{
            var username = document.getElementById("suname").value.trim();
            var password = document.getElementById("spass").value.trim();
            var mobile = document.getElementById("smobile").value.trim();
            var email = document.getElementById("semail").value.trim();
            if (!/^[A-Za-z]+$/.test(username))
			{
                alert("Please enter a username.");
                event.preventDefault();
                return false;
            }
            if (password === "")
			{
                alert("Please enter a password.");
                event.preventDefault();
                return false;
            }
            if (!/^\(?([0-9]{5})\)?[-. ]?([0-9]{5})$/.test(mobile))
			{
                alert("Please enter a valid 10-digit mobile number.");
                event.preventDefault();
                return false;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))
			{
                alert("Please enter a valid email address.");
                event.preventDefault();
                return false;
            }
            return true;
        });
    });
	function phone() {
                var phoneInput = document.getElementById("smobile");
                var phonePattern = /^\(?([0-9]{5})\)?[-. ]?([0-9]{5})$/;
                
                if (!phonePattern.test(phoneInput.value)) {
                    phoneInput.style.borderColor = "red";
                } else {
                    phoneInput.style.borderColor = ""; // Reset to default if valid
                }
            }

            function validatename()
            {
                var nameInput = document.getElementById("suname");
                var namePattern = /^[A-Za-z]+$/;
                
                if (!namePattern.test(nameInput.value))
                {
                    nameInput.style.borderColor = "red";
                }
                else
                {
                    nameInput.style.borderColor = ""; // Reset to default if valid
                }
            }

            function email() {
                var emailInput = document.getElementById("semail");
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (!emailPattern.test(emailInput.value)) {
                    emailInput.style.borderColor = "red";
                } else {
                    emailInput.style.borderColor = ""; // Reset to default if valid
                }
            }
</script>

	</head>
	<body >
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
							<a class="nav-link" href="#login" data-bs-toggle="modal">LogIn</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#signup" data-bs-toggle="modal">Sign Up</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<section id="home" class="bg-image">
		</section>
		
		<section id="menu">
    		<div class="container">
        		<div class="row text-center py-5">
            		<?php
						require("menu.php");
						require("food_items.php");
                		$result = getData($con);
                		while ($row = mysqli_fetch_assoc($result))
						{
                    		component2($row['Name'], $row['Price'], $row['Image']);
                		}
            		?>
        		</div>
			</div>
		</section>

		<div id="aboutus" >
				<center><h1 id="section">About Us</h1></center>
				<div id="about_row">
					<div class="about_col">
						<p>
							Welcome to Foodies, where passion for food meets exceptional dining experience . At The Foodies Restaurant, we believe that food is not just about sustenance; it's an experience, a journey that tantalizes the taste buds, ignites the senses, and brings people together . Our story began 64 years ago with a simple yet profound idea: to create a culinary haven where exquisite flavors, impeccable service, and a warm ambiance converge to create unforgettable memories . At the heart of our philosophy is a commitment to excellence in everything we do . From sourcing the finest ingredients to crafting each dish with precision and care, we spare no effort in ensuring that every meal is a masterpiece.Behind every great meal is a team of passionate individuals dedicated to their craft . Our chefs are culinary virtuosos, constantly pushing the boundaries of flavor and creativity . Our staff is more than just service professionals; they are your hosts, here to ensure that your dining experience is nothing short of extraordinary.Our mission is simple: to delight our guests with exceptional food, impeccable service, and a warm, welcoming atmosphere . Whether you're joining us for a casual meal or a special celebration, we promise to exceed your expectations every time you visit . At The Foodies Restaurent, we believe in giving back to the community that has given us so much. That's why we are committed to supporting local farmers and producers, reducing food waste, and being environmentally responsible in everything we do . We invite you to join us on a culinary journey like no other . Whether you're a seasoned foodie or just looking for a delicious meal, we promise an experience that will tantalize your taste buds and leave you craving more.
						</p>
					</div>
					<div class="about_col">
						<div id="about_img">
							<img src="Images/about.png">
						</div>
					</div>
				</div>
		  </div>

		<section class="container">
			<div class="modal fade" id="login" >
				<div class="modal-dialog">s
					<div class="modal-content" style="background-color:rgba(0,0,0,0.6);">
						<div class="modal-header">
							<h3 class="modal-title">
								Login Form
							</h3>
							<button type="button" class="btn-close" data-bs-dismiss="modal"  style="filter:invert(1);"></button>
						</div>
						<div class="modal-body">
							<form method="POST" action="login.php">
								<div class="input-box">
									<input type="text" placeholder="Username" name="luname" id="luname" required><i class="fa-solid fa-user"></i>
								</div>
								<div class="input-box">
									<input type="password" placeholder="Password" name="lpass" id="lpass" required><i class="fa-solid fa-lock"></i>
								</div>
								<input type="submit" value="Login" name="loginsubmit" class="btn">
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="container">
			<div class="modal" id="signup">
				<div class="modal-dialog">
					<div class="modal-content" style="background-color:rgba(0,0,0,0.6);">
						<div class="modal-header">
							<h3 class="modal-title">
								Sign Up Form
							</h3>
							<button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1);"></button>
						</div>
						<div class="modal-body">
							<form method="POST" action="signup.php" id="signupForm">
								<div class="input-box">
									<input type="text" placeholder="Username" name="Suname" id="suname" oninput="validatename()" required><i class="fa-solid fa-user"></i>
								</div>
								<div class="input-box">
									<input type="password" placeholder="Password" name="Spass" id="spass" required><i class="fa-solid fa-lock"></i>
								</div>
								<div class="input-box">
									<input type="text" placeholder="Mobile Number" name="SMobile" id="smobile" oninput="phone()" required><i class="fa-solid fa-phone"></i>
								</div>
								<div class="input-box">
									<input type="text" placeholder="Email id" name="Semail" id="semail" oninput="email()" required><i class="fa-solid fa-envelope"></i>
								</div>
								<input type="submit" value="Sign Up" name="signupsubmit" class="btn">
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
        	<footer class="footer">
            	<div class="container">
                	<div class="row">
                    	<div class="footer-col">
                        	<h4>company</h4>
                        	<ul>
                            	<li><a href="#">about us</a></li>
                            	<li><a href="#">our services</a></li>
                            	<li><a href="#">privacy policy</a></li>
                        	</ul>
                    	</div>
                    	<div class="footer-col">
                        	<h4>Follow Us</h4>
                        	<div class="social-links">
                            	<a href="#"><i class="fa-brands fa-facebook"></i></a>
                            	<a href="#"><i class="fa-brands fa-twitter"></i></a>
                            	<a href="#"><i class="fa-brands fa-instagram fa-lg"></i></a>
                            	<a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        	</div>
                    	</div>
                	</div>
            	</div>
        	</footer>
        </section>
		
<script src="bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
</body>
</html>


	

