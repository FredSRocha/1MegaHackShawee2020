<?php
include "db.php";

$sql = "SELECT * FROM `service` WHERE 1";
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
//var_dump($list);
//$conn->close();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Business</title>
</head>
<body>
    <h2>Cadastrar Serviços</h2>
    <form id="formService" action="add-service.php" method="POST">
    <label for="id_provider">Provedor:</label>
        <select name="id_provider" id="id_provider">
		    <option value="">Selecione o provedor do serviço</option>
            <?php
              $sql = "SELECT `id`,`name`, `category` FROM `provider` WHERE 1";
              $result = $conn->query($sql);
              if (!$result) {
                trigger_error('Invalid query: ' . $conn->error);
            }
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                ?>
                <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?> - <?php echo $row["category"];?> (<?php echo $row["id"];?>)</option>
		        <?php } } $conn->close(); ?> 
		</select><br><br>
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" value="Corte e Escova"><br><br>
        <label for="price">Preço:</label>
        <input type="text" id="price" name="price" value="10.50"><br><br>
        <input type="submit" value="Cadastrar">
    </form>
    <h2>Listar Trabalhos</h2>
    <pre id="getService"></pre>
    <script type="text/javascript">
        const listService = <?= $list; ?>,
        getService = document.querySelector('#getService');
        if(listService === 0){
            getService.innerHTML = `{ "status" : "Nenhum registro cadastrado no momento." }`
        } else {
            getService.innerHTML = JSON.stringify(listService, undefined, 4); 
        }
    </script>
</body>
</html>