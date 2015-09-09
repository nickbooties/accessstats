<?php
/**
 * ownCloud - accessstats
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Nick Booth <nicbooth@gmail.com>
 * @copyright Nick Booth 2014
 */
namespace OCA\AccessStats\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DownloadResponse;

class AccessStatsController extends Controller {

   
    public function getstats() {

        $timeperiod = json_decode($_POST['accessstats']);

        $from_timestamp = date("Y-m-d 0:0:0",strtotime($timeperiod->from_date));
        $to_timestamp= date("Y-m-d 23:59:59",strtotime($timeperiod->to_date));

        $sql = 'SELECT id, time, username, path FROM `*PREFIX*accessstats_items` WHERE time >= ? and time <= ?';

        error_log($from_timestamp);
        $query = \OCP\DB::prepare($sql);
        $query->bindparam(1,$from_timestamp);
        $query->bindparam(2,$to_timestamp);
        $result = $query->execute();
        $data =  "id,time,username,path\r\n";

        while($row = $result->fetchRow()) {
            $data .= "\"".$row['id']."\",\"".date("H:i:s d/m/Y",$row['time'])."\",\"".$row['username']."\",\"".$row['path']."\"\r\n";
        }

        header('Content-Description: File Transfer');

        //header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=access_report.csv');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($data));

        print($data);
        exit(0);

    }

}
