<?
Class AcessoVO
{
	//Atributos
	private $_ace_id;
	private $_usu_grp_id;
	private $_fer_id;
	private $_ace_visualizar;
	private $_ace_inserir;
	private $_ace_alterar;
	private $_ace_excluir;

	//Propriedades
	function get_ace_id()
	{
		return $this->_ace_id;
	}
	function set_ace_id($value)
	{
		$this->_ace_id = $value;
	}

	function get_usu_grp_id()
	{
		return $this->_usu_grp_id;
	}
	function set_usu_grp_id($value)
	{
		$this->_usu_grp_id = $value;
	}

	function get_fer_id()
	{
		return $this->_fer_id;
	}
	function set_fer_id($value)
	{
		$this->_fer_id = $value;
	}

	function get_ace_visualizar()
	{
		return $this->_ace_visualizar;
	}
	function set_ace_visualizar($value)
	{
		$this->_ace_visualizar = $value;
	}

	function get_ace_inserir()
	{
		return $this->_ace_inserir;
	}
	function set_ace_inserir($value)
	{
		$this->_ace_inserir = $value;
	}

	function get_ace_alterar()
	{
		return $this->_ace_alterar;
	}
	function set_ace_alterar($value)
	{
		$this->_ace_alterar = $value;
	}

	function get_ace_excluir()
	{
		return $this->_ace_excluir;
	}
	function set_ace_excluir($value)
	{
		$this->_ace_excluir = $value;
	}

}
?>