<?
require_once "class/DataAdapter.php";

Class InstituicaoDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function InstituicaoDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM sistema_instituicao ";
		if($where != "")
		{
			$query .= "WHERE ".$fields[0]." LIKE ? ";
			for($i=1;$i<count($fields);$i++)
			{
				$query .= "OR ".$fields[$i]." LIKE ? ";
			}
			$param[] = &$where;
			for($i=1;$i<count($fields);$i++)
			{
				$param[] = &$where;
			}
			for($i=0;$i<count($fields);$i++)
			{
				$type .= "s";
			}
		}
		if($order != "")
		{
			$query .= "ORDER BY ".$order." ".$by." ";
		}
		else
		{
			$query .= "ORDER BY ins_id DESC ";
		}
		if(is_int($limit1) && is_int($limit2))
		{
			$query .= "LIMIT ".$limit1.", ".$limit2;
		}
		$lista = $this->DataAdapter->execute($query,$type,$param,1);
		return $lista;
	}

	function exibe($id)
	{
		$query = "SELECT * FROM sistema_instituicao WHERE ins_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO sistema_instituicao VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$ins_cnpj = $VO->get_ins_cnpj();
		$ins_cepj = $VO->get_ins_cepj();
		$ins_cmpj = $VO->get_ins_cmpj();
		$ins_razao_social = $VO->get_ins_razao_social();
		$ins_nome_fantasia = $VO->get_ins_nome_fantasia();
		$ins_abertura = $VO->get_ins_abertura();
		$ins_fechamento = $VO->get_ins_fechamento();
		$ins_tipo = $VO->get_ins_tipo();
		$ins_ramo = $VO->get_ins_ramo();
		$ins_end_logradouro = $VO->get_ins_end_logradouro();
		$ins_end_num = $VO->get_ins_end_num();
		$ins_end_complemento = $VO->get_ins_end_complemento();
		$ins_end_bairro = $VO->get_ins_end_bairro();
		$ins_end_cidade = $VO->get_ins_end_cidade();
		$ins_end_estado = $VO->get_ins_end_estado();
		$ins_end_cep = $VO->get_ins_end_cep();
		$ins_telefone1 = $VO->get_ins_telefone1();
		$ins_telefone2 = $VO->get_ins_telefone2();
		$ins_email1 = $VO->get_ins_email1();
		$ins_email2 = $VO->get_ins_email2();
		$param = array(&$ins_cnpj, &$ins_cepj, &$ins_cmpj, &$ins_razao_social, &$ins_nome_fantasia, &$ins_abertura, &$ins_fechamento, &$ins_tipo, &$ins_ramo, &$ins_end_logradouro, &$ins_end_num, &$ins_end_complemento, &$ins_end_bairro, &$ins_end_cidade, &$ins_end_estado, &$ins_end_cep, &$ins_telefone1, &$ins_telefone2, &$ins_email1, &$ins_email2);
		$result = $this->DataAdapter->execute($query,"ssssssssssssssssssss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE sistema_instituicao SET ins_cnpj = ?, ins_cepj = ?, ins_cmpj = ?, ins_razao_social = ?, ins_nome_fantasia = ?, ins_abertura = ?, ins_fechamento = ?, ins_tipo = ?, ins_ramo = ?, ins_end_logradouro = ?, ins_end_num = ?, ins_end_complemento = ?, ins_end_bairro = ?, ins_end_cidade = ?, ins_end_estado = ?, ins_end_cep = ?, ins_telefone1 = ?, ins_telefone2 = ?, ins_email1 = ?, ins_email2 = ? WHERE ins_id = ?";
		$ins_id = $VO->get_ins_id();
		$ins_cnpj = $VO->get_ins_cnpj();
		$ins_cepj = $VO->get_ins_cepj();
		$ins_cmpj = $VO->get_ins_cmpj();
		$ins_razao_social = $VO->get_ins_razao_social();
		$ins_nome_fantasia = $VO->get_ins_nome_fantasia();
		$ins_abertura = $VO->get_ins_abertura();
		$ins_fechamento = $VO->get_ins_fechamento();
		$ins_tipo = $VO->get_ins_tipo();
		$ins_ramo = $VO->get_ins_ramo();
		$ins_end_logradouro = $VO->get_ins_end_logradouro();
		$ins_end_num = $VO->get_ins_end_num();
		$ins_end_complemento = $VO->get_ins_end_complemento();
		$ins_end_bairro = $VO->get_ins_end_bairro();
		$ins_end_cidade = $VO->get_ins_end_cidade();
		$ins_end_estado = $VO->get_ins_end_estado();
		$ins_end_cep = $VO->get_ins_end_cep();
		$ins_telefone1 = $VO->get_ins_telefone1();
		$ins_telefone2 = $VO->get_ins_telefone2();
		$ins_email1 = $VO->get_ins_email1();
		$ins_email2 = $VO->get_ins_email2();
		$param = array(&$ins_cnpj, &$ins_cepj, &$ins_cmpj, &$ins_razao_social, &$ins_nome_fantasia, &$ins_abertura, &$ins_fechamento, &$ins_tipo, &$ins_ramo, &$ins_end_logradouro, &$ins_end_num, &$ins_end_complemento, &$ins_end_bairro, &$ins_end_cidade, &$ins_end_estado, &$ins_end_cep, &$ins_telefone1, &$ins_telefone2, &$ins_email1, &$ins_email2, &$ins_id);
		$result = $this->DataAdapter->execute($query,"ssssssssssssssssssssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM sistema_instituicao WHERE ins_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(ins_id) as max_id FROM sistema_instituicao";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>