<?php

if (!isset($_SERVER['HTTP_REFERER'])) {

    header('location: http://localhost:8000/index.php');
    exit;
}

if (isset($_POST['submit'])) {
    echo "<script> window.location.href='" . APPURL . "/products/success.php'; </script>";
}

?>

<?php require "../includes/header.php"; ?>

<?php

if (!isset($_SESSION['username'])) {

    echo "<script> window.location.href='" . APPURL . "'; </script>";
}

?>
<div class="banner">
    <div class="jumbotron jumbotron-bg text-center rounded-0 mb-3 " style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">

        <h1 class="pt-5">
            Pay with Paypal Page
        </h1>
        <p class="lead">
            Save time and leave the groceries to us.
        </p>
    </div>
    <!-- Replace "test" with your own sandbox Business account app client ID 
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>-->
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container">

    </div>
    <form action="success.php" method="post">
        <button name="submit" type="submit" class="btn btn-primary float-left">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
    </form>
    <!-- <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $_SESSION['total_price']; ?>' // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    // const transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                    window.location.href = 'success.php';
                });
            }
        }).render('#paypal-button-container');
    </script> -->



</div>


<?php require "../includes/footer.php"; ?>