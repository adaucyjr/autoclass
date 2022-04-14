<? require "pessoa.co.php" ?>
<h1 class="page-header"><? echo $Pessoa->title ?></h1>
<? if($Pessoa->acao == "inserir" || $Pessoa->acao == "editar" || $Pessoa->acao == "exibir"){ ?>
<form id="form_pessoa" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="pes_id" value="<? echo $Pessoa->VO->get_pes_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="pes_nome">pes_nome:</label>
			<input id="pes_nome" name="pes_nome" type="text" maxlength="20" value="<? echo $Pessoa->VO->get_pes_nome() ?>" required autofocus class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_sobrenome">pes_sobrenome:</label>
			<input id="pes_sobrenome" name="pes_sobrenome" type="text" maxlength="50" value="<? echo $Pessoa->VO->get_pes_sobrenome() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_cpf">pes_cpf:</label>
			<input id="pes_cpf" name="pes_cpf" type="number" maxlength="11" value="<? echo $Pessoa->VO->get_pes_cpf() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_rg">pes_rg:</label>
			<input id="pes_rg" name="pes_rg" type="number" maxlength="11" value="<? echo $Pessoa->VO->get_pes_rg() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_rg_orgao">pes_rg_orgao:</label>
			<input id="pes_rg_orgao" name="pes_rg_orgao" type="text" maxlength="5" value="<? echo $Pessoa->VO->get_pes_rg_orgao() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_rg_estado">pes_rg_estado:</label>
			<input id="pes_rg_estado" name="pes_rg_estado" type="text" maxlength="2" value="<? echo $Pessoa->VO->get_pes_rg_estado() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_nascimento">pes_nascimento:</label>
			<input id="pes_nascimento" name="pes_nascimento" type="date" maxlength="at" value="<? echo $Pessoa->VO->get_pes_nascimento() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_obito">pes_obito:</label>
			<input id="pes_obito" name="pes_obito" type="date" maxlength="at" value="<? echo $Pessoa->VO->get_pes_obito() ?>"   class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_sexo">pes_sexo:</label>
			<input id="pes_sexo" name="pes_sexo" type="checkbox" <? if((bool)$Pessoa->VO->get_pes_sexo()){echo "checked";} ?>   class="" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_escolariadade">pes_escolariadade:</label>
			<input id="pes_escolariadade" name="pes_escolariadade" type="number" maxlength="1" value="<? echo $Pessoa->VO->get_pes_escolariadade() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_profissao">pes_profissao:</label>
			<input id="pes_profissao" name="pes_profissao" type="text" maxlength="40" value="<? echo $Pessoa->VO->get_pes_profissao() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_naturalidade">pes_naturalidade:</label>
			<input id="pes_naturalidade" name="pes_naturalidade" type="text" maxlength="30" value="<? echo $Pessoa->VO->get_pes_naturalidade() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_nacionalidade">pes_nacionalidade:</label>
			<input id="pes_nacionalidade" name="pes_nacionalidade" type="text" maxlength="30" value="<? echo $Pessoa->VO->get_pes_nacionalidade() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_res_logradouro">pes_res_logradouro:</label>
			<input id="pes_res_logradouro" name="pes_res_logradouro" type="text" maxlength="50" value="<? echo $Pessoa->VO->get_pes_res_logradouro() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_res_numero">pes_res_numero:</label>
			<input id="pes_res_numero" name="pes_res_numero" type="text" maxlength="5" value="<? echo $Pessoa->VO->get_pes_res_numero() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_res_complemento">pes_res_complemento:</label>
			<input id="pes_res_complemento" name="pes_res_complemento" type="text" maxlength="30" value="<? echo $Pessoa->VO->get_pes_res_complemento() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_res_bairro">pes_res_bairro:</label>
			<input id="pes_res_bairro" name="pes_res_bairro" type="text" maxlength="50" value="<? echo $Pessoa->VO->get_pes_res_bairro() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_res_cidade">pes_res_cidade:</label>
			<input id="pes_res_cidade" name="pes_res_cidade" type="text" maxlength="50" value="<? echo $Pessoa->VO->get_pes_res_cidade() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_res_estado">pes_res_estado:</label>
			<input id="pes_res_estado" name="pes_res_estado" type="number" maxlength="2" value="<? echo $Pessoa->VO->get_pes_res_estado() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_res_cep">pes_res_cep:</label>
			<input id="pes_res_cep" name="pes_res_cep" type="number" maxlength="8" value="<? echo $Pessoa->VO->get_pes_res_cep() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_tra_logradouro">pes_tra_logradouro:</label>
			<input id="pes_tra_logradouro" name="pes_tra_logradouro" type="text" maxlength="50" value="<? echo $Pessoa->VO->get_pes_tra_logradouro() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_tra_numero">pes_tra_numero:</label>
			<input id="pes_tra_numero" name="pes_tra_numero" type="text" maxlength="5" value="<? echo $Pessoa->VO->get_pes_tra_numero() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_tra_complemento">pes_tra_complemento:</label>
			<input id="pes_tra_complemento" name="pes_tra_complemento" type="text" maxlength="30" value="<? echo $Pessoa->VO->get_pes_tra_complemento() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_tra_bairro">pes_tra_bairro:</label>
			<input id="pes_tra_bairro" name="pes_tra_bairro" type="text" maxlength="50" value="<? echo $Pessoa->VO->get_pes_tra_bairro() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_tra_cidade">pes_tra_cidade:</label>
			<input id="pes_tra_cidade" name="pes_tra_cidade" type="text" maxlength="50" value="<? echo $Pessoa->VO->get_pes_tra_cidade() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_tra_estado">pes_tra_estado:</label>
			<input id="pes_tra_estado" name="pes_tra_estado" type="number" maxlength="2" value="<? echo $Pessoa->VO->get_pes_tra_estado() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_tra_cep">pes_tra_cep:</label>
			<input id="pes_tra_cep" name="pes_tra_cep" type="number" maxlength="8" value="<? echo $Pessoa->VO->get_pes_tra_cep() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_telefone1">pes_telefone1:</label>
			<input id="pes_telefone1" name="pes_telefone1" type="number" maxlength="12" value="<? echo $Pessoa->VO->get_pes_telefone1() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_telefone2">pes_telefone2:</label>
			<input id="pes_telefone2" name="pes_telefone2" type="number" maxlength="12" value="<? echo $Pessoa->VO->get_pes_telefone2() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_email1">pes_email1:</label>
			<input id="pes_email1" name="pes_email1" type="text" maxlength="30" value="<? echo $Pessoa->VO->get_pes_email1() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="pes_email2">pes_email2:</label>
			<input id="pes_email2" name="pes_email2" type="text" maxlength="30" value="<? echo $Pessoa->VO->get_pes_email2() ?>" required  class="form-control" />
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Pessoa->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Pessoa->acao == "listar") { echo $Pessoa->lista; } ?>