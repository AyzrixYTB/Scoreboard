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

use IvanCraft623\RankSystem\session\SessionManager;
use pocketmine\Player;

class RankSystem {

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerRank(Player $player) : string {
        return SessionManager::getInstance()->get($player)->getRanks()[0]->getName();
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerPrefix(Player $player) : string {
        return SessionManager::getInstance()->get($player)->getChatPrefix();
    }
}