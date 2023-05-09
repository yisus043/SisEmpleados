<center>
<img src="https://i2.wp.com/bechapra.com/wp-content/uploads/2021/07/logotipo-bechapra.png?fit=360%2C120&ssl=1" alt="Italian Trulli">
</center>
		
<meta http-equiv="content-type" content="text/html; utf-8">
<?php


include 'funciones.php';



csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
  
  
}

if (isset($_POST['submit'])) {
  $resultado = [
    
    'error' => false,
   
  
  
  ];



  $config = include 'config.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $prospectos = [
    
     "username"    => $_POST['username'],
     
     
     
        "email"    => $_POST['email'],
        "password"    => $_POST['password'],
        "role"    => $_POST['role'],
        "dato1"    => $_POST['dato1'],
        "dato2"    => $_POST['dato2'],
        "dato3"    => $_POST['dato3'],
        "dato4"    => $_POST['dato4'],
        "dato5"    => $_POST['dato5'],
        "dato6"    => $_POST['dato6'],
        "dato7"    => $_POST['dato7'],
        "dato8"    => $_POST['dato8'],
        "dato9"    => $_POST['dato9'],
        "dato10"    => $_POST['dato10'],
   
        "dato13"    => $_POST['dato13'],
        "responsable" => $_POST['responsable'],
        "fecha"    => $_POST['fecha'],
   

      
    ];
  

    $consultaSQL = "INSERT INTO informacion ( username, email, password, role, 
    dato1, dato2, dato3, 
    dato4, dato5, dato6, dato7, dato8, dato9, dato10,
    dato13, responsable, fecha  )";
    $consultaSQL .= "values (:" . implode(", :", array_keys($prospectos)) . ")";

    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute($prospectos);







  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
  
  
$nombre = $_POST['responsable'];
$dato1 = $_POST['dato1'];
$dato5 = $_POST['dato5'];
$dato9 = $_POST['dato9'];
$dato7 = $_POST['dato7'];



$message =

"<font face=Arial, Helvetica, sans-serif size=2 em>





<h2>Aviso por Email:<h2/>
<br>

<p>Un usuario ha registrado un nuevo prospecto, con los siguientes detalles:</p>
<br>


<h5>Cargado por:&nbsp;&nbsp;&nbsp;&nbsp; $nombre<br />
Nombre del prospecto:&nbsp;&nbsp;&nbsp;&nbsp; $dato1<br />
Email del prospecto:&nbsp;&nbsp;&nbsp;&nbsp; $dato5<br />
Estado inicial:&nbsp;&nbsp;&nbsp;&nbsp; $dato9<br />
Fuente inicial:&nbsp;&nbsp;&nbsp;&nbsp; $dato7<br />
</h5>





<p>$mensaje</p>

</font>";

$email = 'prospectos@plataforma.bechapra.com';
$asunto = 'Nuevo Prospecto';
$cabeceras = "From: support@plataforma.bechapra.com \r\nContent-type: text/html\r\n";

mail($email,$asunto,$message,$cabeceras);
  
}




?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>





<?php
if (isset($resultado)) {
  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        </div>
        </div>
        <p>Seras redirigido en un momento .....</p>
    <script>
        var timer = setTimeout(function() {
            window.location='usuarios_portada.php'
        }, 1000);
    </script>
      </div>
    </div>
  </div>
  <?php
}
?>



<style>
.btnazul {
    cursor: pointer;
    font-size: 17px;
    color: #fff;
    background-color: #18395c;
    border-color: #007bff;
}
a.btn.btn-primary.btnazul.aazul {
    text-decoration: none;
    padding-top: 1px;
    border: 2px solid #000;
    border-color: #007bff;
    padding-bottom: 1px;
    font-size: 18px;
    font-family: sans-serif;
}

.desaparecer {
    display: none;
}

  </style>



<div class="container">
  <div class="row">
    <div class="col-md-12">
        <div class="desaparecer">
        </div>

   
      
      <form method="post">

     



      <center>
        
        <h2 class="mt-4">Guardar prospecto</h2>
      <hr style="border: 1px solid #18395c;">
      <br>

 
			


           <?php
$usuario = 'u';
$password = 'U';
$db = new PDO('mysql:host=127.0.0.1;dbname=u', $usuario, $password);
?>








<div class="form-group">



<div class="nover" style="
    margin-top: -90px;
">
<label style="
    display: none;
" for="prospecto">username</label>
          <input  style="
    display: none;
"type="text" name="username" id="username" class="form-control">

        </div>
        <br>


        <label style="
    display: none;
" for="prospecto">email</label>
          <input  style="
    display: none;
"type="text" name="email" id="email" class="form-control">
        </div>
        <br>



        <label style="
    display: none;
" for="prospecto">password</label>
          <input style="
    display: none;
" type="text" name="password" id="password" class="form-control">
    
        <br>


        <label style="
    display: none;
