<?php

    Class Contrasena {
        function hash($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }
        function verify($password, $hash) {
            //echo $password . "    \n";
            //echo $hash . "    \n";
            return password_verify($password, $hash);
        }
    }

?>
