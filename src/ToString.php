<?php

namespace Shapes;

trait ToString
{

    public function __toString(): string
    {
        return var_export($this, true);
    }
}
