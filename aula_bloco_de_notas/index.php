<?php
include 'db_connect.sql'

if(isset($_POST['adicionar_nota'])) {
    $titulo_notas = $_POST['titulo_notas'];
    $conteudo_notas = $_POST['conteudo_notas'];
    $categoria_notas = $_POST['categoria_notas'];

    $sql_create = "INSERT INTO notas (titulo_notas, conteudo_notas, categoria_notas) VALUE ('$titulo_notas','$conteudo_notas','$categoria_notas')";

    if($conn -> query($sql_create) === TRUE){
        echo "Novo cadastro feito com sucesso!";
    }else{
        echo "Erro:". $sql."<br>".$conn -> error;
    }
}
$sql_create = "INSERT INTO notas "
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloco de Notas</title>
</head>
<body>
    <h2> Adicionar Nota </h2>
    <table border='1'>
        <tr>
            <th> Titulo </th>
            <th> Conteúdo </th>
            <th> Categoria </th>
            <th> Opções </th>
            <th> Adicionar </th>
        </tr>
        <tr>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><select name="categorias" required>
                    <option selected disable>Selecione</option>
                    <option>Categoria 1</option>
                    <option>Categoria 2</option>
                </select>
            </td>
            <td>
                <a href='update.php'>Editar</a>
                <a href='delete.php'>Deletar</a>
            </td>
            <td><button type="submit" name="">
                    Criar nota
                </button>
            </td>
        </tr>
</body>
</html>