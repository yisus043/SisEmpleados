<?php
$tema = $_POST['tema'];
$fecha_inicio = $_POST['fecha_inicio'];
$hora_inicio = $_POST['hora_inicio'];
$duracion = $_POST['duracion'];

// Configuración de la API de Zoom
$zoom_api_key = 'PlhlH68NTNq1N6uXoYd01w';
$zoom_api_secret = 'tiEL12qF4oQ9nWm94Zb4deRW2ZEwMCMRUfM0';

// Verificar si existe una reunión a la misma hora
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.zoom.us/v2/users/me/meetings');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . generate_jwt_token($zoom_api_key, $zoom_api_secret),
    'Content-Type: application/json'
));
$response = curl_exec($ch);
curl_close($ch);

$datos_reuniones = json_decode($response);
$reunion_existente = false;
foreach ($datos_reuniones->meetings as $reunion) {
    $start_time = strtotime($reunion->start_time);
    $end_time = strtotime("+" . $reunion->duration . " minutes", $start_time);
    $new_start_time = strtotime($fecha_inicio . ' ' . $hora_inicio . ':00');
    $new_end_time = strtotime("+" . $duracion . " minutes", $new_start_time);
    if (($new_start_time >= $start_time && $new_start_time < $end_time) || 
        ($new_end_time > $start_time && $new_end_time <= $end_time) ||
        ($new_start_time <= $start_time && $new_end_time >= $end_time)) {
        $reunion_existente = true;
        break;
    }
}
// Crear la reunión en Zoom o mostrar un mensaje de error si ya existe una reunión a la misma hora
if ($reunion_existente) {
    echo '<script>alert("Ya existe una reunión programada para la hora y fecha indicadas con el mismo tema.");</script>';
} else {
    $start_time = $fecha_inicio . 'T' . $hora_inicio . ':00';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.zoom.us/v2/users/me/meetings');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . generate_jwt_token($zoom_api_key, $zoom_api_secret),
        'Content-Type: application/json'
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
        'topic' => $tema,
        'type' => 2,
        'start_time' => $start_time,
        'duration' => $duracion,
        'timezone' => 'America/Edmonton'
    )));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Nueva línea
    curl_close($ch);

    // Mostrar el enlace de acceso a la reunión o mensaje de error si no se pudo crear
    if ($httpCode != 201) {
        echo '<script>alert("No se pudo crear la reunión. Por favor, intente de nuevo más tarde.");</script>';
    } else {
        $datos_reunion = json_decode($response);
        $enlace_reunion = $datos_reunion->join_url;
        echo 'La reunión "' . $tema . '" ha sido creada. Puede acceder a ella en el siguiente enlace: <a href="' . $enlace_reunion . '">' . $enlace_reunion . '</a>';
    }
}

// Función para generar el token JWT para la autenticación en la API de Zoom
function generate_jwt_token($api_key, $api_secret) {
    $header = base64_encode(json_encode(array('alg' => 'HS256', 'typ' => 'JWT')));
    $payload = base64_encode(json_encode(array('iss' => $api_key, 'exp' => time() + 3600)));
    $signature = hash_hmac('sha256', $header . '.' . $payload, $api_secret, true);
    $signature_base64 = base64_encode($signature);
    return $header . '.' . $payload . '.' . $signature_base64;
}










use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  // Incluye el archivo autoload.php de PHPMailer
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';



// Configurar PHPMailer
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host       = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'contacto@bechapra.com'; // Cambiar por tu correo electrónico
$mail->Password = ''; // Cambiar por tu contraseña
$mail->setFrom('contacto@bechapra.com', 'contacto@bechapra.com'); // Cambiar por tu nombre y tu correo electrónico
$mail->addAddress('contacto@bechapra.com'); // Cambiar por el correo electrónico al que quieres enviar el mensaje
$mail->Subject = 'Enlace de la reunion Zoom'; // Asunto del mensaje
$mail->Body = 'Has creado una reunión desde bechapra.com/zoom. La reunión "' . $tema . '" ha sido creada. Puede acceder a ella en el siguiente enlace: ' . $enlace_reunion; // Contenido del mensaje

// Enviar el mensaje
if (!$mail->send()) {
    echo '<script>alert("No se pudo enviar el mensaje. Por favor, intente de nuevo más tarde.");</script>';
} else {
    echo '<script>alert("El mensaje ha sido enviado.");</script>';
}


?>
