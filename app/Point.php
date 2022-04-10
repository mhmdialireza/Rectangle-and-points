<?php

namespace App;

class Point
{
    public float $x = 0;
    public float $y = 0;

    public function __construct( float $x = 0,float $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

}