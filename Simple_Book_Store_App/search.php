<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Books</title>
  <link rel="stylesheet" href="search.css"> <!-- Link to CSS for table styling -->
  <style>
  /* Navbar styles */
  .navbar {
    display: flex;
    justify-content: space-around;
    background-color: green;
    padding: 10px 0;
  }

  .navbar a {
    color: white;
    text-decoration: none;
    padding: 14px 20px;
    text-align: center;
  }

  .navbar a:hover {
    background-color: #575757;
  }

  /* .search-container {
    text-align: center;
    margin: 20px;
  }

  .book-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  .book-table th,
  .book-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  .book-table th {
    background-color: #f2f2f2;
  } */
  </style>
</head>

<body>

  <!-- Navbar -->
  <div class="navbar">
    <a href="bookstore.html">Home</a>
    <a href="main.php">Book List</a>
    <a href="search.php">Search Books</a>
    <a href="form.php">Add Book</a>
  </div>

  <div class="search-container">
    <h1>Search for a Book</h1>

    <!-- Search form with query pre-filled after submission -->
    <form action="search.php" method="post">
      <label for="query">Search by Title or Author:</label>
      <input type="text" id="query" name="query"
        value="<?php echo isset($_POST['query']) ? htmlspecialchars($_POST['query']) : ''; ?>" required>
      <input type="submit" value="Search">
    </form>
  </div>

  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the search query
    $query = strtolower(trim($_POST['query']));

    // Read the JSON data from the file
    $json_file = 'json_data.json';
    $json_data = file_get_contents($json_file);
    $books = json_decode($json_data, true);

    // Arrays to store search results by title or author
    $title_results = [];
    $author_results = [];

    // Search for books by title or author
    foreach ($books as $book) {
        if (strpos(strtolower($book['title']), $query) !== false) {
            $title_results[] = $book;
        }
        if (strpos(strtolower($book['author']), $query) !== false) {
            $author_results[] = $book;
        }
    }

    // Determine what type of search was made: Title or Author
    if (count($title_results) > 0 && count($author_results) == 0) {
        echo "<h2>Search result by 'Title': " . htmlspecialchars($_POST['query']) . "</h2>";
        displayResults($title_results);
    } elseif (count($author_results) > 0 && count($title_results) == 0) {
        echo "<h2>Search result by 'Author': " . htmlspecialchars($_POST['query']) . "</h2>";
        displayResults($author_results);
    } elseif (count($title_results) > 0 && count($author_results) > 0) {
        echo "<h2>Search result by 'Title': " . htmlspecialchars($_POST['query']) . "</h2>";
        displayResults($title_results);
        echo "<h2>Search result by 'Author': " . htmlspecialchars($_POST['query']) . "</h2>";
        displayResults($author_results);
    } else {
        echo "<p>No books found matching your search criteria.</p>";
    }
}

// Function to display the results in a table format
function displayResults($results) {
    echo "<table class='book-table'>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Available</th>
                    <th>Pages</th>
                    <th>ISBN</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($results as $book) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($book['title']) . "</td>";
        echo "<td>" . htmlspecialchars($book['author']) . "</td>";
        echo "<td>" . ($book['available'] ? 'Yes' : 'No') . "</td>";
        echo "<td>" . htmlspecialchars($book['pages']) . "</td>";
        echo "<td>" . htmlspecialchars($book['isbn']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
}
?>

</body>

</html>