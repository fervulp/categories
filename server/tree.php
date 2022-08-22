<?php 
    // header("Access-Control-Allow-Origin: http://localhost:3000");
    header('Content-type: application/json');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: POST, PUT, DELETE, GET");

    require_once 'apiWithDB/connect.php'; // get function which connect with base

    $link = connection();
    $method = $_SERVER['REQUEST_METHOD'];

    $fromClient = json_decode(file_get_contents("php://input"), true); // if client use fetch 
    $_GET = !empty($fromClient) ? $fromClient : $_GET;

    $id = !ctype_digit($_GET['id']) || $_GET['id'] <= 0 ? null: (int) $_GET['id']; // only int and not 0
    $title = mb_strlen($_GET['title']) > 255 || !preg_match("/^[А-ЯЁA-Z0-9\-_,.() ]+$/", mb_strtoupper($_GET['title']) ) ? null : mysqli_real_escape_string($link, trim($_GET['title'])) ;  // if text more than 255 characters and exist invalid character
    $parentId = !ctype_digit($_GET['parentId']) || $_GET['parentId'] < 0 ? null : (int) $_GET['parentId']; // only int and 0
        
    $result = 'ERROR';

    switch ($method) {
        case ("GET"): 
            require_once "apiWithDB/show.php"; // get function which show records from base
            if ( is_null($id) ) 
                $result = showRecordsFromBase($link, 0); // return JSON format
            else
                $result = showRecordsFromBase($link, $id);
            break;

        case ("POST"):
            require_once "apiWithDB/change.php"; // get function which change record in base
            if ( !is_null($id) && !is_null($title) && !is_null($parentId)) 
                $result = changeRecordInBase($link, 0, $id, $title, $parentId);

            else if ( !is_null($id) && !is_null($title) && is_null($parentId) ) 
                $result = changeRecordInBase($link, 1, $id, $title, null);

            else if ( !is_null($id) && is_null($title) && !is_null($parentId)) 
                $result = changeRecordInBase($link, 2, $id, null, $parentId );
            else 
                $result = http_response_code(404);
            break;

        case ("PUT"):
            if ( !is_null($title) && !is_null($parentId)) {
                require_once "apiWithDB/add.php"; // get function which add record in base
                $result = addRecordInBase($link, $title, $parentId);
            }
            else 
                $result = http_response_code(404);
            break;

        case ("DELETE"):
            if (!is_null($id)) {
                require_once "apiWithDB/delete.php"; // get function which delete record from base
                $result = deleteRecordFromBase($link, $id);
            }
            else 
                $result = http_response_code(404);
            break;
    }
    print_r($result);
?>

