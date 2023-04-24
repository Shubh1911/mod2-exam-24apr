<?php
// Define the namespace for the class
namespace App\Controllers;

// Import the Stock model using an alias
use App\Model\Stock as user_model;

/**
 * Summary of Stock
 */
class Stock
{

  
  /**
   * Declare a private instance variable to hold an instance of the Stock model
   * @var
   */
  private $user_model;


  /**
   * Constructor that creates a new instance of the Stock model and assigns it to the instance variable
   */
  public function __construct()
  {
    $this->user_model = new user_model();
  }


  /**
   *  Method that loads the home page
   * @return void
   */
  public function home()
  {
    // Load the "Display_all_entry.php" view file
    require_once APPROOT . "/View/Display/Display_all_entry.php";
  }

  public function header()
  {
    require_once APPROOT . "/View/Header/Header.html";
  }

  /**
   * Method that handles user registration
   * @return void
   */
  public function register()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get the user input from the POST request and store it in an array
      $data = [
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "name" => $_POST["name"],
      ];

      // Call the register method of the Stock model to register the user
      $result = $this->user_model->register($data);

      // Redirect the user to the login page after successful registration
      header("Location:/Stock/login");
      exit();
    } else {
      // Load the "register.php" view file if the request method is not POST
      require_once APPROOT . "/View/User/Register.php";
    }
  }

  
  /**
   * Method that handles user login
   * @return void
   */
  public function login()
  {
    // Redirect the user to the home page if they are already logged in
    if (isLoggedIn()) {
      header("Location:/stock/home");
      exit();
    }

    // Handle POST requests for user login
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      // Get the user input from the POST request and store it in an array
      $data = [
        "email" => $_POST["email"],
        "password" => $_POST["password"],
      ];

      // Call the login method of the Stock model to authenticate the user
      $result = $this->user_model->login($data);

      // If the login is successful, create a session for the user and redirect to the home page
      if ($result) {
        setSession($result);
        header("Location:/stock/home");
        exit();
      }
      // If the login is unsuccessful, redirect back to the login page
      else {
        header("Location:/user/login");
        exit();
      }
    }
    // Load the "Login.php" view file if the request method is not POST
    else {
      require_once APPROOT . "/View/User/Login.php";
    }
  }


  /**
   * Method that loads the stock entry page
   * @return void
   */
  public function stock_entry()
  {
    require_once APPROOT . "/View/Stock-entry.php";
  }


  /**
   *  Method that handles user logout
   * @return never
   */
  public function logout()
  {
    // Call the logOut function to destroy the user session
    logOut();
    // Redirect the user to the login page after logging out
    header("Location:/" . 'stock/login');
    exit();
  }
  
  /**
   * Method that adds a new stock entry to the database
   * @return void
   */
  public function add()
  {
    if(isLoggedIn())
    {
    // Check if form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Extract data from form
      $data = [
        "stock_name" => $_POST["sname"],
        "stock_price" => $_POST["sprice"]
      ];
      // Add data to database
      $result = $this->user_model->add_data($data);
      if ($result) {
        echo "added successfully";
      } else {
        echo "unsuccessful";
      }
      exit(); // End script execution
    } else {
      // If form has not been submitted, display the form
      require_once APPROOT . "/View/Display/Stock-entry.php";
    }
  }
  }

  /**
   * Method that display only user entry
   * @return void
   */
  public function display_my_entry()
  {
    if(isLoggedIn())
    {
    // Check if request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get data from database for the logged-in user
      $data = $this->user_model->display_my_entry();
      // Display the data in a view
      require_once APPROOT . "/View/Display_my_entry.php";
    }
  }
  }

  /**
   * display all display_all_entry
   * @return void
   */
  public function display_all_entry()
  {
    if(isLoggedIn())
    {
    // Check if request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get data from database for all users
      $data = $this->user_model->display_all_entry();
      // Display the data in a view
      require_once APPROOT . "/View/Display/Display_my_entry.php";
    }
  }
  }

  /**
   * delete entery in table
   * @return never
   */
  public function delete()
  {
    // Check if request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Get the stock name to be deleted from the form
      $sname = $_POST['stock_name'];
      // Delete the stock from the database
      $this->user_model->delete($sname);
    }
    header("Location:/stock/stock_entry"); // Redirect to home page
    exit();
  }

}
?>