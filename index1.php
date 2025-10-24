<?php
$imagePath = "images/"; 

$library = [
  "title" => "LITHUB LIBRARY",
  "description" => "Welcome to LITHUB LIBRARY, To your gateway to imagination and knowledge. Explore a vast collection of books across genres, from timeless classics to modern thrillers. Discover, learn, and get lost in stories that inspire curiosity and creativity.",
  "cover" => "marvel3.jpg"
];

$similarBooks = [
  ["title" => "Civil War", "author" => "Steve McNiven", "cover" => "marvel2.jpg"],
  ["title" => "X-Men: Dark Phoenix Saga", "author" => "John Byrne", "cover" => "marvel5.jpg"],
  ["title" => "Watchmen", "author" => "Dave Gibbons", "cover" => "dc1.jpg"],
  ["title" => "Jurassic Park", "author" => "Michael Crichton", "cover" => "jurssic.webp"],
  ["title" => "The Girl with the Dragon Tattoo", "author" => "Stieg Larsson", "cover" => "dragontattoo.jpg"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $library["title"]; ?></title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #1d1f27;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 60px 80px;
      flex-wrap: wrap;
    }

    .info {
      max-width: 600px;
    }

    h1 {
      font-size: 52px;
      margin: 0;
      color: #fff;
      letter-spacing: 2px;
    }

    p {
      line-height: 1.7;
      color: #bbb;
      margin-top: 25px;
      font-size: 17px;
    }

    .buttons {
      margin-top: 30px;
    }

    button {
      background: #f4c542;
      color: #1d1f27;
      border: none;
      padding: 12px 22px;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-right: 10px;
      transition: background 0.3s, transform 0.2s;
    }

    button:hover {
      background: #ffd84a;
      transform: scale(1.05);
    }

    .cover img {
      width: 320px;
      height: 450px;
      object-fit: cover;
      box-shadow: 0 10px 30px rgba(0,0,0,0.4);
      border-radius: 12px;
    }

    .similar {
      background: #2a2c35;
      padding: 60px 80px;
    }

    .similar h2 {
      margin-bottom: 25px;
      color: #fff;
      font-size: 26px;
      font-weight: 600;
    }

    .book-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
      gap: 25px;
    }

    .book {
      width: 180px;
      background: #1f212a;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 6px 15px rgba(0,0,0,0.3);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: center;
      padding-bottom: 15px;
    }

    .book:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    }

    .book img {
      width: 100%;
      height: 260px;
      object-fit: cover;
      border-bottom: 1px solid #333;
    }

    .book p {
      margin: 8px 0 0;
      font-size: 14px;
      color: #ddd;
    }

    .book .author {
      color: #999;
      font-size: 13px;
    }

    @media (max-width: 900px) {
      .container {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 40px;
      }
      .cover img {
        width: 70%;
        height: auto;
      }
      .book {
        width: 45%;
      }
    }

    @media (max-width: 480px) {
      .book {
        width: 100%;
      }
    }

  </style>
</head>
<body>

  <div class="container">
    <div class="info">
      <h1><?= $library["title"]; ?></h1>
      <p><?= $library["description"]; ?></p>
      <div class="buttons">
        <button onclick="window.location.href='index.php'">Read Now</button>
      </div>
    </div>
    <div class="cover">
      <img src="<?= $imagePath . $library["cover"]; ?>" alt="<?= $library["title"]; ?> Cover">
    </div>
  </div>

  <div class="similar">
    <h2>Popular Books</h2>
    <div class="book-list">
      <?php foreach ($similarBooks as $s): ?>
        <div class="book">
          <img src="<?= $imagePath . $s["cover"]; ?>" alt="<?= $s["title"]; ?>">
          <p><strong><?= $s["title"]; ?></strong></p>
          <p class="author"><?= $s["author"]; ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</body>
</html>
