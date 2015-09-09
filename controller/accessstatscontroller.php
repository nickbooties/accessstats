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
	
	$from_timestamp = strtotime($timeperiod->from_date);
	$to_timestamp= strtotime($timeperiod->to_date + 86400);
	
	$sql = 'SELECT id, time, username, path FROM `*PREFIX*accessstats_items` WHERE time >= ? and time <= ?';
	
	$query = \OCP\DB::prepare($sql);
	$result = $query->execute(array($from_timestamp, $to_timestamp));
	
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