<?php
include 'db_connect.php';

$sql_usuario = "SELECT id_usuario, nome_usuario from usuario";
$result_usuario = $conn -> query($sql_usuario);

$sql_notas = "SELECT id_notas, titulo_notas from notas";
$result_notas = $conn -> query($sql_notas);

if(isset($_POST['adicionar_usuario'])) {
    $nome_usuario = $_POST['nome_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];

    $sql_create = "INSERT INTO usuario(nome_usuario, email_usuario, senha_usuario) VALUES ('$nome_usuario', '$email_usuario','$senha_usuario')";
    header('Location:index.php');
    if($conn -> query($sql_create) === TRUE){
        echo "Novo usuário cadastrado com sucesso!";
    }else{
        echo "Erro:". $sql."<br>".$conn -> error;
    }
}

if(isset($_POST['adicionar_nota'])) {
    $fk_usuario = $_POST['fk_usuario'];
    $titulo_notas = $_POST['titulo_notas'];
    $conteudo_notas = $_POST['conteudo_notas'];
    $categoria_notas = $_POST['categoria_notas'];

    $sql_create_notas = "INSERT INTO notas(fk_usuario, titulo_notas, conteudo_notas, categoria_notas) VALUES ('$fk_usuario', '$titulo_notas','$conteudo_notas','$categoria_notas')";
    header('Location:index.php');
    if($conn -> query($sql_create_notas) === TRUE){
        echo "Novo cadastro feito com sucesso!";
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
    <title>Bloco de Notas</title>
</head>
<body>
<h2> Adicionar Usuário </h2>
    <form action="" method="POST">
        <table border='1'>
            <tr>
                <th> Nome Usuário </th>
                <th> Email </th>
                <th> Senha </th>
                <th> Adicionar </th>
            </tr>
            <tr>
                <td><input type="text" name="nome_usuario"></td>
                <td><input type="text" name="email_usuario"></td>
                <td><input type="text" name="senha_usuario"></td>
                <td><button type="submit" name="adicionar_usuario">
                        Criar Usuário
                    </button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <h2> Visualizar Usuário: </h2>
    <?php
    $sql_user = "SELECT id_usuario,nome_usuario,email_usuario,senha_usuario from usuario";

    $result_user = $conn -> query($sql_user);

    if ($result_user -> num_rows > 0) {
        echo"
        
        <table border='1'>
        <tr>
                <th> ID usuário </th>
                <th> Nome Usuário </th>
                <th> Email </th>
                <th> Senha </th>
                <th> Opções </th>
        </tr>";
        while($row = $result_user -> fetch_assoc()){
            echo "<tr>
                    <td> {$row['id_usuario']} </td>
                    <td> {$row['nome_usuario']} </td>
                    <td> {$row['email_usuario']} </td>
                    <td> {$row['senha_usuario']} </td>
                    <td>
                        <a href='update_usuarios.php?atualizar_id_usuario={$row['id_usuario']}'><button>Editar</button></a>
                        <a href='index.php?excluir_id={$row['id_usuario']}'><button>Excluir</button></a>
                    </td>
                </tr>"; 
    }
        echo "</table>";
    } else{
            echo "Nenhum usuário encontrado.";
    }

    if(isset($_GET['excluir_id'])) {

        $id_usuario = $_GET['excluir_id'];
        $sql_excluir_usuario = "DELETE FROM usuario WHERE id_usuario = $id_usuario";
        header('Location: index.php');

        if ($conn -> query($sql_excluir_usuario) === TRUE) {
            echo "<br> Usuário excluído com sucesso.";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }
?>

    <h2> Adicionar Nota </h2>
    <form action="" method="POST">
        <table border='1'>
            <tr>
                <th> ID usuário </th>
                <th> Titulo </th>
                <th> Conteúdo </th>
                <th> Categoria </th>
                <th> Adicionar </th>
            </tr>
            <tr>
                <td><select name="fk_usuario" required>
                <option selected disable>Selecione Usuário</option>
                    <?php
                        if ($result_usuario -> num_rows > 0) {
                            while($row = $result_usuario -> fetch_assoc()) {
                                echo "<option value='{$row['id_usuario']}'>{$row['nome_usuario']}</option>";
                            }
                        } else {
                            echo "<option disabled>Nenhum usuário encontrado</option>";
                        }
                    ?>
                    </select>
                <td><input type="text" name="titulo_notas" required></td>
                <td><input type="text" name="conteudo_notas" required></td>
                <td><select name="categoria_notas" required>
                        <option selected disable>Selecione</option>
                        <option value="Urgente">Urgente</option>
                        <option value="Médio">Médio</option>
                        <option value="Não Urgente">Não Urgente</option>
                    </select>
                </td>
                <td><button type="submit" name="adicionar_nota">
                        Criar nota
                    </button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <h2> Visualizar Notas: </h2>
</body>
</html>
<?php
    $sql = "SELECT id_notas,titulo_notas,conteudo_notas,categoria_notas,nome_usuario from notas INNER JOIN usuario ON id_usuario = fk_usuario";

    $result = $conn -> query($sql);

    if ($result -> num_rows > 0) {
        echo"
        
        <table border='1'>
        <tr>
                <th> ID Nota </th>
                <th> Nome Usuário </th>
                <th> Título da Nota </th>
                <th> Conteúdo da Nota </th>
                <th> Categoria </th>
                <th> Opções </th>
        </tr>";
        while($row = $result -> fetch_assoc()){
            echo "<tr>
                    <td> {$row['id_notas']} </td>
                    <td> {$row['nome_usuario']} </td>
                    <td> {$row['titulo_notas']} </td>
                    <td> {$row['conteudo_notas']} </td>
                    <td> {$row['categoria_notas']} </td>
                    <td>
                        <a href='update_notas.php?atualizar_id_notas={$row['id_notas']}'><button>Editar</button></a>
                        <a href='index.php?excluir_id_notas={$row['id_notas']}'><button>Excluir</button></a>
                    </td>
                </tr>"; 
    }
        echo "</table>";
    } else{
            echo "Nenhuma nota encontrada.";
    }

    if(isset($_GET['excluir_id_notas'])) {

        $id_notas = $_GET['excluir_id_notas'];
        $sql_excluir_notas = "DELETE FROM notas WHERE id_notas = $id_notas";

        if ($conn -> query($sql_excluir_notas) === TRUE) {
            echo "<br> Nota excluída com sucesso.";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }

?>