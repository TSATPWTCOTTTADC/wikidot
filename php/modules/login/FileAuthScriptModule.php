<?php
/**
 * Wikidot - free wiki collaboration software
 * Copyright (c) 2008, Wikidot Inc.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * For more information about licensing visit:
 * http://www.wikidot.org/license
 * 
 * @category Wikidot
 * @package Wikidot
 * @version $Id$
 * @copyright Copyright (c) 2008, Wikidot Inc.
 * @license http://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License
 */

class FileAuthScriptModule extends SmartyModule {
	
	public function build($runData){
		$site = $runData->getTemp('site');
		// TODO: ControllerUtils
		$u = new UploadedFileFlowController();
		if($runData->getUser() && $site->getPrivate() && $u->userAllowed($runData->getUser(), $site)){
			$pwdomain = $site->getUnixName() . "." . GlobalProperties::$URL_UPLOAD_DOMAIN;
			$pwproto = ($_SERVER["HTTPS"]) ? "https" : "http";
			$pwurl = "$pwproto://$pwdomain/filesauth.php";
			
			$runData->contextAdd("usePrivateWikiScript", true);
			$runData->contextAdd("privateWikiScriptUrl", $pwurl);
		}
	}
	
}
