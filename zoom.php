<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Zoom</title>
  <style>
    body {
      background-color: #091f52;
    }
    .container {
      max-width: 500px;
      margin: 0 auto;
    }
   form {
  border: 2px solid #253698;
  padding: 20px;
  background-color: #0076ff;
  font-size: 28px;
}
.zver {
  background-color: white;
}

 .a1 {
    float: left;
    width: 50%;
  }
  .a2 {
    float: left;
    width: 50%;
  }
   .zver {
    clear: both;
  }
  </style>
</head>
<body>

<div class="a">
  <center>
    <img src="https://bechapra.com/wp-content/uploads/2021/07/logotipo-bechapra.png" alt="Logo de Bechapra">
    <h1 style="color: white;">Crear una reunión de Zoom para Bechapra (contacto@bechapra.com)</h1>
    <div class="container">
       <form action="reunion.php" method="post">
        <label for="tema">Titulo de la reunión:</label>
        <input type="text" id="tema" name="tema" required><br><br>
        <label for="fecha_inicio">Fecha:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required><br><br>
        <label for="hora_inicio">Hora de inicio:</label>
        <input type="time" id="hora_inicio" name="hora_inicio" required><br><br>
        <label for="duracion">Duración (minutos):</label>
        <input type="number" id="duracion" name="duracion" min="1" max="120" required><br><br>
        <p style="color: white;font-size: 14px;">No mas de 45 minutos en version libre</p>
        <input type="submit" value="Crear reunión">
      </form>
        </div>



  </center>
</div>


</body>
</html>
<br>
<div class="zver">
  <center>
      <h1 style="color: black;">Lista de reuniones para contacto@bechapra.com</h1>
      </center>
        <?php



include 'ver.php';



?>
</div>