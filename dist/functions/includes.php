<?php

    /**
     * includes functions
     * v1.0.0
     * this functions make includes all files from specific directory (dynamic)
     */

    // 1 - includes all css file
    function includesAllCss() {

        $files = glob(layout . "css/*.css", GLOB_BRACE);

        $output = "";

        foreach($files as $file) {

            $output .= "<link rel='stylesheet' href=". $file ." >";

        }

        return $output;

    }

?>