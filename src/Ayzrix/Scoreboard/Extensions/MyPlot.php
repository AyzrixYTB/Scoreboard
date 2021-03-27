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

class MyPlot {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("MyPlot");
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlotOwner(Player $player): string {
        $plot = self::getPlugin()->getPlotByPosition($player->getPosition());

        if (!is_null($plot)) {
            $owner = $plot->owner;
            if (!is_null($owner) and $owner !== "") {
                return $owner;
            }
        }
        return "...";
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlotID(Player $player): string {
        $plot = self::getPlugin()->getPlotByPosition($player->getPosition());

        if (!is_null($plot)) {
            $x = $plot->X ?? 0;
            $z = $plot->Z ?? 0;
            return $x . ";" . $z;
        }
        return "...";
    }
}