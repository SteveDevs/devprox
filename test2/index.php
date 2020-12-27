<?php

$error = '';
if(isset($_GET['error'])){
	$error = $_GET['error'];
}

echo "
<span>{$error}</span>
<form method='POST' action='handle_submit.php'>
  <input type='number' name='number_nodes' placeholder='Insert number of nodes'>
  <button type='submit'>Submit</button>
</form>";
