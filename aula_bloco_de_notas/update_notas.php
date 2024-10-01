<?php 
include 'db_connect.php';

$sql_notas = "SELECT id_notas, titulo_notas, conteudo_notas, categoria_notas from notas";
$result_notas = $conn -> query($sql_notas);

if(isset($_POST['atualizar_notas'])) {
    $id_notas = $_GET['atualizar_id_notas'];
    $novo_titulo_notas = $_POST['novo_titulo_notas'];
    $novo_conteudo_notas = $_POST['novo_conteudo_notas'];
    $nova_categoria_notas = $_POST['nova_categoria_notas'];

    $sql_update_notas = "UPDATE notas SET titulo_notas = '$novo_titulo_notas', conteudo_notas = '$novo_conteudo_notas', categoria_notas = '$nova_categoria_notas'  WHERE id_notas = $id_notas";
    if($conn -> query($sql_update_notas) === TRUE) {
        echo "Nota atualizada com sucesso!";
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
    <title>Atualizar Notas</title>
</head>
<body>
    <h2>Atualizar Nota:</h2>
    <form action="" method="POST">
        <table border='1'>
                <tr>
                    <th> Novo título da nota </th>
                    <th> Novo conteúdo da nota </th>
                    <th> Nova categoria da nota </th>
                    <th> Atualizar </th>
                </tr>
                <tr>
                    <td><input type="text" name="novo_titulo_notas" required></td>
                    <td><input type="text" name="novo_conteudo_notas" required></td>
                    <td><select name="nova_categoria_notas" required>
                        <option selected disable>Selecione</option>
                        <option value="Urgente">Urgente</option>
                        <option value="Médio">Médio</option>
                        <option value="Não Urgente">Não Urgente</option>
                    </select>
                </td>
                    <td><button type="submit" name="atualizar_notas">
                            Confirmar Atualização
                        </button>
                    </td>
                </tr>
            </table>
    </form>
    <a href="index.php">Visualizar o Bloco de Notas</a>
</body>
</html>
