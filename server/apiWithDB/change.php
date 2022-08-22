<?php
    function changeRecordInBase($link, $mode, $id, $title, $parentId) {
        $queries = [
            0 => "UPDATE category SET title = ?, parentId = ? WHERE id = ?",
            1 => "UPDATE category SET title = ? WHERE id = ?",
            2 => "UPDATE category SET parentId = ? WHERE id = ?",
        ]; 

        if ( $mode == '0' || $mode == '2' && $parentId != '0') { // if parentId not exist get error 
            $resultSelect = $link -> prepare("SELECT `id` FROM `category` WHERE `id` = ? LIMIT 1");
            $resultSelect->bind_param('i', $parentId);
            $resultSelect->execute();
            if ( !mysqli_num_rows($resultSelect->get_result()) ) {
                return http_response_code(404);
            } 
        }

        $resultSelect = $link -> prepare("SELECT `id` FROM `category` WHERE `id` = ? LIMIT 1"); // if id not exist get error 
        $resultSelect->bind_param('i', $id);
        $resultSelect->execute();
        if ( !mysqli_num_rows($resultSelect->get_result()) ) {
            return http_response_code(404);
        }


        $resultSelect = $link->prepare($queries[$mode]);
        switch ($mode) {
            case (0):
                $resultSelect->bind_param('sii', $title, $parentId, $id);
                break;
                
            case (1):
                $resultSelect->bind_param('si', $title, $id);
                break;

            case (2):
                $resultSelect->bind_param('si', $parentId, $id);
                break;
            }
        $resultSelect->execute();
        return json_encode( $resultSelect->get_result() );
    }   
?>