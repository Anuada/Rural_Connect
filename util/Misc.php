<?php

$filePath1 = './vendor/autoload.php';
$filePath2 = '../vendor/autoload.php';

if (file_exists($filePath1)) {
    require_once $filePath1;
} elseif (file_exists($filePath2)) {
    require_once $filePath2;
} else {
    die("Error: File does not exist in both directories.");
}

use Doctrine\Inflector\InflectorFactory;

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

    public function generateRandomNumbers()
    {
        $randomNumbers = [];
        for ($i = 0; $i < 8; $i++) {
            $randomNumbers[] = random_int(0, 9);
        }

        return implode('', $randomNumbers);
    }

    public function json_response($data, $message, $code = 200)
    {
        header(header: "Content-Type: application/json");
        http_response_code($code);

        $response = [
            "message" => $message,
        ];

        if ($data !== null) {
            $response["data"] = $data;
        }

        return json_encode($response);
    }

    public function truncateSentence($sentence, $limit = 70)
    {
        if (strlen($sentence) <= $limit)
            return $sentence;

        $truncated = substr($sentence, 0, $limit);
        $lastSpace = strrpos($truncated, ' ');

        if ($lastSpace !== false) {
            $truncated = substr($truncated, 0, $lastSpace);
        }

        return "$truncated...";
    }

    public static function displayPageTitle($title, $icon, $marginLeft = '30px')
    {
        return "
        <div class='row align-items-center'>
            <div class='col-sm-auto' style='width: 10px'><i class='fas $icon'></i></div>
            <div class='col' style='margin-left: $marginLeft'><span>$title</span></div>
        </div>
        ";
    }

    public function formatListWithOxfordComma(array $items)
    {
        $count = count($items);

        if ($count === 1) {
            return $items[0];
        } elseif ($count === 2) {
            return $items[0] . ' and ' . $items[1];
        } else {
            $last = array_pop($items);
            return implode(', ', $items) . ', and ' . $last;
        }
    }

    public static function displayEnumNames(array $enums)
    {
        return array_column($enums, 'name');
    }

    public static function displayEnums(array $enums)
    {
        return array_column($enums, 'value');
    }

    public function pluralize(string $word)
    {
        $inflector = InflectorFactory::create()->build();
        return $inflector->pluralize($word);
    }

    public function displayDeliveryStatusColor($status) {
        switch ($status) {
            case 'To Deliver':
                return "<span class='text-info user-select-none'>$status</span>";
            
            case 'In Transit':
                return "<span class='text-primary user-select-none'>$status</span>";
            
            case 'Failed Delivery':
                return "<span class='text-danger user-select-none'>$status</span>";
            
            case 'Returned':
                return "<span class='text-warning user-select-none'>$status</span>";
            
            case 'Delivered':
                return "<span class='text-teal user-select-none'>$status</span>";
            
            case 'Partially Claimed':
                return "<span class='text-light-green user-select-none'>$status</span>";
            
            case 'Claimed':
                return "<span class='text-success user-select-none'>$status</span>";

            default:
                break;
        }
    }
    
}