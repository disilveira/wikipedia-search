<?php

namespace App\Engine\Wikipedia;

use App\Engine\EngineInterface;
use App\Result;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WikipediaEngine implements EngineInterface
{
    private const URI = 'https://pt.wikipedia.org/w/index.php?search=%s&title=Especial+Pesquisar&fulltext=1&ns0=1';

    /**
     * @var WikipediaParser
     */
    private $parser;

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * WikipediaSearch constructor.
     * @param WikipediaParser $parser
     * @param HttpClientInterface $client
     */
    public function __construct(WikipediaParser $parser, HttpClientInterface $client)
    {
        $this->parser = $parser;
        $this->client = $client;
    }

    public function search(string $term): Result
    {
        $url = sprintf(self::URI, $term);
        $response = $this->client->request('GET', $url);

        return $this->parser->parse($response->getContent());
    }

    public static function getName(): String
    {
        return 'wikipedia';
    }
}
