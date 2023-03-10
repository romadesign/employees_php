<?php 
 setcookie("login_status", "", time() - 3600); // eliminar la cookie de estado de inicio de sesión
 setcookie("type_user", "", time() - 3600); // eliminar la cookie de tipo de usuario
 setcookie("user_id", "", time() - 3600); // eliminar la cookie de identificador de usuario
 header("Location: index.php"); // redirigir al usuario a la página de inicio de sesión
 exit; // asegurarse de que el script se detenga después de redirigir al usuario
?>