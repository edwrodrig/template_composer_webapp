<?php
declare(strict_types=1);

namespace tpl_company_tpl\tpl_project_tpl\model;

class CsvParser {

    public static function getLocationFromFile($filename) {
        $file = fopen($filename, 'r');

        $location = [];
        while ( $line = fgets($file)) {
            if (!isset($location['lat'])) {
                if ($lat = self::getLatitudeFromLine($line)) {
                    $location['lat'] = $lat;
                }
            } else if (!isset($location['lng'])) {
                if ($lon = self::getLongitudeFromLine($line)) {
                    $location['lng'] = $lon;
                }
            } else {
                break;
            }
        }
        fclose($file);
        return $location;
    }

    public static function getDataFromFile($filename) {
        $file = fopen($filename, 'r');

        $data = [];
        while ( $line = fgets($file)) {
            if ( $lineData = self::getDataFromLine($line) ) {
                $data[] = $lineData;
            }
        }
        fclose($file);
        return $data;
    }


    /**
     * MUST MATCH         % Latitude : -23.8208
     * @param string $line
     * @return null
     */
    public static function getLatitudeFromLine(string $line)
    {
        if (preg_match("/^%\s*Latitude\s*:\s*(-?\d{1,2}\.\d{1,4})\s*$/", $line, $matches)) {
            return floatval($matches[1]);
        }
        return null;
    }

    /**
     * MUST MATCH % Longitude : -70.8361
     * @param string $line
     * @return null
     */
    public static function getLongitudeFromLine(string $line) {
        if ( preg_match("/^%\s*Longitude\s*:\s*(-?\d{1,2}\.\d{1,4})\s*$/", $line, $matches)) {
            return floatval($matches[1]);
        }
        return null;
    }

    public static function getDataFromLine(string $line) : ?array {
        if ( $line[0] === "%" )
            return null;

        $cleanLine = preg_replace("/\s+/", "", $line);
        return explode(",", $cleanLine);
    }
}
