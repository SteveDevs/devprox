<?php
namespace Classes;
require 'config.php';

class User
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new \mysqli(HOST, USER, PASSWORD, DATABASE);
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
            if($stmt->num_rows > 0){
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
                        'error' => false,
                        'message' => $this->connection->mysqli_error
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
            $input_data['name'], $input_data['identity_no'], $input_data['surname'], $input_data['dob']);
            
            $stmt->execute();
            $stmt->close();
        } else {
            return header("Location:  error.php?error=" . $this->connection->mysqli_error);

        }
        return header("Location: index.php?message=User was inserted sucessfully");
    }
}
