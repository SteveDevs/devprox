<?php 
namespace Classes;

class Random
{
    public $name;
    public $name_letter;
    public $surname;
    public $surname_letter;
    public $days;

    private $names = [
        "Andre", "Steve", "Brendon", "Bradly", "Peter", "Sally",
        "Jenny", "Brent", "Paul", "Vinny", "Jeff", "Daniel",
        "Leigh", "Tarryn", "Pauline", "Ferlyn", "Fabian", "Chad",
        "Ryan", "Greg"
    ];

    private $names_letters = [
        "A", "S", "B", "B", "P", "S",
        "J", "B", "P", "V", "J", "D",
        "L", "T", "P", "F", "F", "C",
        "R", "G"
    ];

    private $surnames = [
        "Topkin", "Van Der Merve", "Van Heerden","Coetzee",
        "Smith", "Rodgers", "Parry", "Lynn", "Teel", "Johnson",
        "Williams", "Brown", "Jones", "Garcia", "Miller",
        "Davis", "Rodriguez", "Martinez", "Hernandez",
        "Lopez"
    ];

    private $surnames_letters = [
        "T", "V", "V","C",
        "S", "R", "P", "L", "T", "J",
        "W", "B", "J", "G", "M",
        "D", "R", "M", "H",
        "L"
    ];

    public function generate(){
        $this->name_letter = $this->names_letters[array_rand($this->names)];
        $this->surname_letter = $this->surnames_letters[array_rand($this->surnames)];
        //Generate a timestamp using mt_rand.
        $timestamp = mt_rand(1, time());
        $this->days = floor($timestamp/60/60/24);
        //Format that timestamp into a readable date string.
        //$this->date = date("d M Y", $timestamp);
    }
}