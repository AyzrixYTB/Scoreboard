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

use Ayzrix\Scoreboard\Extensions\BankUI;
use Ayzrix\Scoreboard\Extensions\Bounty;
use Ayzrix\Scoreboard\Extensions\CoinsSystem;
use Ayzrix\Scoreboard\Extensions\CombatLogger;
use Ayzrix\Scoreboard\Extensions\EconomyAPI;
use Ayzrix\Scoreboard\Extensions\FactionsPro;
use Ayzrix\Scoreboard\Extensions\FightLogger;
use Ayzrix\Scoreboard\Extensions\Godmode;
use Ayzrix\Scoreboard\Extensions\KDR;
use Ayzrix\Scoreboard\Extensions\MultiEconomy;
use Ayzrix\Scoreboard\Extensions\MultiServerCounter;
use Ayzrix\Scoreboard\Extensions\MyPlot;
use Ayzrix\Scoreboard\Extensions\OnlineTime;
use Ayzrix\Scoreboard\Extensions\PiggyFaction;
use Ayzrix\Scoreboard\Extensions\Prisons;
use Ayzrix\Scoreboard\Extensions\PurePerms;
use Ayzrix\Scoreboard\Extensions\RankSystem;
use Ayzrix\Scoreboard\Extensions\RedSkyBlock;
use Ayzrix\Scoreboard\Extensions\SeeDevice;
use Ayzrix\Scoreboard\Extensions\SimpleFaction;
use Ayzrix\Scoreboard\Extensions\Skyblock;
use Ayzrix\Scoreboard\Extensions\VanishV2;
use Ayzrix\Scoreboard\Extensions\VoteParty;
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
        $string = str_replace(["{ping}", "{tps}", "{name}", "{online}", "{max_online}", "{level}", "{x}", "{y}", "{z}", "{ip}", "{port}", "{uid}", "{xuid}", "{health}", "{max_health}", "{food}", "{max_food}", "{gamemode}", "{scale}", "{xplevel}", "{id}", "{meta}", "{count}"], [$player->getPing(), Server::getInstance()->getTicksPerSecond(), $player->getName(), count(Server::getInstance()->getOnlinePlayers()), Server::getInstance()->getMaxPlayers(), $player->getLevel()->getFolderName(), round($player->getX()), round($player->getY()), round($player->getZ()), $player->getAddress(), $player->getPort(), $player->getUniqueId(), $player->getXuid(), $player->getHealth(), $player->getMaxHealth(), $player->getFood(), $player->getMaxFood(), $player->getGamemode(), $player->getScale(), $player->getXpLevel(), $player->getInventory()->getItemInHand()->getId(), $player->getInventory()->getItemInHand()->getDamage(), $player->getInventory()->getItemInHand()->getCount()], $string);
        if (Main::$options["PiggyFactions"] === true) $string = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}"], [PiggyFaction::getPlayerFaction($player), PiggyFaction::getPlayerRank($player), PiggyFaction::getFactionPower($player)], $string);
        if (Main::$options["FactionsPro"] === true) $string = str_replace(["{faction_name}", "{faction_power}"], [FactionsPro::getPlayerFaction($player), FactionsPro::getFactionPower($player)], $string);
        if (Main::$options["SimpleFaction"] === true) $string = str_replace(["{faction_name}", "{faction_rank}", "{faction_power}", "{faction_money}"], [SimpleFaction::getPlayerFaction($player), SimpleFaction::getPlayerRank($player), SimpleFaction::getFactionPower($player), SimpleFaction::getFactionMoney($player)], $string);
        if (Main::$options["EconomyAPI"] === true) $string = str_replace(["{money}"], [EconomyAPI::getMoney($player)], $string);
        if (Main::$options["PurePerms"] === true) $string = str_replace(["{rank}", "{prefix}", "{suffix}"], [PurePerms::getPlayerRank($player), PurePerms::getPlayerPrefix($player), PurePerms::getPlayerSuffix($player)], $string);
        if (Main::$options["SkyBlock"] === true) $string = str_replace(["{island_blocks}", "{island_members}", "{island_rank}", "{island_size}"], [Skyblock::getIslandBlocks($player), Skyblock::getIslandMembers($player), Skyblock::getIslandRank($player), Skyblock::getIslandSize($player)], $string);
        if (Main::$options["SeeDevice"] === true) $string = str_replace(["{device}"], [SeeDevice::getPlayerOs($player)], $string);
        if (Main::$options["Bounty"] === true) $string = str_replace(["{bounty}"], [Bounty::getPlayerBounty($player)], $string);
        if (Main::$options["Prisons"] === true) $string = str_replace(["{prisons_rank}", "{prisons_prestige}"], [Prisons::getPlayerRank($player), Prisons::getPlayerPrestige($player)], $string);
        if (Main::$options["OnlineTime"] === true) $string = str_replace(["{onlinetime_session}", "{onlinetime_total}"], [OnlineTime::getSessionTime($player), OnlineTime::getTotalTime($player)], $string);
        if (Main::$options["CombatLogger"] === true) $string = str_replace(["{combatlogger_time}"], [CombatLogger::getTaggedTime($player)], $string);
        if (Main::$options["FightLogger"] === true) $string = str_replace(["{fightlogger_time}"], [FightLogger::getTaggedTime($player)], $string);
        if (Main::$options["MyPlot"] === true) $string = str_replace(["{myplot_owner}", "{myplot_id}"], [MyPlot::getPlotOwner($player), MyPlot::getPlotID($player)], $string);
        if (Main::$options["CoinsSystem"] === true) $string = str_replace(["{coins}"], [CoinsSystem::getPlayerCoins($player)], $string);
        if (Main::$options["KDR"] === true) $string = str_replace(["{kills}", "{deaths}", "{kdr}"], [KDR::getPlayerKills($player), KDR::getPlayerDeaths($player), KDR::getPlayerKDR($player)], $string);
        if (Main::$options["VoteParty"] === true) $string = str_replace(["{votes}", "{maxvotes}"], [VoteParty::getVotes(), VoteParty::getMaxVotes()], $string);
        if (Main::$options["BankUI"] === true) $string = str_replace(["{balance}"], [BankUI::getPlayerBalance($player)], $string);
        if (Main::$options["RedSkyBlock"] === true) $string = str_replace(["{island_members}", "{island_rank}", "{island_size}", "{island_value}", "{island_locked_status}"], [RedSkyBlock::getIslandMembers($player), RedSkyBlock::getIslandRank($player), RedSkyBlock::getIslandSize($player), RedSkyBlock::getIslandValue($player), RedSkyBlock::getIslandLocked($player)], $string);
        if (Main::$options["VanishV2"] === true) $string = str_replace(["{vanish_fake_count}"], [VanishV2::getFakeCount()], $string);
        if (Main::$options["MultiEconomy"] === true) $string = str_replace(MultiEconomy::getAllTags($player)[0], MultiEconomy::getAllTags($player)[1], $string);
        if (Main::$options["RankSystem"] === true) $string = str_replace(["{rank}", "{prefix}"], [RankSystem::getPlayerRank($player), RankSystem::getPlayerPrefix($player)], $string);
        if (Main::$options["MultiServerCounter"] === true) $string = str_replace(["{MultiServer.online}", "{MultiServer.Maxonline}"], [MultiServerCounter::getPlayerCount(), MultiServerCounter::getMaxPlayerCount()], $string);
        if (Main::$options["Godmode"] === true) $string = str_replace(["{god}"], [Godmode::isPlayerGod($player)], $string);
        return $string;
    }
}