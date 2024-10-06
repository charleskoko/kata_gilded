<?php declare(strict_types=1);

namespace GildedRose;

use GildedRose\Behaviour\AgedBrieBehavior;
use GildedRose\Behaviour\ConjuredItemBehavior;
use GildedRose\Behaviour\NormalItemBehavior;
use GildedRose\Behaviour\SulfurasBehavior;
use GildedRose\Behaviour\BackstagePassBehavior;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

    public function testNormalBeforeSellDate()
    {
        $item = new Item('normal', 10, 5, new NormalItemBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(9, $rose->getQuality());
        $this->assertEquals(4, $rose->getDaysRemaining());
    }

    public function testNormalOnSellDate()
    {
        $item = new Item('normal', 10, 0, new NormalItemBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(8, $rose->getQuality());
        $this->assertEquals(-1, $rose->getDaysRemaining());
    }

    public function testNormalAfterSellDate()
    {
        $item = new Item('normal', 10, -1, new NormalItemBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(8, $rose->getQuality());
        $this->assertEquals(-2, $rose->getDaysRemaining());
    }

    public function testNormalOfZeroQuality()
    {
        $item = new Item('normal', 0, 5, new NormalItemBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(0, $rose->getQuality());
        $this->assertEquals(4, $rose->getDaysRemaining());
    }

    public function testBrieBeforeSellDate()
    {
        $item = new Item('Aged Brie', 10, 5, new AgedBrieBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(11, $rose->getQuality());
        $this->assertEquals(4, $rose->getDaysRemaining());
    }

    public function testBrieBeforeSellDateWithMaxQuality()
    {
        $item = new Item('Aged Brie', 50, 5, new AgedBrieBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(50, $rose->getQuality());
        $this->assertEquals(4, $rose->getDaysRemaining());
    }

    public function testBrieOnSellDate()
    {
        $item = new Item('Aged Brie', 10, 0, new AgedBrieBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(12, $rose->getQuality());
        $this->assertEquals(-1, $rose->getDaysRemaining());
    }

    public function testBrieOnSellDateNearMaxQuality()
    {
        $item = new Item('Aged Brie', 49, 0, new AgedBrieBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(50, $rose->getQuality());
        $this->assertEquals(-1, $rose->getDaysRemaining());
    }

    public function testBrieOnSellDateWithMaxQuality()
    {
        $item = new Item('Aged Brie', 50, 0, new AgedBrieBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(50, $rose->getQuality());
        $this->assertEquals(-1, $rose->getDaysRemaining());
    }

    public function testBrieAfterSellDate()
    {
        $item = new Item('Aged Brie', 40, -1, new AgedBrieBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(42, $rose->getQuality());
        $this->assertEquals(-2, $rose->getDaysRemaining());
    }

    public function testBrieAfterSellDateWithMaxQuality()
    {
        $item = new Item('Aged Brie', 50, -1, new AgedBrieBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(50, $rose->getQuality());
        $this->assertEquals(-2, $rose->getDaysRemaining());
    }

    public function testSulfurasBeforeSellDate()
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 10, 5, new SulfurasBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(10, $rose->getQuality());
        $this->assertEquals(5, $rose->getDaysRemaining());
    }

    public function testSulfurasOnSellDate()
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 10, 0, new SulfurasBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(10, $rose->getQuality());
        $this->assertEquals(0, $rose->getDaysRemaining());
    }

    public function testSulfurasAfterSellDate()
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 10, -1, new SulfurasBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(10, $rose->getQuality());
        $this->assertEquals(-1, $rose->getDaysRemaining());
    }

    public function testBackstageLongBeforeSellDate()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(11, $rose->getQuality());
        $this->assertEquals(19, $rose->getDaysRemaining());
    }

    public function testBackstageMediumCloseToSellDateUpperBound()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(12, $rose->getQuality());
        $this->assertEquals(9, $rose->getDaysRemaining());
    }

    public function testBackstageMediumCloseToSellDateUpperBoundAtMaxQuality()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 50, 10, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(50, $rose->getQuality());
        $this->assertEquals(9, $rose->getDaysRemaining());
    }

    public function testBackstageMediumCloseToSellDateLowerBound()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 6, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(12, $rose->getQuality());
        $this->assertEquals(5, $rose->getDaysRemaining());
    }

    public function testBackstageMediumCloseToSellDateLowerBoundAtMaxQuality()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 50, 6, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(50, $rose->getQuality());
        $this->assertEquals(5, $rose->getDaysRemaining());
    }

    public function testBackstageVeryCloseToSellDateUpperBound()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 5, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(13, $rose->getQuality());
        $this->assertEquals(4, $rose->getDaysRemaining());
    }

    public function testBackstageVeryCloseToSellDateUpperBoundAtMaxQuality()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 50, 5, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(50, $rose->getQuality());
        $this->assertEquals(4, $rose->getDaysRemaining());
    }

    public function testBackstageVeryCloseToSellDateLowerBound()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 1, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(13, $rose->getQuality());
        $this->assertEquals(0, $rose->getDaysRemaining());
    }

    public function testBackstageVeryCloseToSellDateLowerBoundAtMaxQuality()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 50, 1, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(50, $rose->getQuality());
        $this->assertEquals(0, $rose->getDaysRemaining());
    }

    public function testBackstageOnSellDate()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 0, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(0, $rose->getQuality());
        $this->assertEquals(-1, $rose->getDaysRemaining());
    }

    public function testBackstageAfterSellDate()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, -1, new BackstagePassBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(0, $rose->getQuality());
        $this->assertEquals(-2, $rose->getDaysRemaining());
    }

    public function testConjuredBeforeSellDate()
    {

        $item = new Item('Conjured', 10, 10, new ConjuredItemBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(8, $rose->getQuality());
        $this->assertEquals(9, $rose->getDaysRemaining());
    }

    public function testConjuredOnSellDate()
    {

        $item = new Item('Conjured', 10, 0, new ConjuredItemBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(6, $rose->getQuality());
        $this->assertEquals(-1, $rose->getDaysRemaining());
    }


    public function testConjuredAfterSellDate()
    {

        $item = new Item('Conjured', 10, -1, new ConjuredItemBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(6, $rose->getQuality());
        $this->assertEquals(-2, $rose->getDaysRemaining());
    }

    public function testConjuredOfZeroQuality()
    {

        $item = new Item('Conjured', 0, 5, new ConjuredItemBehavior());
        $rose = new GildedRose($item);
        $rose->tick();

        $this->assertEquals(0, $rose->getQuality());
        $this->assertEquals(4, $rose->getDaysRemaining());
    }
}