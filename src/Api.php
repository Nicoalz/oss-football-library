<?php

declare(strict_types=1);

namespace Nicolasbordeaux\OssFootballLibrary;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Api
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getPopularCompetitions(): array
    {
        $response = $this->client->request(
            'GET',
            'https://www.foot-direct.com/classement'
        );
        $content = $response->getContent();
        $crawler = new Crawler($content);
        $crawler = $crawler->filter('div.content');
        $crawler = $crawler->filter('div.cards')->first();
        $crawler = $crawler->filter('ul.card__list');
        $crawler->filter('li')->each(function (Crawler $node, $i) use (&$competitions) {
            $competitions[] = new Competition(
                $node->filter('span.identity__title')->text(),
                $node->filter('span.identity__subtitle')->text(),
                $node->attr('data-type')
            );
        });
        return $competitions;
    }

}

class Competition
{
    private string $name;
    private string $region;
    private string $type;

    public function __construct(string $name, string $region, string $type)
    {
        $this->name = $name;
        $this->region = $region;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getType(): string
    {
        return $this->type;
    }
}