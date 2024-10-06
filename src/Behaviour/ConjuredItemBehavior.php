<?php

namespace GildedRose\Behaviour;


use GildedRose\Item;
use GildedRose\Interfaces\ItemBehavior;

class ConjuredItemBehavior implements ItemBehavior
{
    public function updateQuality(Item $item): void
    {

        $item->decreaseQuality(2);
        if ($item->sellIn <= 0) {
            $item->decreaseQuality(2);
        }

    }

    public function tick(Item $item): void
    {
        $this->updateQuality($item);
        $item->sellIn--;
    }
}