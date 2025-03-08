<?php include '../view/templates/header.php'; ?>

<div id="container-1">
    <img class="points" src="../assets/img/points2.png" />
    <div id="bg-video">
        <video autoplay muted loop id="bg-video">
            <source src="../assets/video/themesea.mp4" type="video/mp4">
        </video>
    </div>

    <div id="login">
        <h2>Login</h2>
        <form id="form_entrar">
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" placeholder="Digite seu email..." required><br><br>

            <label for="senha">Senha:</label><br>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha..." required><br><br>

            <button type="submit" id="button_login">Entrar</button>
        </form>

        <p id="login-mensagem"></p>

        <hr>
        <a href="../view/cadastro.php" class="sem_conta">Ainda não tem conta? Cadastrar.</a>
    </div>
</div>

<footer style="position: flex">
    <p id="footer-items">© 2024 SeaPassword. All Rights Reserved.</p>
</footer>

<script>
document.querySelector("#form_entrar").addEventListener("submit", async (e) => {
    e.preventDefault();
    
    const email = document.querySelector("#email").value;
    const senha = document.querySelector("#senha").value;
    const mensagem = document.querySelector("#login-mensagem");

    const response = await fetch("../controller/UserController.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password: senha }),
    });

    const data = await response.json();

    if (data.success) {
        mensagem.style.color = "green";
        mensagem.innerText = "Login realizado com sucesso!";
        setTimeout(() => {
            window.location.href = "../view/perfil.php";
        }, 1500);
    } else {
        mensagem.style.color = "red";
        mensagem.innerText = data.error;
    }
});
</script>

</body>
</html>
