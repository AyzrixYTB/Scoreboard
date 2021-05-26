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

class Prisons {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("Prisons");
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerRank(Player $player): string {
        return self::getPlugin()->getRank($player->getName());
    }

    /**
     * @param Player $player
     * @return int
     */
    public static function getPlayerPrestige(Player $player): int {
        return self::getPlugin()->getPrestige($player->getName());
    }
}