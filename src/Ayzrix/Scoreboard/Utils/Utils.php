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

namespace Ayzrix\Scoreboard\Utils;

use Ayzrix\Scoreboard\Extensions\Bounty;
use Ayzrix\Scoreboard\Extensions\CoinsSystem;
use Ayzrix\Scoreboard\Extensions\CombatLogger;
use Ayzrix\Scoreboard\Extensions\EconomyAPI;
use Ayzrix\Scoreboard\Extensions\FactionsPro;
use Ayzrix\Scoreboard\Extensions\FightLogger;
use Ayzrix\Scoreboard\Extensions\MyPlot;
use Ayzrix\Scoreboard\Extensions\OnlineTime;
use Ayzrix\Scoreboard\Extensions\PiggyFaction;
use Ayzrix\Scoreboard\Extensions\Prisons;
use Ayzrix\Scoreboard\Extensions\PurePerms;
use Ayzrix\Scoreboard\Extensions\SeeDevice;
use Ayzrix\Scoreboard\Extensions\SimpleFaction;
use Ayzrix\Scoreboard\Extensions\Skyblock;
use Ayzrix\Scoreboard\Main;
use pocketmine\Player;
use pocketmine\Server;

class Utils {

    /**
     * @param string $value
     * @return bool|string|int|array
     */
    public static function getIntoConfig(string $value) {
        $config = Main::getInstance()->getConfig();
        return $config->get($value);
    }

    /**
     * @param Player $player
     * @param string $string
     * @return string
     */
    public static function formateString(Player $player, string $string): string {
        $string = str_replace(["{ping}", "{tps}", "{name}", "{online}", "{max_online}", "{level}", "{x}", "{y}", "{z}", "{ip}", "{port}", "{uid}", "{xuid}", "{health}", "{max_health}", "{food}", "{max_food}", "{gamemode}", "{scale}"], [$player->getPing(), Server::getInstance()->getTicksPerSecond(), $player->getName(), count(Server::getInstance()->getOnlinePlayers()), Server::getInstance()->getMaxPlayers(), $player->getLevel()->getFolderName(), round($player->getX()), round($player->getY()), round($player->getZ()), $player->getAddress(), $player->getPort(), $player->getUniqueId(), $player->getXuid(), $player->getHealth(), $player->getMaxHealth(), $player->getFood(), $player->getMaxFood(), $player->getGamemode(), $player->getScale()], $string);
        if (Main::$piggyfaction === true) $string = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}"], [PiggyFaction::getPlayerFaction($player), PiggyFaction::getPlayerRank($player), PiggyFaction::getFactionPower($player)], $string);
        if (Main::$factionspro === true) $string = str_replace(["{faction_name}", "{faction_power}"], [FactionsPro::getPlayerFaction($player), FactionsPro::getFactionPower($player)], $string);
        if (Main::$simplefaction === true) $string = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}", "{faction_money}"], [SimpleFaction::getPlayerFaction($player), SimpleFaction::getPlayerRank($player), SimpleFaction::getFactionPower($player), SimpleFaction::getFactionMoney($player)], $string);
        if (Main::$economyapi === true) $string = str_replace(["{money}"], [EconomyAPI::getMoney($player)], $string);
        if (Main::$pureperms === true) $string = str_replace(["{rank}", "{prefix}", "{suffix}"], [PurePerms::getPlayerRank($player), PurePerms::getPlayerPrefix($player), PurePerms::getPlayerSuffix($player)], $string);
        if (Main::$skyblock === true) $string = str_replace(["{island_blocks}", "{island_members}", "{island_rank}", "{island_size}"], [Skyblock::getIslandBlocks($player), Skyblock::getIslandMembers($player), Skyblock::getIslandRank($player), Skyblock::getIslandSize($player)], $string);
        if (Main::$seedevice === true) $string = str_replace(["{device}"], [SeeDevice::getPlayerOs($player)], $string);
        if (Main::$bounty === true) $string = str_replace(["{bounty}"], [Bounty::getPlayerBounty($player)], $string);
        if (Main::$prison === true) $string = str_replace(["{prisons_rank}", "{prisons_prestige}"], [Prisons::getPlayerRank($player), Prisons::getPlayerPrestige($player)], $string);
        if (Main::$onlinetime === true) $string = str_replace(["{onlinetime_session}", "{onlinetime_total}"], [OnlineTime::getSessionTime($player), OnlineTime::getTotalTime($player)], $string);
        if (Main::$combatlogger === true) $string = str_replace(["{combatlogger_time}"], [CombatLogger::getTaggedTime($player)], $string);
        if (Main::$fightlogger === true) $string = str_replace(["{fightlogger_time}"], [FightLogger::getTaggedTime($player)], $string);
        if (Main::$myplot === true) $string = str_replace(["{myplot_owner}", "{myplot_id}"], [MyPlot::getPlotOwner($player), MyPlot::getPlotID($player)], $string);
        if (Main::$coinssystem === true) $string = str_replace(["{coins}"], [CoinsSystem::getPlayerCoins($player)], $string);
        return $string;
    }
}