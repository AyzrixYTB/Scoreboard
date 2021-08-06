[![Discord](https://img.shields.io/discord/800828802921529355.svg?label=&logo=discord&logoColor=ffffff&color=7389D8&labelColor=6A7EC2)](https://discord.gg/ruBKMD9a9J)
# Scoreboard
###### A simple Pocketmine-MP plugin for creating optimized scoreboards.

## Command
| Name              | Usage             | Description                   | Enable                                    |
|-------------------|-------------------|-------------------------------|-------------------------------------------|
| Scoreboard        | /scoreboard       | Hide or show the scoreboard   | Put ``command`` on ``true`` in the [config](https://github.com/AyzrixYTB/Scoreboard/blob/main/resources/config.yml#L74) |

## Supported Tags
| Name                  | Tags                                                         | Download                                                                                                                                                                               |
|-----------------------|---------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------| 
| Base                  | `{ping}`, `{tps}`, `{name}`, `{online}`, `{max_online}`, `{level}`, `{x}`, `{y}`, `{z}`, `{ip}`, `{port}`, `{uid}`, `{xuid}`, `{health}`, `{max_health}`, `{food}`, `{max_food}`, `{gamemode}`, `{scale}`, `{xplevel}`, `{id}`, `{damage}`, `{count}` |                                                                           | |
| PiggyFactions         | `{faction_name}`, `{faction_rank}`, `{faction_power}`                                                 | [Download](https://poggit.pmmp.io/p/PiggyFactions)                                                                                            |
| FactionsPro           | `{faction_name}`, `{faction_power}`                                                                   | [Download](https://poggit.pmmp.io/p/FactionsPro)                                                                                              |
| SimpleFaction         | `{faction_name}`, `{faction_rank}`, `{faction_power}`, `{faction_money}`                              | [Download](https://github.com/AyzrixYTB/SimpleFaction)                                                                                        |
| EconomyAPI            | `{money}`                                                                                             | [Download](https://poggit.pmmp.io/p/EconomyAPI/)                                                                                              |
| PurePerms             | `{rank}`, `{prefix}`, `{suffix}`                                                                      | [Download](https://poggit.pmmp.io/p/PurePerms)                                                                                                |
| SkyBlock              | `{island_blocks}`, `{island_members}`, `{island_rank}`, `{island_size}`                               | [Download](https://poggit.pmmp.io/p/SkyBlock)                                                                                                 |
| SeeDevice             | `{device}`                                                                                            | [Download](https://github.com/Palente/SeeDevice)                                                                                              |
| Bounty                | `{bounty}`                                                                                            | [Download](https://github.com/JaxkDev/Bounty)                                                                                                 |
| Prisons               | `{prisons_rank}`, `{prisons_prestige}`                                                                | [Download](https://github.com/TPEimperialPE/Prisons)                                                                                          |
| OnlineTime            | `{onlinetime_session}`, `{onlinetime_total}`                                                          | [Download](https://github.com/Zedstar16/OnlineTime)                                                                                           |
| CombatLogger          | `{combatlogger_time}`                                                                                 | [Download](https://github.com/JackNoordhuis/PocketMine-Plugins/tree/fcefe035e86150ddce59d7fda6f1bcdbf594a6e7/CombatLogger)                    |
| FightLogger           | `{fightlogger_time}`                                                                                  | [Download](https://poggit.pmmp.io/p/FightLogger)                                                                                              |
| MyPlot                | `{myplot_owner}`, `{myplot_id}`                                                                       | [Download](https://poggit.pmmp.io/p/MyPlot)                                                                                                   |
| CoinsSystem           | `{coins}`                                                                                             | [Download](https://poggit.pmmp.io/p/CoinsSystem)                                                                                              |
| KDR                   | `{kills}` `{deaths}` `{kdr}`                                                                          | [Download](https://poggit.pmmp.io/p/KDR)                                                                                                      |
| Voteparty             | `{votes}` `{maxvotes}`                                                                                | [Download](https://poggit.pmmp.io/p/VoteParty)                                                                                                |
| BankUI                | `{balance}`                                                                                           | [Download](https://poggit.pmmp.io/p/BankUI)                                                                                                   |
| RedSkyBlock           | `{island_members}` `{island_rank}` `{island_size}` `{island_value}` `{island_locked_status}`          | [Download](https://poggit.pmmp.io/p/RedSkyBlock)                                                                                              |
| VanishV2              | `{vanish_fake_count}`                                                                                 | [Download](https://poggit.pmmp.io/p/VanishV2)                                                                                                 |
| MultiEconomy          | `{balance.currencyName}`                                                                              | [Download](https://poggit.pmmp.io/p/MultiEconomy)                                                                                             |
| RankSystem            | `{rank}` `{prefix}`                                                                                   | [Download](https://poggit.pmmp.io/p/RankSystem)                                                                                               |
| MultiServerCounter    | `{MultiServer.online}` `{MultiServer.Maxonline}`                                                      | [Download](https://poggit.pmmp.io/p/MultiServerCounter)                                                                                       |

## Config
```
#     _____                    _                         _
#    / ____|                  | |                       | |
#   | (___   ___ ___  _ __ ___| |__   ___   __ _ _ __ __| |
#    \___ \ / __/ _ \| '__/ _ \ '_ \ / _ \ / _` | '__/ _` |
#    ____) | (_| (_) | | |  __/ |_) | (_) | (_| | | | (_| |
#   |_____/ \___\___/|_|  \___|_.__/ \___/ \__,_|_|  \__,_|
#
#

# Time between a scoreboard update.
# RECOMMANDED: 2 seconds
update_time: 40 # TICKS 20 = 1 second

options:
  # {faction_name} {faction_rank} {faction_power}
  PiggyFactions: false
  # {faction_name} {faction_power}
  FactionsPro: false
  # {faction_name} {faction_rank} {faction_power} {faction_money}
  SimpleFaction: false
  # {money}
  EconomyAPI: false
  # {rank} {prefix} {suffix}
  PurePerms: false
  # {island_blocks} {island_members} {island_rank} {island_size}
  SkyBlock: false
  # {device}
  SeeDevice: false
  # {bounty}
  Bounty: false
  # {prisons_rank} {prisons_prestige}
  Prisons: false
  # {onlinetime_session} {onlinetime_total}
  OnlineTime: false
  # {combatlogger_time}
  CombatLogger: false
  # {fightlogger_time}
  FightLogger: false
  # {myplot_owner} {myplot_id}
  MyPlot: false
  # {coins}
  CoinsSystem: false
  # {kills} {deaths} {kdr}
  KDR: false
  # {votes} {maxvotes}
  VoteParty: false
  # {balance}
  BankUI: false
  # {island_members} {island_rank} {island_size} {island_value} {island_locked_status}
  RedSkyBlock: false
  # {vanish_fake_count}
  VanishV2: false
  # {balance.currencyName} -> Replace "currencyName" by the currency name
  MultiEconomy: false
  # {rank} {prefix}
  RankSystem: false
  # {MultiServer.online} {MultiServer.Maxonline}
  MultiServerCounter: false

# BASE VARIABLES : {ping} {tps} {name} {online} {max_online} {level} {x} {y} {z} {ip} {port} {uid} {xuid} {health} {max_health} {food} {max_food} {gamemode} {scale}

per_world: false
title: "§6Scoreboard"
lines:
    - "line1"
    - "line2"

# Edit just if per_world is on true
worlds:
  world:
    title: "§6Scoreboard"
    lines:
      - "line1"
      - "line2"

# true or false if you want the command for disable the scoreboard
command: false
command_description: "Hide or show the scoreboard"
command_success_hide: "§aYou have successfully hidden the scoreboard"
command_success_show: "§aYou have successfully displayed the scoreboard"
```
