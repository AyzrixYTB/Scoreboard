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

use pocketmine\plugin\Plugin;
use pocketmine\Server;

class MultiServerCounter {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("MultiServerCounter");
    }

    /**
     * @return int
     */
    public static function getPlayerCount(): int {
        return (int)self::getPlugin()->getCachedPlayers() + count(Server::getInstance()->getOnlinePlayers());
    }

    /**
     * @return int
     */
    public static function getMaxPlayerCount(): int {
        return (int)self::getPlugin()->getCachedMaxPlayers() + Server::getInstance()->getMaxPlayers();
    }
}