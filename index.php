<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <title>CRUD en PHP</title>
</head>
<body>
    <?php 
        $con=mysqli_connect("localhost:3307","root",'admin', 'usuarios');
        if ($con -> connect_errno) {
            die("Fallo en la conexión: (" .$con -> mysqli_connect_errno().")".$con -> mysqli_connect_error());
        }
        $usuario = "SELECT * FROM usuario";
        $resUsuarios = $con -> query($usuario);
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
                  <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/creacion-persona.html">Creación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/modificacion.php">Actualización</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/eliminacion.php">Eliminación</a>
                </li>
            </div>
          </div>
        </div>
      </nav>
      <br>
    <div style="margin: 40px;">
      <h1 style="margin-top: 30px;">Usuarios creados</h1>
        <table id="example" class="table table-striped table-sm">
              <thead>
                    <tr>
                      <th class="table-dark" scope="col">#</th>
                      <th class="table-dark" scope="col">ID</th>
                      <th class="table-dark" scope="col">NOMBRE</th>
                      <th class="table-dark" scope="col">EMAIL</th>
                      <th class="table-dark" scope="col">URL</th>
                    </tr>
              </thead>
              <tbody>                  
              <?php 
                  $numItem= 0;
                  while ($result = $resUsuarios -> fetch_array(MYSQLI_BOTH)) {
                  $numItem = $numItem + 1;
              ?>
                <tr> 
                      <th scope="row"><?php echo $numItem ?></th>
                      <td> <?php echo  $result['ID'] ?></td>
                      <td><?php echo $result['NOMBRE'] ?></td>
                      <td><?php echo $result['EMAIL'] ?></td>
                      <td><?php echo $result['URL'] ?></td>
                  </tr>            
              <?php  
                  }
              ?>  
            </tbody>       
          </table> 
    </div>
  <script>
      $(document).ready(function() {
        $('#example').DataTable();
      } );
  </script>
</body>
</html>