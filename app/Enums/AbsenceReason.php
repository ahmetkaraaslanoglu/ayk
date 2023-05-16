<?php

namespace App\Enums;

enum AbsenceReason: string
{
    case Sick = 'sick';
    case Personal = 'personal';
    case Other = 'other';
}
