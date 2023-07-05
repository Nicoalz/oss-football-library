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

    /**
     * @return Competition[]
     */
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
        $competitions = [];
        $crawler->filter('li')->each(function (Crawler $node, $i) use (&$competitions) {
            $competitions[] = new Competition(
                $node->filter('span.identity__title')->text(),
                $node->filter('span.identity__subtitle')->text(),
                $node->attr('data-type')
            );
        });
        return $competitions;
    }

    /**
     * @return Winner[]
     */
    public function getBestWinners(string $competitionID): array
    {
        $response = $this->client->request(
            'GET',
            'https://www.foot-direct.com/' . $competitionID . '/#tabAwards'
        );
        $content = $response->getContent();
        $crawler = new Crawler($content);
        $crawler = $crawler->filter('div#tabAwards');
        $crawler = $crawler->filter('div.card')->first();
        $winners = [];
        $crawler = $crawler->filter('div.statHorizontalBar')->each(function (Crawler $node, $i) use (&$winners) {
            $winners[] = new Winner(
                $node->filter('div.statHorizontalBar__label')->text(),
                (int) $node->filter('div.statHorizontalBar__value')->text()
            );
        });

        return $winners;
    }

}