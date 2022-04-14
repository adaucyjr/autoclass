<?
Class UsuarioGrupoVO
{
	//Atributos
	private $_usu_grp_id;
	private $_usu_grp_nome;

	//Propriedades
	function get_usu_grp_id()
	{
		return $this->_usu_grp_id;
	}
	function set_usu_grp_id($value)
	{
		$this->_usu_grp_id = $value;
	}

	function get_usu_grp_nome()
	{
		return $this->_usu_grp_nome;
	}
	function set_usu_grp_nome($value)
	{
		$this->_usu_grp_nome = $value;
	}

}
?>