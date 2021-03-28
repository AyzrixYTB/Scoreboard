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

use DaPigGuy\PiggyFactions\players\PlayerManager;
use pocketmine\Player;

class PiggyFaction {

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerFaction(Player $player): string {
        $member = PlayerManager::getInstance()->getPlayer($player);
        $faction = $member === null ? null : $member->getFaction();
        if (!is_null($faction)) {
            return $faction->getName();
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerRank(Player $player): string {
        $member = PlayerManager::getInstance()->getPlayer($player);
        $faction = $member === null ? null : $member->getFaction();
        if (!is_null($faction)) {
            return $member->getRole();
        } else return "...";
    }

    /**
     * @param Player $player
     * @return float|string
     */
    public static function getFactionPower(Player $player) {
        $member = PlayerManager::getInstance()->getPlayer($player);
        $faction = $member === null ? null : $member->getFaction();
        if (!is_null($faction)) {
            return round($faction->getPower(), 2);
        } else return "...";
    }
}