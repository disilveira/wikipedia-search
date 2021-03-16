<?php

namespace App\Engine\Wikipedia;

use App\Result;
use App\ResultItem;
use Symfony\Component\DomCrawler\Crawler;

class WikipediaParser
{
    public function parse(string $content): Result
    {
        $crawler = new Crawler($content);
        $count = (int) $crawler->filter('.results-info')->attr('data-mw-num-results-total');

        $items = [];
        $list = $crawler->filter('.mw-search-results');

        /** @var \DOMElement $itemNode */
        foreach ($list->children() as $itemNode) {
            $itemNode = new Crawler($itemNode);
            $item = [
                'title' => $itemNode->filter('.mw-search-result-heading a')->first()->attr('title'),
                'preview' => $itemNode->filter('.searchresult')->first()->text()
            ];

            $items[] = ResultItem::fromArray($item);
        }

        return new Result($count, $items);
    }
}
