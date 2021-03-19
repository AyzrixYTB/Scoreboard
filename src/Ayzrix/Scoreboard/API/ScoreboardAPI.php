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

namespace Ayzrix\Scoreboard\API;

use pocketmine\network\mcpe\protocol\BatchPacket;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\Player;

class ScoreboardAPI {

    /** @var Player */
    private $player;

    /**
     * @var string
     */
    public $displayname = "";

    /**
     * @var string
     */
    public $datas = [];

    /**
     * @var string|null
     */
    public $objectiveName = null;

    /**
     * BossBar constructor.
     * @param Player $player
     */
    public function __construct(Player $player) {
        $this->player = $player;
        $this->objectiveName = "" . $player->getId() . "";
        $this->displayname = " ";
    }

    /**
     * @return Player
     */
    public function getPlayer() : Player {
        return $this->player;
    }

    /**
     * @return string
     */
    public function getDisplayName() : string {
        return $this->displayname;
    }

    /**
     * @param string $display
     * @return $this
     */
    public function setDisplayName(string $display = "") : self {
        if ($display !== $this->getDisplayName()){
            $this->displayname = $display;
        }
        return $this;
    }

    /**
     * @return string[]
     */
    public function getData() : array {
        return $this->datas;
    }

    public function setLine(int $number, string $customname) : self {
        if (isset($this->datas[$number])){
            if ($this->datas[$number] == $customname){
                return $this;
            }
        }
        $this->datas[$number]  = $customname;
        return $this;
    }

    public function sendRemoveObjectivePacket() : void {
        $pk = new RemoveObjectivePacket();
        $pk->objectiveName = $this->objectiveName;
        $this->getPlayer()->dataPacket($pk);
    }

    public function set() : void {
        $batch = new BatchPacket();
        $batch->addPacket($this->setScorePacket(array_keys($this->getData())));

        $pk = new SetScorePacket();
        $pk->type = SetScorePacket::TYPE_CHANGE;
        $pk->entries = array_map(function (string $text, int $score) {

            $entry = new ScorePacketEntry();
            $entry->type = ScorePacketEntry::TYPE_FAKE_PLAYER;
            $entry->objectiveName = $this->objectiveName;
            $entry->scoreboardId = $score;
            $entry->score = $score;
            $entry->customName = $text . " ";

            return $entry;
        }, ($texts = array_values($this->getData())), array_keys($this->getData()));

        $batch->addPacket($pk);

        $pk = new SetDisplayObjectivePacket();
        $pk->displayName = $this->displayname;
        $pk->objectiveName = $this->objectiveName;
        $pk->displaySlot = 'sidebar';
        $pk->criteriaName = 'dummy';
        $pk->sortOrder = 0;
        $this->getPlayer()->sendDataPacket($pk);
        $this->getPlayer()->sendDataPacket($batch);
    }

    public function setScorePacket(array $lines) : SetScorePacket {
        $pk = new SetScorePacket();
        $pk->type = SetScorePacket::TYPE_REMOVE;

        foreach ($lines as $score) {
            $entry = new ScorePacketEntry;
            $entry->objectiveName = $this->objectiveName;
            $entry->score = $score;
            $entry->scoreboardId = $score;
            $pk->entries[] = $entry;
        }
        return $pk;
    }
}