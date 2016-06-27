<?php
/**
 * src/pocketmine/entity/AttributeManager.php
 *
 * @package default
 */
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
namespace pocketmine\entity;
use pocketmine\Player;
class AttributeManager
{
    const MAX_HEALTH = 0;
    const MAX_HUNGER = 1;
    const EXPERIENCE = 2;
    const EXPERIENCE_LEVEL = 3;
    const MOVEMENTSPEED = 4;
    /** @var Attribute[] */
    protected $attributes = [];
    /** @var Player */
    protected $player;
    /**
     *
     * @param unknown $player
     */
    public function __construct($player)
    {
        $this->player = $player;
    }
    /**
     *
     */
    public function init()
    {
    
	}
    /**
     *
     * @return unknown
     */
    public function getPlayer()
    {
        
    }
    /**
     *
     * @param int     $id
     * @param string  $name
     * @param float   $minValue
     * @param float   $maxValue
     * @param float   $defaultValue
     * @param bool    $shouldSend   (optional)
     * @return Attribute
     */
    public function addAttribute($id, $name, $minValue, $maxValue, $defaultValue, $shouldSend = false)
    {
       
    }
    /**
     *
     * @param unknown $id
     * @return null|Attribute
     */
    public function getAttribute($id)
    {
        
    }
    /**
     *
     * @param unknown $name
     * @return null|Attribute
     */
    public function getAttributeByName($name)
    {
        
    }
    /**
     *
     */
    public function sendAll()
    {
        
    }
    /**
     *
     */
    public function resetAll()
    {
        
    }
}