<?php
namespace Nicolasbordeaux\OssFootballLibrary;
class Competition
{
    private string $name;
    private string $region;
    private string $type;
    private string $id;

    public function __construct(string $name, string $region, ?string $type)
    {
        $this->name = $name;
        $this->region = $region;
        $this->type = $type ?? 'unknown';
        $this->id = strtolower($this->region) . '/' . str_replace(' ', '-', strtolower($this->name));

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

    public function getId(): string
    {
        return $this->id;
    }

}