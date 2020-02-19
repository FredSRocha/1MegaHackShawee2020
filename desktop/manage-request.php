<?php
include "db.php";

$sql = "SELECT * FROM `job` WHERE 1";
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

if(isset($_GET['id'])){
    $id_provider = $_GET['id'];
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
    <h2>Solicitar Demanda</h2>
    <p>Fique tranquilo sobre pagar adiantado. O seu direito legal de arrependimento bem como insatisfação com os serviços prestados por nossos profissionais estão resguardados:</p>
    <ul>
        <li>Em caso de arrependimento o valor será extornado e você não terá prejuízo algum!</li>
        <li>Em caso de insatisfação com serviço ou atendimento prestado por um dos profissionais cadastrados na plataforma resolveremos tudo!</li>
    </ul>
    <p>Fique tranquilo, é como pedir comida, selecione o serviço desejado e faça o pagamento. Em seguida aguarde, em instantes o servidor do produto ou serviço escolhido por você entrará em contato.</p>
    <p>Muito obrigado!</p>
    <form id="formRequest" action="add-request.php" method="POST">
        <label for="address">Data/Hora:</label>
        <!--https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/datetime-local-->
        <input
            type="datetime-local"
            id="datatime"
            name="datetime"
            value="2020-02-18T06:30"><br><br>
        <label for="service">Serviços:</label>
        <select name="service" id="service" onchange="setValue()">
		    <option value="">Selecione o  serviço</option>
            <?php
              $sql = "SELECT * FROM `service` WHERE 1";
              $result = $conn->query($sql);
              if (!$result) {
                trigger_error('Invalid query: ' . $conn->error);
            }
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                ?>
                <option value="<?php echo $row["name"];?>,<?php echo $row["price"];?>"><?php echo $row["name"];?> - R$ <?php echo $row["price"];?></option>
		        <?php } } $conn->close(); ?> 
		</select><br><br>
        <label for="category">Mensagem:</label><br><br>
        <textarea rows="4" class="form-control" name="message" placeholder="Message">Lorem ipsum dolor, please, maximum 140 chars.</textarea><br><br>
        <input type="hidden" id="id_provider" name="id_provider" value="<?= (isset($_GET['id']) ? $id_provider : ''); ?>"><br><br>
        <input type="hidden" name="nameService" id="nameService">
        <!--<input type="submit" value="Contratar">-->
    </form>
    <div id="paypal-button"></div>
    <h2>Listar Demanda</h2>
    <pre id="getJob"></pre>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  function setValue() {
      const selectValue = document.querySelector('#service').value;
      const valuePayment = selectValue.split(","); // 0: name service | 1: value (float) 
    return valuePayment[1];
  }
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'demo_sandbox_client_id',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'pt_BR',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: setValue(),
            currency: 'BRL'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        const serviceValue = document.querySelector('#service').value;
        const nameValue = serviceValue.split(","); // 0: name service | 1: value (float)
        document.querySelector('#nameService').value = nameValue[0];
        // send form to user
        document.querySelector('#formRequest').submit();
        
      });
    }
  }, '#paypal-button');

</script>
<script type="text/javascript">
        const listJob = <?= $list; ?>,
        getJob = document.querySelector('#getJob');
        if(listJob === 0){
            getJob.innerHTML = `{ "status" : "Nenhum registro cadastrado no momento." }`
        } else {
            getJob.innerHTML = JSON.stringify(listJob, undefined, 4); 
        }
    </script>

</body>
</html>