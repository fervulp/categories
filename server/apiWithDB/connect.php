<?php
    function connection() {
        $server = "mariadb";
        $user = 'root';
        $password = 'root';
        $db = 'sandbox';
        
        $link = mysqli_connect($server, $user, $password, $db);
                    
        if (!$link) {
            die("ERROR: Cannot connect to database $db on server $server using user name $user".mysqli_connect_errno().", ".mysqli_connect_error().")");
            exit();
        }
        return $link;
    }

?>
