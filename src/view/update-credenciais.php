<?php include '../view/templates/header.php'; ?>

<div class="embaço">
    <video autoplay muted loop id="bg-video">
        <source src="../assets/video/themesea.mp4" type="video/mp4">
    </video>
</div>

<br>

<form action="/seapassword/controller/update_armazenamento.php" method="post" class="arm">

    <h2 class="armazenamento">ARMAZENAMENTO ESSENCIAL</h2>

    <div class="pai">
        <!-- Campos de credenciais simulados para exibição -->
        <div class="input-group">
            <label for="descricao1">Descrição</label>
            <input type="text" name="descricao1" id="inputs_arm" value="Minha Conta Exemplo">
            
            <label for="email1">Email</label>
            <input type="email" name="email1" id="inputs_arm" value="email@exemplo.com">
            
            <label for="senha1">Senha</label>
            <input type="password" name="senha1" id="senha1" class="inputs_arm" value="Senha123">
            
            <button class="button_mostrar" type="button" onclick="togglePasswordVisibility('senha1')">👁️‍🗨️</button>
        </div>

        <div class="input-group">
            <label for="descricao2">Descrição</label>
            <input type="text" name="descricao2" id="inputs_arm" value="Outra Conta">
            
            <label for="email2">Email</label>
            <input type="email" name="email2" id="inputs_arm" value="usuario@teste.com">
            
            <label for="senha2">Senha</label>
            <input type="password" name="senha2" id="senha2" class="inputs_arm" value="Segredo456">
            
            <button class="button_mostrar" type="button" onclick="togglePasswordVisibility('senha2')">👁️‍🗨️</button>
        </div>
    </div>

    <script>
    // Script para alternar visibilidade da senha
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    }
    </script>

    <button class="button_salvar" type="submit">SALVAR ALTERAÇÕES</button>

</form>

<br>

<?php include 'templates/footer.php'; ?>
