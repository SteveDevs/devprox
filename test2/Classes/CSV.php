<?php 
namespace Classes;

class CSV
{

  public function generateCsv($data, $delimiter = ',', $enclosure = '"') {
    if (file_exists('storage/output.csv')) {
      unlink('storage/output.csv');
    }
    $handle = fopen("storage/output.csv" ,"w");

    fputcsv($handle, array('Id', 'Name', 'Surname', 'Initials', 'Age', 'DateOfBirth'));
    $id = 0;
    foreach ($data as $line) {
      ++$id;
      $line_arr = explode(',', $line);
      $timestamp = 1 + ($line_arr[0] * 60 * 60 * 24);

      $dob = date('d-m-Y', $timestamp);
      $age = floor((time() - strtotime(strval($dob))) / 31556926);

      $dob = str_replace('-', '/', strval($dob));
      $ini_arr = explode(" ",$line_arr[2]);
      $initial = '';
      foreach ($ini_arr as $value) {
        $initial .= $value[0];
      }
      $data = [$id, $line_arr[2], $line_arr[1], $initial, $age, $dob];
      fputcsv($handle, $data);
    }

    fclose($handle);
    header("Location:import.php");
  }

  public function saveCsvToDB($input) {
    $num = 0;
    try {
      $connection = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    } catch (\Exception $e) {
      header("Location: error.php?error=" . $e->getMessage());
      exit();
    }
        //$file = fopen('output.csv', "r");

    //$csvFile = file($input);

    if ($stmt = $connection->prepare("TRUNCATE TABLE csv_import")) {
      $stmt->execute();
      $stmt->close();
    } else {
      header("Location: error.php?error=" . $connection->error);
      return;
    }

    set_time_limit(0);
    ini_set('memory_limit', '-1');

    $csv = array_map('str_getcsv', file('storage/' . $input['name'])); 

    $values = array(); 
    $count = 0;
    foreach($csv as $row ) {
      ++$count;
      if($row[0] != 'Id'){
        $date = date("Y-m-d", strtotime(str_replace('/', '-', $row[5])));
        $values[] = '('.$row[0].', "'. $row[1] .'", "' . 
        $row[2] . '", "'. $row[3] .'", ' . $row[4] . ', "' . $date . '")';
        if($count%100 == 0){
            $connection->query('INSERT INTO csv_import (id, name, surname, initial, age, dob) VALUES '.implode(',', $values));

              $values = [];
        }
      }
    }
    $connection->query('INSERT INTO csv_import (id, name, surname, initial, age, dob) VALUES '.implode(',', $values));
    
    header("Location:csv_success.php?num=" . strval($count - 1));
      return;
  }
}