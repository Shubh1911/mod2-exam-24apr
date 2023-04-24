<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link to the CSS file -->
  <link rel="stylesheet" href="../../../Public/css/display/style.css">

  <title>All Entry</title>
</head>

<body>
  <!-- Table to display the stock data -->
  <table>

    <thead>
      <tr>
        <th>Stock Name</th>
        <th>Stock Price</th>
        <th>Created Date</th>
        <th>Last Update</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Loop through the data and output each row as a table row
      foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['stock_name'] . '</td>';
        echo '<td>' . $row['stock_price'] . '</td>';
        echo '<td>' . $row['created_date'] . '</td>';
        echo '<td>' . $row['last_update'] . '</td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
  <!-- Table ends here -->

  <!-- Links to other pages -->
  <div class="buttons">
    <a href="/stock/stock_entry">stock-entry</a>
    <a href="/stock/logout">logout</a>
    <a href="/stock/display">my-data</a>
  </div>
</body>

</html>