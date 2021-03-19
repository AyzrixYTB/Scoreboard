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

class FactionsPro {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("FactionsPro");
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerFaction(Player $player) : string {
        $faction = self::getPlugin()->getPlayerFaction($player->getName());
        if (!is_null($faction) and $faction !== "") {
            return $faction;
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string|int
     */
    public static function getPlayerRank(Player $player) {
        $faction = self::getPlugin()->getPlayerFaction($player->getName());
        if (!is_null($faction) and $faction !== "") {
            return self::getPlugin()->getFactionPower($faction);
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string|int
     */
    public static function getFactionPower(Player $player) {
        $faction = self::getPlugin()->getPlayerFaction($player->getName());
        if (!is_null($faction) and $faction !== "") {
            return self::getPlugin()->getFactionPower($faction);
        } else return "...";
    }
}