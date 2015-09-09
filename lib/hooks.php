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
namespace OCA\AccessStats;
use OCP\IDBConnection;

class Hooks {

    public static function registerHooks() {
	
	\OCP\Util::connectHook('OC_Filesystem', 'read', 'OCA\AccessStats\Hooks', 'logRead');
    }
    
    public static function logRead($params){
        //LOG: user, path, time
	
       // $logstring = \OCP\User::getUser().", ".$params['path'].", ".date("d-m-Y H:i:s");
        
        $sql = "insert into `*PREFIX*accessstats_items` (`username`,`path`,`time`) values (?,?,?)";
        \OCP\DB::beginTransaction();
	
        $query =\ OCP\DB::prepare($sql);
        $result = $query->execute(array(\OCP\User::getUser(), $params['path'], time()));

        \OCP\DB::commit();
	
    }
}
