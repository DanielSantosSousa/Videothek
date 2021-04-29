<?php
/**
 * Nutze diese Funktion um einfach eine Ausgabe
 * mit htmlspecialchars() zu erstellen.
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

/**
 * Nutze diese Funktion um auf einen POST-Wert
 * zuzugreifen.
 */
function post(string $key, $default = '')
{
    return $_POST[$key] ?? $default;
}

function dd($value) {
    die(var_dump($value));
}


/**
 * Stellt eine Verbindung zur Datenbank her und gibt die
 * Datenbankverbindung als PDO zurück.
 */
$dbInstance = null;

function db(): PDO
{
    global $dbInstance;

    if ($dbInstance) {
        return $dbInstance;
    }

    $db = [
        'name'     => 'videothek',
        'username' => 'root',
        'password' => '',
    ];

    try {
        return $dbInstance = new PDO('mysql:host=127.0.0.1;dbname=' . $db['name'], $db['username'], $db['password'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ]);
    } catch (PDOException $e) {
        die('Keine Verbindung zur Datenbank möglich: ' . $e->getMessage());
    }
}

function validateInput($name, $email, $telephone, $movie){

    $name         = trim($name);
    $email        = trim($email);
    $telephone    = trim($telephone);
    $movie        = trim($movie);

    $errors = [];

    if($name === ''){
        $errors[] = 'Bitte geben Sie einen Namen an';
    }

    if($email === ''){
        $errors[] = 'Bitte geben Sie eine Email an.';
    } elseif (preg_match("/[^@]+@[^.]+\..+$/", $email) == false) {
        $errors[] = 'Bitte geben Sie eine gültige Email-Adress ein';
    }

    if ($telephone !== '') {
        if(! preg_match("/^[0-9\-\(\)\/\+\s]+$/", $telephone)){
            $errors[] = 'Bitte geben Sie eine gültige Telefonnummer ein';
        }
    }

    if($movie === ''){
        $errors[] = 'Bitte wählen Sie ein Video aus';
    }

    return $errors;
}