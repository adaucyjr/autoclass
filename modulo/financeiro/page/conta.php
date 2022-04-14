<? require "conta.co.php" ?>
<h1 class="page-header"><? echo $Conta->title ?></h1>
<? if($Conta->acao == "inserir" || $Conta->acao == "editar" || $Conta->acao == "exibir"){ ?>
<form id="form_conta" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="con_id" value="<? echo $Conta->VO->get_con_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="con_nome">con_nome:</label>
			<input id="con_nome" name="con_nome" type="text" maxlength="20" value="<? echo $Conta->VO->get_con_nome() ?>" required autofocus class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="con_numero">con_numero:</label>
			<input id="con_numero" name="con_numero" type="text" maxlength="10" value="<? echo $Conta->VO->get_con_numero() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="con_tipo">con_tipo:</label>
			<input id="con_tipo" name="con_tipo" type="text" maxlength="10" value="<? echo $Conta->VO->get_con_tipo() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="con_saldo">con_saldo:</label>
			<input id="con_saldo" name="con_saldo" type="text" maxlength="102" value="<? echo $Conta->VO->get_con_saldo() ?>" required  class="form-control" />
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Conta->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Conta->acao == "listar") { echo $Conta->lista; } ?>