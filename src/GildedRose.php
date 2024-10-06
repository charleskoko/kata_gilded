<?php declare(strict_types=1);

namespace GildedRose;

class GildedRose
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    // Mise à jour de l'item
    public function tick(): void
    {
        $this->item->tick();
    }

    // Retourne la qualité actuelle de l'item
    public function getQuality(): int
    {
        return $this->item->quality;
    }

    // Retourne les jours restants (SellIn) de l'item
    public function getDaysRemaining(): int
    {
        return $this->item->sellIn;
    }
}