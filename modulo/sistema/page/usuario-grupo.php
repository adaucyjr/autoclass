<? require "usuario-grupo.co.php" ?>
<h1 class="page-header"><? echo $UsuarioGrupo->title ?></h1>
<? if($UsuarioGrupo->acao == "inserir" || $UsuarioGrupo->acao == "editar" || $UsuarioGrupo->acao == "exibir"){ ?>
<form id="form_usuario-grupo" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="usu_grp_id" value="<? echo $UsuarioGrupo->VO->get_usu_grp_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="usu_grp_nome">usu_grp_nome:</label>
			<input id="usu_grp_nome" name="usu_grp_nome" type="text" maxlength="20" value="<? echo $UsuarioGrupo->VO->get_usu_grp_nome() ?>" required autofocus class="form-control" />
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $UsuarioGrupo->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($UsuarioGrupo->acao == "listar") { echo $UsuarioGrupo->lista; } ?>