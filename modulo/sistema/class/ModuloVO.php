<?
Class ModuloVO
{
	//Atributos
	private $_mod_id;
	private $_mod_nome;
	private $_mod_pasta;

	//Propriedades
	function get_mod_id()
	{
		return $this->_mod_id;
	}
	function set_mod_id($value)
	{
		$this->_mod_id = $value;
	}

	function get_mod_nome()
	{
		return $this->_mod_nome;
	}
	function set_mod_nome($value)
	{
		$this->_mod_nome = $value;
	}

	function get_mod_pasta()
	{
		return $this->_mod_pasta;
	}
	function set_mod_pasta($value)
	{
		$this->_mod_pasta = $value;
	}

}
?>