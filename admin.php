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

\OCP\App::checkAppEnabled('accessstats');
OC_Util::checkAdminUser();
\OCP\Util::addScript('accessstats', 'accessstats_admin'); 

$tpl = new OCP\Template("accessstats", "accessstats_admin");
$tpl->assign('title', "File Access Statistics Download");

return $tpl->fetchPage();