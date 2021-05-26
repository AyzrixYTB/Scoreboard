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

class KDR {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("KDR");
    }

    /**
     * @param Player $player
     * @return int
     */
    public static function getPlayerKills(Player $player): int {
        if (self::getPlugin()->getProvider()->playerExists($player)) {
            return self::getPlugin()->getProvider()->getPlayerKillPoints($player);
        } else return 0;
    }

    /**
     * @param Player $player
     * @return int
     */
    public static function getPlayerDeaths(Player $player): int {
        if (self::getPlugin()->getProvider()->playerExists($player)) {
            return self::getPlugin()->getProvider()->getPlayerDeathPoints($player);
        } else return 0;
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerKDR(Player $player): string {
        if (self::getPlugin()->getProvider()->playerExists($player)) {
            return self::getPlugin()->getProvider()->getKillToDeathRatio($player);
        } else return "0.0";
    }
}