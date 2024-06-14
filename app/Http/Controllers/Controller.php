<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

date_default_timezone_set('Asia/Ho_Chi_Minh');

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function priceSaleProduct($price, $sale)
    {
        $p = ($price * ($sale / 100)); //Discount price
        $stl = strlen($p); //The length of the discounted Price
        $d = 1; //dividend
        for ($i = 1; $i < $stl; $i++) {
            $d = $d . "0";
        }
        $p2 = ceil($p / $d) * $d; //Discounted original price
        return $price - $p2;
    }
    function roundDown($number)
    {
        if ($number <= 0) {
            return 0;
        }
        $stl = strlen($number); //The length of the discounted Price
        $numberAsString = (string) $number;

        // Get the first character of the string
        $firstDigit = $numberAsString[0];
        for ($i = 4; $i < $stl; $i++) {
            $firstDigit = $firstDigit . "0";
        }
        return (int) $firstDigit;
    }
    function roundUp($number)
    {
        if ($number <= 0) {
            return 0;
        }

        $stl = strlen($number); //The length of the discounted Price
        $numberAsString = (string) $number;

        // Get the first character of the string
        $firstDigit = $numberAsString[0] + 1;
        for ($i = 4; $i < $stl; $i++) {
            $firstDigit = $firstDigit . "0";
        }
        return (int) $firstDigit;
    }

    function vn_to_str($str)
    {

        $unicode = array(

            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd' => 'đ',

            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i' => 'í|ì|ỉ|ĩ|ị',

            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D' => 'Đ',

            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach ($unicode as $nonUnicode => $uni) {

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

        return $str;
    }

    function link_slug($str)
    {
        $pattern = array('/\+/', '/\?/', '/\-/', '/\*/', '/\!/', '/\[/', '/\]/', '/\^/', '/\$/', '/\(/', '/\)/', '/\{/', '/\}/', '/\=/', '/\|/', '/\</', '/\>/', '/\./', '/\:/', '/\#/', '/\'/', '/\"/', '/\,/', '/\%/', '/\_/');
        $str = $this->vn_to_str($str);
        $str = str_replace("/", "", $str);
        $str = preg_replace($pattern, ' ', $str);
        $str = preg_replace('/\s\s+/', ' ', $str);
        $str = strtolower(str_replace(" ", "-", $str));
        return $str;
    }
}
