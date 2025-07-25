<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location: http://localhost:8000/');
    exit;
}

?>
<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php
if (!isset($_SESSION['username'])) {

    echo "<script> window.location.href='" . APPURL . "'; </script>";
}

try {
    $products = $conn->prepare("SELECT * FROM cart WHERE user_id=:user_id");
    $products->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $products->execute();
    $allProducts = $products->fetchAll(PDO::FETCH_OBJ);

    if (isset($_SESSION['price'])) {
        $_SESSION['total_price'] = $_SESSION['price'] + 500;
    }

    if (isset($_POST['submit'])) {

        if (
            empty($_POST['name']) or empty($_POST['lname'])
            or empty($_POST['address']) or empty($_POST['city'])
            or  empty($_POST['phone_number'])
            or empty($_POST['order_notes'])
        ) {
            echo "<script>alert('one or more inputs are empty')</script>";
        } else {
            $name = $_POST['name'];
            $lname = $_POST['lname'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $phone_number = $_POST['phone_number'];
            $order_notes = $_POST['order_notes'];
            $price = $_SESSION['total_price'];
            $user_id = $_SESSION['user_id'];

            $insert = $conn->prepare("INSERT INTO orders(name, lname, address, city, phone_number, order_notes, price, user_id)
            VALUES(:name, :lname, :address, :city, :phone_number, :order_notes, :price, :user_id)");

            $insert->execute([
                ":name" => $name,
                ":lname" => $lname,
                ":address" => $address,
                ":city" => $city,
                ":phone_number" => $phone_number,
                ":order_notes" => $order_notes,
                ":price" => $price,
                ":user_id" => $user_id,
            ]);

            echo "<script> window.location.href='" . APPURL . "/products/charge.php'; </script>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">
            <div class="container">
                <h1 class="pt-5">
                    Checkout
                </h1>
                <p class="lead">
                    Save time and leave the groceries to us.
                </p>
            </div>
        </div>
    </div>

    <section id="checkout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7">
                    <h5 class="mb-3">BILLING DETAILS</h5>
                    <!-- Bill Detail of the Page -->
                    <form action="checkout.php" method="POST" class="bill-detail">
                        <fieldset>
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control" placeholder="Name" type="text" name="name">
                                </div>
                                <div class="col">
                                    <input class="form-control" placeholder="Last Name" type="text" name="lname">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="address" placeholder="Address"></textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="city" placeholder="Town / City" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="phone_number" placeholder="Phone Number" type="tel">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="order_notes" placeholder="Order Notes"></textarea>
                            </div>
                        </fieldset>
                        <button name="submit" type="submit" class="btn btn-primary float-left">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>

                    </form>
                    <!-- Bill Detail of the Page end -->
                </div>
                <div class="col-xs-12 col-sm-5">
                    <div class="holder">
                        <h5 class="mb-3">YOUR ORDER</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allProducts as $product) : ?>
                                        <tr>
                                            <td>
                                                <?php echo $product->pro_title; ?> x<?php echo $product->pro_qty; ?>
                                            </td>
                                            <td class="text-right">
                                                Ks <?php echo $product->pro_price; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td>
                                            <strong>Cart Subtotal</strong>
                                        </td>
                                        <td class="text-right">
                                            <?php if (isset($_SESSION['price'])) : ?>
                                                Ks <?php echo $_SESSION['price']; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Shipping</strong>
                                        </td>
                                        <td class="text-right">
                                            Ks 500
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>ORDER TOTAL</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>Ks <?php echo $_SESSION['price'] + 500; ?></strong>
                                        </td>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>


                    </div>

                    <div class="clearfix">
                    </div>
                </div>
            </div>
    </section>
</div>
<?php require "../includes/footer.php"; ?>