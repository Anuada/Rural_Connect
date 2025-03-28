<?php

class Misc
{
    public function lastIndex($string)
    {
        $stringCount = strlen($string);
        $i = $stringCount - 1;
        return $string[$i];
    }

    public function url($route = null, $fragments = null)
    {
        $http_protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $project_folder = basename(dirname(__DIR__));
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestPathFrag = $_SERVER['REQUEST_URI'];

        if ($route != null) {
            if ($host == 'localhost' || filter_var($host, FILTER_VALIDATE_IP)) {
                return $http_protocol . '://' . $host . '/' . $project_folder . '/' . $route;
            }
            return $http_protocol . '://' . $host . '/' . $route;
        } elseif ($fragments != null && $fragments == true) {
            return $http_protocol . "://" . $host . $requestPathFrag;
        }
        return $http_protocol . "://" . $host . $requestPath;
    }

    public function uploadImage($file, $filename, $filedir)
    {
        $img_name = $filename . ".png";
        $img_file = $filedir . $img_name;
        move_uploaded_file($file["tmp_name"], $img_file);

        return $img_file;
    }

    public function generateUUID()
    {
    // Generate 16 random bytes
    $data = random_bytes(16);

    // Set the version to 0100 (version 4)
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set the variant to 10xx (RFC 4122)
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Format the bytes as a UUID string
    return sprintf(
        '%s-%s-%s-%s-%s',
        bin2hex(substr($data, 0, 4)),
        bin2hex(substr($data, 4, 2)),
        bin2hex(substr($data, 6, 2)),
        bin2hex(substr($data, 8, 2)),
        bin2hex(substr($data, 10, 6))
    );
    }

    public static function displayEnums(array $enums)
    {
        return array_column($enums, 'value');
    }
}