<?php
    function addRecordInBase($link, $title, $parentId) {
        $resultSelect = $link -> prepare("SELECT `id` FROM `category` WHERE `id` = ? LIMIT 1");
        $resultSelect->bind_param('i', $parentId);
        $resultSelect->execute();

        if ( mysqli_num_rows($resultSelect->get_result()) || $parentId == '0' ) {
            $resultSelect = $link->prepare("INSERT INTO category (title, parentId) VALUES (?, ?)");
            $resultSelect->bind_param('si', $title, $parentId);
            $resultSelect->execute();
            return json_encode( $resultSelect->get_result() );
        
        } else {
            return http_response_code(404);
        }
    }
?>