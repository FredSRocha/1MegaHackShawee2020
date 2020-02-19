<?php

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