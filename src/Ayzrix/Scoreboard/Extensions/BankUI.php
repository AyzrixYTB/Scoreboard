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

namespace Ayzrix\Scoreboard\Extensions;

use Ayzrix\Scoreboard\Utils\Utils;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\Config;

class BankUI {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("BankUI");
    }

    /**
     * @param Player $player
     * @return string
     */
    public static function getPlayerBalance(Player $player): string {
        $config = new Config(self::getPlugin()->getDataFolder() . "Players/" . $player->getName() . ".yml", Config::YAML);
        if (Utils::getIntoConfig("convert_money") === true) {
            return Utils::convertMoney($config->get("Money") ?? 0);
        } else return $config->get("Money") ?? 0;
    }
}