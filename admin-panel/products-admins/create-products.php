<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php

if (!isset($_SESSION['adminname'])) {

  echo "<script> window.location.href='" . ADMINURL . "/admins/login-admins.php'; </script>";
}


//fetching categories 

$categories = $conn->query("SELECT * FROM categories");
$categories->execute();

$allCategories = $categories->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {

  if (
    empty($_POST['title']) or empty($_POST['price'])  or empty($_POST['description'])
    or empty($_POST['category_id']) or empty($_POST['exp_date'])
  ) {

    echo "<script>alert('one or more inputs are empty')</script>";
  } else {



    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $exp_date = $_POST['exp_date'];
    $quantity = $_POST['quantity'];
    $image = time() . $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'] . '/products-admins/img_products/' . $image);
    $target_file = $_SERVER['DOCUMENT_ROOT'] . '/products-admins/img_products/' . $image;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $picname = basename($_FILES['image']['name']);
    $image = time() . $picname;
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
      echo "<script>alert('Please upload photo having extension .jpg/.jpeg/.png');</script>";
    } else if ($_FILES["image"]["size"] > 20000000) {
      echo "<script>alert('your photo exceed the size of 2 MB');</script>";
    }

    $insert = $conn->prepare("INSERT INTO products(title, price, description,quantity, category_id, exp_date, image)
            VALUES(:title, :price, :description, :quantity, :category_id, :exp_date, :image)");

    $insert->bindParam(":title", $title);
    $insert->bindParam(":price", $price);
    $insert->bindParam(":description", $description);
    $insert->bindParam(":quantity", $quantity);
    $insert->bindParam(":category_id", $category_id);
    $insert->bindParam(":exp_date", $exp_date);
    $insert->bindParam(":image", $image);

    if ($insert->execute()) {
      echo "<script> window.location.href='" . ADMINURL . "/products-admins/show-products.php'; </script>";
    }
  }
}


?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Create Products</h5>
        <form method="POST" action="create-products.php" enctype="multipart/form-data">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <label>Title</label>

            <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
          </div>

          <div class="form-outline mb-4 mt-4">
            <label>Price</label>

            <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea name="description" placeholder="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Quantity</label>
            <input type="text" name="quantity" id="form2Example1" class="form-control" placeholder="quantity" />
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Select Category</label>
            <select name="category_id" class="form-control" id="exampleFormControlSelect1">
              <option>--select category--</option>
              <?php foreach ($allCategories as $category) : ?>
                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Select Expiration Date</label>
            <select name="exp_date" class="form-control" id="exampleFormControlSelect1">
              <option>--select expiration date--</option>
              <option>2024</option>
              <option>2025</option>
              <option>2026</option>

            </select>
          </div>

          <div class="form-outline mb-4 mt-4">
            <label>Image</label>

            <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
          </div>



          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

      </div>
    </div>
  </div>
</div>
<?php require "../layouts/footer.php"; ?>