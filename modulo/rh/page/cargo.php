<? require "cargo.co.php" ?>
<h1 class="page-header"><? echo $Cargo->title ?></h1>
<? if($Cargo->acao == "inserir" || $Cargo->acao == "editar" || $Cargo->acao == "exibir"){ ?>
<form id="form_cargo" method="post" onkeypress="return noSubmitEnter(event)">
	<input type="hidden" name="car_id" value="<? echo $Cargo->VO->get_car_id() ?>" />
	<div class="row">
		<div class="col-md-12 form-group">
			<label for="car_nome">car_nome:</label>
			<input id="car_nome" name="car_nome" type="text" maxlength="30" value="<? echo $Cargo->VO->get_car_nome() ?>" required autofocus class="form-control" />
		</div>
		<div class="col-md-12 form-group">
			<label for="car_salario">car_salario:</label>
			<input id="car_salario" name="car_salario" type="text" maxlength="52" value="<? echo $Cargo->VO->get_car_salario() ?>" required  class="form-control" />
		</div>
	</div>
	<input type="submit" name="acao" value="Salvar" class="btn btn-primary btn-submit"><input type="button" value="Voltar" onclick="location='<? echo $Cargo->redirect ?>'" class="btn btn-danger" />
</form>
<? } if($Cargo->acao == "listar") { echo $Cargo->lista; } ?>