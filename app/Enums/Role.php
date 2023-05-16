<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Manager = 'manager';
    case Teacher = 'teacher';
    case Student = 'student';
    case Guest = 'guest';
}
