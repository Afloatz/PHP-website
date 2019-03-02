<?php

function get_connection()
{
	$config = require 'config.php';
    return new PDO(
    	$config['database_dsn'],
    	$config['database_user'],
    	$config['database_pass']
    );	
}

function get_pets($limit = null)
{
    $pdo = get_connection();

    $query = 'SELECT * FROM pet';
    if ($limit != 0) {
    	$query = $query .' LIMIT '.$limit;
    };
    $result = $pdo->query($query);
    $pets = $result->fetchAll();

    return $pets;
}

function get_pet($id)
{
	$pdo = get_connection();
	$query = 'SELECT * FROM pet WHERE id = '.$id;
	$result = $pdo->query($query);

	return $result->fetch();
}

function save_pets($petsToSave)
{
	$json = json_encode($petsToSave, JSON_PRETTY_PRINT);
	file_put_contents('data/pets.json', $json);
}
