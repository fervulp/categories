<?php
function showRecordsFromBase($link, $id=0) {

    $resultSelect = $link -> prepare("SELECT `id` FROM `category` WHERE `id` = ? LIMIT 1");
    $resultSelect->bind_param('i', $id);
    $resultSelect->execute();
    if ( !mysqli_num_rows($resultSelect->get_result()) ) {
        $id = 0;
    }


    $response = array();
    $query = "SELECT * FROM category ЦРУ";
    $query = mysqli_query($link, $query) ;
    
    while ($row = mysqli_fetch_assoc($query)) {
        $response[$row['id']] = $row;
        $response[$row['id']]['child'] = [];
    } // get all base with id title parentId

    foreach ( $response as $el) {
        if ($el['parentId']) {
            $response[ $el['parentId'] ]['child'][$el['id']] = [];
            
        }
    }

    $selectArray = array_filter( $response , function($value) use ($id) {
        return $value['parentId'] == "{$id}";

    }, ARRAY_FILTER_USE_BOTH ); // get array with we will start JSON


    $GLOBALS['response'] = $response;

    $JSON = [];

    function addInJSONresponse($idElement, &$JSON) {
        $JSON[$idElement] = $GLOBALS['response'][$idElement];
        $childMassive = &$JSON [$idElement]['child'];

        if ( $GLOBALS['response'][$idElement]['child'] ) {
            foreach (array_keys( $GLOBALS['response'][$idElement]['child'] ) as $idChild) {
                addInJSONresponse($idChild, $childMassive);
            }
        }
    }

    foreach ( array_keys( $selectArray ) as $idElement) {
        addInJSONresponse($idElement, $JSON);
    }

    $result = json_encode($JSON);
    echo $result;
}

?>