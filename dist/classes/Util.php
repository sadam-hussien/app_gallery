<?php

    /**
     * utility
    */

    class Util {

        // this method for get the input value and sanitization it
        public function inputVal($str) {

            $data = trim($str);

            $data = stripslashes($data);

            $data = htmlspecialchars($data);

            return $data;

        }

        // this method for showing message
        public function msg($type, $content) {

            return "<div class='alert alert-".$type."'>".$content."</div>";

        }

    }

?>