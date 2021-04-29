<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Ausleihen</title>
</head>
<body>
    <h1>Ausleih-Daten erfassen</h1>

    <?php if (isset($errors)): ?>
    <ul>
    <?php 
       foreach($errors as $error) {
           echo '<li>' . $error . '</li>';
       }
    ?>
    </ul>
    <?php endif ?>
​
    <a href="/m307_2/01_videothek/">Home</a>

    <form id="formular" action="/m307_2/01_videothek/ausleihen/validate" method="post">

    <fieldset>
            <legend class="form-legend">Personendaten</legend> <br>
            <div class="form-group">
                <label class="form-label" for="name">*Name:</label> <br>
                <input class="form-control" type="text" id="name" name="name"  value="<?= isset($name) ? e($name) : '' ?>"> <br> <br>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">*Email:</label> <br>
                <input class="form-control" type="email" id="email" name="email" value="<?= isset($email) ? e($email) : '' ?>"> <br> <br>
            </div>
            <div class="form-group">
                <label class="form-label" for="telephone">Telefon:</label> <br>
                <input class="form-control" type="text" id="telephone" name="telephone" value="<?= isset($telephone) ? e($telephone) : '' ?>"> <br> <br>
            </div>
    </fieldset>
​
    <fieldset>
            <legend class="form-legend">Ausleihdaten</legend> <br>

            <label class="form-label" for="membership">*Mitgliederstatus</label> <br>
                <select onchange="calcExpectedDate()" class="form-control" id="membership" name="membership">
                    <?php foreach($memberships as $membership) : ?>
                        <option <?= isset($selectedMembership) ? ($selectedMembership === $membership['id'] ? 'selected' : '') : '' ?> value="<?= e($membership['id'])?>">
                            <?= e($membership['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select> <br> <br>
                
            <label class="form-label" for="movie">*Ausgeleihtes Video:</label> <br>
                <select class="form-control" id="movie" name="movie">
                    <?php foreach($movies as $movie) : ?>
                        <option value="<?= e($movie['id']) ?>">
                            <?= e($movie['title']) ?>
                        </option> 
                    <?php endforeach; ?>
                </select>
        </fieldset> <br>
        <label class="form-label" for="expectedDate">Zurückerwartet bis am:</label> <br>
        <input disabled type="text" id="expectedDate" name="expectedDate" value="" val><br><br>
        <button type="submit" name="form-submit">Ausleihen</button>
        <script src="/m307_2/01_videothek/public/js/rent.js" type="text/javascript"></script>
    </form>
</body>
</html>