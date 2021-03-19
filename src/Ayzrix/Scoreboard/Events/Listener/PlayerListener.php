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
use Ayzrix\Scoreboard\Extensions\EconomyAPI;
use Ayzrix\Scoreboard\Extensions\FactionsPro;
use Ayzrix\Scoreboard\Extensions\PiggyFaction;
use Ayzrix\Scoreboard\Extensions\PurePerms;
use Ayzrix\Scoreboard\Extensions\SimpleFaction;
use Ayzrix\Scoreboard\Main;
use Ayzrix\Scoreboard\Utils\Utils;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\Server;

class PlayerListener implements Listener {

    /** @var array $scoreboards */
    public static $scoreboards = [];

    public function PlayerJoin (PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $levelName = $player->getLevel()->getFolderName();
        if (Utils::getIntoConfig("per_world") === false) {
            $scoreboard = self::$scoreboards[$player->getName()] = new ScoreboardAPI($player);
            $scoreboard->setDisplayName(Utils::getIntoConfig("title"));
            $i = 0;
            foreach (Utils::getIntoConfig("lines") as $line) {
                $line = str_replace(["{ping}", "{tps}", "{name}", "{online}", "{max_online}", "{level}", "{x}", "{y}", "{z}"], [$player->getPing(), Server::getInstance()->getTicksPerSecond(), $player->getName(), count(Server::getInstance()->getOnlinePlayers()), Server::getInstance()->getMaxPlayers(), $levelName, round($player->getX()), round($player->getY()), round($player->getZ())], $line);
                if (Main::$piggyfaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}"], [PiggyFaction::getPlayerFaction($player), PiggyFaction::getPlayerRank($player), PiggyFaction::getFactionPower($player)], $line);
                if (Main::$factionspro === true) $line = str_replace(["{faction_name}", "{faction_power}"], [FactionsPro::getPlayerFaction($player), FactionsPro::getFactionPower($player)], $line);
                if (Main::$simplefaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}", "{faction_money}"], [SimpleFaction::getPlayerFaction($player), SimpleFaction::getPlayerRank($player), SimpleFaction::getFactionPower($player), SimpleFaction::getFactionMoney($player)], $line);
                if (Main::$economyapi === true) $line = str_replace(["{money}"], [EconomyAPI::getMoney($player)], $line);
                if (Main::$pureperms === true) $line = str_replace(["{rank}", "{prefix}", "{suffix}"], [PurePerms::getPlayerRank($player), PurePerms::getPlayerPrefix($player), PurePerms::getPlayerSuffix($player)], $line);
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
                    $line = str_replace(["{ping}", "{tps}", "{name}", "{online}", "{max_online}", "{level}", "{x}", "{y}", "{z}"], [$player->getPing(), Server::getInstance()->getTicksPerSecond(), $player->getName(), count(Server::getInstance()->getOnlinePlayers()), Server::getInstance()->getMaxPlayers(), $levelName, round($player->getX()), round($player->getY()), round($player->getZ())], $line);
                    if (Main::$piggyfaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}"], [PiggyFaction::getPlayerFaction($player), PiggyFaction::getPlayerRank($player), PiggyFaction::getFactionPower($player)], $line);
                    if (Main::$factionspro === true) $line = str_replace(["{faction_name}", "{faction_power}"], [FactionsPro::getPlayerFaction($player), FactionsPro::getFactionPower($player)], $line);
                    if (Main::$simplefaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}", "{faction_money}"], [SimpleFaction::getPlayerFaction($player), SimpleFaction::getPlayerRank($player), SimpleFaction::getFactionPower($player), SimpleFaction::getFactionMoney($player)], $line);
                    if (Main::$economyapi === true) $line = str_replace(["{money}"], [EconomyAPI::getMoney($player)], $line);
                    if (Main::$pureperms === true) $line = str_replace(["{rank}", "{prefix}", "{suffix}"], [PurePerms::getPlayerRank($player), PurePerms::getPlayerPrefix($player), PurePerms::getPlayerSuffix($player)], $line);
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
                    $scoreboard = self::$scoreboards[$player->getName()] = new ScoreboardAPI($player);
                    $scoreboard->setDisplayName(Utils::getIntoConfig("worlds")[$levelName]["title"]);
                    $i = 0;
                    foreach (Utils::getIntoConfig("worlds")[$levelName]["lines"] as $line) {
                        $line = str_replace(["{ping}", "{tps}", "{name}", "{online}", "{max_online}", "{level}", "{x}", "{y}", "{z}"], [$player->getPing(), Server::getInstance()->getTicksPerSecond(), $player->getName(), count(Server::getInstance()->getOnlinePlayers()), Server::getInstance()->getMaxPlayers(), $levelName, round($player->getX()), round($player->getY()), round($player->getZ())], $line);
                        if (Main::$piggyfaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}"], [PiggyFaction::getPlayerFaction($player), PiggyFaction::getPlayerRank($player), PiggyFaction::getFactionPower($player)], $line);
                        if (Main::$factionspro === true) $line = str_replace(["{faction_name}", "{faction_power}"], [FactionsPro::getPlayerFaction($player), FactionsPro::getFactionPower($player)], $line);
                        if (Main::$simplefaction === true) $line = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}", "{faction_money}"], [SimpleFaction::getPlayerFaction($player), SimpleFaction::getPlayerRank($player), SimpleFaction::getFactionPower($player), SimpleFaction::getFactionMoney($player)], $line);
                        if (Main::$economyapi === true) $line = str_replace(["{money}"], [EconomyAPI::getMoney($player)], $line);
                        if (Main::$pureperms === true) $line = str_replace(["{rank}", "{prefix}", "{suffix}"], [PurePerms::getPlayerRank($player), PurePerms::getPlayerPrefix($player), PurePerms::getPlayerSuffix($player)], $line);
                        $scoreboard->setLine($i, $line);
                        $i++;
                    }
                    $scoreboard->set();
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
