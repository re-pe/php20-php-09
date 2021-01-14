<?php

namespace Shapes;

require_once 'src/ToString.php';

class Circle
{
    use ToString;

    public function __construct(
        private float $x,
        private float $y,
        private float $r,
    ) {
    }

    public function __get($name): mixed
    {
        return match($name) {
        'centerPoint' => [
            'x' => $this->x,
            'y' => $this->y,
        ],
        'radius' => $this->r,
        'parameters' => [
            'x' => $this->x,
            'y' => $this->y,
            'r' => $this->r,
        ],
        default => throw new Error("Property $name does not exist"),
        };
    }

    public function isPointInside(float $x, float $y): bool
    {
        $distX = $x - $this->x;
        $distY = $y - $this->y;
        return !($distX ** 2 + $distY ** 2 > $this->r ** 2);
    }
}
