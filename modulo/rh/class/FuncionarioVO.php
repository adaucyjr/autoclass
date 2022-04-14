<?
Class FuncionarioVO
{
	//Atributos
	private $_fun_id;
	private $_pes_id;
	private $_fun_documento;
	private $_car_id;
	private $_fun_funcao;
	private $_fun_salario;
	private $_fun_admissao;
	private $_fun_demissao;
	private $_fun_setor;

	//Propriedades
	function get_fun_id()
	{
		return $this->_fun_id;
	}
	function set_fun_id($value)
	{
		$this->_fun_id = $value;
	}

	function get_pes_id()
	{
		return $this->_pes_id;
	}
	function set_pes_id($value)
	{
		$this->_pes_id = $value;
	}

	function get_fun_documento()
	{
		return $this->_fun_documento;
	}
	function set_fun_documento($value)
	{
		$this->_fun_documento = $value;
	}

	function get_car_id()
	{
		return $this->_car_id;
	}
	function set_car_id($value)
	{
		$this->_car_id = $value;
	}

	function get_fun_funcao()
	{
		return $this->_fun_funcao;
	}
	function set_fun_funcao($value)
	{
		$this->_fun_funcao = $value;
	}

	function get_fun_salario()
	{
		return $this->_fun_salario;
	}
	function set_fun_salario($value)
	{
		$this->_fun_salario = $value;
	}

	function get_fun_admissao()
	{
		return $this->_fun_admissao;
	}
	function set_fun_admissao($value)
	{
		$this->_fun_admissao = $value;
	}

	function get_fun_demissao()
	{
		return $this->_fun_demissao;
	}
	function set_fun_demissao($value)
	{
		$this->_fun_demissao = $value;
	}

	function get_fun_setor()
	{
		return $this->_fun_setor;
	}
	function set_fun_setor($value)
	{
		$this->_fun_setor = $value;
	}

}
?>