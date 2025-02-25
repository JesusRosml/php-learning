<?php
    // Se establece el encabezado de respuesta para indicar que el contenido es JSON
    header('Content-Type: application/json');

    // Los arreglos asociativos se converten en objetos cuando se transforman en objetos JSON
    $response = [
        'name' => 'Jess Meshee',
        'email' => 'jess.meshee@gmail.com',
        'language' => [ 'PHP', 'Python', 'JavaScript' ]
    ];

    // Obtiene el tipo de metodo
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'GET') {
        print json_encode($response); // Convierte en un objeto JSON

        exit(); // Detiene el codigo
    }

    http_response_code(405); // Devuelve el status de la petición
    print json_encode(['message' => 'Método no permitido']);
?>