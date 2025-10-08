<?php
  session_start();
  require("food_items.php");
  require("menu.php");
  require("payment.php");

  if (isset($_POST['remove']))
  {
      if ($_GET['action'] == 'remove')
      {
          foreach ($_SESSION['cart'] as $key => $value)
          {
              if($value["product_id"] == $_GET['id'])
              {
                  unset($_SESSION['cart'][$key]);
                  echo "<script>alert('Product has been Removed...!')</script>";
                  echo "<script>window.location = 'cart.php'</script>";
              }
          }
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
        .price-details h6 {
            padding: 3% 2%;
        }
        .shopping-cart {
            padding: 4% 0;
        }
        .cart-items {
            padding: 2% 0;
        }
        /*.modal-header {
            background-color: #845bb3;
            color: white;
            border-bottom: none;
        }
        .modal-header .close {
            color: white;
            opacity: 1;
        }
        .modal-header .close:hover {
            color: #845bb3;
        }
        .nav-pills .nav-link {
            border-radius: 0;
            color: #555;
            border: 1px solid #ddd;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        .nav-pills .nav-link i {
            margin-right: 10px;
        }
        .nav-pills .nav-link.active {
            background-color: #845bb3;
            color: white;
            border-color: #845bb3;
        }
        .nav-pills .nav-link:hover {
            background-color: #845bb3;
            color: white;
        }
        .tab-content {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 0;
            box-shadow: none;
            border-color: #845bb3;
        }
        .form-control:focus {
            border-color: #845bb3;
            box-shadow: none;
        }
        .modal-footer {
            border-top: none;
        }
        .modal-footer{
            background-color: #845bb3;
            border: none;
        }
        .modal-footer:hover {
            background-color: #845bb3;
        }
        .modal-body {
            max-height: 500px;
            overflow-y: auto;
        }
        #qrCode {
            width: 100%;
            height: auto;
        }*/
    </style>
    <script>
        function updateCartTotalPrice(productId, productPrice) {
            let quantity = document.getElementById('cart-quantity-' + productId).value;
            let total = quantity * productPrice;
            document.getElementById('cart-total-' + productId).innerText = total.toFixed(2);
            updateTotalPrice();
        }

        function updateTotalPrice() {
            let totalPrice = 0;
            const cartItems = document.querySelectorAll('.cart-items');
            cartItems.forEach(item => {
                const productId = item.querySelector('input[type="number"]').id.split('-').pop();
                const quantity = item.querySelector('input[type="number"]').value;
                const productPrice = parseFloat(item.querySelector('h5[id^="price-"]').innerText.replace('$', ''));
                totalPrice += quantity * productPrice;
            });
            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
            document.getElementById('amount-payable').innerText = totalPrice.toFixed(2);
        }
        /*function handlePaymentSubmit(event, method) {
        event.preventDefault();
        const formData = new FormData(event.target);
        formData.append('paymentMethod', method);

        // Check if all fields are filled
        if (validateForm(formData)) {
            // Simulate successful payment
            alert('Payment successful!');
            $('#paymentModal').modal('hide');
        } else {
            alert('Please fill all the fields.');
        }
    }

    function validateForm(formData) {
        // Check if any form field is empty
        for (const value of formData.values()) {
            if (!value.trim()) {
                return false;
            }
        }
        return true;
    }*/
    </script>
    <link rel="stylesheet" href="bootstrap-5.3.1-dist/css/bootstrap.min.css">
	<script src="bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap-5.3.1-dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script crossorigin="anonymous" src="https://code.jquery.com/jquery-latest.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <a href="index.php"><button class="btn btn-outline-success">Back</button></a>
                <hr>

                <?php
                $total = 0;
                if (isset($_SESSION['cart'])){
                    $product_id = array_column($_SESSION['cart'], 'product_id');
                    $result = getData($con);
                    while ($row = mysqli_fetch_assoc($result)){
                        foreach ($product_id as $id){
                            if ($row['Id'] == $id)
                            {
                                cartElement($row['Image'], $row['Name'], $row['Price'], $row['Id']);
                                $total += (int)$row['Price'];
                            }
                        }
                    }
                } else {
                    echo "<h5>Cart is Empty</h5>";
                }
                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            } else {
                            echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#address" style="margin-bottom:20px;">Proceed</button>
                    </div>
                    <div class="col-md-6">
                        <h6><span id="total-price"><?php echo $total; ?></span>/-</h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6><span id="amount-payable"><?php echo $total; ?></span>/-</h6>

                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="modal fade" id="paymodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Payment Options</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
              <ul class="nav flex-column nav-pills" id="paymentTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="upi-tab" data-toggle="pill" href="#upi" role="tab" aria-controls="upi" aria-selected="true">
                    <i class="fas fa-mobile-alt"></i>UPI
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="onlineBanking-tab" data-toggle="pill" href="#onlineBanking" role="tab" aria-controls="onlineBanking" aria-selected="false">
                    <i class="fas fa-university"></i>Online Banking
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="card-tab" data-toggle="pill" href="#card" role="tab" aria-controls="card" aria-selected="false">
                    <i class="fas fa-credit-card"></i>Credit/Debit Card
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="cod-tab" data-toggle="pill" href="#cod" role="tab" aria-controls="cod" aria-selected="false">
                    <i class="fas fa-money-bill-wave"></i>Cash on Delivery
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-8">
              <div class="tab-content" id="paymentTabContent">

                <div class="tab-pane fade show active" id="upi" role="tabpanel" aria-labelledby="upi-tab">
                  <form id="upiForm" onsubmit="return handlePaymentSubmit(event, 'upi')">
                    <div class="form-group">
                      <label for="upiId">UPI ID</label>
                      <input type="text" class="form-control" id="upiId" name="upiId" placeholder="Enter your UPI ID" required>
                    </div>
                    <div class="form-group">
                      <label for="qrCode">Scan QR Code</label>
                      <img src="Images\qr-code.png" style="height:100px;width:100px;" alt="QR Code" id="qrCode">
                    </div>
                    <button type="submit" class="btn rounded" style="background-color:#845bb3;">Submit UPI Payment</button>
                  </form>
                </div>

                <div class="tab-pane fade" id="onlineBanking" role="tabpanel" aria-labelledby="onlineBanking-tab">
                  <form id="onlineBankingForm" onsubmit="return handlePaymentSubmit(event, 'onlineBanking')">
                    <div class="form-group">
                      <label for="bankName">Bank Name</label>
                      <input type="text" class="form-control" id="bankName" name="bankName" placeholder="Enter your Bank Name" required>
                    </div>
                    <div class="form-group">
                      <label for="accountNumber">Account Number</label>
                      <input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="Enter your Account Number" required>
                    </div>
                    <div class="form-group">
                      <label for="ifscCode">IFSC Code</label>
                      <input type="text" class="form-control" id="ifscCode" name="ifscCode" placeholder="Enter IFSC Code" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Online Banking Payment</button>
                  </form>
                </div>

                <div class="tab-pane fade" id="card" role="tabpanel" aria-labelledby="card-tab">
                  <form id="cardForm" onsubmit="return handlePaymentSubmit(event, 'card')">
                    <div class="form-group">
                      <label for="cardNumber">Card Number</label>
                      <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Enter your Card Number" required>
                    </div>
                    <div class="form-group">
                      <label for="cardName">Name on Card</label>
                      <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Enter Name on Card" required>
                    </div>
                    <div class="form-group">
                      <label for="cardExpiry">Expiry Date</label>
                      <input type="text" class="form-control" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group">
                      <label for="cardCvv">CVV</label>
                      <input type="text" class="form-control" id="cardCvv" name="cardCvv" placeholder="Enter CVV" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Card Payment</button>
                  </form>
                </div>

                <div class="tab-pane fade" id="cod" role="tabpanel" aria-labelledby="cod-tab">
                  <form id="codForm" onsubmit="return handlePaymentSubmit(event, 'cod')">
                    <p>Cash on Delivery is available. Please ensure you have the exact amount ready.</p>
                    <button type="submit" class="btn btn-primary">Confirm COD</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>-->
</body>
</html>