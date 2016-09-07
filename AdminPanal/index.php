<?php 
session_start();
$noNavebar = "";
$pageTitle = "Login Page";
if (isset($_SESSION['username'])){
   header("Location: dashboard.php"); // redirect to dashboard page 
   exit();
  }

include 'init.php';
?>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <h3 style="font-size:30px;margin-left:500px">
                    Ecommerce
                </h3>

            </div>
        </div>
    </nav>

<center>
  <h4 class="text-center">Admin Login</h4>
<form class="login" method="post" action="login.php">
	<div class="form-group row">
    <div class="col-sm-10">
      <input type="text" class="form-control" name="user"  placeholder="Username" autocomplete="off" data-text="nada">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pass" placeholder="Password" autocomplete="new-password">
    </div>
  </div>
  <div class="form-group row">
    <div class=" col-sm-10">
      <button type="submit" class="btn btn-primary btn-block">Login</button>
    </div>
</div>
</form>
</center>

<?php include_once $tmp.'footer.php';
?>