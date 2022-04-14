<? require "instituicao.co.php" ?>
<h1 class="page-header"><? echo $Instituicao->title ?></h1>
<? if($Instituicao->acao == "inserir" || $Instituicao->acao == "editar" || $Instituicao->acao == "exibir"){ ?>
<form id="form_instituicao" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="ins_id" value="<? echo $Instituicao->VO->get_ins_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="ins_cnpj">ins_cnpj:</label>
			<input id="ins_cnpj" name="ins_cnpj" type="number" maxlength="14" value="<? echo $Instituicao->VO->get_ins_cnpj() ?>" required autofocus class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_cepj">ins_cepj:</label>
			<input id="ins_cepj" name="ins_cepj" type="number" maxlength="14" value="<? echo $Instituicao->VO->get_ins_cepj() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_cmpj">ins_cmpj:</label>
			<input id="ins_cmpj" name="ins_cmpj" type="number" maxlength="14" value="<? echo $Instituicao->VO->get_ins_cmpj() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_razao_social">ins_razao_social:</label>
			<input id="ins_razao_social" name="ins_razao_social" type="text" maxlength="50" value="<? echo $Instituicao->VO->get_ins_razao_social() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_nome_fantasia">ins_nome_fantasia:</label>
			<input id="ins_nome_fantasia" name="ins_nome_fantasia" type="text" maxlength="30" value="<? echo $Instituicao->VO->get_ins_nome_fantasia() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_abertura">ins_abertura:</label>
			<input id="ins_abertura" name="ins_abertura" type="date" maxlength="at" value="<? echo $Instituicao->VO->get_ins_abertura() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_fechamento">ins_fechamento:</label>
			<input id="ins_fechamento" name="ins_fechamento" type="date" maxlength="at" value="<? echo $Instituicao->VO->get_ins_fechamento() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_tipo">ins_tipo:</label>
			<input id="ins_tipo" name="ins_tipo" type="text" maxlength="30" value="<? echo $Instituicao->VO->get_ins_tipo() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_ramo">ins_ramo:</label>
			<input id="ins_ramo" name="ins_ramo" type="text" maxlength="50" value="<? echo $Instituicao->VO->get_ins_ramo() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_end_logradouro">ins_end_logradouro:</label>
			<input id="ins_end_logradouro" name="ins_end_logradouro" type="text" maxlength="50" value="<? echo $Instituicao->VO->get_ins_end_logradouro() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_end_num">ins_end_num:</label>
			<input id="ins_end_num" name="ins_end_num" type="text" maxlength="5" value="<? echo $Instituicao->VO->get_ins_end_num() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_end_complemento">ins_end_complemento:</label>
			<input id="ins_end_complemento" name="ins_end_complemento" type="text" maxlength="30" value="<? echo $Instituicao->VO->get_ins_end_complemento() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_end_bairro">ins_end_bairro:</label>
			<input id="ins_end_bairro" name="ins_end_bairro" type="text" maxlength="50" value="<? echo $Instituicao->VO->get_ins_end_bairro() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_end_cidade">ins_end_cidade:</label>
			<input id="ins_end_cidade" name="ins_end_cidade" type="text" maxlength="50" value="<? echo $Instituicao->VO->get_ins_end_cidade() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_end_estado">ins_end_estado:</label>
			<input id="ins_end_estado" name="ins_end_estado" type="number" maxlength="2" value="<? echo $Instituicao->VO->get_ins_end_estado() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_end_cep">ins_end_cep:</label>
			<input id="ins_end_cep" name="ins_end_cep" type="number" maxlength="8" value="<? echo $Instituicao->VO->get_ins_end_cep() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_telefone1">ins_telefone1:</label>
			<input id="ins_telefone1" name="ins_telefone1" type="number" maxlength="12" value="<? echo $Instituicao->VO->get_ins_telefone1() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_telefone2">ins_telefone2:</label>
			<input id="ins_telefone2" name="ins_telefone2" type="number" maxlength="12" value="<? echo $Instituicao->VO->get_ins_telefone2() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_email1">ins_email1:</label>
			<input id="ins_email1" name="ins_email1" type="text" maxlength="30" value="<? echo $Instituicao->VO->get_ins_email1() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="ins_email2">ins_email2:</label>
			<input id="ins_email2" name="ins_email2" type="text" maxlength="30" value="<? echo $Instituicao->VO->get_ins_email2() ?>" required  class="form-control" />
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Instituicao->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Instituicao->acao == "listar") { echo $Instituicao->lista; } ?>