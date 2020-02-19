<?php
include "db.php";

$sql = "SELECT * FROM `testimonial` WHERE 1";
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
    <title>Local Business</title>
</head>
<body>
    <h2>Avaliar Profissional/Serviço</h2>
    <form id="formTestimonial" action="add-testimonial.php" method="POST">
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
        <label for="rating">Classificar Atendimento (1-5):</label>
        <input type="number" id="rating" name="rating" value="3"><br><br>
        <textarea rows="4" class="form-control" name="testimonial" placeholder="testimonial">Lorem ipsum dolor, please, maximum 140 chars.</textarea><br><br>
        <input type="submit" value="Cadastrar">
    </form>
    <h2>Listar Trabalhos</h2>
    <pre id="getTestimonial"></pre>
    <script type="text/javascript">
        const listTestimonial = <?= $list; ?>,
        getTestimonial = document.querySelector('#getTestimonial');
        if(listTestimonial === 0){
            getTestimonial.innerHTML = `{ "status" : "Nenhum registro cadastrado no momento." }`
        } else {
            getTestimonial.innerHTML = JSON.stringify(listTestimonial, undefined, 4); 
        }
    </script>
</body>
</html>