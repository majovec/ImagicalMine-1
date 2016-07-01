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
 * @link http://forums.imagicalcorp.net/
 * 
 *
*/

namespace pocketmine\utils\notifier;
use pocketmine\Server;

class Notification {
    
    public function __construct(string $text, string $title = "ImagicalMine", string $pathToIcon = "") {
        
        if($pathToIcon == "") {
            $pathToIcon = Server::getInstance()->getFilePath() . "bin/ImagicalMine.ico";
        }
        
         switch(true) {
            case stristr(PHP_OS, 'DAR'): // MACOSX
            $this->error = shell_exec("osascript -e 'display notfication \"{$text}\" with title \"{$title}\"'");
            break;
            
            
            case stristr(PHP_OS, 'WIN'): // Windows
            $this->error = shell_exec("powershell -executionPolicy Unrestricted " . __DIR__ . "\\WIN.ps1 -Title '{$title}' -text '{$text}' -iconpath '{$pathToIcon}'");
            break;
            
            
            case stristr(PHP_OS, 'LINUX'): // LINUX
            $this->error = shell_exec("notify-send '{$title}' '{$text}'");
            break;
        }
    }
}