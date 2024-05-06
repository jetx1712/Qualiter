<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se todos os campos do formulário estão preenchidos
    if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['telefone']) && !empty($_POST['mensagem'])) {
        // Informações do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $assunto = "Contato através do formulário QUALITER";
        $mensagem = $_POST['mensagem'];

        // Configurações de e-mail
        $destinatario = 'david.trindade@inducta.com.br'; // Insira o endereço de e-mail para onde deseja receber as mensagens
        $remetente = $email; // Insira o endereço de e-mail que será exibido como remetente
        $cabecalhos = "Cliente: $remetente" . "\r\n" .
            "Reply-To: $email" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        // Construir o corpo da mensagem
        $corpo = "Nome: $nome\n";
        $corpo .= "E-mail: $email\n";
        $corpo .= "Telefone: $telefone\n";
        $corpo .= "Assunto: $assunto\n";
        $corpo .= "Mensagem: $mensagem\n";

        // Envio do e-mail
        $enviado = mail($destinatario, $assunto, $corpo, $cabecalhos);

        // Verifica se o e-mail foi enviado com sucesso
        if ($enviado) {
            header('Content-Type: application/json');
            echo json_encode(array('sucesso' => true));
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('sucesso' => false));
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('sucesso' => false, 'erro' => 'Todos os campos do formulário devem ser preenchidos.'));
    }
}