<?php

namespace App;

class Rectangle
{
    public ?Point $leftDown;
    public ?Point $rightTop;

    public function __construct(?Point $leftDown, ?Point $rightTop)
    {
        $this->leftDown = $leftDown ?? new Point();
        $this->rightTop = $rightTop ?? new Point();
    }

    public function isInside(Point $point): bool
    {
        if (
            $point->x < $this->leftDown->x ||
            $point->x > $this->rightTop->x ||
            $point->y < $this->leftDown->y ||
            $point->y > $this->rightTop->y
        ) {
            return false;
        }
        return true;
    }

    public function isBaseState()
    {
        if (
            $this->leftDown->x <= $this->rightTop->x + 1 &&
            $this->leftDown->y <= $this->rightTop->y + 1
        ) {
            return true;
        }
    }

    public function isBaseStateY()
    {
        if (
            $this->leftDown->x > $this->rightTop->x + 1 &&
            $this->leftDown->y <= $this->rightTop->y + 1
        ) {
            return true;
        }
    }

    public function isBaseStateX()
    {
        if (
            $this->leftDown->x <= $this->rightTop->x + 1 &&
            $this->leftDown->y > $this->rightTop->y + 1
        ) {
            return true;
        }
    }
}
