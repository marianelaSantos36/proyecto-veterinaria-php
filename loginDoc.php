<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Doctor</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .card {
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: #007bff;
      color: #fff;
      border-radius: 10px 10px 0 0;
      padding: 15px;
      text-align: center;
    }
    .card {
      margin-top: 50px;
    }
    body{
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
    .text-center{
      color:black;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3>Login Doctor</h3>
          </div>
          <div style="text-align: center;">
            <img src="img/logoU.png" alt="" width="100px" >
          </div>  
          <div class="card-body">
            <form id="loginForm">
              <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" name="username" id="username" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <button type="button" id="loginButton" class="btn btn-danger btn-block">Iniciar Sesión</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.getElementById("loginButton").addEventListener("click", function() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
         // solicitud AJAX  ------- obj XMLHttpRequest
        var xhr = new XMLHttpRequest();
        //solicitud post al archivo verificar 
        xhr.open("POST", "login/verificarLoginDoc.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//enviaremos un formulario
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Verificar respuesta
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // si es correcto rediccionamos a nuestra vista doctor
                        window.location.href = "vistaDoctor/HomeDoctor.php";
                    } else {
                        //mostrar un alert si es incorrecto
                        alert("Usuario o contraseña incorrectos.");
                    }
                } else {
                    // otros errores
                    alert("Error al iniciar sesión. Por favor, inténtalo de nuevo más tarde.");
                }
            }
        };
        //enviamos el nombre y la contraseña, lo usare en la vista doctor para hacer un "BIENVENIDO DOCTOR "NOMBRE_QUE_SE_GUARDO""
        xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
    });
  </script>
</body>
</html>
