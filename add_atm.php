<?php
    // Verifica si los campos del formulario están definidos en $_POST
    if (isset($_POST['title']) && isset($_POST['notes']) && isset($_POST['lat']) && isset($_POST['lng'])) {
        // Obtén los datos del formulario
        $title = $_POST['title'];
        $notes = $_POST['notes'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];

        // Carga los datos actuales del archivo JSON
        $jsonData = file_get_contents(__DIR__ . '/locations.json');

        // Verifica si el archivo JSON existe
        if ($jsonData !== false) {
            $data = json_decode($jsonData, true);

            if ($data !== null) {
                // Genera un nuevo objeto JSON
                $newATM = [
                    'id' => uniqid(),
                    'type' => 'ATMs',
                    'timestamp' => date('c'),
                    'title' => $title,
                    'notes' => $notes,
                    'lat' => floatval($lat),
                    'lng' => floatval($lng)
                ];

                // Agrega el nuevo objeto al array de datos
                $data[] = $newATM;

                // Convierte el array de datos nuevamente a formato JSON
                $newJsonData = json_encode($data, JSON_PRETTY_PRINT);

                if ($newJsonData !== false) {
                    // Escribe los datos en el archivo JSON
                    if (file_put_contents(__DIR__ . '/locations.json', $newJsonData) !== false) {
                        // Redirige al usuario de vuelta a la página principal
                        header('Location: index.html');
                        exit;
                    } else {
                        // Error al escribir en el archivo JSON
                        echo 'Error al escribir en el archivo JSON.';
                    }
                } else {
                    // Error al convertir datos a JSON
                    echo 'Error al convertir datos a JSON.';
                }
            } else {
                // Error al decodificar JSON
                echo 'Error al decodificar JSON.';
            }
        } else {
            // Error al cargar el archivo JSON
            echo 'Error al cargar el archivo JSON.';
        }
    } else {
        // Campos del formulario faltantes
        echo 'Faltan campos en el formulario.';
    }

?>
