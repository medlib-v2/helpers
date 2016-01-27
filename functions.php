<?php


if (! function_exists('cleanIsbn')) {

    /**
     * @param $isbn
     * @param array $replace
     * @param string $delimiter
     * @return mixed|string
     */
    function cleanIsbn($isbn, $replace = [], $delimiter='') {

        if( !empty($replace) ) {
            $str = str_replace((array)$replace, '', $isbn);
        }

        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, trim($clean, '-'));

        return $clean;
    }
}

if (! function_exists('image_matirial')) {

    /**
     * @param $isbn
     * @param array $replace
     * @param string $delimiter
     * @return mixed|string
     */
    function image_matirial($material) {

        $url = null;

        if($material == "Unknown"){

            $url = url('images/icon_unknown_16x16.png');

        } elseif($material == "Visual") {

            $url = url('images/icon_per_16x16.gif');

        } elseif($material == "Music CD") {

            $url = url('images/24/audio-cd.png');

        } elseif($material == "VHS (1/2 in., videocassette)") {

            $url = url('images/icon_vhs_16x16.png');
        }
        return $url;
    }
}