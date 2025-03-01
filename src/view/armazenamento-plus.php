<?php include '../view/templates/header.php'; ?>

<!-- background embaçado -->
<div class="embaço">
    <video autoplay muted loop id="bg-video">
        <source src="../assets/video/themesea.mp4" type="video/mp4">
    </video>
</div>

<br>

<!-- formulário do armazenamento -->
<form class="arm">
    <h2 class="armazenamento">ARMAZENAMENTO PLUS</h2>

    <div class="pai">
        <!-- Os campos serão preenchidos dinamicamente -->
    </div>

    <script>
    // Script para o "olhinho" funcionar
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
    </script>

    <button class="button_salvar" type="submit">SALVAR</button>
</form>

<br>

<a href="/seapassword/view/update_credencial.php">
    <button class="button_atualizar">ATUALIZAR</button>
</a>

<br>

<?php include 'templates/footer.php'; ?>
