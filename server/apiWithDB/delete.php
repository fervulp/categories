<?php

    function deleteRecordFromBase($link, $id) {

        $resultSelect = $link -> prepare("SELECT `id` FROM `category` WHERE `id` = ? LIMIT 1"); // if id not exist get error
        $resultSelect->bind_param('i', $id);
        $resultSelect->execute();
        if ( !mysqli_num_rows($resultSelect->get_result()) ) {
            return http_response_code(404);
        }

    
        function delete($link, $id) {
            // delete id item
            $resultSelect = $link -> prepare("DELETE FROM category WHERE id = ?");
            $resultSelect->bind_param('i', $id);
            $resultSelect->execute();

            // check on exist child which we wiil delete
            $resultSelect = $link -> prepare("SELECT id FROM category WHERE parentId = ?");
            $resultSelect->bind_param('i', $id);
            $resultSelect->execute();
            $result = $resultSelect->get_result()->fetch_all() ;
            
            if (!$result) {
                return false;
            }
            // delete child of id item
            $resultSelect = $link -> prepare("DELETE FROM category WHERE parentId = ?");
            $resultSelect->bind_param('i', $id);
            $resultSelect->execute();

            foreach($result as $el) {
                delete($link, $el[0]);
            }
        }

        delete($link, $id);
        
    }
?>