<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
</head>
<body>
    <h1>Ausgeliehene Videos</h1>
    <a href="/m307_2/01_videothek/">Home</a>
    <ul>
        <?php foreach($result as $loan) : ?>
            <li>
                <?= e($loan['name']) . " | " . e($loan['fk_movieid']) . " | Zur&uumlck Erwartet am: " .  e(date_format($loan['expectedReturn'],"d-m-Y")) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>