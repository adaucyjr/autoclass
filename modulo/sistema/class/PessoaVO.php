<?
Class PessoaVO
{
	//Atributos
	private $_pes_id;
	private $_pes_nome;
	private $_pes_sobrenome;
	private $_pes_cpf;
	private $_pes_rg;
	private $_pes_rg_orgao;
	private $_pes_rg_estado;
	private $_pes_nascimento;
	private $_pes_obito;
	private $_pes_sexo;
	private $_pes_escolariadade;
	private $_pes_profissao;
	private $_pes_naturalidade;
	private $_pes_nacionalidade;
	private $_pes_res_logradouro;
	private $_pes_res_numero;
	private $_pes_res_complemento;
	private $_pes_res_bairro;
	private $_pes_res_cidade;
	private $_pes_res_estado;
	private $_pes_res_cep;
	private $_pes_tra_logradouro;
	private $_pes_tra_numero;
	private $_pes_tra_complemento;
	private $_pes_tra_bairro;
	private $_pes_tra_cidade;
	private $_pes_tra_estado;
	private $_pes_tra_cep;
	private $_pes_telefone1;
	private $_pes_telefone2;
	private $_pes_email1;
	private $_pes_email2;

	//Propriedades
	function get_pes_id()
	{
		return $this->_pes_id;
	}
	function set_pes_id($value)
	{
		$this->_pes_id = $value;
	}

	function get_pes_nome()
	{
		return $this->_pes_nome;
	}
	function set_pes_nome($value)
	{
		$this->_pes_nome = $value;
	}

	function get_pes_sobrenome()
	{
		return $this->_pes_sobrenome;
	}
	function set_pes_sobrenome($value)
	{
		$this->_pes_sobrenome = $value;
	}

	function get_pes_cpf()
	{
		return $this->_pes_cpf;
	}
	function set_pes_cpf($value)
	{
		$this->_pes_cpf = $value;
	}

	function get_pes_rg()
	{
		return $this->_pes_rg;
	}
	function set_pes_rg($value)
	{
		$this->_pes_rg = $value;
	}

	function get_pes_rg_orgao()
	{
		return $this->_pes_rg_orgao;
	}
	function set_pes_rg_orgao($value)
	{
		$this->_pes_rg_orgao = $value;
	}

	function get_pes_rg_estado()
	{
		return $this->_pes_rg_estado;
	}
	function set_pes_rg_estado($value)
	{
		$this->_pes_rg_estado = $value;
	}

	function get_pes_nascimento()
	{
		return $this->_pes_nascimento;
	}
	function set_pes_nascimento($value)
	{
		$this->_pes_nascimento = $value;
	}

	function get_pes_obito()
	{
		return $this->_pes_obito;
	}
	function set_pes_obito($value)
	{
		$this->_pes_obito = $value;
	}

	function get_pes_sexo()
	{
		return $this->_pes_sexo;
	}
	function set_pes_sexo($value)
	{
		$this->_pes_sexo = $value;
	}

	function get_pes_escolariadade()
	{
		return $this->_pes_escolariadade;
	}
	function set_pes_escolariadade($value)
	{
		$this->_pes_escolariadade = $value;
	}

	function get_pes_profissao()
	{
		return $this->_pes_profissao;
	}
	function set_pes_profissao($value)
	{
		$this->_pes_profissao = $value;
	}

	function get_pes_naturalidade()
	{
		return $this->_pes_naturalidade;
	}
	function set_pes_naturalidade($value)
	{
		$this->_pes_naturalidade = $value;
	}

	function get_pes_nacionalidade()
	{
		return $this->_pes_nacionalidade;
	}
	function set_pes_nacionalidade($value)
	{
		$this->_pes_nacionalidade = $value;
	}

	function get_pes_res_logradouro()
	{
		return $this->_pes_res_logradouro;
	}
	function set_pes_res_logradouro($value)
	{
		$this->_pes_res_logradouro = $value;
	}

	function get_pes_res_numero()
	{
		return $this->_pes_res_numero;
	}
	function set_pes_res_numero($value)
	{
		$this->_pes_res_numero = $value;
	}

	function get_pes_res_complemento()
	{
		return $this->_pes_res_complemento;
	}
	function set_pes_res_complemento($value)
	{
		$this->_pes_res_complemento = $value;
	}

	function get_pes_res_bairro()
	{
		return $this->_pes_res_bairro;
	}
	function set_pes_res_bairro($value)
	{
		$this->_pes_res_bairro = $value;
	}

	function get_pes_res_cidade()
	{
		return $this->_pes_res_cidade;
	}
	function set_pes_res_cidade($value)
	{
		$this->_pes_res_cidade = $value;
	}

	function get_pes_res_estado()
	{
		return $this->_pes_res_estado;
	}
	function set_pes_res_estado($value)
	{
		$this->_pes_res_estado = $value;
	}

	function get_pes_res_cep()
	{
		return $this->_pes_res_cep;
	}
	function set_pes_res_cep($value)
	{
		$this->_pes_res_cep = $value;
	}

	function get_pes_tra_logradouro()
	{
		return $this->_pes_tra_logradouro;
	}
	function set_pes_tra_logradouro($value)
	{
		$this->_pes_tra_logradouro = $value;
	}

	function get_pes_tra_numero()
	{
		return $this->_pes_tra_numero;
	}
	function set_pes_tra_numero($value)
	{
		$this->_pes_tra_numero = $value;
	}

	function get_pes_tra_complemento()
	{
		return $this->_pes_tra_complemento;
	}
	function set_pes_tra_complemento($value)
	{
		$this->_pes_tra_complemento = $value;
	}

	function get_pes_tra_bairro()
	{
		return $this->_pes_tra_bairro;
	}
	function set_pes_tra_bairro($value)
	{
		$this->_pes_tra_bairro = $value;
	}

	function get_pes_tra_cidade()
	{
		return $this->_pes_tra_cidade;
	}
	function set_pes_tra_cidade($value)
	{
		$this->_pes_tra_cidade = $value;
	}

	function get_pes_tra_estado()
	{
		return $this->_pes_tra_estado;
	}
	function set_pes_tra_estado($value)
	{
		$this->_pes_tra_estado = $value;
	}

	function get_pes_tra_cep()
	{
		return $this->_pes_tra_cep;
	}
	function set_pes_tra_cep($value)
	{
		$this->_pes_tra_cep = $value;
	}

	function get_pes_telefone1()
	{
		return $this->_pes_telefone1;
	}
	function set_pes_telefone1($value)
	{
		$this->_pes_telefone1 = $value;
	}

	function get_pes_telefone2()
	{
		return $this->_pes_telefone2;
	}
	function set_pes_telefone2($value)
	{
		$this->_pes_telefone2 = $value;
	}

	function get_pes_email1()
	{
		return $this->_pes_email1;
	}
	function set_pes_email1($value)
	{
		$this->_pes_email1 = $value;
	}

	function get_pes_email2()
	{
		return $this->_pes_email2;
	}
	function set_pes_email2($value)
	{
		$this->_pes_email2 = $value;
	}

}
?>