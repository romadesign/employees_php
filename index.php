<?php include './db/dbconnect.php'; ?>
<?php include_once('template/header.php') ?>
<?php require('fetch/login.php');
if (isset($_COOKIE['login_status']) == "true") {
    header('Location: users.php');
}
?>

<div class="container">

    <div class="row justify-content-center vh-100 align-items-center">
    
        <form class="content-login" action="<?php echo login() ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <?php 
    // Se comprueba si hay un mensaje en la sesión
session_start();
if(isset($_SESSION['mensaje'])) {
   // Si hay un mensaje, se muestra al usuario
   echo $_SESSION['mensaje'];

   // Se elimina el mensaje de la sesión para evitar que se muestre de nuevo
   unset($_SESSION['mensaje']);
}
    ?>  
        </form>
    </div>

</div>

<?php include_once('template/footer.php') ?>