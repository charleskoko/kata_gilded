<?php

namespace GildedRose\Behaviour;

use GildedRose\Item;
use GildedRose\Interfaces\ItemBehavior;


class BackstagePassBehavior implements ItemBehavior
{
    public function updateQuality(Item $item): void
    {
        if ($item->sellIn > 10) {
            $item->increaseQuality();
        } elseif ($item->sellIn > 5) {
            $item->increaseQuality(2);
        } elseif ($item->sellIn > 0) {
            $item->increaseQuality(3);
        } else {
            $item->quality = 0;
        }
    }

    public function tick(Item $item): void
    {
        $this->updateQuality($item);
        $item->sellIn--;
    }
}