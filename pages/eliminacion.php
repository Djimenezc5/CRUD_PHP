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
                <h1>Eliminación de usuarios</h1>
                <h6>Selecione una persona</h6>
                
                <form method="POST" action="eliminacion.php">
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
                  <form method="POST" action="eliminacion.php"> 
                    <?php 
                        $valor = !isset($_POST["selecionado"])? 0 : $_POST["selecionado"]; 
                        while ($usuarios = $resUsuarios2 -> fetch_array(MYSQLI_BOTH)) {
                            if ($valor == $usuarios['ID']) {  
                    ?>
                            <input type="hidden" name="ID_PERSONA" value = "<?php echo $usuarios['ID']; ?>">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nombre</span>
                                <input type="text" class="form-control" placeholder="Daniel Jiménez" value = "<?php echo $usuarios['NOMBRE']; ?>" size="30" minlength="10" maxlength="50" disabled>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="djimenezc5" value = "<?php echo $usuarios['EMAIL']; ?>" size="30" minlength="10" maxlength="75" disabled>
                                <span class="input-group-text" id="basic-addon2">usuario@ejemplo.com</span>
                            </div>
                            <label for="basic-url" class="form-label">Tu URL</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">https://ejemplo.com/usuarios/</span>
                                <input type="text" class="form-control" value = "<?php echo $usuarios['URL']; ?>"  size="30" minlength="10" maxlength="100" disabled>
                            </div> 
                            <br>
                            <div class="col-12">
                                <button class="btn btn-danger" type="submit">Eliminar</button>
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
        mysqli_query($con, "DELETE FROM usuario WHERE ID = '$idEliminar'");
        header("Location: http://localhost:8012/CRUD_PHP/index.php");
        exit;
    }
?>