<?php
class ModificaProveedorModel extends CI_Model {

	private $id="";
	private $Modificador="";
  private $fechamodificacion="";
	private $id_proveedor="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
		if(isset($data['id'])){$this->id=$data['id'];}
    if(isset($data['Modificador'])){$this->Modificador=$data['Modificador'];}
    if(isset($data['fechamodificacion'])){$this->fechamodificacion=$data['fechamodificacion'];}
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

	public function getNombre()
    {
		return $this->nombre;
	}

    public function setNombre($nombre)
    {
		$this->nombre=$nombre;
	}

    public function insert()
    	{
        $today=getdate();
        $this->fechamodificacion=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
        $this->db->set('Modificador', $this->Modificador);
        $this->db->set('id_proveedor', $this->id_proveedor);
        $this->db->set('fechamodificacion', $this->fechamodificacion);
        $this->db->insert('modificaproveedor');
    	}

			public function selectProveedorMod($id)
      {
    		$query=$this->db->select('empleado.*,fechamodificacion')
                        ->from('modificaproveedor')
												->join("empleado","empleado.id=modificaproveedor.Modificador")
                        ->where("modificaproveedor.id_proveedor",$id)
												->order_by('fechamodificacion', 'desc')
                        ->get();
    		return $query->custom_result_object("EmpleadoModel");
      }

}


?>
