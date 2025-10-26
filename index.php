<?php
$jsonPath = "books.json";
if (!file_exists($jsonPath)) {
  die("Error: books.json not found!");
}

$json = file_get_contents($jsonPath);
$books = json_decode($json, true);

if (!$books || !is_array($books)) {
  die("Error: Invalid or empty books.json file.");
}

function display_books($id, $title, $list) {
  if (empty($list) || !is_array($list)) return;

  echo "
  <div class='category' id='cat_$id' data-genre='" . strtolower($title) . "'>
    <h2>" . htmlspecialchars($title) . "</h2>
    <button class='scroll-btn left' onclick=\"scrollRow('$id', -1)\">&#10094;</button>
    <div class='book-list' id='$id'>";

  foreach ($list as $book) {
    $image = htmlspecialchars($book['imageLink'] ?? 'default.jpg');
    $bookTitle = htmlspecialchars($book['title'] ?? 'Unknown Title');
    $author = htmlspecialchars($book['author'] ?? '');
    $year = htmlspecialchars($book['year'] ?? '');

    echo "
      <a href='book_details.php?title=" . urlencode($bookTitle) . "' class='book-link'>
        <div class='book-card'
             data-title='" . strtolower($bookTitle) . "'
             data-author='" . strtolower($author) . "'
             data-year='" . strtolower($year) . "'
             data-genre='" . strtolower($title) . "'>
          <img src='images/$image' alt='$bookTitle'>
          <h3>$bookTitle</h3>
        </div>
      </a>";
  }

  echo "
    </div>
    <button class='scroll-btn right' onclick=\"scrollRow('$id', 1)\">&#10095;</button>
  </div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LITHUB LIBRARY</title>
  <style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: url('blue.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #fff;
  }

  body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: -1;
  }

  .header-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 60px 20px 20px;
  }

  h1 {
    margin: 0;
    padding: 15px 40px;
    font-size: 46px;
    font-weight: 800;
    letter-spacing: 2px;
    color: #fff;
    background: linear-gradient(90deg, #001540, #002b80);
    border: 3px solid #00bfff;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0, 191, 255, 0.7);
    text-shadow: 0 0 10px #00bfff, 0 0 20px #00bfff, 0 0 40px #00bfff;
    display: inline-block;
    width: fit-content;
  }

  .search-bar {
    display: flex;
    justify-content: center;
    margin-top: 18px;
    width: 100%;
  }

  .search-bar-inner {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    max-width: 500px; 
    width: 100%;
  }

  .search-bar label {
    font-weight: bold;
    font-size: 17px;
    color: #fff;
  }

  .search-bar input {
    flex: 1;
    padding: 8px 12px;
    border-radius: 20px;
    border: 2px solid #00bfff;
    font-size: 15px;
    outline: none;
    background-color: rgba(255, 255, 255, 0.85);
    color: #222;
    transition: 0.3s;
    box-shadow: 0 0 8px rgba(0, 191, 255, 0.4);
  }

  .search-bar input:focus {
    box-shadow: 0 0 12px rgba(0, 191, 255, 0.7);
  }

  .container {
    padding: 0 20px 40px;
  }

  .category {
    margin-bottom: 60px;
    position: relative;
  }

  .category h2 {
    margin: 10px 0 15px 20px;
    color: #fff;
  }

  .book-list {
    display: flex;
    overflow-x: auto;
    gap: 20px;
    scroll-behavior: smooth;
    padding: 10px 20px;
  }

  .book-list::-webkit-scrollbar {
    display: none;
  }

  .book-card {
    flex: 0 0 auto;
    width: 190px;
    height: 330px;
    background: rgba(30, 30, 30, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.4);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease;
    position: relative;
  }

  .book-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.3), transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 16px;
  }

  .book-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 22px rgba(253, 252, 252, 0.6);
  }

  .book-card:hover::before {
    opacity: 1;
  }

  .book-card img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .book-card h3 {
    font-size: 15px;
    font-weight: 600;
    color: #f3f4f6;
    margin: 10px 8px 8px;
    text-align: center;
    line-height: 1.3em;
    min-height: 2.6em;
    overflow: hidden;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    display: -webkit-box;
  }

  .book-link {
    text-decoration: none;
    color: inherit;
  }

  .scroll-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 22px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    cursor: pointer;
    transition: 0.2s;
    z-index: 5;
  }

  .scroll-btn:hover {
    background-color: #007bff;
    color: white;
  }

  .scroll-btn.left { left: 0; }
  .scroll-btn.right { right: 0; }

  @media (max-width: 700px) {
    .scroll-btn { display: none; }
    .search-bar input { width: 70%; }
  }
  </style>
</head>
<body>

  <div class="header-section">
    <h1>LITHUB LIBRARY</h1>
    <div class="search-bar">
      <div class="search-bar-inner">
        <label for="searchInput">Search</label>
        <input type="text" id="searchInput" autocomplete="off" oninput="runSearch()">
      </div>
    </div>
  </div>

  <div class="container">
    <?php
      display_books("fantasy","Fantasy Books", $books["fantasy_books"] ?? []);
      display_books("action", "Action Books", $books["action_books"] ?? []);
      display_books("comics", "Comics Books", $books["comics"] ?? []);
      display_books("romance", "Romance Books", $books["romance_books"] ?? []);
    ?>
  </div>

<script>
function phonetic(str) {
  if (!str) return "";
  str = str.toLowerCase().replace(/[^a-z]/g, "");
  if (!str) return "";
  const map = {b:1,f:1,p:1,v:1,c:2,g:2,j:2,k:2,q:2,s:2,x:2,z:2,d:3,t:3,l:4,m:5,n:5,r:6};
  let code = str[0];
  let prev = map[str[0]] || 0;
  for (let i=1;i<str.length;i++){
    const digit = map[str[i]] || 0;
    if (digit !== prev && digit !== 0) code += digit;
    prev = digit;
  }
  return code.padEnd(4,"0").slice(0,4);
}

function runSearch() {
  const query = document.getElementById('searchInput').value.trim().toLowerCase();
  const queryPhonetic = phonetic(query);
  const cards = document.querySelectorAll('.book-card');
  const categories = document.querySelectorAll('.category');
  if (query === "") {
    categories.forEach(cat => cat.style.display = '');
    cards.forEach(card => card.style.display = '');
    return;
  }
  let foundCategoryIds = new Set();
  cards.forEach(card => {
    const title = card.dataset.title;
    const author = card.dataset.author;
    const year = card.dataset.year;
    const genre = card.dataset.genre;
    const text = `${title} ${author} ${year} ${genre}`;
    const soundMatch = phonetic(title).includes(queryPhonetic) || phonetic(author).includes(queryPhonetic) || phonetic(genre).includes(queryPhonetic);
    const exactMatch = text.includes(query);
    const match = exactMatch || soundMatch;
    card.style.display = match ? '' : 'none';
    if (match) {
      const category = card.closest('.category');
      if (category) foundCategoryIds.add(category.id);
    }
  });
  categories.forEach(cat => {
    const genre = cat.dataset.genre;
    if (foundCategoryIds.has(cat.id) || genre.includes(query)) cat.style.display = '';
    else cat.style.display = 'none';
  });
}

function scrollRow(id, direction) {
  const row = document.getElementById(id);
  if (!row) return;
  const scrollAmount = 300;
  row.scrollBy({ left: scrollAmount * direction, behavior: 'smooth' });
}
</script>

</body>
</html>
