<?php

namespace MariusB\ItemID;

use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as Color;

class Main extends PluginBase implements Listener{
    
    const PREFIX = Color::WHITE."[".Color::GREEN."ItemID".Color::WHITE."]";

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
             if (count($args) < 1) {
                $inHandid = $sender->getInventory()->getItemInHand()->getId();
                $inHandname = $sender->getInventory()->getItemInHand()->getName();
                $sender->sendMessage($this->message("You're holding $inHandName ID: $inHandID"));
                return true;
                 
             }else{
                $sender->sendMessage($this->message("Invalid usage: /item"));
                return true;
                }
             }else{
                $sender->sendMessage($this->message("You dont have permission for this command", false));
                return true;
             }
         }else{
             $sender->sendMessage($this->message("Please run this command in game", false));
           }
      return true;
    }
    } 

    return true;
    
}

    public function message($msg, $positive=true){
     if($positive === true){
         return self::PREFIX." $msg";
     }elseif($positive === false);{
         return self::PREFIX." ".Color::RED."$msg";
        }else{
         return "ERROR: Invalid value for second param";   
        }
        }
     }
     }   
    }
    }
}
