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

    public function onEnable(){
        $this->saveDefaultConfig();
        self::$instance = $this;

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

        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new ScoreboardTask(), Utils::getIntoConfig("update_time"));
    }

    /**
     * @return Main
     */
    public static function getInstance(): Main {
        return self::$instance;
    }
}
