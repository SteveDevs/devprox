<?php 
namespace Classes;
use Database;

class CSV
{

    public function generateCsv($data, $delimiter = ',', $enclosure = '"') {
        if (file_exists('output.csv')) {
            unlink('output.csv');
        }
       $handle = fopen(__DIR__ . 'output.csv' ,"w");
       foreach ($data as $line) {
        print_r($data);
        exit();
               fputcsv($handle, $line, $delimiter, $enclosure);
       }
       rewind($handle);
       while (!feof($handle)) {
               $contents .= fread($handle, 8192);
       }

       fclose($handle);
       return $contents;
    }

    public function saveCsvToDB() {
        $database = new Database();
        $connection = $database->mysqli;
        $file = fopen('output.csv', "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            if ($stmt = $connection->prepare("INSERT INTO csv_import (
            initial, name, surname, dob) 
            VALUES (?, ?, ?, ?)")) {

            $stmt->bind_param("ssss", 
            $getData[0], $getData[1], $getData[2], $getData[3]);
            $stmt->execute();
            $stmt->close();
        } else {
            header("Location: error.php?error=" . $connection->error);
        }
      
        fclose($file);  
     }
    }
}