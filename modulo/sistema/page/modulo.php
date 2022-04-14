<? require "modulo.co.php" ?>
<h1 class="page-header"><? echo $Modulo->title ?></h1>
<? if($Modulo->acao == "inserir" || $Modulo->acao == "editar" || $Modulo->acao == "exibir"){ ?>
<form id="form_modulo" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="mod_id" value="<? echo $Modulo->VO->get_mod_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="mod_nome">mod_nome:</label>
			<input id="mod_nome" name="mod_nome" type="text" maxlength="20" value="<? echo $Modulo->VO->get_mod_nome() ?>" required autofocus class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="mod_pasta">mod_pasta:</label>
			<input id="mod_pasta" name="mod_pasta" type="text" maxlength="20" value="<? echo $Modulo->VO->get_mod_pasta() ?>" required  class="form-control" />
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Modulo->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Modulo->acao == "listar") { echo $Modulo->lista; } ?>