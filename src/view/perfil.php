<?php include '../view/templates/header.php'; ?>

<div id="bg-video">
    <video autoplay muted loop id="bg-video">
        <source src="../assets/video/themesea.mp4" type="video/mp4">
    </video>
</div>

<br>

<h1 class="title_meu_perfil">MINHAS INFORMAÇÕES</h1>

<br>

<div class="informacoes">
    <p class="email_meu_perfil">Email: <span id="email"></span></p>
    <p class="senha_meu_perfil">Senha: <span id="senha"></span></p>
    <p class="plano_meu_perfil">Plano: <span id="plano"></span></p>
    <p class="data_pagamento_meu_perfil">Data de Pagamento: <span id="data_pagamento"></span></p>
    <p class="data_expiracao_meu_perfil">Data de Expiração: <span id="data_expiracao"></span></p>
</div>

<br>

<form action="/seapassword/model/deletar_conta.php" method="post">
    <input type="hidden" name="id_usuario" id="id_usuario">
    <button type="submit" class="button_excluir" onclick="return confirm('Você tem certeza que deseja deletar sua conta?')">
        Deletar Conta
    </button>
</form>

<br>


<script>
    // Simulação de dados para teste
    const userData = {
        id_usuario: 1,
        email: "usuario@email.com",
        senha: "******",
        plano: "Premium",
        data_pagamento: "2025-02-01",
        data_expiracao: "2025-03-01"
    };
    
    document.getElementById("email").innerText = userData.email;
    document.getElementById("senha").innerText = userData.senha;
    document.getElementById("plano").innerText = userData.plano;
    document.getElementById("data_pagamento").innerText = userData.data_pagamento;
    document.getElementById("data_expiracao").innerText = userData.data_expiracao;
    document.getElementById("id_usuario").value = userData.id_usuario;
</script>

<?php include 'templates/footer.php'; ?>
