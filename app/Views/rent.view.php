<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Video</title>
</head>
<body>
    <h1>Ausleih-Daten erfassen</h1>


    <fieldset>
            <legend class="form-legend">Personendaten</legend> <br>
            <div class="form-group">
                <label class="form-label" for="name">*Name:</label> <br>
                <input class="form-control" type="text" id="name" name="name"> <br> <br>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">*Email:</label> <br>
                <input class="form-control" type="email" id="email" name="email"> <br> <br>
            </div>
            <div class="form-group">
                <label class="form-label" for="phone">Telefon:</label> <br>
                <input class="form-control" type="text" id="phone" name="phone"> <br> <br>
            </div>
    </fieldset>
​
    <fieldset>
            <legend class="form-legend">Ausleihdaten</legend> <br>

            <label class="form-label" for="membership">*Mitgliederstatus</label> <br>
                <select class="form-control" id="membership" name="membership">
                    <option value="">keine</option>
                    <option value="bronze">Bronze</option>
                    <option value="silver">Silber</option>
                    <option value="gold">Gold</option>
                </select> <br> <br>
                
            <label class="form-label" for="membership">*Ausgeleihtes Video:</label> <br>
                <select class="form-control" id="video" name="video">
                    <option value="">keine</option>
                    <option value="bronze">Bronze</option>
                    <option value="silver">Silber</option>
                    <option value="gold">Gold</option>
                </select>

        </fieldset>
</body>
</html>