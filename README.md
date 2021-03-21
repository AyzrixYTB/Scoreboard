[![Discord](https://img.shields.io/discord/800828802921529355.svg?label=&logo=discord&logoColor=ffffff&color=7389D8&labelColor=6A7EC2)](https://discord.gg/wuNvKw948n)
# Scoreboard
###### A simple Pocketmine-MP plugin for creating optimized scoreboards.

## Future additions

| Name                  | Description                                           | Type      |
|-----------------------|-------------------------------------------------------|-----------|

## Additional plugins
| Name          | Usage                                                         | Download                                                      |
|---------------|---------------------------------------------------------------|---------------------------------------------------------------| 
| PiggyFactions | {faction_name} {faction_rank} {faction_power}                 | [Download](https://poggit.pmmp.io/p/PiggyFactions)            |
| FactionsPro   | {faction_name} {faction_power}                                | [Download](https://poggit.pmmp.io/p/FactionsPro)              |
| SimpleFaction | {faction_name} {faction_rank} {faction_power} {faction_money} | [Download](https://github.com/AyzrixYTB/SimpleFaction)        |
| EconomyAPI    | {money}                                                       | [Download](https://poggit.pmmp.io/p/EconomyAPI/)              |
| PurePerms     | {rank} {prefix} {suffix}                                      | [Download](https://poggit.pmmp.io/p/PurePerms)                |
| SkyBlock      | {island_blocks} {island_members} {island_rank} {island_size}  | [Download](https://github.com/andresbytes/SkyBlock)           |
| SeeDevice     | {device}                                                      | [Download](https://github.com/Palente/SeeDevice)              |

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
  PiggyFaction: false
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

# BASE VARIABLES : {ping} {tps} {name} {online} {max_online} {level} {x} {y} {z}

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
```
