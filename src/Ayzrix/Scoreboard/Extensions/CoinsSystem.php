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

class CoinsSystem {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("CoinsSystem");
    }

    /**
     * @param Player $player
     * @return int
     */
    public static function getPlayerCoins(Player $player): int {
        return self::getPlugin()->getCoins($player->getName());
    }
}