<?php

namespace mehrbod1gamer\simpleWear;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Armor;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;

class main extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCloth(PlayerInteractEvent $event)
    {
        $item  = $event->getItem();
        $player = $event->getPlayer();
        $armorInventory = $player->getArmorInventory();
        $inventory = $player->getInventory();
        if ($item instanceof Armor) {
            switch ($this->getType($item)) {
                case "boot":
                    if (!$armorInventory->isSlotEmpty(3)){
                        $boot = $armorInventory->getBoots();
                        $inventory->addItem($boot);
                    }
                    $armorInventory->setBoots($item);
                    $inventory->removeItem($item);
                    break;
                case "legging":
                    if (!$armorInventory->isSlotEmpty(2)){
                        $legging = $armorInventory->getLeggings();
                        $inventory->addItem($legging);
                    }
                    $armorInventory->setLeggings($item);
                    $inventory->removeItem($item);
                    break;
                case "chest_plate":
                    if (!$armorInventory->isSlotEmpty(1)){
                        $chest_plate = $armorInventory->getChestplate();
                        $inventory->addItem($chest_plate);
                    }
                    $armorInventory->setChestplate($item);
                    $inventory->removeItem($item);
                    break;
                case "helmet":
                    if (!$armorInventory->isSlotEmpty(0)){
                        $helmet = $armorInventory->getHelmet();
                        $inventory->addItem($helmet);
                    }
                    $armorInventory->setHelmet($item);
                    $inventory->removeItem($item);
                    break;
            }
        }
    }

    public function getType(Item $item)
    {
        $id = $item->getId();
        $boots = [
            Item::DIAMOND_BOOTS,
            Item::IRON_BOOTS,
            Item::GOLD_BOOTS,
            Item::LEATHER_BOOTS,
            Item::CHAIN_BOOTS,
        ];
        $leggings = [
            Item::DIAMOND_LEGGINGS,
            Item::IRON_LEGGINGS,
            Item::GOLD_LEGGINGS,
            Item::CHAIN_LEGGINGS,
            Item::LEATHER_LEGGINGS,
        ];
        $chest_plates = [
            Item::DIAMOND_CHESTPLATE,
            Item::CHAIN_CHESTPLATE,
            Item::GOLD_CHESTPLATE,
            Item::IRON_CHESTPLATE,
            Item::LEATHER_CHESTPLATE,
        ];
        $helmets = [
            Item::DIAMOND_HELMET,
            Item::CHAIN_HELMET,
            Item::GOLD_HELMET,
            Item::IRON_HELMET,
            Item::LEATHER_HELMET,
        ];
        if     (in_array($id, $boots)){return "boot";}
        elseif (in_array($id, $leggings)){return "legging";}
        elseif (in_array($id, $chest_plates)){return "chest_plate";}
        elseif (in_array($id, $helmets)){return "helmet";}
    }
}