" for="prospecto">role</label>
          <input style="
    display: none;
" type="text" name="role" id="role" class="form-control">
    
        <br>

</div>
<center>





<div class="form-group">
          <label for="prospecto">Nombre prospecto:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="text" name="dato1" id="dato1" class="form-control">
        </div>
        <br>
</center>

<center>
        <div class="form-group">
          <label for="prospecto">Apellido prospecto:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="text" name="dato2" id="dato2" class="form-control">
        </div>
        <br>
</center>



<center>
        <div class="form-group">
          <label for="prospecto">Celular:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="number" name="dato3" id="dato3" class="form-control">
        </div>
        <br>
</center>



<center>
        <div class="form-group">
          <label for="prospecto">Télefono de casa:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;
    
          <input type="number" name="dato4" id="dato4" class="form-control">
        </div>
        <br>
</center>


<center>
        <div class="form-group">
          <label for="prospecto">Email:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;
          <input type="text" name="dato5" id="dato5" class="form-control">
        </div>
        <br>
</center>



<center>
        <div class="form-group">
          <label for="prospecto">Ciudad:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         
          <input type="text" name="dato6" id="dato6" class="form-control">
        </div>
        <br>
</center>


<center>
        <div class="form-group">
          <label for="prospecto">Fuente de prospecto:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          
          <select type="text" style="width:180px" name="dato7" id="dato7" width="20px" class="form-control">
  <option value="télefono">télefono</option>
  <option value="email">email</option>
  <option value="pagina web">pagina web</option>
  <option value="campañas">campañas</option>
</select>




        </div>
        <br>


    


</center>





<center>
        <div class="form-group">
          <label for="prospecto">Categoría:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
          <select type="text" style="width:180px" name="dato8" id="dato8" width="20px" class="form-control">
  <option value="vida">vida</option>
  <option value="gatos medicos">gatos medicos</option>
  <option value="daños">daños</option>
  <option value="autos">autos</option>
  <option value="ahorro">ahorro</option>
  <option value="protección y ahorro">protección y ahorro</option>
  <option value="flotillas">flotillas</option>
  <option value="retiro">retiro</option>
</select>
        </div>
        <br>
</center>


<center>
        <div class="form-group">
          <label for="prospecto">Estado:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;
          <select type="text" style="width:180px" name="dato9" id="dato9" width="20px" class="form-control">
  <option value="abierto">abierto</option>
  <option value="contactado">contactado</option>
  <option value="no interesado">no interesado</option>
  <option value="propuesta enviada">propuesta enviada</option>
  <option value="propuesta por enviar">propuesta por enviar</option>
  <option value="venta cerrada">venta cerrada</option>
  <option value="cita programada">cita programada</option>
  <option value="segunda llamada">segunda llamada</option>
</select>
        </div>
        <br>
</center>

<center>
        <div class="form-group">
          <label for="prospecto">Via de contacto:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;
          <select type="text" style="width:180px" name="dato10" id="dato10" width="20px" class="form-control">
  <option value="llamada">llamada</option>
  <option value="email">email</option>
  <option value="whatsapp">whatsapp</option>
  
</select>
        </div>
        <br>

</center>



<center>
        <div class="form-group">
          <label for="prospecto">Comentarios:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         
          <input type="text" name="dato13" id="dato13" class="form-control">
        </div>
        <br>
</center>


  

    <?php
$usuario = 'u';
$password = 'U';
$db = new PDO('mysql:host=127.0.0.1;dbname=u', $usuario, $password);
?>



<form method="post">
          <div class="form-group" style="text-align-last: center;">
      <div class="form-group">
          <label for="name">Encargado del prospecto:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
           

          <select name="responsable" id="responsable" style="width:180px" class="form-control selectvalores" >
          



<?php  

$query = $db->prepare("SELECT * FROM `responsable` where datos = '".$_SESSION['usuarios_login']."'    " );






$query->execute();
$data = $query->fetchAll();

foreach ($data as $valores):
 
echo '<option  value="'.$_SESSION['usuarios_login'].'" selected>'.$_SESSION['usuarios_login'].'</option readonly>';


endforeach;
?>
</select>
        </div>
<br>


</center>


<center>

        <div class="form-group">
          <label for="prospecto">Fecha:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="datetime" name="fecha"  value="<?php echo date("d-m-Y");?>" readonly>

        </div>
        <br>
</center>


</center>
       

        



<br><br>

<center>
        <div class="form-group">
          <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
          <input type="submit" name="submit" class="btn btn-primary btnazul" value="Guardar Prospecto">
         
          <a class="btn btn-primary btnazul aazul" href="usuarios_portada.php">Regresar al inicio</a>
        </div>








        
</div>


        </div>
<br>

       
</div>
<br><br>

   
      </form>
    </div>
  </div>
</div>



