<?php

class Wao_Forpix_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * @author shev <shevn@i.ua>
     * @param type $file_input /оригинал
     * @param type $file_output /уменьшенная копия
     * @param type $nwidth / новая ширина
     * @param type $nheight / новая висота
     * @param type $quality / качество
     * @return boolean
     * @todo резайз aнимированых gif
     */
    public function imgresize($file_input, $file_output, $nwidth, $nheight = false, $quality = 100) {
        if (!file_exists($file_input))
            return false;

        if (file_exists($file_output))
            return true;

        $img_info = getimagesize($file_input);

        if ($img_info === false)
            return false;


        list($width, $height) = $img_info;

        $nwidth = ($nwidth > $width) ? $width : $nwidth;
        $nheight = ($nheight > $height) ? $height : $nheight;

        if (!$nheight) {
            $nheight = round($nwidth * $height / $width);
        } elseif (!$nwidth) {
            $nwidth = round($nheight * $width / $height);
        }

        $k = (($width < $nwidth && $height < $nheight) ? 1 : max($nwidth / $width, $nheight / $height));
        $size = array('width' => (int) ($width * $k), 'height' => (int) ($height * $k));

        $type = substr(strrchr($img_info['mime'], '/'), 1);
        $funcImagecreatefrom = "imagecreatefrom" . $type;

        if (!function_exists($funcImagecreatefrom))
            return false;

        $source = $funcImagecreatefrom($file_input);

        if ($source === false)
            return (false);

        $thumb = imagecreatetruecolor($nwidth, $nheight);
        imagealphablending($thumb, false);
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $size['width'], $size['height'], $width, $height);
        imagesavealpha($thumb, true);

        switch ($type) {
            case 'pjepg':
            case 'jpeg':
            case 'jpg':
                imagejpeg($thumb, $file_output, $quality);
                break;

            case 'gif':
            case 'png':
                imagepng($thumb, $file_output);
                break;
        }
        imagedestroy($thumb);
        imagedestroy($source);
        return (true);
    }

    public function html2rgb($color) {
        if ($color[0] == '#')
            $color = substr($color, 1);

        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0] . $color[1],
                $color[2] . $color[3],
                $color[4] . $color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        else
            return false;

        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);



        $red = round(round(($r / 0x33)) * 0x33);
        $green = round(round(($g / 0x33)) * 0x33);
        $blue = round(round(($b / 0x33)) * 0x33);
        $thisRGB = sprintf('%02X%02X%02X', $red, $green, $blue);



        return $thisRGB;
    }

    public function sizewh($sizewh) {

        switch ($sizewh) {
            case '1':

                $w = 4000;
                $h = 3000;
                break;

            case '2':

                $w = 4000;
                $h = 2600;
                break;
            case '3':

                $w = 3840;
                $h = 2400;
                break;
            case '4':

                $w = 3200;
                $h = 2048;
                break;
            case '5':

                $w = 2560;
                $h = 2048;
                break;
            case '6':

                $w = 2880;
                $h = 1800;
                break;
            case '7':

                $w = 2560;
                $h = 1600;
                break;
            case '8':

                $w = 2560;
                $h = 1440;
                break;
            case '9':

                $w = 1920;
                $h = 1200;
                break;
            case '10':

                $w = 1920;
                $h = 1080;
                break;

            case '11':

                $w = 1680;
                $h = 1050;
                break;
            case '12':

                $w = 1600;
                $h = 1200;
                break;
            case '13':

                $w = 1600;
                $h = 900;
                break;
            case '14':

                $w = 1440;
                $h = 900;
                break;
            case '15':

                $w = 1366;
                $h = 768;
                break;
            case '16':

                $w = 1280;
                $h = 1024;
                break;
            case '17':

                $w = 1280;
                $h = 800;
                break;
            case '18':

                $w = 1024;
                $h = 768;
                break;
            case '19':

                $w = 1024;
                $h = 1024;
                break;
            case '20':

                $w = 1024;
                $h = 600;
                break;
            case '21':

                $w = 960;
                $h = 800;
                break;
            case '22':

                $w = 640;
                $h = 480;
                break;
            case '23':

                $w = 480;
                $h = 272;
                break;
            case '24':

                $w = 320;
                $h = 240;
                break;
            default:
                return FALSE;
        }
        return array('w' => $w, 'h' => $h);
    }

    function translitIt($str) {
        $tr = array(
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
            "Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
            "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
            "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
            "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
            "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
            "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "e", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "_", "/" => "_", "\\" => "_", "'" => "_", "\"" => "_", "(" => "", ")" => "", "." => "",
            "+" => "", "*" => "", "&" => "_"
        );
        return strtr($str, $tr);
    }

}