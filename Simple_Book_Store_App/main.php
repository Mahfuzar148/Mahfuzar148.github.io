<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book List</title>
  <link rel="stylesheet" href="style1.css">
</head>

<body>

  <nav>
    <div class="nav-container">
      <div class="hamburger" onclick="toggleMenu()">
        &#9776;
        <!-- Hamburger icon -->
      </div>
      <div class="logo">Bookstore</div> <!-- Added Bookstore logo -->
      <ul class="nav-links">
        <li><a href="bookstore.html">Home</a></li>
        <li><a href="form.php">Add Book</a></li>
        <li><a href="main.php">View Available Books</a></li>
        <li><a href="search.php">Search for Books</a></li>
      </ul>
    </div>
  </nav>

  <?php
    // Load JSON data
    $jsonData = file_get_contents('json_data.json');
    $books = json_decode($jsonData, true);

    // Handle delete request
    if (isset($_GET['delete'])) {
        $isbnToDelete = $_GET['delete'];
        // Filter out the book to delete
        $books = array_filter($books, function ($book) use ($isbnToDelete) {
            return $book['isbn'] != $isbnToDelete;
        });
        // Save updated data back to JSON file
        file_put_contents('json_data.json', json_encode(array_values($books), JSON_PRETTY_PRINT));
        header("Location: main.php"); // Refresh the page after deletion
        exit();
    }

    // Handle update request
    if (isset($_POST['update'])) {
        $isbnToUpdate = $_POST['isbn'];
        foreach ($books as &$book) {
            if ($book['isbn'] == $isbnToUpdate) {
                $book['title'] = $_POST['title'];
                $book['author'] = $_POST['author'];
                $book['available'] = ($_POST['available'] === 'true');
                $book['pages'] = $_POST['pages'];
            }
        }
        // Save updated data back to JSON file
        file_put_contents('json_data.json', json_encode($books, JSON_PRETTY_PRINT));
        header("Location: main.php"); // Refresh the page after update
        exit();
    }
    ?>

  <div class="book-list">
    <h2 class="title">Book List</h2>

    <table class="book-table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Available</th>
          <th>Pages</th>
          <th>ISBN</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $book): ?>
        <tr>
          <td><?php echo htmlspecialchars($book['title']); ?></td>
          <td><?php echo htmlspecialchars($book['author']); ?></td>
          <td><?php echo $book['available'] ? 'Yes' : 'No'; ?></td>
          <td><?php echo htmlspecialchars($book['pages']); ?></td>
          <td><?php echo htmlspecialchars($book['isbn']); ?></td>
          <td>
            <a href="main.php?delete=<?php echo $book['isbn']; ?>" class="btn btn-delete">Delete</a>
            <button type="button" class="btn btn-edit"
              onclick="openEditForm('<?php echo $book['isbn']; ?>', '<?php echo htmlspecialchars($book['title']); ?>', '<?php echo htmlspecialchars($book['author']); ?>', '<?php echo $book['available'] ? 'true' : 'false'; ?>', '<?php echo htmlspecialchars($book['pages']); ?>')">Edit</button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Edit Form (initially hidden) -->
  <div id="edit-form-container" class="form-popup">
    <form method="post" class="form-container">
      <h2>Edit Book</h2>

      <label for="title"><b>Title</b></label>
      <input type="text" id="edit-title" name="title" required>

      <label for="author"><b>Author</b></label>
      <input type="text" id="edit-author" name="author" required>

      <label for="available"><b>Available</b></label>
      <select id="edit-available" name="available">
        <option value="true">Yes</option>
        <option value="false">No</option>
      </select>

      <label for="pages"><b>Pages</b></label>
      <input type="number" id="edit-pages" name="pages" required>

      <input type="hidden" id="edit-isbn" name="isbn">

      <button type="submit" class="btn btn-save" name="update">Save</button>
      <button type="button" class="btn cancel" onclick="closeEditForm()">Cancel</button>
    </form>
  </div>

  <script>
  // Function to open the edit form with the book's current data
  function openEditForm(isbn, title, author, available, pages) {
    document.getElementById('edit-isbn').value = isbn;
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-author').value = author;
    document.getElementById('edit-available').value = available;
    document.getElementById('edit-pages').value = pages;

    document.getElementById('edit-form-container').style.display = 'block';
  }

  // Function to close the edit form
  function closeEditForm() {
    document.getElementById('edit-form-container').style.display = 'none';
  }

  // Function to toggle the hamburger menu
  function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('show');
  }
  document.addEventListener("DOMContentLoaded", function() {
    const hamburgerButton = document.getElementById("hamburger-button");
    const navbarLinks = document.getElementById("navbar-links");

    hamburgerButton.addEventListener("click", function() {
      navbarLinks.classList.toggle("show");
    });
  });
  </script>

</body>

</html>