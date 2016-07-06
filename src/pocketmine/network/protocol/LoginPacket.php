<?php

/*
 *
 *  _                       _           _ __  __ _
 * (_)                     (_)         | |  \/  (_)
 *  _ _ __ ___   __ _  __ _ _  ___ __ _| | \  / |_ _ __   ___
 * | | '_ ` _ \ / _` |/ _` | |/ __/ _` | | |\/| | | '_ \ / _ \
 * | | | | | | | (_| | (_| | | (_| (_| | | |  | | | | | |  __/
 * |_|_| |_| |_|\__,_|\__, |_|\___\__,_|_|_|  |_|_|_| |_|\___|
 *                     __/ |
 *                    |___/
 *
 * This program is a third party build by ImagicalMine.
 *
 * PocketMine is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author ImagicalMine Team
 * @link http://forums.imagicalcorp.ml/
 *
 *
*/

namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>


class LoginPacket extends DataPacket
{
    const NETWORK_ID = Info::LOGIN_PACKET;
	public $username;
	public $protocol;
	public $clientUUID;
	public $clientId;
	public $identityPublicKey;
	public $serverAddress;
	public $skinID;
	public $skin = null;
	public function decode(){
		$this->protocol = $this->getInt();
		$str = zlib_decode($this->get($this->getInt()), 1024 * 1024 * 64); //Max 64MB
		$this->setBuffer($str, 0);
		$chainData = json_decode($this->get($this->getLInt()));
		foreach ($chainData->{"chain"} as $chain){
			$webtoken = $this->decodeToken($chain);
			if(isset($webtoken["extraData"])){
				if(isset($webtoken["extraData"]["displayName"])){
					$this->username = $webtoken["extraData"]["displayName"];
				}
				if(isset($webtoken["extraData"]["identity"])){
					$this->clientUUID = $webtoken["extraData"]["identity"];
				}
				if(isset($webtoken["identityPublicKey"])){
					$this->identityPublicKey = $webtoken["identityPublicKey"];
				}
			}
		}
		$skinToken = $this->decodeToken($this->get($this->getLInt()));
		if(isset($skinToken["ClientRandomId"])){
			$this->clientId = $skinToken["ClientRandomId"];
		}
		if(isset($skinToken["ServerAddress"])){
			$this->serverAddress = $skinToken["ServerAddress"];
		}
		if(isset($skinToken["SkinData"])){
			$this->skin = base64_decode($skinToken["SkinData"]);
		}
		if(isset($skinToken["SkinId"])){
			$this->skinId = $skinToken["SkinId"];
		}
	}
	public function encode(){
	}
	public function decodeToken($token){
		$tokens = explode(".", $token);
		list($headB64, $payloadB64, $sigB64) = $tokens;
		return json_decode(base64_decode($payloadB64), true);
	}
}
