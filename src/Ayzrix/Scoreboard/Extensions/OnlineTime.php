<?php

/***
 *       _____                    _                         _
 *      / ____|                  | |                       | |
 *     | (___   ___ ___  _ __ ___| |__   ___   __ _ _ __ __| |
 *      \___ \ / __/ _ \| '__/ _ \ '_ \ / _ \ / _` | '__/ _` |
 *      ____) | (_| (_) | | |  __/ |_) | (_) | (_| | | | (_| |
 *     |_____/ \___\___/|_|  \___|_.__/ \___/ \__,_|_|  \__,_|
 *
 *
 */

namespace Ayzrix\Scoreboard\Extensions;

use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

class OnlineTime {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("OnlineTime");
    }

    public static function getSessionTime(Player $player): string {
        return self::getPlugin()->getSessionTime($player->getName());
    }

    public static function getTotalTime(Player $player): string {
        return self::getPlugin()->getTotalTime($player->getName());
    }
}