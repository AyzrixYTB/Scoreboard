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
use ShockedPlot7560\FactionMaster\API\MainAPI;
use ShockedPlot7560\FactionMaster\Database\Entity\FactionEntity;
use ShockedPlot7560\FactionMaster\Database\Entity\UserEntity;
use ShockedPlot7560\FactionMaster\Utils\Ids;

class FactionMaster {

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerFaction(Player $player): string {
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        if ($faction instanceof FactionEntity) {
            return $faction->name;
        } else return "...";
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerRank(Player $player): string {
        $user = MainAPI::getUser($player->getName());
        if ($user instanceof UserEntity) {
            switch ($user->rank) {
                case Ids::RECRUIT_ID:
                    return "";
                case Ids::MEMBER_ID:
                    return "*";
                case Ids::COOWNER_ID:
                    return "**";
                case Ids::OWNER_ID:
                    return "***";
            }
        }
        return "...";
    }

    /**
     * @param Player $player
     * @return int
     */
    public static function getFactionPower(Player $player): int {
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        if ($faction instanceof FactionEntity) {
            return $faction->power;
        }
        return 0;
    }

    /**
     * @param Player $player
     * @return int
     */
    public static function getFactionLevel(Player $player): int {
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        if ($faction instanceof FactionEntity) {
            return $faction->level;
        }
        return 1;
    }

    /**
     * @param Player $player
     * @return int
     */
    public static function getFactionXp(Player $player): int {
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        if ($faction instanceof FactionEntity) {
            return $faction->xp;
        }
        return 0;
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getFactionMessage(Player $player): string {
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        if ($faction instanceof FactionEntity) {
            if (!is_null($faction->messageFaction)) {
                return $faction->messageFaction;
            }
        }
        return "...";
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getFactionDescription(Player $player): string {
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        if ($faction instanceof FactionEntity) {
            if (!is_null($faction->description)) {
                return $faction->description;
            }
        }
        return "...";
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getFactionVisibility(Player $player): string {
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        if ($faction instanceof FactionEntity) {
            switch ($faction->visibility) {
                case Ids::PUBLIC_VISIBILITY:
                    return "Public";
                case Ids::INVITATION_VISIBILITY:
                    return "Invitation";
                case Ids::PRIVATE_VISIBILITY:
                    return "Private";
            }
        }
        return "...";
    }
}