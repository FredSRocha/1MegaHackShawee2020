<?php

include "db.php";

$data = json_decode(file_get_contents("php://input"));

if($data){
    $sql = "INSERT INTO `testimonial` (`id_provider`, `testimonial`, `rating`)
    VALUES('{$data->id_provider}', '{$data->testimonial}', '{$data->rating}')";
} else {
    $sql = "INSERT INTO `testimonial` (`id_provider`, `testimonial`, `rating`)
    VALUES ('{$_POST["id_provider"]}', '{$_POST["testimonial"]}', '{$_POST["rating"]}')";
}

$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Novo registro inserido com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();

if(!$data){
    header("location: manage-testimonial.php");
}

?>
