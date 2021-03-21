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
use room17\SkyBlock\island\RankIds;

class Skyblock {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("SkyBlock");
    }

    /**
     * @param Player $player
     * @return int|string
     */
    public static function getIslandBlocks(Player $player){
        $session = self::getPlugin()->getSessionManager()->getSession($player);

        if (!is_null($session) and $session->hasIsland()) {
            return $session->getIsland()->getBlocksBuilt();
        } else return "...";
    }

    /**
     * @param Player $player
     * @return int|string
     */
    public static function getIslandMembers(Player $player) {
        $session = self::getPlugin()->getSessionManager()->getSession($player);

        if (!is_null($session) and $session->hasIsland()) {
            return count($session->getIsland()->getMembers());
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getIslandSize(Player $player): string {
        $session = self::getPlugin()->getSessionManager()->getSession($player);

        if (!is_null($session) and $session->hasIsland()) {
            return $session->getIsland()->getCategory();
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getIslandRank(Player $player): string {
        $session = self::getPlugin()->getSessionManager()->getSession($player);

        if (!is_null($session) and $session->hasIsland()) {
            switch ($session->getRank()) {
                case RankIds::MEMBER:
                    return "Member";
                case RankIds::OFFICER:
                    return "Officer";
                case RankIds::LEADER:
                    return "Leader";
                case RankIds::FOUNDER:
                    return "Founder";
            }
        }
        return "...";
    }
}