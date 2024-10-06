<?php declare(strict_types=1);

namespace GildedRose\Behaviour;

use GildedRose\Item;
use GildedRose\Interfaces\ItemBehavior;

class AgedBrieBehavior implements ItemBehavior
{
    public function updateQuality(Item $item): void
    {
        $item->increaseQuality();
        if ($item->sellIn <= 0) {
            $item->increaseQuality();
        }
    }

    public function tick(Item $item): void
    {
        $this->updateQuality($item);
        $item->sellIn--;
    }
}