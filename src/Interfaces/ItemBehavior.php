<?php declare(strict_types=1);

namespace GildedRose\Interfaces;

use GildedRose\Item;

interface ItemBehavior
{
    public function updateQuality(Item $item): void;

    public function tick(Item $item);
}