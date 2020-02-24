<?php

include "db.php";

$data = json_decode(file_get_contents("php://input"));

if($data){
    $sql = "INSERT INTO `delivery` (`name`, `address`, `message`)
    VALUES('{$data->name}', '{$data->address}', '{$data->message}' )";
} else {
    $sql = "INSERT INTO `delivery` (`name`, `address`, `message`)
    VALUES ('{$_POST["name"]}', '{$_POST["address"]}', '{$_POST["message"]}')";
}

$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Novo registro inserido com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$sql = "SELECT * FROM `provider` WHERE `category` = 'entregador' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        // TOTALVOICE

        $phone = $row['phone'];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.totalvoice.com.br/sms');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"numero_destino":"{$phone}","mensagem":"Olá, você gostaria de fazer uma entrega agora? Clique no link e saiba mais https://localbiz.jusblog.com","resposta_usuario":false,"tags":"","multi_sms":true,"data_criacao":"2020-02-18T23:01:00-03:00"}');

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Access-Token: 5117687945ddded8c0568f478ef04b08';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
                
    }
}

// ZENVIA 

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.zenvia.com/v1/channels/whatsapp/messages');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"from\": \"exultant-swordtail\",\n  \"to\": \"5531984248321\",\n  \"contents\": [{\n    \"type\": \"text\",\n    \"text\": \"Olá, por favor aguarde no seu local de solicitação, pois o entregador chegará em instantes para atendimento. Obrigado por utilizar nossos serviços, não deixe de avaliar a sua experiência.\"\n  }]\n}");

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-Api-Token: JxVWIm_hLJr7hUulotiiVWoGcKNR91_VnT9L';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$conn->close();

if(!$data){
    header("location: manage-delivery.php");
}

?>
