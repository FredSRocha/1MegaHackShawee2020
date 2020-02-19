<?php
include "db.php";

$sql = "SELECT * FROM `delivery` WHERE 1";
$result = $conn->query($sql);
$list = [];

if ($result->num_rows > 0) {
    // output data of each row
     $data = array() ;
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $list = json_encode($data);
} else {
    $list = "0";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Business</title>
</head>
<body>
    <h2>Solicitar Entregador</h2>
    <form id="formDelivery" action="add-delivery.php" method="POST">
        <label for="name">Qual o seu nome?</label>
        <input type="text" id="name" name="name" value="Cleber Reis"><br><br>
        <label for="address">Data/Hora da retirada:</label>
        <!--https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/datetime-local-->
        <input
            type="datetime-local"
            id="datatime"
            name="datetime"
            value="2020-02-18T06:30"><br><br>
        <label for="address">Endereço:</label>
        <input type="text" id="address" name="address" value="Rua dos Guajajaras, 1707, Barro Preto, Belo Horizonte, MG, Brasil, 30180099"><br><br>
        <label for="category">Mensagem:</label><br><br>
        <textarea rows="4" class="form-control" name="message" placeholder="Message">Lorem ipsum dolor, please, maximum 140 chars.</textarea><br><br>
        <input type="submit" value="Cadastrar">
    </form>
    <h2>Entregadores Solicitados</h2>
    <pre id="getDelivery"></pre>
    <script src="../totalvoice.js"></script>
    <script type="text/javascript">
        const listDelivery = <?= $list; ?>,
        getDelivery = document.querySelector('#getDelivery');
        if(listDelivery === 0){
            getDelivery.innerHTML = `{ "status" : "Nenhum registro cadastrado no momento." }`
        } else {
            getDelivery.innerHTML = JSON.stringify(listDelivery, undefined, 4); 
        }
    </script>
    <?php
        $sql = "SELECT * FROM `provider` WHERE `category` = 'entregador' ";
        $result = $conn->query($sql);
        $list = [];
        
        if ($result->num_rows > 0) {
            $data = array() ;
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $list = json_encode($data);
        } else {
            $list = "0";
        }

        $conn->close();
    ?>
    <h2>Listar Entregadores Cadastrados</h2>
    <pre id="getDeliveryProvider"></pre>
    <script type="text/javascript">
        const listDeliveryProvider = <?= $list; ?>;
        getDeliveryProvider = document.querySelector('#getDeliveryProvider')
        if(listDeliveryProvider === 0){
            getDeliveryProvider.innerHTML = `{ "status" : "Nenhum registro cadastrado no momento." }`
        } else {
            getDeliveryProvider.innerHTML = JSON.stringify(listDeliveryProvider, undefined, 4)
        }
    </script>
</body>
</html>