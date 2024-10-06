<?php

namespace GildedRose\Behaviour;

use GildedRose\Interfaces\ItemBehavior;
use GildedRose\Item;

class NormalItemBehavior implements ItemBehavior
{
    public function updateQuality(Item $item): void
    {
        $item->decreaseQuality();
        if ($item->sellIn <= 0) {
            $item->decreaseQuality();
        }
    }

    public function tick(Item $item): void
    {
        $this->updateQuality($item);
        $item->sellIn--;
    }
}