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

    /** @var array $options */
    public static $options = [];

    public function onEnable(){
        $this->saveDefaultConfig();
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new ScoreboardTask(), Utils::getIntoConfig("update_time"));
        $this->checkDependencies();
    }

    private function checkDependencies(): void {
        foreach (Utils::getIntoConfig("options") as $pluginName => $bool) {
            if ($bool === true) {
                $plugin = $this->getServer()->getPluginManager()->getPlugin($pluginName);
                if (is_null($plugin)) {
                    $this->getLogger()->notice("Please download a valid version of {$pluginName}");
                    $this->getServer()->getPluginManager()->disablePlugin($this);
                    return;
                } else self::$options[$pluginName] = true;
            } else self::$options[$pluginName] = false;
        }
    }

    /**
     * @return Main
     */
    public static function getInstance(): Main {
        return self::$instance;
    }
}
