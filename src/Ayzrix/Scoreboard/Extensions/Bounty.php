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

class Bounty {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("Bounty");
    }

    /**
     * @param Player $player
     * @return int
     */
    public static function getPlayerBounty(Player $player): int {
        if (self::getPlugin()->hasBounty($player->getName())) {
            return self::getPlugin()->getBounty($player->getName());
        } else return 0;
    }
}