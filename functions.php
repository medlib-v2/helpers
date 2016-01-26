<?php


if (! function_exists('cleanIsbn')) {
    /**
     * @param $isbn
     * @return mixed|string
     */
    function cleanIsbn($isbn) {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $isbn);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '', $clean);

        return $clean;
    }
}