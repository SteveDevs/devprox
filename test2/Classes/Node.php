<?php
namespace Classes;

class Node
{
    public const RED = 0;
    public const BLACK = 1;

    public $value;
    public $color;
    public $p;
    public $left;
    public $right;

    public function __construct(int $value = null)
    {
        $this->value = $value;
        $this->color = self::BLACK;
        $this->p = $this->left = $this->right = null;
    }
}
