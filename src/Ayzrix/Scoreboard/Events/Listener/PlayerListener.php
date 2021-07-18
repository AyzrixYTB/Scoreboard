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

namespace Ayzrix\Scoreboard\Events\Listener;

use Ayzrix\Scoreboard\API\ScoreboardAPI;
use Ayzrix\Scoreboard\Utils\Utils;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;

class PlayerListener implements Listener {

    /** @var ScoreboardAPI[] $scoreboards */
    public static $scoreboards = [];

    public function PlayerJoin (PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $levelName = $player->getLevel()->getFolderName();
        if (Utils::getIntoConfig("per_world") === false) {
            $scoreboard = self::$scoreboards[$player->getName()] = new ScoreboardAPI($player);
            $scoreboard->setDisplayName(Utils::getIntoConfig("title"));
            $i = 0;
            foreach (Utils::getIntoConfig("lines") as $line) {
                $line = Utils::formateString($player, $line);
                $scoreboard->setLine($i, $line);
                $i++;
            }
            $scoreboard->set();
        } else {
            if (isset(Utils::getIntoConfig("worlds")[$levelName])) {
                $scoreboard = self::$scoreboards[$player->getName()] = new ScoreboardAPI($player);
                $scoreboard->setDisplayName(Utils::getIntoConfig("worlds")[$levelName]["title"]);
                $i = 0;
                foreach (Utils::getIntoConfig("worlds")[$levelName]["lines"] as $line) {
                    $line = Utils::formateString($player, $line);
                    $scoreboard->setLine($i, $line);
                    $i++;
                }
                $scoreboard->set();
            }
        }
    }

    public function PlayerLevelChange(EntityLevelChangeEvent $event) {
        $player = $event->getEntity();
        $levelName = $event->getTarget()->getFolderName();
        if ($player instanceof Player) {
            if (Utils::getIntoConfig("per_world") === true) {
                if (isset(Utils::getIntoConfig("worlds")[$levelName])) {
                    if (isset(self::$scoreboards[$player->getName()])) {
                        $scoreboard = self::$scoreboards[$player->getName()] = new ScoreboardAPI($player);
                        $scoreboard->sendRemoveObjectivePacket();
                        $scoreboard->setDisplayName(Utils::getIntoConfig("worlds")[$levelName]["title"]);
                        $i = 0;
                        foreach (Utils::getIntoConfig("worlds")[$levelName]["lines"] as $line) {
                            $line = Utils::formateString($player, $line);
                            $scoreboard->setLine($i, $line);
                            $i++;
                        }
                        $scoreboard->set();
                    }
                } else {
                    if (isset(self::$scoreboards[$player->getName()])) {
                        self::$scoreboards[$player->getName()]->sendRemoveObjectivePacket();
                        unset(self::$scoreboards[$player->getName()]);
                    }
                }
            }
        }
    }
}
