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

use Ayzrix\Scoreboard\Utils\Utils;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

class Godmode {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("Godmode");
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function isPlayerGod(Player $player): string {
        if (isset(self::getPlugin()->godList[$player->getName()])) {
            return Utils::getIntoConfig("enable");
        } else return Utils::getIntoConfig("disable");
    }
}