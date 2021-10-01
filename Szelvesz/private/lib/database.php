<?php
function db_connect(): PDO
{
    return new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

function db_statement(string $query, array $parameters): PDOStatement|false
{
    $pdo = db_connect();
    $statement = $pdo->prepare($query);
    $statement->execute($parameters);
    return $statement;
}

function db_fetchAll(string $query, array $parameters = []): array
{
    $statement = db_statement($query, $parameters);
    return $statement->fetchAll();
}

function db_fetch(string $table, string $where = '1', array $parameters = []): array|false
{
    $statement = db_statement("SELECT * FROM $table WHERE $where LIMIT 1", $parameters);
    return $statement->fetch();
}

function db_fetch_single(string $attribute, string $table, string $where = '1', array $parameters = []): array|false
{
    $statement = db_statement("SELECT $attribute FROM $table WHERE $where LIMIT 1", $parameters);
    return $statement->fetch();
}


function db_execute(string $query, array $parameters = []): array
{
    $pdo = db_connect();
    $statement = $pdo->prepare($query);
    $statement->execute($parameters);
    return [
        'affected' => $statement->rowCount(),
        'last' => $pdo->lastInsertId()
    ];
}