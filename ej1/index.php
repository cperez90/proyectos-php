<?php

$books = [
        [
                'name' =>    "Do Androids Dream of Electric Sheep",
                'author' => 'Philip K. Dick',
                'releaseYear' => 1968,
                'purchaseUrl' => 'http://exemple.com'
        ],
        [
                'name' => 'Proyect Hail Mary',
                'author' => 'Andy Weir',
                'releaseYear' => 2021,
                'purchaseUrl' => 'http://exemple.com'
        ],
        [
                'name' => 'The Martian',
                'author' => 'Andy Weir',
                'releaseYear' => 2011,
                'purchaseUrl' => 'http://exemple.com'
        ]
];

/*function filter($items, $fn) {
    $filteredItems = [];

    foreach ($items as $item){
        if ($fn($item)) {
            $filteredItems[] = $item;
        }
    }

    return $filteredItems;
};*/

$filteredBooks = array_filter($books, function ($book){
    return $book['author'] === 'Andy Weir';
});

require  "index.view.php";