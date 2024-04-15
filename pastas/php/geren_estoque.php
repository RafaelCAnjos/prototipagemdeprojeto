<?php
include_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro_produtos.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro de Produtos</title>
</head>

<body>
    <div class="container">


        <div class="form">
            <form action="../php/cad_produtos.php" method="post">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastro de Produtos</h1>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nomeProduto">Nome do Produto:</label>
                    <input type="text" class="form-control" name="nomeProduto" id="nomeProduto"
                        placeholder="Digite o nome do produto">
                </div>
                <div class="form-group">
                    <label for="descricaoProduto">Descrição do Produto:</label>
                    <textarea class="form-control" name="descricaoProduto" id="descricaoProduto" rows="3"
                        placeholder="Digite a descrição do produto"></textarea>
                </div>
                <div class="form-group">
                    <label for="precoProduto">Preço do Produto:</label>
                    <input type="text" class="form-control" name="precoProduto" id="precoProduto"
                        placeholder="Digite o preço do produto">
                </div>
                <div class="form-group">
                    <label for="quantidadeProduto">Quantidade em Estoque:</label>
                    <input type="number" class="form-control" name="quantidadeProduto" id="quantidadeProduto"
                        placeholder="Digite a quantidade">
                </div>

                <div class="continue-button">
                    <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                </div>
            </form>
        </div>
        <div class="form">
            <form method="post">
                <div class="card">
                    <div class="card-header">
                        Itens de Estoque
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome do Item</th>
                                    <th>Quantidade</th>
                                    <th>preço</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="telaEstoque">
                                <?php
                                exibirExtoque($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/geren_estoque.js"></script>

</html>


<?php
    function exibirExtoque($conn){
        $queryProdutos = "select * from produto";
        $resultProduto = mysqli_query($conn, $queryProdutos);
        
        for($i = 0; $i < mysqli_num_rows($resultProduto); $i++){
            $produtos = mysqli_fetch_array($resultProduto);
            
            echo "
            <tr>
                <td>".$produtos['prod_nome']."</td>
                <td>".$produtos['prod_quant']."</td>
                <td>".$produtos['prod_preco']."</td>
                <td>
                    <button type='submit' class='btn btn-sm btn-danger' name='".$produtos['prod_id']."'>Remover</button>
                </td>
            <tr>
            ";
        }
    }
    function deletar($id_Produt, $conn){
        $queryProdutos = "delete from produto where prod_id = $id_Produt";
        mysqli_query($conn, $queryProdutos);
    }
    if(isset($_POST['id'])){
        deletar($_POST['id'],  $conn);
    }
?>