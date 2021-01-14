<?php

namespace Shapes;

class Rectangle
{
    use ToString;

    public function __construct(private float $x1, private float $y1, private float $x2, private float $y2)
    {
        if ($x2 < $x1) {
            list($this->x1, $this->x2) = [$x2, $x1];
        }

        if ($y2 < $y1) {
            list($this->y1, $this->y2) = [$y2, $y1];
        }
    }

    public function __get($name): mixed
    {
        return match($name) {
        'cornerPoints' => [
            'x1' => $this->x1,
            'y1' => $this->y1,
            'x2' => $this->x2,
            'y2' => $this->y2,
        ],
        default => throw new Error("Property $name does not exist"),
        };
    }

    public function move(float $dX, float $dY): void
    {
        $this->x1 += $dX;
        $this->y1 += $dY;
        $this->x2 += $dX;
        $this->y2 += $dY;
    }

    public function isPointInside(float $x, float $y): bool
    {
        return ($this->x1 <= $x) && ($x <= $this->x2)
            && ($this->y1 <= $y) && ($y <= $this->y2);
    }


    public function intersection(Rectangle $rectangle): ?Rectangle
    {
        list('x1' => $x1, 'y1' => $y1, 'x2' => $x2, 'y2' => $y2) = $rectangle->cornerPoints;

        if ($this->x1 > $x1) {
            $x1 = $this->x1;
        }

        if ($this->y1 > $y1) {
            $y1 = $this->y1;
        }

        if ($this->x2 < $x2) {
            $x2 = $this->x2;
        };

        if ($this->y2 < $y2) {
            $y2 = $this->y2;
        };

        if ($x2 < $x1 || $y2 < $y1) {
            return null;
        }

        return new Rectangle($x1, $y1, $x2, $y2);
    }

    public function union(Rectangle $rectangle): ?Rectangle
    {
        /* if (is_null($this->intersection($rectangle))) {
            return null;
        } */

        list('x1' => $x1, 'y1' => $y1, 'x2' => $x2, 'y2' => $y2) = $rectangle->cornerPoints;

        if ($this->x1 < $x1) {
            $x1 = $this->x1;
        }

        if ($this->y1 < $y1) {
            $y1 =  $this->y1;
        }

        if ($this->x2 > $x2) {
            $x2 = $this->x2;
        };

        if ($this->y2 > $y2) {
            $y2 = $this->y2;
        };

        return new Rectangle($x1, $y1, $x2, $y2);
    }
}
