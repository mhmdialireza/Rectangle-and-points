<?php

namespace App;

class File
{
    public string $path;
    public array $points;
    public Rectangle $rectangle;

    public function __construct(string $path = 'data.txt', array $points = [])
    {
        $this->path = 'data.txt';
        $this->points = $points;
        $this->rectangle = new Rectangle(null, null);
    }

    public function execute()
    {
        if (!($file = fopen($this->path, "r"))) {
            die('Invalid path');
        }

        for ($count = fgets($file); $count-- > 0; feof($file)) {
            $this->setPoints(...$this->filter(fgets($file)));
        }
        $this->setRectangle(...$this->filter(fgets($file)));

        fclose($file);
    }

    private function setPoints(float $x, float $y)
    {
        $this->points[] = new Point($x, $y);
    }

    private function setRectangle(float $x1, float $y1, float $x2, float $y2)
    {
        $this->rectangle->leftDown->x = $x1;
        $this->rectangle->leftDown->y = $y1;
        $this->rectangle->rightTop->x = $x2;
        $this->rectangle->rightTop->y = $y2;
    }

    private function filter(string $str): array
    {
        return array_filter(explode(' ', $str), fn ($value) => !is_null($value) && $value !== '');
    }
}
