<?php include '../view/templates/header.php'; ?>

<div class="embaço">
    <video autoplay muted loop id="bg-video">
        <source src="../assets/video/themesea.mp4" type="video/mp4">
    </video>
</div>

<h1 class="pagamento">PAGAMENTO</h1>

<div class="box_pagamento">

    <!-- Formulário de pagamento -->
    <form action="/seapassword/model/inserir_pagamento.php" method="post">

        <input type="hidden" name="id_usuario" id="id_usuario">
        <input type="hidden" name="id_plano" id="id_plano">

        <label for="num_cartao">Número do cartão</label><br>
        <input type="text" name="numero_cartao" id="numero_cartao" maxlength="19" placeholder="1234 5678 9012 3456"><br><br>
        
        <label for="agencia">Agência</label><br>
        <input type="text" name="agencia" id="agencia" maxlength="4" placeholder="1234"><br><br>
    
        <label for="cod_seguranca">Código de segurança</label><br>
        <input type="text" name="codigo_seguranca" id="codigo_seguranca" maxlength="3" placeholder="123"><br><br>
        
        <label for="CPF">CPF</label><br>
        <input type="text" name="cpf" id="cpf" maxlength="14" placeholder="123.456.789-01"><br><br>

        <button type="submit" id="button_pagar">Pagar</button>
        
    </form>
</div>

<script>
// Simulação de dados (para testes antes da integração com back-end)
const pagamentoData = {
    id_usuario: 1, // Substituir pelo ID real no futuro
    id_plano: 2, // Exemplo: ID do plano Plus
};

// Preencher os campos ocultos com dados simulados
document.getElementById("id_usuario").value = pagamentoData.id_usuario;
document.getElementById("id_plano").value = pagamentoData.id_plano;

// Máscara para CPF
document.getElementById("cpf").addEventListener("input", function(event) {
    let input = event.target;
    let value = input.value.replace(/\D/g, ''); 

    if (value.length > 9) {
        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, "$1.$2.$3-$4");
    } else {
        value = value.replace(/(\d{3})(\d{3})(\d{1,3})/, "$1.$2.$3");
    }

    input.value = value;
});

// Máscara para número do cartão
document.getElementById("numero_cartao").addEventListener("input", function(event) {
    let input = event.target;
    let value = input.value.replace(/\s+/g, ''); 
    value = value.replace(/(\d{4})(?=\d)/g, "$1 "); 
    input.value = value;
});

</script>

<br>

<footer style="position: fixed">
    <p id="footer-items">© 2024 SeaPassword. All Rights Reserved.</p>
</footer>

</body>
</html>
