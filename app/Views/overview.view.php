<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/m307_2/01_videothek/public/css/overview.css">
    <title>Ausgeliehene Videos</title>
</head>
<body>
    <h1>Ausgeliehene Videos</h1>
    <a href="/m307_2/01_videothek/">Home</a><br><br>
    <?php if (isset($errors)): ?>
        <ul>
            <?php
            foreach($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            ?>
        </ul>
    <?php endif ?>
    <form id="formular" action="/m307_2/01_videothek/uebersicht/statusaendern" method="post">
    <button type="submit" name="form-submit">Status auf zurückgegeben ändern</button>
        <br><br>

        <?php foreach($result as $loan) : ?>
            <input type="checkbox" name="loans[]" value="<?= $loan['id'] ?>" id="<?= $loan['id'] ?>">
            <label for="<?= e($loan['id']) ?>"><?= e($loan['name']) . " | " . e($loan['fk_movieid']) . " | Zur&uumlck Erwartet am: " .  e(date_format($loan['expectedReturn'],"d-m-Y")) . (($loan['expectedReturn'] < $now) ? '😠' : '😁' . ' | ')?></label>
            <a href="/m307_2/01_videothek/uebersicht/bearbeiten?id=<?= $loan['id'] ?>"> bearbeiten </a><br>
        <?php endforeach; ?>
    </form>
</body>
</html>