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
namespace OCA\AccessStats\AppInfo;

use \OCP\AppFramework\App;
use \OCA\AccessStats\Hooks;

\OCA\AccessStats\Hooks::registerHooks();
\OCP\App::registerAdmin('accessstats','admin');

