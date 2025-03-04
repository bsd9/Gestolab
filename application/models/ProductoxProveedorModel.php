<?php
class ProductoxProveedorModel extends CI_Model {

	private $id="";
	private $idProducto="";
	private $idProveedor="";
	private $costo ="";
	private $divisa ="";
  private $CodProd ="";


	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
		$this->idProducto=$data['idProducto'];
		$this->idProveedor=$data['idProveedor'];
		$this->costo=$data['costo'];
		$this->divisa=$data['divisa'];
    $this->CodProd=$data['CodProd'];
  }

  /**
	 * @return string
	 */
	public function getCodProd()
	{
		return $this->CodProd;
	}

	/**
	 * @param string $id
	 */
	public function setCodProd($codProd)
	{
		$this->CodProd = $codProd;
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
	public function getIdProveedor()
	{
		return $this->idProveedor;
	}

	/**
	 * @param string $idProveedor
	 */
	public function setIdProveedor($idProveedor)
	{
		$this->idProveedor = $idProveedor;
	}

	/**
	 * @return string
	 */
	public function getCosto()
	{
		return $this->costo;
	}

	/**
	 * @param string $costo
	 */
	public function setCosto($costo)
	{
		$this->costo = $costo;
	}

	/**
	 * @return string
	 */
	public function getDivisa()
	{
		return $this->divisa;
	}

	/**
	 * @param string $divisa
	 */
	public function setDivisa($divisa)
	{
		$this->divisa = $divisa;
	}


    public function insert()
    	{
				$this->db->set('idProducto', $this->idProducto);
				$this->db->set('idProveedor', $this->idProveedor);
				$this->db->set('costo', $this->costo);
				$this->db->set('divisa', $this->divisa);
				$this->db->set('CodProd', $this->CodProd);
        $this->db->insert('productoxproveedor');
    	}

			public function update()
				{
					$this->db->set('idProducto', $this->idProducto);
					$this->db->set('idProveedor', $this->idProveedor);
					$this->db->set('costo', $this->costo);
					$this->db->set('divisa', $this->divisa);
  				$this->db->set('CodProd', $this->CodProd);
					$this->db->where("id",  $this->id);
					$this->db->update('productoxproveedor');
				}

      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('productoxproveedor');
    		return $query->custom_result_object("ProductoxProveedorModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->where("id",$id)
                        ->from('productoxproveedor')
                        ->get();
    		return $query->custom_result_object("ProductoxProveedorModel");
      }

			public function delete($id)
      {
    		$query=$this->db->where("idProducto",$id)
                        ->from('productoxproveedor')
                        ->delete();
      }

      public function selectByProd($id){
        $query=$this->db->select('productoxproveedor.*, proveedor.razonSocial as idProveedor')
                        ->where("productoxproveedor.idProducto",$id)
                        ->from('productoxproveedor')
                        ->join("proveedor" , "proveedor.id=productoxproveedor.idProveedor")
                        ->get();
        return $query->custom_result_object("ProductoxProveedorModel");
      }
}
?>
