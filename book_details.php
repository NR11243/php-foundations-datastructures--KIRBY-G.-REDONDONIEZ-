<?php
$jsonPath = "books.json";
if (!file_exists($jsonPath)) {
  die("Error: books.json not found!");
}

$json = file_get_contents($jsonPath);
$booksData = json_decode($json, true);

if (!$booksData) {
  die("Error: Invalid JSON format in books.json");
}

// Combine all books into one array
$allBooks = [];
foreach ($booksData as $category => $list) {
  if (is_array($list)) {
    // Keep track of which category each book came from
    foreach ($list as $b) {
      $b['category'] = $category;
      $allBooks[] = $b;
    }
  }
}

$title = $_GET['title'] ?? '';
$book = null;

// Find the book by title
foreach ($allBooks as $b) {
  if (isset($b['title']) && strcasecmp($b['title'], $title) === 0) {
    $book = $b;
    break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $book ? htmlspecialchars($book['title']) : "Book Details"; ?></title>
  <style>
    body {
      background: #1e1f24;
      color: #f1f1f1;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 60px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }

    .book-details {
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
      max-width: 1000px;
      background: #2a2b31;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.4);
    }

    img {
      width: 320px;
      height: 460px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    .info {
      max-width: 550px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    h1 {
      color: #ffd84a;
      font-size: 40px;
      margin-bottom: 15px;
      letter-spacing: 1px;
    }

    p {
      font-size: 17px;
      line-height: 1.8;
      color: #d1d1d1;
      margin-bottom: 10px;
    }

    .summary {
      margin-top: 20px;
      background: #1d1e22;
      padding: 20px;
      border-radius: 12px;
      color: #ccc;
      font-style: italic;
      box-shadow: inset 0 0 10px rgba(0,0,0,0.3);
    }

    .back-btn {
      display: inline-block;
      margin-top: 25px;
      padding: 10px 20px;
      background: #ffd84a;
      color: #1e1f24;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      width: fit-content;
      transition: 0.3s;
    }

    .back-btn:hover {
      background: #ffec85;
      transform: scale(1.05);
    }
  </style>
</head>
<body>
<?php if ($book): ?>
  <div class="book-details">
    <img src="images/<?= htmlspecialchars($book['imageLink'] ?? 'default.jpg'); ?>" alt="<?= htmlspecialchars($book['title']); ?>">
    <div class="info">
      <h1><?= htmlspecialchars($book['title']); ?></h1>

      <?php
        // Smartly detect how to display creator info
        $category = strtolower($book['category'] ?? '');
        $hasWriter = !empty($book['writer']);
        $hasArtist = !empty($book['artist']);
        $hasAuthor = !empty($book['author']);

        if (strpos($category, 'comic') !== false) {
          if ($hasWriter || $hasArtist) {
            if ($hasWriter) echo "<p><strong>Writer:</strong> " . htmlspecialchars($book['writer']) . "</p>";
            if ($hasArtist) echo "<p><strong>Artist:</strong> " . htmlspecialchars($book['artist']) . "</p>";
          } else {
            echo "<p><strong>Creator:</strong> Unknown</p>";
          }
        } else {
          echo "<p><strong>Author:</strong> " . htmlspecialchars($book['author'] ?? 'Unknown') . "</p>";
        }
      ?>

      <p><strong>Year:</strong> <?= htmlspecialchars($book['year'] ?? 'N/A'); ?></p>

      <?php if (!empty($book['description'])): ?>
        <div class="summary">
          <?= nl2br(htmlspecialchars($book['description'])); ?>
        </div>
      <?php endif; ?>

      <a href="index.php" class="back-btn">← Back to Library</a>
    </div>
  </div>
<?php else: ?>
  <div class="book-details">
    <p>Book not found.</p>
    <a href="index.php" class="back-btn">← Back to Library</a>
  </div>
<?php endif; ?>
</body>
</html>
