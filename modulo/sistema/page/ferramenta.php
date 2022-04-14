<? require "ferramenta.co.php" ?>
<h1 class="page-header"><? echo $Ferramenta->title ?></h1>
<? if($Ferramenta->acao == "inserir" || $Ferramenta->acao == "editar" || $Ferramenta->acao == "exibir"){ ?>
<form id="form_ferramenta" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="fer_id" value="<? echo $Ferramenta->VO->get_fer_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="fer_nome">fer_nome:</label>
			<input id="fer_nome" name="fer_nome" type="text" maxlength="20" value="<? echo $Ferramenta->VO->get_fer_nome() ?>" required autofocus class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="fer_page">fer_page:</label>
			<input id="fer_page" name="fer_page" type="text" maxlength="20" value="<? echo $Ferramenta->VO->get_fer_page() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="mod_id">mod_id:</label>
			<? echo $Ferramenta->Util->geraSelect("mod_id", "sistema_modulo", "mod_id", "mod_id", "", "", "mod_id", $Ferramenta->VO->get_mod_id(), "form-control"); ?>
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Ferramenta->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Ferramenta->acao == "listar") { echo $Ferramenta->lista; } ?>