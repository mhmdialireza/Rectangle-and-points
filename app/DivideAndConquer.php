<?php

namespace App;

class DivideAndConquer
{
    public function execute(Rectangle $rectangle, array $points)
    {
        if ($rectangle->isBaseState()) {
            $insidePoints = [];
            foreach ($points as $point) {
                if ($rectangle->isInside($point)) {
                    $insidePoints[] = $point;
                }
            }
            return $insidePoints;
        } else if ($rectangle->isBaseStateX()) {
            $x1 = $rectangle->leftDown->x;
            $y1 = $rectangle->leftDown->y;
            $x2 = $rectangle->rightTop->x;
            $y2 = $rectangle->rightTop->y;

            $middleY = floor(($y1 + $y2) / 2);

            $newRectangle1 = new Rectangle(new Point($x1, $y1), new Point($x2, $middleY));
            $newRectangle2 = new Rectangle(new Point($x1, $middleY), new Point($x2, $y2));

            return [
                ...$this->execute($newRectangle1, $points),
                ...$this->execute($newRectangle2, $points)
            ];
        } else if ($rectangle->isBaseStateY()) {
            $x1 = $rectangle->leftDown->x;
            $y1 = $rectangle->leftDown->y;
            $x2 = $rectangle->rightTop->x;
            $y2 = $rectangle->rightTop->y;

            $middleX = floor(($x1 + $x2) / 2);

            $newRectangle1 = new Rectangle(new Point($x1, $y1), new Point($middleX, $y2));
            $newRectangle2 = new Rectangle(new Point($middleX, $y1), new Point($x2, $y2));

            return [
                ...$this->execute($newRectangle1, $points),
                ...$this->execute($newRectangle2, $points)
            ];
        } else {
            $x1 = $rectangle->leftDown->x;
            $y1 = $rectangle->leftDown->y;
            $x2 = $rectangle->rightTop->x;
            $y2 = $rectangle->rightTop->y;

            $middleX = floor(($x1 + $x2) / 2);
            $middleY = floor(($y1 + $y2) / 2);

            $newRectangle1 = new Rectangle(new Point($x1, $y1), new Point($middleX, $middleY));
            $newRectangle2 = new Rectangle(new Point($x1, $middleY), new Point($middleX, $y2));
            $newRectangle3 = new Rectangle(new Point($middleX, $middleY), new Point($x2, $y2));
            $newRectangle4 = new Rectangle(new Point($middleX, $y1), new Point($x2, $middleY));

            return [
                ...$this->execute($newRectangle1, $points),
                ...$this->execute($newRectangle2, $points),
                ...$this->execute($newRectangle3, $points),
                ...$this->execute($newRectangle4, $points),
            ];
        }
    }
}
