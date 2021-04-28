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

    <form action="/m307_2/01_videothek/ausleihen/validate" method="post">

    <fieldset>
            <legend class="form-legend">Personendaten</legend> <br>
            <div class="form-group">
                <label class="form-label" for="name">*Name:</label> <br>
                <input class="form-control" type="text" id="name" name="name"  value="<?= $name ?? '' ?>"> <br> <br>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">*Email:</label> <br>
                <input class="form-control" type="email" id="email" name="email" value="<?= $email ?? '' ?>"> <br> <br>
            </div>
            <div class="form-group">
                <label class="form-label" for="phone">Telefon:</label> <br>
                <input class="form-control" type="text" id="phone" name="phone" value="<?= $phone ?? '' ?>"> <br> <br>
            </div>
    </fieldset>
​
    <fieldset>
            <legend class="form-legend">Ausleihdaten</legend> <br>

            <label class="form-label" for="membership">*Mitgliederstatus</label> <br>
                <select class="form-control" id="membership" name="membership">
                    <?php foreach($memberships as $membership) : ?>
                        <option value="<?= $membership['id'] ?>">
                            <?= $membership['title'] ?>
                        </option>
                    <?php endforeach; ?>
                </select> <br> <br>
                
            <label class="form-label" for="movie">*Ausgeleihtes Video:</label> <br>
                <select class="form-control" id="movie" name="movie">
                    <?php foreach($movies as $movie) : ?>
                        <option value="<?= $movie['id'] ?>">
                            <?= $movie['title'] ?>
                        </option> 
                    <?php endforeach; ?>
                </select>
                
        </fieldset> <br>

        <button type="submit" name="form-submit">Ausleihen</button>

    </form>
</body>
</html>