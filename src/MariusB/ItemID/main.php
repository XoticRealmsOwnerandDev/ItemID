<?php

namespace MariusB\ItemID;

use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class Main extends PluginBase implements Listener{

public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->getLogger()->info("ItemID is enabled");
}

public function onDisable(){
$this->getLogger()->info("ItemID is Disabled");
}

public function onItemHeld(PlayerItemHeldEvent $event){
$item = $event->getItem();
$player = $event->getPlayer();
if($player->hasPermission('item.info')){
$player->sendPopup($item->getName()." §eID: ".$item->getId().":".$item->getDamage(), 2); // More info about item that is held
return true;
}
}

public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    if(strtolower($command->getName()) === "item"){
         if ($sender instanceof Player){
           if ($sender->hasPermission("item.command")){            
             if (count($args) <1) {
                $inHandid = $sender->getInventory()->getItemInHand()->getId();
                $inHandname = $sender->getInventory()->getItemInHand()->getName();
                $sender->sendMessage("[ItemID]You are holding $inHandname ID $inHandid meta $inHandmeta");
                return true;}
             else {$sender->sendMessage("[ItemID]what?what?");
              return true;}
         }else {$sender->sendMessage("[ItemID]You are not a Player");
           }
      return true;}
    } 

    return true;}    
}
