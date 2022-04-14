<? require "acesso.co.php" ?>
<h1 class="page-header"><? echo $Acesso->title ?></h1>
<? if($Acesso->acao == "inserir" || $Acesso->acao == "editar" || $Acesso->acao == "exibir"){ ?>
<form id="form_acesso" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="ace_id" value="<? echo $Acesso->VO->get_ace_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="usu_grp_id">usu_grp_id:</label>
			<? echo $Acesso->Util->geraSelect("usu_grp_id", "sistema_usuario_grupo", "usu_grp_id", "usu_grp_id", "", "", "usu_grp_id", $Acesso->VO->get_usu_grp_id(), "form-control"); ?>
		</div>
		<div class="col-md-12 form-group">
			<label for="fer_id">fer_id:</label>
			<? echo $Acesso->Util->geraSelect("fer_id", "sistema_ferramenta", "fer_id", "fer_id", "", "", "fer_id", $Acesso->VO->get_fer_id(), "form-control"); ?>
		</div>
		<div class="col-md-12 form-group">
			<label for="ace_visualizar">ace_visualizar:</label>
			<input id="ace_visualizar" name="ace_visualizar" type="checkbox" <? if((bool)$Acesso->VO->get_ace_visualizar()){echo "checked";} ?>   class="" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ace_inserir">ace_inserir:</label>
			<input id="ace_inserir" name="ace_inserir" type="checkbox" <? if((bool)$Acesso->VO->get_ace_inserir()){echo "checked";} ?>   class="" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ace_alterar">ace_alterar:</label>
			<input id="ace_alterar" name="ace_alterar" type="checkbox" <? if((bool)$Acesso->VO->get_ace_alterar()){echo "checked";} ?>   class="" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ace_excluir">ace_excluir:</label>
			<input id="ace_excluir" name="ace_excluir" type="checkbox" <? if((bool)$Acesso->VO->get_ace_excluir()){echo "checked";} ?>   class="" />
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Acesso->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Acesso->acao == "listar") { echo $Acesso->lista; } ?>