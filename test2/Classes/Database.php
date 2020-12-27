
<?php 
namespace Classes;

class Database
{
    public $mysqli;

    public function __construct()
    {
        try {
            $this->mysqli = new \mysqli(HOST, USER, PASSWORD, DATABASE);
        } catch (\Exception $e) {
            header("Location: error.php?error=" . $e->getMessage());
            exit();
        }
    }

}