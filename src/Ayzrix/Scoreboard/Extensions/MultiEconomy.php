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

use Ayzrix\Scoreboard\Main;
use Ayzrix\Scoreboard\Utils\Utils;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

class MultiEconomy {

    /**
     * @return Plugin
     */
    public static function getPlugin(): Plugin {
        return Server::getInstance()->getPluginManager()->getPlugin("MultiEconomy");
    }

    public static function getAllTags(Player $player): array {
        $currencies = self::getPlugin()->getCurrencies();
        $return = [];
        foreach ($currencies as $currency) {
            $return[0][] = "{balance." . $currency->getName() . "}";
            if (Utils::getIntoConfig("convert_money") === true) {
                $return[1][] = Utils::convertMoney($currency->getBalance($player->getName()));
            } else $return[1][] = $currency->getBalance($player->getName());
        }
        return $return;
    }
}