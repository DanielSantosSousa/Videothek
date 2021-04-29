<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/m307_2/01_videothek/public/css/edit.css">
    <title>Edit a loan</title>
</head>
<body>

    <h1>Ausleih-Daten bearbeiten</h1>

    <?php if (isset($errors)): ?>
    <ul>
    <?php 
       foreach($errors as $error) {
           echo '<li>' . $error . '</li>';
       }
    ?>
    </ul>
    <?php endif ?>

    <a href="/m307_2/01_videothek/">Home</a>

    <form action="/m307_2/01_videothek/uebersicht/bearbeiten/validate" method="post">

    <fieldset>
            <input hidden name="id" type="text" value="<?= $id ?>">
            <legend class="form-legend">Personendaten</legend> <br>
            <div class="form-group">
                <label class="form-label" for="name">*Name:</label> <br>
                <input type="text" id="name" name="name"  value="<?= e($name) ?? '' ?>"> <br> <br>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">*Email:</label> <br>
                <input type="email" id="email" name="email" value="<?= e($email) ?? '' ?>"> <br> <br>
            </div>
            <div class="form-group">
                <label class="form-label" for="telephone">Telefon:</label> <br>
                <input class="form-control" type="text" id="telephone" name="telephone" value="<?= e($telephone) ?? '' ?>"> <br> <br>
            </div>
    </fieldset>

    <fieldset>
            <legend class="form-legend">Ausleihdaten</legend> <br>

            <label class="form-label" for="membership">*Mitgliederstatus</label> <br>
                <select disabled class="form-control" id="membership" name="membership">
                        <option value="<?= e($membership) ?>">
                            <?= e($membership) ?>
                        </option>
                </select> <br> <br>

            <label class="form-label" for="video">*Ausgeleihtes Video:</label> <br>
                <select class="form-control" id="movie" name="movie">
                    <?php foreach($movies as $aMovie) : ?>
                        <option <?= (($movie === $aMovie['title'] || $movie === $aMovie['id']) ? 'selected' : '') ?> value="<?= $aMovie['id'] ?>">
                            <?= $aMovie['title'] ?>
                        </option>
                    <?php endforeach; ?>
                </select><br><br>

            
            <label class="form-label" for="video">Video Zur&uumlckgebracht:</label> <br>
            <select class="form-control" id="returned" name="returned">
                <option <?= (!$returned ? 'selected' : '') ?> value="0"> Nein </option>
                <option <?= ($returned ? 'selected' : '') ?> value="1"> Ja </option>
            </select>
                
        </fieldset> <br>

        <input class="submit" type="submit" name="form-submit" value="Speichern"></input>

    </form>
</body>
</html>