<style>
  tr + tr {
    margin-top: 10px;
  }
</style>

<?php
date_default_timezone_set('America/Edmonton');



// Configuración de la API de Zoom
$zoom_api_key = 'PlhlH68NTNq1N6uXoYd01w';
$zoom_api_secret = 'tiEL12qF4oQ9nWm94Zb4deRW2ZEwMCMRUfM0';

// Obtener la lista de reuniones programadas
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.zoom.us/v2/users/me/meetings');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . generate_jwt_token($zoom_api_key, $zoom_api_secret),
    'Content-Type: application/json'
));
$response = curl_exec($ch);
curl_close($ch);



// Mostrar la tabla de reuniones programadas
$datos_reuniones = json_decode($response);
if(!empty($datos_reuniones->meetings)) {
    // Ordenar reuniones por fecha y hora, de más reciente a más antigua
    usort($datos_reuniones->meetings, function($a, $b) {
        return strtotime($b->start_time) - strtotime($a->start_time);
    });

    echo '<table>';
    echo '<tr><th>Tema</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Fecha y hora</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Duración</th><th>Enlace</th></tr>';
    foreach($datos_reuniones->meetings as $reunion) {
        echo '<tr>';
        echo '<td>' . $reunion->topic . '</td>';
         echo '<td>' ;
        echo '<td>' . date('Y-m-d H:i:s', strtotime($reunion->start_time)) . '</td>';
                echo '<td>' ;
        echo '<td>' . $reunion->duration . ' minutos</td>';
        echo '<td><a href="' . $reunion->join_url . '">' . $reunion->join_url . '</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No hay reuniones programadas.';
}


// Función para generar el token JWT para la autenticación en la API de Zoom
function generate_jwt_token($api_key, $api_secret) {
    $header = base64_encode(json_encode(array('alg' => 'HS256', 'typ' => 'JWT')));
    $payload = base64_encode(json_encode(array('iss' => $api_key, 'exp' => time() + 3600)));
    $signature = hash_hmac('sha256', $header . '.' . $payload, $api_secret, true);
    $signature_base64 = base64_encode($signature);
    return $header . '.' . $payload . '.' . $signature_base64;
}
?>
