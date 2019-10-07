<?php


namespace Model\DataView;

use ApiHelper;
use Model;

class DataView extends Model
{
    public function writeStats($stats = '', $code = '') {
        if (!empty($stats)) {
            $url = 'http://ip-api.com/json';
//            $ipInfo = ApiHelper::getFromUrlCurl($url . '/' . $stats['ip']);
//            $ipInfo = json_encode($ipInfo);
            $sql = 'INSERT INTO links_plus (info, view_code)
                    VALUES ("'. $stats .'", "' . $code . '");';
            $dataWrite = $this->db->query($sql);
            if ($dataWrite) {
                return 'true';
            }
        }
    }

    public function getStats($code = '') {
        if (!empty($code)) {
            $sql = 'SELECT info FROM links_plus
                    WHERE view_code LIKE '. $code;
            $dataGet = $this->db->query($sql);
            if ($dataGet) {
                return $dataGet;
            }
        }
    }
}