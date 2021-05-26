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

class VoteParty {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("VoteParty");
    }

    /**
     * @return int
     */
    public static function getVotes(): int {
        return (int)self::getPlugin()->serverData->getTotalVotes();
    }

    /**
     * @return int
     */
    public static function getMaxVotes(): int {
        return (int)self::getPlugin()->getConfig()->get("VotestoVoteParty");
    }
}