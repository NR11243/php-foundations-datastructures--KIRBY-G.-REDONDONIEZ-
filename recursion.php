<?php
$library = [
  "Fiction" => [
    "Fantasy" => ["Harry Potter", "The Hobbit"],
    "Mystery" => ["Sherlock Holmes", "Gone Girl"]
  ],
  "Non-Fiction" => [
    "Science" => ["A Brief History of Time", "The Selfish Gene"],
    "Biography" => ["Steve Jobs", "Becoming"]
  ]
];

function displayLibrary($library, $indent = 0) {
  foreach ($library as $key => $value) {
    if (is_int($key)) {
      echo str_repeat(' ', $indent) . $value . PHP_EOL;
      continue;
    }

    echo str_repeat(' ', $indent) . $key . PHP_EOL;

    if (is_array($value)) {
      $isList = array_values($value) === $value;
      if ($isList) {
        foreach ($value as $book) {
          echo str_repeat(' ', $indent + 1) . $book . PHP_EOL;
        }
      } else {
        displayLibrary($value, $indent + 1);
      }
    }
  }
}

if (php_sapi_name() === 'cli' && realpath($argv[0]) === __FILE__) {
  echo "Library Structure:\n";
  displayLibrary($library);
}
?>
