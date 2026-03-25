<?php

namespace App\Model;

enum Condition: string
{
    case New         = 'new';
    case Used        = 'used';
    case Refurbished = 'refurbished';
}