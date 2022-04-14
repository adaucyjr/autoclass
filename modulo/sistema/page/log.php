<? require "log.co.php" ?>
<h1 class="page-header"><? echo $Log->title ?></h1>
<? if($Log->acao == "inserir" || $Log->acao == "editar" || $Log->acao == "exibir"){ ?>
<form id="form_log" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="log_id" value="<? echo $Log->VO->get_log_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="usu_id">usu_id:</label>
			<? echo $Log->Util->geraSelect("usu_id", "sistema_usuario", "usu_id", "usu_id", "", "", "usu_id", $Log->VO->get_usu_id(), "form-control"); ?>
		</div>
		<div class="col-md-12 form-group">
			<label for="log_data_hora">log_data_hora:</label>
			<input id="log_data_hora" name="log_data_hora" type="text" maxlength="atetim" value="<? echo $Log->VO->get_log_data_hora() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="log_ip">log_ip:</label>
			<input id="log_ip" name="log_ip" type="text" maxlength="32" value="<? echo $Log->VO->get_log_ip() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="log_tela">log_tela:</label>
			<input id="log_tela" name="log_tela" type="text" maxlength="100" value="<? echo $Log->VO->get_log_tela() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="log_acao">log_acao:</label>
			<input id="log_acao" name="log_acao" type="text" maxlength="1" value="<? echo $Log->VO->get_log_acao() ?>" required  class="form-control" />
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Log->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Log->acao == "listar") { echo $Log->lista; } ?>