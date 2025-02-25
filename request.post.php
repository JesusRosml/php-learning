<?php
    header('Content-Type: application/json');

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        print json_encode([
            'success' => false,
            'message' => 'Método no permitido'
        ]);

        exit();
    }

    // sirve para leer el contenido del cuerpo de la solicitud HTTP que en este caso es un JSON
    $request = file_get_contents( 'php://input', true );
    // El contenido se decodifica para convertirlos en un objeto php para su manipulación
    $data = json_decode( $request );

    /*
        Obtiene el último error ocurrido durante la decodificación de un string JSON con json_decode(),
        Esta función devuelve una constante que indica el tipo de error, como JSON_ERROR_NONE si no hubo errores.
    */
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        http_response_code( 400 );

        print json_encode([
            'success' => false,
            'message' => 'JSON inválido'
        ]);

        exit();
    }

    // isset() determina si una variable es declarada y es diferente a null
    if ( !isset( $data->nameCompleted ) || !isset( $data->email ) ) {
        http_response_code( 400 );

        print json_encode([
            'success' => false,
            'message' => 'Faltan campos requeridos'
        ]);

        exit();
    }

    // Accedemos de esta manera $data-property a las propiedades del objeto stdClass
    $nameCompleted = $data->nameCompleted;
    $email = filter_var( $data->email, FILTER_SANITIZE_EMAIL );

    if ( !$email ) {
        http_response_code( 400 );

        print json_encode([
            'success' => false,
            'message' => 'Email inválido'
        ]);

        exit();
    }

    http_response_code( 200 );
    print json_encode([
        'success' => true,
        'message' => 'Datos recibidos correctamente',
        'data' => [ $nameCompleted, $email ]
    ]);
?>