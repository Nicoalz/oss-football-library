<?php
namespace Nicolasbordeaux\OssFootballLibrary;
class Winner
{
    private string $name;
    private int $winsNmb;

    public function __construct(string $name, int $winsNmb)
    {
        $this->name = $name;
        $this->winsNmb = $winsNmb;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWinsNmb(): int
    {
        return $this->winsNmb;
    }

}