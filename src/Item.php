<?php declare(strict_types=1);

namespace GildedRose;


use GildedRose\Interfaces\ItemBehavior;
use PhpParser\Node\Expr\Instanceof_;
use function PHPUnit\Framework\isInstanceOf;

class Item
{
    public string $name;
    public int $quality;
    public int $sellIn;
    private ItemBehavior $behavior;

    public function __construct(string $name, int $quality, int $sellIn, ItemBehavior $behavior)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
        $this->behavior = $behavior;
    }

    public function tick(): void
    {
        $this->behavior->tick($this);
    }

    public function decreaseQuality(int $amount = 1): void
    {
        $this->quality = max(0, $this->quality - $amount);
    }

    public function increaseQuality(int $amount = 1): void
    {
        $this->quality = min(50, $this->quality + $amount);
    }
}