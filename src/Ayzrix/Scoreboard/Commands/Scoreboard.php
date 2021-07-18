<?php

namespace Ayzrix\Scoreboard\Commands;

use Ayzrix\Scoreboard\API\ScoreboardAPI;
use Ayzrix\Scoreboard\Events\Listener\PlayerListener;
use Ayzrix\Scoreboard\Main;
use Ayzrix\Scoreboard\Utils\Utils;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;

class Scoreboard extends PluginCommand {

    public function __construct(Main $plugin) {
        parent::__construct("scoreboard", $plugin);
        $this->setDescription(Utils::getIntoConfig("command_description"));
    }

    public function execute(CommandSender $player, string $commandLabel, array $args) {
        if ($player instanceof Player) {
            if (isset(PlayerListener::$scoreboards[$player->getName()])) {
                PlayerListener::$scoreboards[$player->getName()]->sendRemoveObjectivePacket();
                unset(PlayerListener::$scoreboards[$player->getName()]);
                $player->sendMessage(Utils::getIntoConfig("command_success_hide"));
            } else {
                $levelName = $player->getLevel()->getFolderName();
                if (Utils::getIntoConfig("per_world") === false) {
                    $scoreboard = PlayerListener::$scoreboards[$player->getName()] = new ScoreboardAPI($player);
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
                        $scoreboard = PlayerListener::$scoreboards[$player->getName()] = new ScoreboardAPI($player);
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
                $player->sendMessage(Utils::getIntoConfig("command_success_show"));
            }
        } else $player->sendMessage("You can only use this command ingame.");
    }
}
