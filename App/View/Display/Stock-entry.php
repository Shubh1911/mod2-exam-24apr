<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notes Maker App</title>
  <link rel="stylesheet" href="../../../Public/css/display/style.css">
  <!-- Include js file to send post and get requests asynchronously -->
  <script defer src="/Public/js/addNote.js"></script>
</head>
<body>
<!-- Create a form to submit new stock data -->
<form action="/stock/add" method="post">
  <label for="sname">Stock Name:</label>
  <input type="text" id="sname" name="sname"><br><br>
  <label for="sprice">Stock Price:</label>
  <input type="number" id="sprice" name="sprice"><br><br>
  <input type="submit" value="Submit">
</form>
</body>
</html>
