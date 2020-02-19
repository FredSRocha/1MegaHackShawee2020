<?php

include "db.php";

$data = json_decode(file_get_contents("php://input"));

if($data){
    $sql = "INSERT INTO `provider` (`address`, `available`, `category`, `name`, `phone`, `type`, `lat`, `lng`)
    VALUES('{$data->address}', '{$data->available}', '{$data->category}', '{$data->name}', '{$data->phone}', '{$data->type}', '{$data->lat}', '{$data->lng}')";
} else {  
    $sql = "INSERT INTO `provider` (`address`, `available`, `category`, `name`, `phone`, `type`, `lat`, `lng`)
    VALUES ('{$_POST["address"]}', '{$_POST["available"]}', '{$_POST["category"]}', '{$_POST["name"]}', '{$_POST["phone"]}', '{$_POST["type"]}', '{$_POST["lat"]}', '{$_POST["lng"]}')";
}

$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Novo registro inserido com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();

if(!$data){
    header("location: manage-provider.php");
}

?>
