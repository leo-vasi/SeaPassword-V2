<?php include '../view/templates/header.php'; ?>

<div id="container-1">
    <img class="points" src="../assets/img/points2.png">

    <div id="bg-video">
        <video autoplay muted loop id="bg-video">
            <source src="../assets/video/themesea.mp4" type="video/mp4">
        </video>
    </div>

    <div id="login">
        <h2>Login</h2>

        <!-- Formulário de login -->
        <form action="../controller/login_registro.php" method="post" id="form_entrar">
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" placeholder="Digite seu email..." required><br><br>

            <label for="senha">Senha:</label><br>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha..." required><br><br>

            <button type="submit" id="button_login">Entrar</button>
        </form>

        <hr>

        <a href="../view/cadastro.php" class="sem_conta">Ainda não tem conta? Cadastrar.</a>
    </div>
</div>

<?php include '../view/templates/footer.php'; ?>
