<?php
class FacturaProveedorModel extends CI_Model {
	private $id="";
  private $numero="";
	private $estado="";
	private $idCompra="";
	private $idCreador="";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->numero=$data['numero'];
    $this->idCompra=$data['idCompra'];
    if(isset($data['estado'])){$this->estado=$data['estado'];}
  }

	public function getIdCreador()
    {
		return $this->idCreador;
	}

    public function setIdreador($idCreador)
    {
		$this->idCreador=$idCreador;
	}

	public function getIdCompra()
    {
		return $this->idCompra;
	}

    public function setIdCompra($idCompra)
    {
		$this->idCompra=$idCompra;
	}

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getNumero()
    {
		return $this->numero;
	}

    public function setNumero($numero)
    {
		$this->numero=$numero;
	}

	public function getEstado()
    {
		return $this->estado;
	}

    public function setEstado($estado)
    {
		$this->estado=$estado;
	}

    public function insert()
    	{
        $this->db->set('idCreador', $this->session->userdata('id') );
				$this->db->set('idCompra', $this->idCompra);
        $this->db->set('numero', $this->numero);
	      $this->db->set('estado', 0);
        $this->db->insert('facturaProveedor');
        return $this->db->insert_id();
    	}

			public function update()
				{

          $this->db->set('numero', $this->numero);
		//			$this->db->set('estado', $this->estado);
					$this->db->where("id",  $this->id);
					$this->db->update('facturaProveedor');
				}

      public function selectAll()
      {
    		$query=$this->db->select('facturaProveedor.*, proveedor.razonSocial as nombreComprador')
                        ->from('facturaProveedor')
                        ->join("compra" , "compra.id=facturaProveedor.idCompra")
                        ->join("proveedor" , "proveedor.id=compra.idProveedor")
                        ->get();
    		return $query->custom_result_object("FacturaProveedorModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->where("id",$id)
                        ->from('facturaProveedor')
                        ->get();
    		return $query->custom_result_object("FacturaProveedorModel");
      }

			public function selectByCompra($id)
      {
    		$query=$this->db->select('*')
                        ->where("idCompra",$id)
                        ->from('facturaProveedor')
                        ->get();
    		return $query->custom_result_object("FacturaProveedorModel");
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('facturaProv', "numero de factura", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
