<?php

use Nicolasbordeaux\OssFootballLibrary\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testGetPopularCompetitions()
    {
        $client = Symfony\Component\HttpClient\HttpClient::create();
        $api = new Api($client);
        $competitions = $api->getPopularCompetitions();
        $this->assertIsArray($competitions);
        foreach ($competitions as $competition) {
            $this->assertIsString($competition->getName());
            $this->assertIsString($competition->getRegion());
            $this->assertIsString($competition->getType());
            $this->assertIsString($competition->getId());
        }
    }

    public function testGetBestWinners()
    {
        $client = Symfony\Component\HttpClient\HttpClient::create();
        $api = new Api($client);
        $mockedCompetitionId = 'international/coupe-du-monde';
        $winners = $api->getBestWinners($mockedCompetitionId);
        $this->assertIsArray($winners);
        foreach ($winners as $winner) {
            $this->assertIsString($winner->getName());
            $this->assertIsInt($winner->getWinsNmb());
        }
    }
}