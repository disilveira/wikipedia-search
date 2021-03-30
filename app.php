<?php

require 'vendor/autoload.php';

use App\Engine\Wikipedia\WikipediaEngine;
use App\Engine\Wikipedia\WikipediaParser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;

$app = new Application;

$app
    ->register('search')
    ->setDefinition(array(
        new InputArgument('word', InputArgument::REQUIRED, 'Word to search')
    ))
    ->setDescription('Search from wikipedia')
    ->setHelp('
        O comando <info>search</info> exige um argumento <info>word</info>.
        Exemplos:
        <comment>php app.php search pucminas</comment>
    ')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $word = $input->getArgument('word');
        $wikipedia = new WikipediaEngine(new WikipediaParser(), HttpClient::create());
        $results = $wikipedia->search($word);

        $item = [];
        $data = [];

        foreach ($results as $result) {
            $item['title'] = $result->getTitle();
            $item['preview'] = $result->getPreview();
            $data[] = $item;
        }


        $table = new Table($output);
        $table
            ->setHeaders(array(
                array(new TableCell('showing ' . $results->countItemsOnPage() . ' records of ' . $results->count() . ' records for term "' . $word . '" on ' . $wikipedia->getName(), array('colspan' => 2))),
                array('Title', 'Preview'),
            ))
            ->setRows(
                $data
            );
        $table->setStyle('borderless');
        $table->render();
    });

$app->run();
