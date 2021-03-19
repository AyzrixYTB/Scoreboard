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

class PurePerms {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerRank(Player $player) : string{
        $group = self::getPlugin()->getUserDataMgr()->getGroup($player, $player->getLevel()->getName());
        return $group;
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerPrefix(Player $player) : string{
        $prefix = self::getPlugin()->getUserDataMgr()->getNode($player, "prefix");
        if (!is_null($prefix) and $prefix !== "") {
            return $prefix;
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerSuffix(Player $player) : string{
        $suffix = self::getPlugin()->getUserDataMgr()->getNode($player, "suffix");

        if (!is_null($suffix) and $suffix !== "") {
            return $suffix;
        } else return "...";
    }
}