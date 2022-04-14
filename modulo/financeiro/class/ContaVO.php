<?
Class ContaVO
{
	//Atributos
	private $_con_id;
	private $_con_nome;
	private $_con_numero;
	private $_con_tipo;
	private $_con_saldo;

	//Propriedades
	function get_con_id()
	{
		return $this->_con_id;
	}
	function set_con_id($value)
	{
		$this->_con_id = $value;
	}

	function get_con_nome()
	{
		return $this->_con_nome;
	}
	function set_con_nome($value)
	{
		$this->_con_nome = $value;
	}

	function get_con_numero()
	{
		return $this->_con_numero;
	}
	function set_con_numero($value)
	{
		$this->_con_numero = $value;
	}

	function get_con_tipo()
	{
		return $this->_con_tipo;
	}
	function set_con_tipo($value)
	{
		$this->_con_tipo = $value;
	}

	function get_con_saldo()
	{
		return $this->_con_saldo;
	}
	function set_con_saldo($value)
	{
		$this->_con_saldo = $value;
	}

}
?>