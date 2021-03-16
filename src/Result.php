<?php

namespace App;

class Result implements \Countable, \IteratorAggregate
{
    /**
     * @var int
     */
    private $count;

    /**
     * @var array|ResultItem
     */
    private $items = [];

    /**
     * Result constructor.
     * @param int $count
     * @param ResultItem|array $items
     */
    public function __construct(int $count, array $items)
    {
        $this->count = $count;

        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function addItem(ResultItem $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return ResultItem|array
     */
    public function getItems()
    {
        return $this->items;
    }

    public function countItemsOnPage(): int
    {
        return count($this->items);
    }

    public function count()
    {
        return $this->count;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}