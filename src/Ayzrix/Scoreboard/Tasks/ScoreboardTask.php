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

namespace Ayzrix\Scoreboard\Tasks;

use Ayzrix\Scoreboard\Events\Listener\PlayerListener;
use Ayzrix\Scoreboard\Utils\Utils;
use pocketmine\Player;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class ScoreboardTask extends Task {

    public function onRun(int $currentTick) {
        foreach (PlayerListener::$scoreboards as $name => $value) {
            if (!Server::getInstance()->getPlayer($name) instanceof Player) {
                unset(PlayerListener::$scoreboards[$name]);
                continue;
            }
            $player = Server::getInstance()->getPlayer($name);
            $scoreboard = PlayerListener::$scoreboards[$name];
            if (Utils::getIntoConfig("per_world") === false) {
                $scoreboard->setDisplayName(Utils::getIntoConfig("title"));
                $i = 0;
                foreach (Utils::getIntoConfig("lines") as $line) {
                    $line = Utils::formateString($player, $line);
                    $scoreboard->setLine($i, $line);
                    $i++;
                }
                $scoreboard->set();
            } else {
                $levelName = $player->getLevel()->getFolderName();
                if (isset(Utils::getIntoConfig("worlds")[$levelName])) {
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
    }
}