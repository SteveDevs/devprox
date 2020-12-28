<?php
namespace Classes;
require "config.php";

class User
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        } catch (\Exception $e) {
            header("Location: error.php?error=" . $e->getMessage());
            exit();
        }
    }

    public function get($id){
        $sqlstr = "SELECT * FROM user WHERE identity_no = ?";
        if ($stmt = $this->connection->prepare($sqlstr)){
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $stmt->store_result();
            $numberofrows = $stmt->num_rows;
            if($numberofrows > 0){
                return json_encode(
                    [
                        'error' => false,
                        'exists' => true
                    ]
                );
            }
            $stmt->close();
        } else {
            return json_encode(
                    [
                        'error' => true,
                        'message' => $this->connection->error
                    ]
                );
        }
        return json_encode(
                    [
                        'error' => false,
                        'exists' => false
                    ]
                );
    }

    public function insert($input_data){
        if ($stmt = $this->connection->prepare("INSERT INTO user (
            name, identity_no, surname, dob) 
            VALUES (?, ?, ?, ?)")) {

            $stmt->bind_param("ssss", 
            $input_data['name'], $input_data['identity_no'], $input_data['surname'], date("Y-m-d", strtotime(str_replace('/', '-', $input_data['dob']))));

            if(!$stmt->execute()){
                header("Location:  error.php?error=" . $stmt->error);
                $stmt->close();
                return;
            }
            $stmt->close();
        } else {
            header("Location:  error.php?error=" . $this->connection->error);
            return;
        }
        header("Location: index.php?success_message=User was inserted sucessfully");
    }
}
