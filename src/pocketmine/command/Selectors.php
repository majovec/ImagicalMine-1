<?php

/**
 * src/pocketmine/command/Selectors.php
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

namespace pocketmine\command;
class Selectors {
    
    private $selectors = [];
    
    /*
    This is executed when executing a command
    param @content string
    */
    
    public function parse(string $content, $sender) : string {
        $selectors = $this->selectors;
        foreach($selectors as $name => $sel) {
            $content = $sel->parse($content, $sender);
        }
        return $content;
    }
    /*
    With this, plugins will be able to register selectors give us the ability to add some easilier
    */
    public function add(string $selectorName, Selectors $select) {
        $this->selectors[$selectorName] = $select;
    }
    
    
}