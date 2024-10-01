<?php 
include 'db_connect.php';

$sql_usuario = "SELECT id_usuario, nome_usuario from usuario";
$result_usuario = $conn -> query($sql_usuario);

if(isset($_POST['atualizar_usuario'])) {
    $id_usuario = $_GET['atualizar_id_usuario'];
    $novo_nome_usuario = $_POST['novo_nome_usuario'];
    $novo_email_usuario = $_POST['novo_email_usuario'];
    $nova_senha_usuario = $_POST['nova_senha_usuario'];

    $sql_update_usuarios = "UPDATE usuario SET nome_usuario = '$novo_nome_usuario', email_usuario = '$novo_email_usuario', senha_usuario = '$nova_senha_usuario'  WHERE id_usuario = $id_usuario";
    if($conn -> query($sql_update_usuarios) === TRUE){
        echo "Usuário atualizado com sucesso!";
    }else{
        echo "Erro:". $sql."<br>".$conn -> error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuários</title>
</head>
<body>
    <h2>Atualizar Usuário:</h2>
    <form action="" method="POST">
        <table border='1'>
                <tr>
                    <th> Novo nome do usuário </th>
                    <th> Novo email </th>
                    <th> Nova senha </th>
                    <th> Atualizar </th>
                </tr>
                <tr>
                    <td><input type="text" name="novo_nome_usuario"></td>
                    <td><input type="text" name="novo_email_usuario"></td>
                    <td><input type="text" name="nova_senha_usuario"></td>
                    <td><button type="submit" name="atualizar_usuario">
                            Confirmar Atualização
                        </button>
                    </td>
                </tr>
            </table>
    </form>
    <a href="index.php">Visualizar o Bloco de Notas</a>
</body>
</html>