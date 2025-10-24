<?php
$bookInfo = [
"Harry Potter" => [
"author" => "J.K. Rowling",
"year" => 1997,
"genre" => "Fantasy"
],
"The Hobbit" => [
"author" => "J.R.R. Tolkien",
"year" => 1937,
"genre" => "Fantasy"
],
"Sherlock Holmes" => [
"author" => "Arthur Conan Doyle",
"year" => 1892,
"genre" => "Mystery"
],
"Gone Girl" => [
"author" => "Gillian Flynn",
"year" => 2012,
"genre" => "Mystery"
],
"A Brief History of Time" => [
"author" => "Stephen Hawking",
"year" => 1988,
"genre" => "Science"
],
"The Selfish Gene" => [
"author" => "Richard Dawkins",
"year" => 1976,
"genre" => "Science"
],
"Steve Jobs" => [
"author" => "Walter Isaacson",
"year" => 2011,
"genre" => "Biography"
],
"Becoming" => [
"author" => "Michelle Obama",
"year" => 2018,
"genre" => "Biography"
]
];


function getBookInfo($title, $bookInfo) {
if (isset($bookInfo[$title])) {
$info = $bookInfo[$title];
echo "Title: " . $title . PHP_EOL;
echo "Author: " . $info['author'] . PHP_EOL;
echo "Year: " . $info['year'] . PHP_EOL;
echo "Genre: " . $info['genre'] . PHP_EOL;
} else {
echo "Book not found\n";
}
}

if (php_sapi_name() === 'cli' && realpath($argv[0]) === __FILE__) {
getBookInfo('Harry Potter', $bookInfo);
}

?>