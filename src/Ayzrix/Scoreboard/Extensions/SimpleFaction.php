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

use Ayzrix\SimpleFaction\API\FactionsAPI;
use pocketmine\Player;

class SimpleFaction {

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerFaction(Player $player): string {
        if (FactionsAPI::isInFaction($player)) {
            return FactionsAPI::getFaction($player);
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerRank(Player $player): string {
        if (FactionsAPI::isInFaction($player)) {
            return FactionsAPI::getRank($player->getName());
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string|int
     */
    public static function getFactionPower(Player $player): string {
        if (FactionsAPI::isInFaction($player)) {
            return FactionsAPI::getPower(FactionsAPI::getFaction($player));
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string|int
     */
    public static function getFactionMoney(Player $player) {
        if (FactionsAPI::isInFaction($player)) {
            return FactionsAPI::getMoney(FactionsAPI::getFaction($player));
        } else return "...";
    }
}