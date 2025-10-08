<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodies</title>

    <!-- Bootstrap 5 CSS -->
    <link href="bootstrap-5.3.1-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body { background-color: #f8f9fa; }
        .modal-header { background-color: #845bb3; color: white; border-bottom: none; }
        .modal-header .btn-close { filter: invert(1); }
        .nav-pills .nav-link {
            border-radius: 0; color: #555; border: 1px solid #ddd;
            margin-bottom: 5px; display: flex; align-items: center;
        }
        .nav-pills .nav-link i { margin-right: 10px; }
        .nav-pills .nav-link.active { background-color: #845bb3; color: white; border-color: #845bb3; }
        .nav-pills .nav-link:hover { background-color: #845bb3; color: white; }
        .tab-content { padding: 20px; border: 1px solid #ddd; border-radius: 4px; background-color: white; }
        .form-group label { font-weight: bold; }
        .form-control { border-radius: 0; border-color: #845bb3; box-shadow: none; }
        .form-control:focus { border-color: #845bb3; box-shadow: none; }
        .modal-footer { border-top: none; background-color: #845bb3; }
        .modal-body { max-height: 500px; overflow-y: auto; }
        #qrCode { width: 100%; height: auto; }
        .is-invalid { border-color: red !important; }
        .is-valid { border-color: green !important; }
    </style>
</head>
<body>

    <!-- Address Modal -->
    <div class="modal" id="address">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <p>Enter Contact No:</p>
                        <input type="text" name="contact" id="phone" oninput="Handlecontact()" class="form-control"><br><br>
                        <p>Enter Address:</p>
                        <textarea rows="4" cols="30" name="add" id="addressField" oninput="Handlecontact()" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="proceedButton" data-bs-toggle="modal" data-bs-target="#paymodal" disabled onclick="hide()">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Payment Options</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="nav flex-column nav-pills" id="paymentTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="upi-tab" data-bs-toggle="pill" href="#upi" role="tab">
                                            <i class="fas fa-mobile-alt"></i>UPI
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="onlineBanking-tab" data-bs-toggle="pill" href="#onlineBanking" role="tab">
                                            <i class="fas fa-university"></i>Online Banking
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="card-tab" data-bs-toggle="pill" href="#card" role="tab">
                                            <i class="fas fa-credit-card"></i>Credit/Debit Card
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="cod-tab" data-bs-toggle="pill" href="#cod" role="tab">
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
                                                    <label>UPI ID</label>
                                                    <input type="text" class="form-control" id="upiId" name="upiId" placeholder="Enter your UPI ID" oninput="validateUpiId()" required>
                                                    <small id="upiError" class="form-text text-danger" style="display:none;">Invalid UPI ID. Please enter a valid UPI ID in the format name@bank.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Scan QR Code</label>
                                                    <img src="Images/qr-code.png" style="height:100px;width:100px;" alt="QR Code" id="qrCode">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit UPI Payment</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="onlineBanking" role="tabpanel" aria-labelledby="onlineBanking-tab">
                                            <form id="onlineBankingForm" onsubmit="return handleOnlineBanking(event, 'onlineBanking')">
                                                <div class="form-group">
                                                    <label for="bankName">Bank Name</label>
                                                    <input type="text" class="form-control" id="bankName" name="bankName" placeholder="Enter your Bank Name" oninput="validateBankName()" required>
                                                    <small id="bankNameError" class="form-text text-danger" style="display:none;">Please enter a valid bank name.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="accountNumber">Account Number</label>
                                                    <input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="Enter your Account Number" oninput="validateAccountNumber()" required>
                                                    <small id="accountNumberError" class="form-text text-danger" style="display:none;">Please enter a valid account number (9-18 digits).</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ifscCode">IFSC Code</label>
                                                    <input type="text" class="form-control" id="ifscCode" name="ifscCode" placeholder="Enter IFSC Code" oninput="validateIfscCode()" required>
                                                    <small id="ifscCodeError" class="form-text text-danger" style="display:none;">Please enter a valid IFSC code (e.g., ABCD0123456).</small>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Online Banking Payment</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="card" role="tabpanel" aria-labelledby="card-tab">
                                            <form id="cardForm" onsubmit="return handleCard(event, 'card')">
                                                <div class="form-group">
                                                    <label for="cardNumber">Card Number</label>
                                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Enter your Card Number" oninput="validateCardNumber()" required>
                                                    <small id="cardNumberError" class="form-text text-danger" style="display:none;">Please enter a valid card number (16 digits).</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cardName">Name on Card</label>
                                                    <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Enter Name on Card" oninput="validateCardName()" required>
                                                    <small id="cardNameError" class="form-text text-danger" style="display:none;">Please enter the name on the card.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cardExpiry">Expiry Date</label>
                                                    <input type="text" class="form-control" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" oninput="validateCardExpiry()" required>
                                                    <small id="cardExpiryError" class="form-text text-danger" style="display:none;">Please enter a valid expiry date (MM/YY).</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cardCvv">CVV</label>
                                                    <input type="text" class="form-control" id="cardCvv" name="cardCvv" placeholder="Enter CVV" oninput="validateCardCvv()" required>
                                                    <small id="cardCvvError" class="form-text text-danger" style="display:none;">Please enter a valid CVV (3 digits).</small>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Card Payment</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="cod" role="tabpanel" aria-labelledby="cod-tab">
                                            <form id="codForm" onsubmit="return handleCOD(event, 'cod')">
                                                <p>Cash on Delivery is available. Please ensure you have the exact amount ready.</p>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="confirmCheckbox" required>
                                                    <label class="form-check-label" for="confirmCheckbox">I confirm that I have the exact amount ready for Cash on Delivery.</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Confirm COD</button>
                                            </form>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function hide() { 
            var addrModal = bootstrap.Modal.getInstance(document.getElementById('address')); 
            if (addrModal) addrModal.hide(); 
        }

        function handlePaymentSubmit(event, paymentType) {
            event.preventDefault();
            if (paymentType === 'upi') {
                if (validateUpiId()) {
                    alert('Payment Successful..!!');
                    var payModal = bootstrap.Modal.getInstance(document.getElementById('paymodal'));
                    if (payModal) payModal.hide();
                    window.location.href = "cart.php?payment_success=1&clear_cart=1";
                    return true;
                } else {
                    alert('Invalid UPI ID');
                    return false;
                }
            }
            return true;
        }

        function handleOnlineBanking(event) {
            event.preventDefault();
            if (validateBankName() && validateAccountNumber() && validateIfscCode()) {
                alert('Payment Successful..!!');
                var payModal = bootstrap.Modal.getInstance(document.getElementById('paymodal'));
                if (payModal) payModal.hide();
                window.location.href = "cart.php?payment_success=1&clear_cart=1";
            } else {
                alert('Please correct the errors.');
            }
        }

        function handleCard(event) {
            event.preventDefault();
            if (validateCardNumber() && validateCardName() && validateCardExpiry() && validateCardCvv()) {
                alert('Payment Successful..!!');
                var payModal = bootstrap.Modal.getInstance(document.getElementById('paymodal'));
                if (payModal) payModal.hide();
                window.location.href = "cart.php?payment_success=1&clear_cart=1";
            } else {
                alert('Please correct the errors.');
            }
        }

        function handleCOD(event) {
            event.preventDefault();
            if (document.getElementById('confirmCheckbox').checked) {
                alert('Cash on Delivery confirmed.');
                var payModal = bootstrap.Modal.getInstance(document.getElementById('paymodal'));
                if (payModal) payModal.hide();
                window.location.href = "cart.php?payment_success=1&clear_cart=1";
            } else {
                alert('Please confirm COD.');
            }
        }

        // --- VALIDATIONS (same as before) ---
        function Handlecontact() {
            const phoneInput = document.getElementById("phone");
            const addressField = document.getElementById("addressField");
            const proceedButton = document.getElementById("proceedButton");
            const phonePattern = /^\d{10}$/;
            let isPhoneValid = phonePattern.test(phoneInput.value);
            let isAddressValid = addressField.value.trim().length > 0;

            if (isPhoneValid) { phoneInput.classList.add('is-valid'); phoneInput.classList.remove('is-invalid'); }
            else { phoneInput.classList.add('is-invalid'); phoneInput.classList.remove('is-valid'); }

            if (isAddressValid) { addressField.classList.add('is-valid'); addressField.classList.remove('is-invalid'); }
            else { addressField.classList.add('is-invalid'); addressField.classList.remove('is-valid'); }

            proceedButton.disabled = !(isPhoneValid && isAddressValid);
        }

        function validateUpiId() {
            const upiId = document.getElementById("upiId");
            const upiPattern = /^[a-zA-Z0-9.\-_]{2,256}@[a-zA-Z]{2,64}$/;
            const isValid = upiPattern.test(upiId.value);
            document.getElementById("upiError").style.display = isValid ? "none" : "block";
            return isValid;
        }
        function validateBankName() {
    const bankName = document.getElementById("bankName");
    const error = document.getElementById("bankNameError");
    const isValid = bankName.value.trim().length > 0;
    error.style.display = isValid ? "none" : "block";
    return isValid;
}

function validateAccountNumber() {
    const accountNumber = document.getElementById("accountNumber");
    const error = document.getElementById("accountNumberError");
    const isValid = /^\d{9,18}$/.test(accountNumber.value);
    error.style.display = isValid ? "none" : "block";
    return isValid;
}

function validateIfscCode() {
    const ifscCode = document.getElementById("ifscCode");
    const error = document.getElementById("ifscCodeError");
    const isValid = /^[A-Z]{4}0[A-Z0-9]{6}$/.test(ifscCode.value);
    error.style.display = isValid ? "none" : "block";
    return isValid;
}

function validateCardNumber() {
    const cardNumber = document.getElementById("cardNumber");
    const error = document.getElementById("cardNumberError");
    const isValid = /^\d{16}$/.test(cardNumber.value);
    error.style.display = isValid ? "none" : "block";
    return isValid;
}

function validateCardName() {
    const cardName = document.getElementById("cardName");
    const error = document.getElementById("cardNameError");
    const isValid = cardName.value.trim().length > 0;
    error.style.display = isValid ? "none" : "block";
    return isValid;
}

function validateCardExpiry() {
    const cardExpiry = document.getElementById("cardExpiry");
    const error = document.getElementById("cardExpiryError");
    const isValid = /^(0[1-9]|1[0-2])\/\d{2}$/.test(cardExpiry.value);
    error.style.display = isValid ? "none" : "block";
    return isValid;
}

function validateCardCvv() {
    const cardCvv = document.getElementById("cardCvv");
    const error = document.getElementById("cardCvvError");
    const isValid = /^\d{3}$/.test(cardCvv.value);
    error.style.display = isValid ? "none" : "block";
    return isValid;
}

    </script>
</body>
</html>

<?php

// clear cart if payment successful
if (isset($_GET['clear_cart'])) {
    unset($_SESSION['cart']);
}
?>