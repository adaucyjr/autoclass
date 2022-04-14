<? require "funcionario.co.php" ?>
<h1 class="page-header"><? echo $Funcionario->title ?></h1>
<? if($Funcionario->acao == "inserir" || $Funcionario->acao == "editar" || $Funcionario->acao == "exibir"){ ?>
<form id="form_funcionario" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="fun_id" value="<? echo $Funcionario->VO->get_fun_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="pes_id">pes_id:</label>
			<? echo $Funcionario->Util->geraSelect("pes_id", "sistema_pessoa", "pes_id", "pes_id", "", "", "pes_id", $Funcionario->VO->get_pes_id(), "form-control"); ?>
		</div>
		<div class="col-md-12 form-group">
			<label for="fun_documento">fun_documento:</label>
			<input id="fun_documento" name="fun_documento" type="text" maxlength="15" value="<? echo $Funcionario->VO->get_fun_documento() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="car_id">car_id:</label>
			<? echo $Funcionario->Util->geraSelect("car_id", "rh_cargo", "car_id", "car_id", "", "", "car_id", $Funcionario->VO->get_car_id(), "form-control"); ?>
		</div>
		<div class="col-md-12 form-group">
			<label for="fun_funcao">fun_funcao:</label>
			<input id="fun_funcao" name="fun_funcao" type="text" maxlength="20" value="<? echo $Funcionario->VO->get_fun_funcao() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="fun_salario">fun_salario:</label>
			<input id="fun_salario" name="fun_salario" type="text" maxlength="72" value="<? echo $Funcionario->VO->get_fun_salario() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="fun_admissao">fun_admissao:</label>
			<input id="fun_admissao" name="fun_admissao" type="date" maxlength="at" value="<? echo $Funcionario->VO->get_fun_admissao() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="fun_demissao">fun_demissao:</label>
			<input id="fun_demissao" name="fun_demissao" type="date" maxlength="at" value="<? echo $Funcionario->VO->get_fun_demissao() ?>" required  class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="fun_setor">fun_setor:</label>
			<? echo $Funcionario->Util->geraSelect("fun_setor", "", "fun_setor", "fun_setor", "", "", "fun_setor", $Funcionario->VO->get_fun_setor(), "form-control"); ?>
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Funcionario->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Funcionario->acao == "listar") { echo $Funcionario->lista; } ?>