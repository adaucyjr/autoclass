<?
Class UsuarioVO
{
	//Atributos
	private $_usu_id;
	private $_usu_login;
	private $_usu_senha;
	private $_usu_grp_id;
	private $_usu_status;
	private $_pes_id;

	//Propriedades
	function get_usu_id()
	{
		return $this->_usu_id;
	}
	function set_usu_id($value)
	{
		$this->_usu_id = $value;
	}

	function get_usu_login()
	{
		return $this->_usu_login;
	}
	function set_usu_login($value)
	{
		$this->_usu_login = $value;
	}

	function get_usu_senha()
	{
		return $this->_usu_senha;
	}
	function set_usu_senha($value)
	{
		$this->_usu_senha = $value;
	}

	function get_usu_grp_id()
	{
		return $this->_usu_grp_id;
	}
	function set_usu_grp_id($value)
	{
		$this->_usu_grp_id = $value;
	}

	function get_usu_status()
	{
		return $this->_usu_status;
	}
	function set_usu_status($value)
	{
		$this->_usu_status = $value;
	}

	function get_pes_id()
	{
		return $this->_pes_id;
	}
	function set_pes_id($value)
	{
		$this->_pes_id = $value;
	}

}
?>