<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php


if (isset($_POST['submit'])) {

  if (
    empty($_POST['email']) or empty($_POST['password'])
    or empty($_POST['adminname'])
  ) {

    echo "<script>alert('one or more inputs are empty')</script>";
  } else {



    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $adminname = $_POST['adminname'];

    $insert = $conn->prepare("INSERT INTO admins(email, adminname, mypassword)
            VALUES(:email, :adminname, :mypassword)");
    $insert->bindParam(":email", $email);
    $insert->bindParam(":adminname", $adminname);
    $insert->bindParam(":mypassword", $password);
    if ($insert->execute()) {
      echo "<script>alert('Admin Registration successful')</script>";
      header("Location: http://localhost:8000/admin-panel/admins/login-admins.php");
      exit();
    } else {
      echo "<script>alert('Error create admin')</script>";
    }




    // header("Location: login.php");
  }
}



?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Create Admins</h5>
        <form method="POST" action="create-admins.php">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />

          </div>

          <div class="form-outline mb-4">
            <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="adminname" />
          </div>
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
          </div>







          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>


        </form>

      </div>
    </div>
  </div>
</div>
<?php require "../layouts/footer.php"; ?>