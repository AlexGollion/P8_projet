<?php 

namespace App\Enum;

enum EmployeeStatut: string
{
    case cdd = 'cdd';
    case cdi = 'cdi';
    case freelance = 'freelance';

    public function getLabel(): string
    {
        return match ($this) 
        {
            self::cdd => 'cdd',
            self::cdi => 'cdi',
            self::freelance => 'freelance',
        };
    }
}

?>