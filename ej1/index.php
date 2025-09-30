<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Demo</title>
</head>
<body>
    <?php
    $books = [
            [
                'name' =>    "Do Androids Dream of Electric Sheep",
                'autor' => 'Philip K. Dick',
                'purchaseUrl' => 'http://exemple.com'
                    ],
        [
                'name' => 'Proyect Hail Mary',
            'autor' => 'Andy Weir',
               'purchaseUrl' => 'http://exemple.com'
        ]


    ];
    ?>
    <ul>
        <?php foreach ($books as $book) : ?>
        <li>
            <a href="<?= $book['purchaseUrl']; ?>">
            <?= $book['name']; ?>
        </a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>