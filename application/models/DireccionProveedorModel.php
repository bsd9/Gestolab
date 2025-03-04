<?php

class DireccionProveedorModel extends CI_Model {
	private $id="";
	private $cuidad="";
  private $direccion="";
	private $id_proveedor="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
      if(isset($data['id'])){$this->id=$data['id'];}
      if(isset($data['ciudad'])){$this->ciudad=$data['ciudad'];}
      if(isset($data['direccion'])){$this->direccion=$data['direccion'];}
      if(isset($data['id_proveedor'])){$this->id_proveedor=$data['id_proveedor'];}
    }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	/**
	 * return string
	 */
	public function getCiudad()
	{
		return $this->ciudad;
	}

	/**
	 * param string $nombre
	 */
	public function setCiudad($ciudad)
	{
		$this->ciudad = $ciudad;
	}

	/**
	 * return string
	 */
	public function getDireccion()
	{
		return $this->direccion;
	}

	/**
	 * param string $apellido
	 */
	public function setDireccion($direccion)
	{
		$this->direccion = $direccion;
	}

	public function getIdProveedor()
	{
		return $this->id_proveedor;
	}

	/**
	 * param string $id_proveedor
	 */
	public function setIdProveedor($id_proveedor)
	{
		$this->id_proveedor = $id_proveedor;
	}


    public function insert()
    	{
        $this->db->set('ciudad', $this->ciudad);
        $this->db->set('direccion', $this->direccion);
        $this->db->set('id_proveedor', $this->id_proveedor);
        $this->db->insert('direccionproveedor');

			}

			public function update()
	    	{
          $this->db->set('ciudad', $this->ciudad);
          $this->db->set('direccion', $this->direccion);
          $this->db->set('id_proveedor', $this->id_proveedor);
					$this->db->update('direccionproveedor');

				}



      public function selectAll()
      {

    		$query=$this->db->select('*')
												->from('direccionproveedor')
												->get();
				return $query->custom_result_object("DireccionProveedorModel");
      }
			public function deleteProveedorDireccion($id)
			{
				$query=$this->db->where("id_proveedor",$id)
												->delete('direccionproveedor');
			}
			public function selectOne($id)
      {

				$query=$this->db->select('direccionproveedor.ciudad as idCiudad, direccionproveedor.*,ciudad.nombre as ciudad, departamento.nombre as departamento, pais.nombre as pais, pais.tipo as region')
												->from('direccionproveedor')
												->where("id_proveedor",$id)
												->join("ciudad","ciudad.id=direccionproveedor.ciudad")
												->join("departamento","departamento.id=ciudad.iddepartamento")
												->join("pais","pais.id=departamento.idpais")
												->get();
    		return $query->result();
			}
}
?>
