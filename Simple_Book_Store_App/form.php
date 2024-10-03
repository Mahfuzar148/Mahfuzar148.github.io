<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $available = $_POST['available'] ? true : false;
    $pages = $_POST['pages'];
    $isbn = $_POST['isbn'];

    // Step 1: Read existing JSON data
    $json_file = 'json_data.json';
    $json_data = file_get_contents($json_file);
    $books = json_decode($json_data, true);

    // Step 2: Create a new book entry
    $new_book = [
        'title' => $title,
        'author' => $author,
        'available' => $available,
        'pages' => $pages,
        'isbn' => $isbn
    ];

    // Step 3: Add new book to the array
    $books[] = $new_book;

    // Step 4: Encode array back to JSON and save it to file
    file_put_contents($json_file, json_encode($books , JSON_PRETTY_PRINT));

    // Step 5: Redirect to main.php to display updated table
    header('Location: main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Book</title>
  <link rel="stylesheet" href="form.css"> <!-- Link to external CSS file -->

</head>

<body>

  <nav>
    <ul>
      <li><a href="bookstore.html">Home</a></li>
      <li><a href="form.php">Add Book</a></li>
      <li><a href="main.php">View Available Books</a></li>
      <li><a href="search.php">Search for Books</a></li>
    </ul>
  </nav>

  <div class="form-container">
    <h1>Add New Book</h1>

    <form action="form.php" method="post">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required>

      <label for="author">Author:</label>
      <input type="text" id="author" name="author" required>

      <label for="available">Available:</label>
      <select id="available" name="available" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>

      <label for="pages">Pages:</label>
      <input type="number" id="pages" name="pages" required>

      <label for="isbn">ISBN:</label>
      <input type="text" id="isbn" name="isbn" required>

      <input type="submit" name="submit" value="Add Book">
    </form>
  </div>
</body>

</html>