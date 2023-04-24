<?php
namespace App\Model;

use App\Libraries\Database;

/**
 * Summary of Stock
 */
class Stock
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  // function for login
  public function login($data)
  {
    // destructure email and password
    $email = $data["email"];
    $password = $data["password"];

    // create query to check if the email and password exist in the database
    $query = "SELECT `id` from register where email = '$email' and password = '$password'";
    $result = $this->db->execute($query);

    // check if the result contains any row, if yes return the row's id
    if ($result->num_rows) {
      return $result->fetch_assoc();
    }
    return false;
  }

  // function for registration
  public function register($data)
  {
    // destructure name, email and password
    $name = $data["name"];
    $email = $data["email"];
    $password = $data["password"];

    // create insert query to add the user in the database
    $query = "INSERT INTO register (name,email,password)
        VALUES ('$name','$email', '$password')";
    $result = $this->db->execute($query);

    // return the result
    return $result;
  }

  // function to add stock data
  public function add_data($data)
  {
    $id = $_SESSION['user'];
    $sname = $data['stock_name'];
    $sprice = $data['stock_price'];
    $createdate = date('Y-m-d');
    $update = date('Y-m-d H:i:s');

    // create insert query to add the stock data in the database
    $query = "INSERT INTO stock_data (user_id, stock_name, stock_price,create_date,last_update) 
                    VALUES ('$id', '$sname', '$sprice', '$createdate','$update')";
    // Execute the query here
    $result = $this->db->execute($query);

    // return the result
    return $result;
  }

  // function to display user's stock data
  public function display_my_entry()
  {
    $id = $_SESSION['user'];

    // create query to fetch user's stock data from the database
    $query = "SELECT stock_name,stock_price,create_date,last_update from stock_data where user_id = '$id' ";
    $result = $this->db->execute($query);
    $data = [];
    $i = 0;
    while ($row = $result->fetch_assoc()) {
      $data[$i]['stock_name'] = $row['stock_name'];
      $data[$i]['stock_price'] = $row['Stock_price'];
      $data[$i]['created_date'] = $row['created_date'];
      $data[$i]['last_update'] = $row['last_update'];
      $i++;
    }
    return $data;
  }

  // function to display all stock data
  public function display_all_entry()
  {
    // Get the user ID from the session
    $id = $_SESSION['user'];

    // Select all entries for the user from the stock_data table
    $query = "SELECT stock_name, stock_price, create_date, last_update FROM stock_data";
    $result = $this->db->execute($query);

    // Iterate over the result and store each row in an array
    $data = [];
    $i = 0;
    while ($row = $result->fetch_assoc()) {
      $data[$i]['stock_name'] = $row['stock_name'];
      $data[$i]['stock_price'] = $row['Stock_price'];
      $data[$i]['created_date'] = $row['created_date'];
      $data[$i]['last_update'] = $row['last_update'];
      $i++;
    }

    // Return the array of entries
    return $data;
  }

  public function delete($sname)
  {
    // Delete the entry with the given stock name from the stock_data table
    $query = "DELETE FROM notes WHERE stock_name='$sname'";
    $this->db->execute($query);
  }
}
?>