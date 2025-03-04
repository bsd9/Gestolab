<?php

class NombreComercialProveedorModel extends CI_Model {
	private $id="";
  private $nombre="";
	private $id_proveedor="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
      if(isset($data['id'])){$this->id=$data['id'];}
      if(isset($data['nombre'])){$this->nombre=$data['nombre'];}
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
	public function getNombre()
	{
		return $this->nombre;
	}

	/**
	 * param string $nombre
	 */
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
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
        $this->db->set('nombre', $this->nombre);
        $this->db->set('id_proveedor', $this->id_proveedor);
        $this->db->insert('nombrecomercialproveedor');

			}

			public function update()
	    	{
          $this->db->set('nombre', $this->nombre);
          $this->db->set('id_proveedor', $this->id_proveedor);
					$this->db->update('nombrecomercialproveedor');

				}



      public function selectAll()
      {

    		$query=$this->db->select('*')
												->from('nombrecomercialproveedor')
												->get();
				return $query->custom_result_object("NombreComercialproveedorModel");
      }
			public function deleteProveedorNombres($id)
			{
				$query=$this->db->where("id_proveedor",$id)
												->delete('nombrecomercialproveedor');
			}
			public function selectOne($id)
      {

				$query=$this->db->select('*')
												->from('nombrecomercialproveedor')
												->where("id_proveedor",$id)
												->get();
    		return $query->custom_result_object("NombreComercialProveedorModel");
			}
}
