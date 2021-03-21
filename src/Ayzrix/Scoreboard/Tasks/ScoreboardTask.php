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
use Ayzrix\Scoreboard\Extensions\Bounty;
use Ayzrix\Scoreboard\Extensions\CombatLogger;
use Ayzrix\Scoreboard\Extensions\EconomyAPI;
use Ayzrix\Scoreboard\Extensions\FactionsPro;
use Ayzrix\Scoreboard\Extensions\OnlineTime;
use Ayzrix\Scoreboard\Extensions\PiggyFaction;
use Ayzrix\Scoreboard\Extensions\Prisons;
use Ayzrix\Scoreboard\Extensions\PurePerms;
use Ayzrix\Scoreboard\Extensions\SeeDevice;
use Ayzrix\Scoreboard\Extensions\SimpleFaction;
use Ayzrix\Scoreboard\Extensions\Skyblock;
use Ayzrix\Scoreboard\Main;
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
                    $line = str_replace(["{ping}", "{tps}", "{name}", "{online}", "{max_online}", "{level}", "{x}", "{y}", "{z}"], [$player->getPing(), Server::getInstance()->getTicksPerSecond(), $player->getName(), count(Server::getInstance()->getOnlinePlayers()), Server::getInstance()->getMaxPlayers(), $player->getLevel()->getFolderName(), round($player->getX()), round($player->getY()), round($player->getZ())], $line);
                    if (Main::$piggyfaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}"], [PiggyFaction::getPlayerFaction($player), PiggyFaction::getPlayerRank($player), PiggyFaction::getFactionPower($player)], $line);
                    if (Main::$factionspro === true) $line = str_replace(["{faction_name}", "{faction_power}"], [FactionsPro::getPlayerFaction($player), FactionsPro::getFactionPower($player)], $line);
                    if (Main::$simplefaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}", "{faction_money}"], [SimpleFaction::getPlayerFaction($player), SimpleFaction::getPlayerRank($player), SimpleFaction::getFactionPower($player), SimpleFaction::getFactionMoney($player)], $line);
                    if (Main::$economyapi === true) $line = str_replace(["{money}"], [EconomyAPI::getMoney($player)], $line);
                    if (Main::$pureperms === true) $line = str_replace(["{rank}", "{prefix}", "{suffix}"], [PurePerms::getPlayerRank($player), PurePerms::getPlayerPrefix($player), PurePerms::getPlayerSuffix($player)], $line);
                    if (Main::$skyblock === true) $line = str_replace(["{island_blocks}", "{island_members}", "{island_rank}", "{island_size}"], [Skyblock::getIslandBlocks($player), Skyblock::getIslandMembers($player), Skyblock::getIslandRank($player), Skyblock::getIslandSize($player)], $line);
                    if (Main::$seedevice === true) $line = str_replace(["{device}"], [SeeDevice::getPlayerOs($player)], $line);
                    if (Main::$bounty === true) $line = str_replace(["{bounty}"], [Bounty::getPlayerBounty($player)], $line);
                    if (Main::$prison === true) $line = str_replace(["{prisons_rank}", "{prisons_prestige}"], [Prisons::getPlayerRank($player), Prisons::getPlayerPrestige($player)], $line);
                    if (Main::$onlinetime === true) $line = str_replace(["{onlinetime_session}", "{onlinetime_total}"], [OnlineTime::getSessionTime($player), OnlineTime::getTotalTime($player)], $line);
                    if (Main::$combatlogger === true) $line = str_replace(["{combatlogger_time}"], [CombatLogger::getTaggedTime($player)], $line);
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
                        $line = str_replace(["{ping}", "{tps}", "{name}", "{online}", "{max_online}", "{level}", "{x}", "{y}", "{z}"], [$player->getPing(), Server::getInstance()->getTicksPerSecond(), $player->getName(), count(Server::getInstance()->getOnlinePlayers()), Server::getInstance()->getMaxPlayers(), $player->getLevel()->getFolderName(), round($player->getX()), round($player->getY()), round($player->getZ())], $line);
                        if (Main::$piggyfaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}"], [PiggyFaction::getPlayerFaction($player), PiggyFaction::getPlayerRank($player), PiggyFaction::getFactionPower($player)], $line);
                        if (Main::$factionspro === true) $line = str_replace(["{faction_name}", "{faction_power}"], [FactionsPro::getPlayerFaction($player), FactionsPro::getFactionPower($player)], $line);
                        if (Main::$simplefaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}", "{faction_money}"], [SimpleFaction::getPlayerFaction($player), SimpleFaction::getPlayerRank($player), SimpleFaction::getFactionPower($player), SimpleFaction::getFactionMoney($player)], $line);
                        if (Main::$economyapi === true) $line = str_replace(["{money}"], [EconomyAPI::getMoney($player)], $line);
                        if (Main::$pureperms === true) $line = str_replace(["{rank}", "{prefix}", "{suffix}"], [PurePerms::getPlayerRank($player), PurePerms::getPlayerPrefix($player), PurePerms::getPlayerSuffix($player)], $line);
                        if (Main::$skyblock === true) $line = str_replace(["{island_blocks}", "{island_members}", "{island_rank}", "{island_size}"], [Skyblock::getIslandBlocks($player), Skyblock::getIslandMembers($player), Skyblock::getIslandRank($player), Skyblock::getIslandSize($player)], $line);
                        if (Main::$seedevice === true) $line = str_replace(["{device}"], [SeeDevice::getPlayerOs($player)], $line);
                        if (Main::$bounty === true) $line = str_replace(["{bounty}"], [Bounty::getPlayerBounty($player)], $line);
                        if (Main::$prison === true) $line = str_replace(["{prisons_rank}", "{prisons_prestige}"], [Prisons::getPlayerRank($player), Prisons::getPlayerPrestige($player)], $line);
                        if (Main::$onlinetime === true) $line = str_replace(["{onlinetime_session}", "{onlinetime_total}"], [OnlineTime::getSessionTime($player), OnlineTime::getTotalTime($player)], $line);
                        if (Main::$combatlogger === true) $line = str_replace(["{combatlogger_time}"], [CombatLogger::getTaggedTime($player)], $line);
                        $scoreboard->setLine($i, $line);
                        $i++;
                    }
                    $scoreboard->set();
                }
            }
        }
    }
}