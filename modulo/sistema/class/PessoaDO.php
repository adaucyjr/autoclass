<?
require_once "class/DataAdapter.php";

Class PessoaDO
{
	//Atributos
	private $DataAdapter;

	//Construtor
	function PessoaDO()
	{
		$this->DataAdapter = new DataAdapter();
	}

	//Métodos
	function lista($fields, $where, $order, $by, $limit1, $limit2)
	{
		$type = "";
		$param = array();
		$query = "SELECT SQL_CALC_FOUND_ROWS ".join(", ", $fields)." ";
		$query .= "FROM sistema_pessoa ";
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
			$query .= "ORDER BY pes_id DESC ";
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
		$query = "SELECT * FROM sistema_pessoa WHERE pes_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function insere($VO)
	{
		$query = "INSERT INTO sistema_pessoa VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$pes_nome = $VO->get_pes_nome();
		$pes_sobrenome = $VO->get_pes_sobrenome();
		$pes_cpf = $VO->get_pes_cpf();
		$pes_rg = $VO->get_pes_rg();
		$pes_rg_orgao = $VO->get_pes_rg_orgao();
		$pes_rg_estado = $VO->get_pes_rg_estado();
		$pes_nascimento = $VO->get_pes_nascimento();
		$pes_obito = $VO->get_pes_obito();
		$pes_sexo = (bool)$VO->get_pes_sexo();
		$pes_escolariadade = $VO->get_pes_escolariadade();
		$pes_profissao = $VO->get_pes_profissao();
		$pes_naturalidade = $VO->get_pes_naturalidade();
		$pes_nacionalidade = $VO->get_pes_nacionalidade();
		$pes_res_logradouro = $VO->get_pes_res_logradouro();
		$pes_res_numero = $VO->get_pes_res_numero();
		$pes_res_complemento = $VO->get_pes_res_complemento();
		$pes_res_bairro = $VO->get_pes_res_bairro();
		$pes_res_cidade = $VO->get_pes_res_cidade();
		$pes_res_estado = $VO->get_pes_res_estado();
		$pes_res_cep = $VO->get_pes_res_cep();
		$pes_tra_logradouro = $VO->get_pes_tra_logradouro();
		$pes_tra_numero = $VO->get_pes_tra_numero();
		$pes_tra_complemento = $VO->get_pes_tra_complemento();
		$pes_tra_bairro = $VO->get_pes_tra_bairro();
		$pes_tra_cidade = $VO->get_pes_tra_cidade();
		$pes_tra_estado = $VO->get_pes_tra_estado();
		$pes_tra_cep = $VO->get_pes_tra_cep();
		$pes_telefone1 = $VO->get_pes_telefone1();
		$pes_telefone2 = $VO->get_pes_telefone2();
		$pes_email1 = $VO->get_pes_email1();
		$pes_email2 = $VO->get_pes_email2();
		$param = array(&$pes_nome, &$pes_sobrenome, &$pes_cpf, &$pes_rg, &$pes_rg_orgao, &$pes_rg_estado, &$pes_nascimento, &$pes_obito, &$pes_sexo, &$pes_escolariadade, &$pes_profissao, &$pes_naturalidade, &$pes_nacionalidade, &$pes_res_logradouro, &$pes_res_numero, &$pes_res_complemento, &$pes_res_bairro, &$pes_res_cidade, &$pes_res_estado, &$pes_res_cep, &$pes_tra_logradouro, &$pes_tra_numero, &$pes_tra_complemento, &$pes_tra_bairro, &$pes_tra_cidade, &$pes_tra_estado, &$pes_tra_cep, &$pes_telefone1, &$pes_telefone2, &$pes_email1, &$pes_email2);
		$result = $this->DataAdapter->execute($query,"sssssssssssssssssssssssssssssss",$param);
		return $result;
	}

	function atualiza($VO)
	{
		$query = "UPDATE sistema_pessoa SET pes_nome = ?, pes_sobrenome = ?, pes_cpf = ?, pes_rg = ?, pes_rg_orgao = ?, pes_rg_estado = ?, pes_nascimento = ?, pes_obito = ?, pes_sexo = ?, pes_escolariadade = ?, pes_profissao = ?, pes_naturalidade = ?, pes_nacionalidade = ?, pes_res_logradouro = ?, pes_res_numero = ?, pes_res_complemento = ?, pes_res_bairro = ?, pes_res_cidade = ?, pes_res_estado = ?, pes_res_cep = ?, pes_tra_logradouro = ?, pes_tra_numero = ?, pes_tra_complemento = ?, pes_tra_bairro = ?, pes_tra_cidade = ?, pes_tra_estado = ?, pes_tra_cep = ?, pes_telefone1 = ?, pes_telefone2 = ?, pes_email1 = ?, pes_email2 = ? WHERE pes_id = ?";
		$pes_id = $VO->get_pes_id();
		$pes_nome = $VO->get_pes_nome();
		$pes_sobrenome = $VO->get_pes_sobrenome();
		$pes_cpf = $VO->get_pes_cpf();
		$pes_rg = $VO->get_pes_rg();
		$pes_rg_orgao = $VO->get_pes_rg_orgao();
		$pes_rg_estado = $VO->get_pes_rg_estado();
		$pes_nascimento = $VO->get_pes_nascimento();
		$pes_obito = $VO->get_pes_obito();
		$pes_sexo = (bool)$VO->get_pes_sexo();
		$pes_escolariadade = $VO->get_pes_escolariadade();
		$pes_profissao = $VO->get_pes_profissao();
		$pes_naturalidade = $VO->get_pes_naturalidade();
		$pes_nacionalidade = $VO->get_pes_nacionalidade();
		$pes_res_logradouro = $VO->get_pes_res_logradouro();
		$pes_res_numero = $VO->get_pes_res_numero();
		$pes_res_complemento = $VO->get_pes_res_complemento();
		$pes_res_bairro = $VO->get_pes_res_bairro();
		$pes_res_cidade = $VO->get_pes_res_cidade();
		$pes_res_estado = $VO->get_pes_res_estado();
		$pes_res_cep = $VO->get_pes_res_cep();
		$pes_tra_logradouro = $VO->get_pes_tra_logradouro();
		$pes_tra_numero = $VO->get_pes_tra_numero();
		$pes_tra_complemento = $VO->get_pes_tra_complemento();
		$pes_tra_bairro = $VO->get_pes_tra_bairro();
		$pes_tra_cidade = $VO->get_pes_tra_cidade();
		$pes_tra_estado = $VO->get_pes_tra_estado();
		$pes_tra_cep = $VO->get_pes_tra_cep();
		$pes_telefone1 = $VO->get_pes_telefone1();
		$pes_telefone2 = $VO->get_pes_telefone2();
		$pes_email1 = $VO->get_pes_email1();
		$pes_email2 = $VO->get_pes_email2();
		$param = array(&$pes_nome, &$pes_sobrenome, &$pes_cpf, &$pes_rg, &$pes_rg_orgao, &$pes_rg_estado, &$pes_nascimento, &$pes_obito, &$pes_sexo, &$pes_escolariadade, &$pes_profissao, &$pes_naturalidade, &$pes_nacionalidade, &$pes_res_logradouro, &$pes_res_numero, &$pes_res_complemento, &$pes_res_bairro, &$pes_res_cidade, &$pes_res_estado, &$pes_res_cep, &$pes_tra_logradouro, &$pes_tra_numero, &$pes_tra_complemento, &$pes_tra_bairro, &$pes_tra_cidade, &$pes_tra_estado, &$pes_tra_cep, &$pes_telefone1, &$pes_telefone2, &$pes_email1, &$pes_email2, &$pes_id);
		$result = $this->DataAdapter->execute($query,"sssssssssssssssssssssssssssssssi",$param);
		return $result;
	}

	function deleta($id)
	{
		$query = "DELETE FROM sistema_pessoa WHERE pes_id = ?";
		$param = array(&$id);
		$result = $this->DataAdapter->execute($query,"i",$param);
		return $result;
	}

	function ultimoId()
	{
		$query = "SELECT MAX(pes_id) as max_id FROM sistema_pessoa";
		$result = $this->DataAdapter->execute($query);
		return $result;
	}
}
?>