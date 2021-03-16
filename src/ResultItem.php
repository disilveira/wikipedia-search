<?php

namespace App;

class ResultItem
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $preview;

    /**
     * ResultItem constructor.
     * @param string $title
     * @param string $preview
     */
    public function __construct(string $title, string $preview)
    {
        $this->title = $title;
        $this->preview = $preview;
    }

    public static function fromArray(array $item)
    {
        return new self(trim($item['title']), trim($item['preview']));
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getPreview(): string
    {
        return $this->preview;
    }
}