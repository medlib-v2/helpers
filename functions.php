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

if(! function_exists('ISBN13toISBN10')){
    
    /**
     * @param $isbn
     * @return string
     */
    function ISBN13toISBN10($isbn) {

        if (strlen($isbn) !== 13)
            return $isbn;

        if (preg_match('/^\d{3}(\d{9})\d$/', $isbn, $m)) {
            $sequence = $m[1];
            $sum = 0;
            $mul = 10;
            for ($i = 0; $i < 9; $i++) {
                $sum = $sum + ($mul * (int) $sequence{$i});
                $mul--;
            }
            $mod = 11 - ($sum%11);
            if ($mod == 10) {
                $mod = "X";
            }
            else if ($mod == 11) {
                $mod = 0;
            }
            $isbn = $sequence.$mod;
        }
        return $isbn;
    }
}

if (! function_exists('image_matirial')) {

    /**
     * @param $material
     * @return string
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

if (! function_exists('getAmazonCover')){

    /**
     * @param $isbn
     * @return string
     */
    function getAmazonCover($isbn) {

        $isbn = ISBN13toISBN10(preg_replace('/[^\d]/','',$isbn));

        if($isbn != '') {

            $cover = 'https://images-eu.ssl-images-amazon.com/images/P/'.$isbn.'.MZZZZZZZ.jpg';

            try {
                list($width, $height, $type, $attr) = getimagesize($cover);
                if ($width == 1 and $height == 1) { $cover = asset('/images/no_book_cover.jpg'); }
            }
            catch (Exception $e) { $cover = asset('/images/no_book_cover.jpg'); }

        }
        else { $cover = asset('/images/no_book_cover.jpg');}

        return $cover;

    }
}
