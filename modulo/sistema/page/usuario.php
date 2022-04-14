<? require "usuario.co.php" ?>
<h1 class="page-header"><? echo $Usuario->title ?></h1>
<? if($Usuario->acao == "inserir" || $Usuario->acao == "editar" || $Usuario->acao == "exibir"){ ?>
<form id="form_usuario" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="usu_id" value="<? echo $Usuario->VO->get_usu_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="usu_login">usu_login:</label>
			<input id="usu_login" name="usu_login" type="text" maxlength="20" value="<? echo $Usuario->VO->get_usu_login() ?>" required autofocus class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="usu_senha">usu_senha:</label>
			<input id="usu_senha" name="usu_senha" type="password" maxlength="20" value="<? echo $Usuario->VO->get_usu_senha() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="usu_grp_id">usu_grp_id:</label>
			<? echo $Usuario->Util->geraSelect("usu_grp_id", "sistema_usuario_grupo", "usu_grp_id", "usu_grp_id", "", "", "usu_grp_id", $Usuario->VO->get_usu_grp_id(), "form-control"); ?>
		</div>
		<div class="col-md-12 form-group">
			<label for="usu_status">usu_status:</label>
			<input id="usu_status" name="usu_status" type="checkbox" <? if((bool)$Usuario->VO->get_usu_status()){echo "checked";} ?>   class="" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_id">pes_id:</label>
			<? echo $Usuario->Util->geraSelect("pes_id", "sistema_pessoa", "pes_id", "pes_id", "", "", "pes_id", $Usuario->VO->get_pes_id(), "form-control"); ?>
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Usuario->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Usuario->acao == "listar") { echo $Usuario->lista; } ?>