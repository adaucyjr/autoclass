<? require "movimentacao.co.php" ?>
<h1 class="page-header"><? echo $Movimentacao->title ?></h1>
<? if($Movimentacao->acao == "inserir" || $Movimentacao->acao == "editar" || $Movimentacao->acao == "exibir"){ ?>
<form id="form_movimentacao" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="mov_id" value="<? echo $Movimentacao->VO->get_mov_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="con_id">con_id:</label>
			<? echo $Movimentacao->Util->geraSelect("con_id", "financeiro_conta", "con_id", "con_id", "", "", "con_id", $Movimentacao->VO->get_con_id(), "form-control"); ?>
		</div>
		<div class="col-md-12 form-group">
			<label for="mov_valor">mov_valor:</label>
			<input id="mov_valor" name="mov_valor" type="text" maxlength="102" value="<? echo $Movimentacao->VO->get_mov_valor() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="mov_tipo">mov_tipo:</label>
			<input id="mov_tipo" name="mov_tipo" type="number" maxlength="1" value="<? echo $Movimentacao->VO->get_mov_tipo() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="mov_descricao">mov_descricao:</label>
			<input id="mov_descricao" name="mov_descricao" type="text" maxlength="50" value="<? echo $Movimentacao->VO->get_mov_descricao() ?>" required  class="form-control" />
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Movimentacao->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Movimentacao->acao == "listar") { echo $Movimentacao->lista; } ?>