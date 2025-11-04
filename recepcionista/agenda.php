<?php
    $pag = "agenda";
?>

<div id="calendar"></div>


<!-- Modal Cadastrar -->
<div class="modal fade" id="cadastrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addEvento" method="post">
          <div class="form-group">
        <label for="title">Título</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Título do evento">
          </div>
          <div class="form-group">
        <label for="start">Início</label>
        <input type="text" class="form-control" id="start" name="start" onkeypress="Datahora(event,this)">
          </div>
          <div class="form-group">
        <label for="end">Fim</label>
        <input type="text" class="form-control" id="end" name="end" onkeypress="Datahora(event,this)">
          </div>
          <small>
            <div id="mensagem"></div>
          </small>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="cadEvento" id="cadEvento" value="cadEvento" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal  Visualizar-->
<div class="modal fade" id="visualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="visEvento"> 
          <dl class="row">
              <dt class="col-sm-3">ID</dt>
              <dt class="col-sm-9" id="id"></dt>

              <dt class="col-sm-3">TÍTULO</dt>
              <dt class="col-sm-9" id="title"></dt>

              <dt class="col-sm-3">INÍCIO</dt>
              <dt class="col-sm-9" id="start"></dt>

              <dt class="col-sm-3">FIM</dt>
              <dt class="col-sm-9" id="end"></dt>
          </dl>
        </div>
      </div>
      <div>
        <small>
          <div class="mensagem">
          </div>
        </small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-danger">Excluir</button>
      </div>
    </div>
  </div>
</div>