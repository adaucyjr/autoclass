<?
Class FerramentaVO
{
	//Atributos
	private $_fer_id;
	private $_fer_nome;
	private $_fer_page;
	private $_mod_id;

	//Propriedades
	function get_fer_id()
	{
		return $this->_fer_id;
	}
	function set_fer_id($value)
	{
		$this->_fer_id = $value;
	}

	function get_fer_nome()
	{
		return $this->_fer_nome;
	}
	function set_fer_nome($value)
	{
		$this->_fer_nome = $value;
	}

	function get_fer_page()
	{
		return $this->_fer_page;
	}
	function set_fer_page($value)
	{
		$this->_fer_page = $value;
	}

	function get_mod_id()
	{
		return $this->_mod_id;
	}
	function set_mod_id($value)
	{
		$this->_mod_id = $value;
	}

}
?>