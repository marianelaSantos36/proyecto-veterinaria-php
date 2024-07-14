<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    .card {
        margin-top: 50px;
    }
    body {
        background-color: papayawhip;
    }
    .card-header {
        background-color: mediumvioletred;
        color: white;
    }
    .card {
        padding: 20px;
        background-image: url(img/aaaaa.png);
        background-size: cover; 
    }
    .text-center {
        color:black;
    }
</style>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header">
            <h3 style="text-align: center;">Login Administrador</h3>
          </div>
          <div style="text-align: center;">
            <img src="img/logoU.png" alt="" width="100px">
          </div>            
          
          <div class="card-body">
            <form  method="POST" id="loginForm">
              <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" name="username" id="username" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-danger btn-block">Iniciar Sesión</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault(); 

        // DATOS DEL FORMULARIO
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        //PREGNTAMOS SI LOS DATOS SON COORECTOS ESTA POR DEFECTO
        if (username === "usuario1" && password === "contraseña1") {
            // DIRECCIONAR A VISTA ADMIN
            window.location.href = "vistaAdmi/home.php";
        } else {
            // SI ES INCORRECTO MENSAJE
            alert("Usuario o contraseña incorrectos.");
        }
    });
  </script>
</body>
</html>
