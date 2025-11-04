<?php
    $pag = "produtos";
    require_once("../conexao.php");
?>

<div class="mt-3 mb-3">
    <a href="index.php?pag=<?php echo $pag ?>&funcao=novo">
         <button type="button" class="btn btn-success">Novo 
Produto</button>
    </a>
   
</div>

<table class="table table-striped" id="myTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Descrição</th>
      <th scope="col">Valor Compra</th>
      <th scope="col">Valor Venda</th>
      <th scope="col">Estoque</th>
      <th scope="col">Imagem</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php
        //Seleciona os dados no banco
        $query = $pdo->query("SELECT * FROM produtos order by id desc");
        //Executa a consulta
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        for($i=0; $i < count($res); $i++){
            $id = $res[$i]['id'];
            $nome = $res[$i]['nome'];
            $descricao = $res[$i]['descricao'];
            $valor_compra = $res[$i]['valor_compra'];
            $valor_venda = $res[$i]['valor_venda'];
            $estoque = $res[$i]['estoque'];
            $imagem = $res[$i]['imagem'];
        
    ?>
    <tr>
        <td><?php echo $id; ?></td>
        <td><?php echo $nome; ?></td>
        <td><?php echo $descricao; ?></td>
        <td><?php echo $valor_compra; ?></td>
        <td><?php echo $valor_venda; ?></td>
        <td><?php echo $estoque; ?></td>
        <td><?php echo $imagem; ?></td>
        <td>
            <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" title="Editar Dados"><i class="fa-solid fa-pen-to-square"></i></a>
            <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>"><i class="fa-solid fa-trash" title="Excluir Dados" style="color: #FF0000"></i></a>
        </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <?php
            if(@$_GET['funcao'] == 'editar'){
                $titulo = "Editar Registro";
                $id2 = $_GET['id'];
                
                $query = $pdo->query("SELECT * FROM produtos WHERE id = '$id2'");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                $nome2 = $res[0]['nome'];
                $descricao2 = $res[0]['descricao'];
                $valor_compra2 = $res[0]['valor_compra'];
                $valor_venda2 = $res[0]['valor_venda'];
                $estoque2 = $res[0]['estoque'];
                $imagem2 = $res[0]['imagem'];
            }else{
                $titulo = "Inserir Registro";
            }
        ?>
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input value="<?php echo @$nome2; ?>" type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input value="<?php echo @$descricao2; ?>" type="text" class="form-control" 
                id="descricao" name="descricao" placeholder="Descrição">
            </div>
            <div class="form-group">
                <label for="valor_compra">Valor de Compra</label>
                <input value="<?php echo @$valor_compra2; ?>" type="text" class="form-control" 
                id="valor_compra" name="valor_compra" placeholder="Valor de Compra">
            </div>
            <div class="form-group">
              <label for="valor_venda">Valor de Venda</label>
              <input value="<?php echo @$valor_venda2; ?>" type="text" 
              class="form-control" 
              id="valor_venda" name="valor_venda" placeholder="Valor de Venda">
            </div>
            <div class="form-group">
              <label for="estoque">Estoque</label>
              <input value="<?php echo @$estoque2; ?>" type="number" 
              class="form-control" 
              id="estoque" name="estoque" placeholder="Estoque">
            </div>
            <div class="form-group">
              <label for="imagem">Imagem</label>
              <input value="<?php echo @$imagem2; ?>" type="file" 
              class="form-control" 
              id="imagem" name="imagem" placeholder="Imagem">
            </div>
            <small>
                <div id="mensagem">
                    
                </div>
            </small>
      </div>
      <div class="modal-footer">
        <input value="<?php echo @$_GET['id']; ?>" type="hidden" name="txtid2" id="txtid2">
        <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" id="btn-salvar" class="btn btn-primary">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal para excluir os dados -->
<div class="modal fade" tabindex="-1" id="modalExcluir">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Excluir Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja Excluir este Registro?</p>
        <div align="center" id="mensagem-excluir">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn-cancelar-excluir" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form method="post">
            <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id']?>">
            <button type="button" id="btn-excluir" class="btn btn-danger">Excluir</button>
        </form>
        
      </div>
    </div>
  </div>
</div>

<?php
    if(@$_GET["funcao"] != null && @$_GET["funcao"] == "novo"){
        echo "<script>$('#modalDados').modal('show');</script>";
    }

    if(@$_GET["funcao"] != null && @$_GET["funcao"] == "editar"){
        echo "<script>$('#modalDados').modal('show');</script>";
    }

    if(@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir"){
    echo "<script>$('#modalExcluir').modal('show');</script>";
}
?>

<script>
    $(document).ready(function(){
        var pag = "<?=$pag?>";
        $('#btn-salvar').click(function(event){
            event.preventDefault();
            $.ajax({
                url: pag + "/inserir.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem){
                    $('#mensagem').removeClass()
                    if(mensagem == 'Salvo com Sucesso!'){
                        $('#mensagem').addClass('mensagem-sucesso');
                        $('#btn-fechar').click();
                        window.location = "index.php?pag=" + pag;
                    }else{
                        $('#mensagem').addClass('mensagem-erro');
                    }
                    $('#mensagem').text(mensagem);
                }
            })
        })
    })
</script>

<script>
    $(document).ready(function(){
        var pag = "<?=$pag?>";
        $('#btn-excluir').click(function(event){
            event.preventDefault(); oku9
            $.ajax({
                url: pag + "/excluir.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem){
                    $('#mensagem_excluir').removeClass()
                    if(mensagem == 'Excluído com Sucesso!'){
                        $('#mensagem_excluir').addClass('mensagem-sucesso');
                        $('#btn-cancelar-excluir').click();
                        window.location = "index.php?pag=" + pag;
                    }else{
                        $('#mensagem_excluir').addClass('mensagem-erro');
                    }
                    $('#mensagem_excluir').text(mensagem);
                }
            })
        })
    })
</script>


