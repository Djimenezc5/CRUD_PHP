<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <title>Eliminación</title>
    <script>
        function enviar(seleccion)
        {
            if(seleccion>0)
            {
                document.forms[0].submit();
            }
        }
	</script>
</head>
    <body>
        <?php 
            $con=mysqli_connect("localhost:3307","root",'admin', 'usuarios');
            if ($con -> connect_errno) {
                die("Fallo en la conexión: (" .$con -> mysqli_connect_errno().")".$con -> mysqli_connect_error());
            }
            $usuario = "SELECT * FROM usuario";
            $resUsuarios = $con -> query($usuario);
            $resUsuarios2 = $con -> query($usuario);
        ?>
        <nav class="navbar navbar-dark bg-dark fixed-top">
                <div class="container-fluid">
                <a class="navbar-brand" href="#">CRUD para PHP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">CRUD para PHP</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../pages/creacion-persona.html">Creación</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/modificacion.php">Actualización</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/eliminacion.php">Eliminación</a>
                        </li>
                    </div>
                </div>
                </div>
            </nav>
            <br>
            <div style="margin: 40px;">
                <h1>Actualización de usuarios</h1>
                <h6>Selecione una persona</h6>
                
                <form method="POST" action="modificacion.php">
                    <select name="selecionado" class="form-select" onchange="enviar(this.value)">
                        <option selected value="0">Selecione un valor</option>
                        <?php 
                            while ($result = $resUsuarios -> fetch_array(MYSQLI_BOTH)) {
                            echo'<option value="'.$result['ID'].'">'.$result['ID'].'-'.$result['NOMBRE'].'</option>';   
                            }                                
                        ?>     
                    </select>
                </form>
                <br>
                  <form method="POST" action="modificacion.php"> 
                    <?php 
                        $valor = !isset($_POST["selecionado"])? 0 : $_POST["selecionado"]; 
                        while ($usuarios = $resUsuarios2 -> fetch_array(MYSQLI_BOTH)) {
                            if ($valor == $usuarios['ID']) {  
                    ?>
                            <input type="hidden" name="ID_PERSONA" value = "<?php echo $usuarios['ID']; ?>">
                            <div for="validationDefault01" class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nombre</span>
                                <input id="validationDefault01" 
                                       type="text" 
                                       class="form-control" 
                                       name="NOMBRE"  
                                       placeholder="Daniel Jiménez" 
                                       value = "<?php echo $usuarios['NOMBRE']; ?>" 
                                       required
                                       minlength="5" 
                                       maxlength="50"
                                       pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$"
                                       title="Letras, el tamaño minimo es 5 caracteres y el máximo de 50" 
                                       >
                            </div>
                            <div for="validationDefault02" class="input-group mb-3">
                                <input id="validationDefault02" 
                                       type="email" 
                                       class="form-control" 
                                       name="EMAIL" 
                                       placeholder="djimenezc5" 
                                       value = "<?php echo $usuarios['EMAIL']; ?>" 
                                       size="30" 
                                       required 
                                       minlength="5" 
                                       maxlength="75"
                                       >
                                <span class="input-group-text" id="basic-addon2">usuario@ejemplo.com</span>
                            </div>
                            <label for="basic-url" class="form-label">Tu URL</label>
                            <div for="validationDefault03" class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">https://ejemplo.com/usuarios/</span>
                                <input id="validationDefault03"
                                       type="text" 
                                       class="form-control" 
                                       name="URL" value = "<?php echo 
                                       $usuarios['URL']; ?>"  
                                       required 
                                       minlength="5" 
                                       maxlength="100"
                                       >
                            </div> 
                            <br>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Actualizar</button>
                            </div>   
                    <?php 
                        }
                    }
                    ?>
                    </form>
            </div>
    </body>
</html>
<?php 
    $idEliminar = !isset($_POST["ID_PERSONA"])? 0 : $_POST["ID_PERSONA"];
    $con=mysqli_connect("localhost:3307","root",'admin', 'usuarios');
    if ($con -> connect_errno) {
        die("Fallo en la conexión: (" .$con -> mysqli_connect_errno().")".$con -> mysqli_connect_error());
    }
    if ($idEliminar > 0) {
        mysqli_query($con, "UPDATE usuario SET NOMBRE = '$_POST[NOMBRE]', EMAIL ='$_POST[EMAIL]', URL ='$_POST[URL]' WHERE ID = '$idEliminar'");
        mysqli_close($con);
        header("Location: http://localhost:8012/CRUD_PHP/index.php");
        exit;
    }
?>