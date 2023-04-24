<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MY Entry</title>
  <link rel="stylesheet" href="../../../Public/css/display/style.css">
  <!-- js file to send post and get requests asynchronously -->
  <script defer src="/Public/js/addNote.js"></script>
</head>

<body>
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
      // loop through the data and output each row as a table row
      foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['stock_name'] . '</td>';
        echo '<td>' . $row['stock_price'] . '</td>';
        echo '<td>' . $row['created_date'] . '</td>';
        echo '<td>' . $row['last_update'] . '</td>';
        echo '<td><form method="post" action="/stock/delete"><input type="hidden" name="id" value="' . $row['stock_name'] . '"><button type="submit">Delete</button></form></td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
</body>

</html>