<?php 
    $con=mysqli_connect("localhost:3307","root",'admin') or die ("error al conectarse al server");

    mysqli_select_db($con,"usuarios");
    mysqli_query($con,
    "INSERT INTO `usuarios`.`usuario`(`NOMBRE`,`EMAIL`,`URL`,`ESTADO`) 
     VALUES ('$_POST[NOMBRE]','$_POST[EMAIL]','$_POST[URL]','$_POST[ESTADO]')"
    ); 
    header("Location: http://localhost:8012/CRUD_PHP/index.php");
    exit;
?>