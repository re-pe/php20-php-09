<?php

$clear_cmd = match(PHP_OS_FAMILY) {
    'Windows' => 'cls',
    'BSD', 'Darwin', 'Solaris', 'Linux' => 'clear',
    default => throw new Error('Unknown operating system!'),
};

system($clear_cmd);

require_once 'src/ToString.php';
require_once 'src/Rectangle.php';
require_once 'src/Circle.php';

use Shapes\Rectangle;
use Shapes\Circle;

$rectangle = new Rectangle(1, 1, 3, 3);

echo "\n\$rectangle === ", $rectangle, "\n";

$rectangle2 = clone $rectangle;

$rectangle2->move(3, 3);

echo "\n\$rectangle2 === ", $rectangle2, "\n";

$point = [5, 5];

$pointStr = implode(', ', $point);

echo "\n\$rectangle->cornerPoints === ", var_export($rectangle->cornerPoints, true), "\n";

echo "\n\$rectangle2->cornerPoints === ", var_export($rectangle2->cornerPoints, true), "\n";

echo "\n\$rectangle->isPointInside($pointStr) === ", var_export($rectangle->isPointInside(...$point), true), "\n";

echo "\n\$rectangle2->isPointInside($pointStr) === ", var_export($rectangle2->isPointInside(...$point), true), "\n";

$rectangle3 = $rectangle->intersection($rectangle2);

if (is_null($rectangle3)) {
    echo "\n\$rectangle3 === null\n";
} else {
    echo "\n\$rectangle3->cornerPoints === ", var_export($rectangle3->cornerPoints, true), "\n";
}

$rectangle4 = $rectangle->union($rectangle2);

echo "\n\$rectangle4->cornerPoints === ", var_export($rectangle4->cornerPoints, true), "\n";

$circle = new Circle(3, 3, 2);

echo "\n\$circle->parameters === ", var_export($circle->parameters, true), "\n";
// xdebug_break();
echo "\n\$circle->isPointInside(5, 3) === ", var_export($circle->isPointInside(5, 3), true), "\n";
$points = [
  [0, 0],
  [0, 1],
  [1, 3],
  [1, 1],
  [0, 2],
  [2, 0],
  [2, 2],
  [0, 3],
  [3, 0],
  [3, 3],
];
foreach ($points as $point) {
    echo "\n\$circle->isPointInside({$point[0]}, {$point[1]}) === ",
          var_export($circle->isPointInside(...$point), true),
          "\n";
}
