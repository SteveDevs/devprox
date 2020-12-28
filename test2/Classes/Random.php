<?php 
namespace Classes;

class Random
{
    public $name;

    public $surname;

    public $days;

    private $names = [
        "Andre Smith", "Steve", "Brendon", "Bradly", "Peter", "Sally",
        "Jenny", "Brent", "Paul", "Vinny", "Jeff", "Daniel",
        "Leigh", "Tarryn", "Pauline Joe", "Ferlyn", "Fabian", "Chad",
        "Ryan", "Greg Peel"
    ];

    private $surnames = [
        "Topkin", "Van Der Merve", "Van Heerden","Coetzee",
        "Smith", "Rodgers", "Parry", "Lynn", "Teel", "Johnson",
        "Williams", "Brown", "Jones", "Garcia", "Miller",
        "Davis", "Rodriguez", "Martinez", "Hernandez",
        "Lopez"
    ];


    public function generate(){
        $this->name = $this->names[array_rand($this->names)];
        $this->surname = $this->surnames[array_rand($this->surnames)];
        //Generate a timestamp using mt_rand.
        $timestamp = mt_rand(1, time());
        $this->days = floor($timestamp/60/60/24);
    }
}