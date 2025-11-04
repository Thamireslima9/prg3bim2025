<?php
    require_once("../../conexao.php");
    
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $valor_compra = $_POST["valor_compra"];
    $valor_venda = $_POST["valor_venda"];
    $estoque = $_POST["estoque"];

    $valor_compra = str_replace(',', '.', $valor_compra);
    $valor_vendqa = str_replace(',', '.', $valor_venda);
    
    $id = $_POST["txtid2"];

    // $nome_img = preg_replace('/[ -]+/' , '-' , @$_FILES['imagem']['name']);
   $nome_img = ""; 
    $caminho = '../../img/produtos/' .$nome_img;
    if (@$_FILES['imagem']['name'] == ""){
        $imagem = "sem-foto.jpg";
    }else{ 
        $imagem = $nome_img;
    }

    $imagem_temp = @$_FILES['imagem']['tmp_name']; 
    $ext = pathinfo($imagem, PATHINFO_EXTENSION);   
    if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
    move_uploaded_file($imagem_temp, $caminho);
    }else{
        echo 'Extensão de Imagem não permitida!';
        exit();
    }

    if($nome == ""){
        echo "O nome é de preenchimento obrigatório!";
        exit();
    }

    if($valor_compra = ""){
        echo "O valor de compra é de preenchimento obrigatório!";
        exit();
    }
    if($valor_venda = ""){
        echo "O valor de venda é de preenchimento obrigatório!";
        exit();
    }
    if($estoque = ""){
        echo "O valor do estoque é de preenchimento obrigatório!";
        exit();
    }

    if($id == ""){
        $res = $pdo->prepare("INSERT INTO produtos (nome, descricao, valor_compra, valor_venda, estoque, imagem) 
        VALUES(:nome, :descricao, :valor_compra, :valor_venda, :estoque, :imagem)");
    }else{
         $res = $pdo->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, valor_compra = :valor_compra,
         valor_venda = :valor_venda, estoque = :estoque, imagem = :imagem WHERE id = '$id'");
    }


    $res->bindValue(":nome", $nome);
    $res->bindValue(":descricao", $descricao);
    $res->bindValue(":valor_compra", $valor_compra);
    $res->bindValue(":valor_venda", $valor_venda);
    $res->bindValue(":estoque", $estoque);
    $res->bindValue(":imagem", $imagem);

    $res-> execute();

    echo "Salvo com sucesso!";
?>