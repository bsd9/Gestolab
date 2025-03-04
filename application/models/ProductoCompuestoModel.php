<?php
class ProductoCompuestoModel extends CI_Model {

	private $id="";
	private $idProducto="";
	private $subproducto="";
	private $cantidad ="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
		$this->idProducto=$data['idProducto'];
		$this->subproducto=$data['subproducto'];
		$this->cantidad=$data['cantidad'];

  }

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getIdProducto()
	{
		return $this->idProducto;
	}

	/**
	 * @param string $idProducto
	 */
	public function setIdProducto($idProducto)
	{
		$this->idProducto = $idProducto;
	}

	/**
	 * @return string
	 */
	public function getSubproducto()
	{
		return $this->subproducto;
	}

	/**
	 * @param string $subproducto
	 */
	public function setSubproducto($subproducto)
	{
		$this->subproducto = $subproducto;
	}

	/**
	 * @return string
	 */
	public function getCantidad()
	{
		return $this->cantidad;
	}

	/**
	 * @param string $cantidad
	 */
	public function setCantidad($cantidad)
	{
		$this->cantidad = $cantidad;
	}


    public function insert()
    	{
				$this->db->set('idProducto', $this->idProducto);
				$this->db->set('subproducto', $this->subproducto);
				$this->db->set('cantidad', $this->cantidad);
        $this->db->insert('productocompuesto');
    	}

			public function update()
				{
					$this->db->set('idProducto', $this->idProducto);
					$this->db->set('subproducto', $this->subproducto);
					$this->db->set('cantidad', $this->cantidad);
					$this->db->where("id",  $this->id);
					$this->db->update('productocompuesto');
				}

      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('productocompuesto');
    		return $query->custom_result_object("ProductoCompuestoModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->where("id",$id)
                        ->from('productocompuesto')
                        ->get();
    		return $query->custom_result_object("ProductoCompuestoModel");
      }


			public function delete($id)
			{
				$query=$this->db->where("idProducto",$id)
		                    ->from('productocompuesto')
		                    ->delete();
		  }

}
?>
