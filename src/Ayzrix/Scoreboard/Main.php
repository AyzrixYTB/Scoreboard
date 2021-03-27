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

namespace Ayzrix\Scoreboard;

use Ayzrix\Scoreboard\Events\Listener\PlayerListener;
use Ayzrix\Scoreboard\Tasks\ScoreboardTask;
use Ayzrix\Scoreboard\Utils\Utils;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    /** @var Main $instance */
    private static $instance;

    public static $piggyfaction = false;
    public static $factionspro = false;
    public static $simplefaction = false;
    public static $economyapi = false;
    public static $pureperms = false;
    public static $skyblock = false;
    public static $seedevice = false;
    public static $bounty = false;
    public static $prison = false;
    public static $combatlogger = false;
    public static $onlinetime = false;
    public static $fightlogger = false;
    public static $myplot = false;
    public static $coinssystem = false;

    public function onEnable(){
        $this->saveDefaultConfig();
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new ScoreboardTask(), Utils::getIntoConfig("update_time"));
        $this->checkDependencies();
    }

    private function checkDependencies(): void {

        if (Utils::getIntoConfig("options")["PiggyFaction"] === true) {
            $piggyfaction = $this->getServer()->getPluginManager()->getPlugin("PiggyFactions");
            if(is_null($piggyfaction)) {
                $this->getLogger()->notice("Please download a valid version of PiggyFaction");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$piggyfaction = true;
        }

        if (Utils::getIntoConfig("options")["FactionsPro"] === true) {
            $factionspro = $this->getServer()->getPluginManager()->getPlugin("FactionsPro");
            if(is_null($factionspro)) {
                $this->getLogger()->notice("Please download a valid version of FactionsPro");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$factionspro = true;
        }

        if (Utils::getIntoConfig("options")["SimpleFaction"] === true) {
            $simplefaction = $this->getServer()->getPluginManager()->getPlugin("SimpleFaction");
            if(is_null($simplefaction)) {
                $this->getLogger()->notice("Please download a valid version of SimpleFaction");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$simplefaction = true;
        }

        if (Utils::getIntoConfig("options")["EconomyAPI"] === true) {
            $economyapi = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
            if(is_null($economyapi)) {
                $this->getLogger()->notice("Please download a valid version of EconomyAPI");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$economyapi = true;
        }

        if (Utils::getIntoConfig("options")["PurePerms"] === true) {
            $pureperms = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
            if(is_null($pureperms)) {
                $this->getLogger()->notice("Please download a valid version of PurePerms");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$pureperms = true;
        }

        if (Utils::getIntoConfig("options")["SkyBlock"] === true) {
            $skyblock = $this->getServer()->getPluginManager()->getPlugin("SkyBlock");
            if(is_null($skyblock)) {
                $this->getLogger()->notice("Please download a valid version of SkyBlock");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$skyblock = true;
        }

        if (Utils::getIntoConfig("options")["SeeDevice"] === true) {
            $seedevice = $this->getServer()->getPluginManager()->getPlugin("SeeDevice");
            if(is_null($seedevice)) {
                $this->getLogger()->notice("Please download a valid version of SeeDevice");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$seedevice = true;
        }

        if (Utils::getIntoConfig("options")["Bounty"] === true) {
            $bounty = $this->getServer()->getPluginManager()->getPlugin("Bounty");
            if(is_null($bounty)) {
                $this->getLogger()->notice("Please download a valid version of Bounty");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$bounty = true;
        }

        if (Utils::getIntoConfig("options")["Prisons"] === true) {
            $prison = $this->getServer()->getPluginManager()->getPlugin("Prisons");
            if(is_null($prison)) {
                $this->getLogger()->notice("Please download a valid version of Prisons");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$prison = true;
        }

        if (Utils::getIntoConfig("options")["OnlineTime"] === true) {
            $onlinetime = $this->getServer()->getPluginManager()->getPlugin("OnlineTime");
            if(is_null($onlinetime)) {
                $this->getLogger()->notice("Please download a valid version of OnlineTime");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$onlinetime = true;
        }

        if (Utils::getIntoConfig("options")["CombatLogger"] === true) {
            $combatlogger = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
            if(is_null($combatlogger)) {
                $this->getLogger()->notice("Please download a valid version of CombatLogger");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$combatlogger = true;
        }

        if (Utils::getIntoConfig("options")["FightLogger"] === true) {
            $fightlogger = $this->getServer()->getPluginManager()->getPlugin("FightLogger");
            if(is_null($fightlogger)) {
                $this->getLogger()->notice("Please download a valid version of FightLogger");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$fightlogger = true;
        }

        if (Utils::getIntoConfig("options")["MyPlot"] === true) {
            $myplot = $this->getServer()->getPluginManager()->getPlugin("MyPlot");
            if(is_null($myplot)) {
                $this->getLogger()->notice("Please download a valid version of MyPlot");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$myplot = true;
        }

        if (Utils::getIntoConfig("options")["CoinsSystem"] === true) {
            $coinssystem = $this->getServer()->getPluginManager()->getPlugin("CoinsSystem");
            if(is_null($coinssystem)) {
                $this->getLogger()->notice("Please download a valid version of CoinsSystem");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            } else self::$coinssystem = true;
        }
    }

    /**
     * @return Main
     */
    public static function getInstance(): Main {
        return self::$instance;
    }
}
