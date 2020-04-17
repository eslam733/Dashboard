<?php 
$Nonav = "";
$title_page = "login";
include "init.php";
//check if any session exist
session_start();
if(isset($_SESSION['username']))
{
    header("Location: Dashboard.php");
}

?>


<div class="my-alert">
    
</div>
<div class="d-flex justify-content-center">
<form class="mt-5 text-center col-md-3 login">
    <label class="font-weight-bold label mt-5">ADMIN LOGIN</label>
    <input type="username" placeholder="Username" class="form-control mb-2 username" id="exampleInputEmail1" aria-describedby="emailHelp">
    <input type="password" placeholder="Password" class="form-control mb-2 password" id="exampleInputPassword1">
    <input type="submit" class="btn btn-primary loginAdmin" value="login"/>
</form>
</div>



<?php include $tem . "footer.php" ?>