<?php
include "db.php";

$sql = "SELECT * FROM `provider`";
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

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Biz</title>
</head>
<body>
    <h2>Registar Provedores</h2>
    <form id="formProvider" action="add-provider.php" method="POST">
        <label for="address">Endereço:</label>
        <input type="text" id="address" name="address" placeholder="Endereço Completo" value="Rua dos Guajajaras, 1707, Barro Preto, Belo Horizonte, MG, Brasil, 30180099"><br><br>
        <label for="available">Horários:</label>
        <select name="available" id="available">
            <option value="segunda-sexta (8:00-12:00 | 13:00-17:00)">segunda-sexta (8:00-12:00 | 13:00-17:00)</option>
            <option value="segunda-sexta (9:00-12:00 | 13:00-18:00)">segunda-sexta (9:00-12:00 | 13:00-18:00)</option>
            <option value="por favor, entre em contato para saber horários">por favor, entre em contato para saber horários</option>
        </select><br><br>
        <label for="category">Categoria:</label>
        <select name="category" id="category">
            <option value="servidor">servidor</option>
            <option value="entregador">entregador</option>
        </select><br><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Nome e Sobrenome" value="John Doe PHP"><br><br>
        <label for="phone">Telefone:</label>
        <input type="text" id="phone" name="phone" value="3199558866"><br><br>
        <label for="type">Tipo de serviço/entrega:</label>
        <input type="text" id="type" name="type" value="Consultor Jurídico"><br><br>
        <label for="lat">Latitude:</label>
        <input type="text" id="lat" name="lat" value="-19.9870967"><br><br>
        <label for="lng">Longitude:</label>
        <input type="text" id="lng" name="lng" value="-44.0021423"><br><br>
        <input type="submit" value="Cadastrar">
    </form>
    <h2>Listar Provedores</h2>
    <pre id="getProvider"></pre>
    <script type="text/javascript">
        const listProvider = <?= $list; ?>,
        getProvider = document.querySelector('#getProvider')
        if(listProvider === 0){
            getProvider.innerHTML = `{ "status" : "Nenhum registro cadastrado no momento." }`
        } else {
            getProvider.innerHTML = JSON.stringify(listProvider, undefined, 4)
        }
    </script>
    <?php
    $sql = "SELECT * FROM `provider` WHERE `category` = 'servidor' ";
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
    ?>
    <h2>Listar Servidores</h2>
    <pre id="getServer"></pre>
    <script type="text/javascript">
        const listServer = <?= $list; ?>;
        getServer = document.querySelector('#getServer')
        if(listServer === 0){
            getServer.innerHTML = `{ "status" : "Nenhum registro cadastrado no momento." }`
        } else {
            getServer.innerHTML = JSON.stringify(listServer, undefined, 4)
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
    <h2>Listar Entregadores</h2>
    <pre id="getDelivery"></pre>
    <script type="text/javascript">
        const listDelivery = <?= $list; ?>;
        getDelivery = document.querySelector('#getDelivery')
        if(listDelivery === 0){
            getDelivery.innerHTML = `{ "status" : "Nenhum registro cadastrado no momento." }`
        } else {
            getDelivery.innerHTML = JSON.stringify(listDelivery, undefined, 4)
        }
    </script>
</body>
</html>