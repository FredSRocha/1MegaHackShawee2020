<?php

include "db.php";

$data = json_decode(file_get_contents("php://input"));

if($data){
    $sql = "INSERT INTO `job` (`id_provider`, `datetime`, `message`, `service`)
    VALUES('{$data->id_provider}', '{$data->date_hour}', '{$data->message}', '{$data->service}')";
} else {   
    $sql = "INSERT INTO `job` (`id_provider`, `datetime`, `message`, `service`)
    VALUES ('{$_POST["id_provider"]}', '{$_POST["datetime"]}', '{$_POST["message"]}', '{$_POST["service"]}')";
}

$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Novo registro inserido com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();

if(!$data){
    header("location: manage-request.php");
}

?>
