<?php

include "db.php";

$data = json_decode(file_get_contents("php://input"));

if($data){
    $sql = "INSERT INTO `service` (`id_provider`, `name`, `price`)
    VALUES('{$data->id_provider}', '{$data->name}', '{$data->price}')";
} else {
    $sql = "INSERT INTO `service` (`id_provider`, `name`, `price`)
    VALUES ('{$_POST["id_provider"]}', '{$_POST["name"]}', '{$_POST["price"]}')";
}

$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Novo registro inserido com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();

if(!$data){
    header("location: manage-service.php");
}

?>
