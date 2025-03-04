<?php

class ProveedorModel extends CI_Model {

	private $id="";
  private $razonSocial="";
  private $NIT="";
	private $paginaWeb="";

  private $estado="";
	private $fax="";

	private $fechaIngreso="";
	private $logo="";
	private $notas='';

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
      if(isset($data['id'])){$this->id=$data['id'];}
      if(isset($data['razonSocial'])){$this->razonSocial=$data['razonSocial'];}
      if(isset($data['NIT'])){$this->NIT=$data['NIT'];}
      if(isset($data['paginaWeb'])){$this->paginaWeb=$data['paginaWeb'];}

      if(isset($data['estado'])){$this->estado=$data['estado'];}
      if(isset($data['fax'])){$this->fax=$data['fax'];}
      if(isset($data['fechaIngreso'])){$this->fechaIngreso=$data['fechaIngreso'];}
      if(isset($data['estado'])){$this->estado=$data['estado'];}
      if(isset($data['logo'])){$this->logo=$data['logo'];}

			if(isset($data['notas'])){$this->notas=$data['notas'];}
}

public function getNotas()
	{
	return $this->notas;
}

	public function setNotas($notas)
	{
	$this->notas=$notas;
}



	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getRazonSocial()
		{
		return mb_strtoupper($this->razonSocial);
	}

		public function setRazonSocial($razonSocial)
		{
		$this->razonSocial=mb_strtoupper ($razonSocial);
	}

	public function getNIT()
    {
		return $this->NIT;
	}

    public function setNIT($NIT)
    {
		$this->NIT=$NIT;
	}



	public function getEstado()
    {
		return $this->estado;
	}

    public function setEstado($estado)
    {
		$this->estado=$estado;
	}

  public function getPaginaWeb()
    {
		return $this->paginaWeb;
	}

    public function setPaginaWeb($paginaWeb)
    {
		$this->paginaWeb=$paginaWeb;
	}

  public function getFax()
    {
		return $this->fax;
	}

    public function setFax($fax)
    {
		$this->fax=$fax;
	}

  public function getFechaIngreso()
    {
		return $this->fechaingreso;
	}

    public function setFechaIngreso($fechaingreso)
    {
		$this->fechaingreso=$fechaingreso;
	}

	public function getlogo()
    {
		return $this->logo;
	}

    public function setlogo($logo)
    {
		$this->logo=$logo;
	}

	public function ruleUniqueRazonSocial($nombre)
	{
		$query=$this->db->select('proveedor.*')
										->from('proveedor')
										->where("proveedor.id !=",$this->id)
										->where("proveedor.razonSocial",$nombre)
										->where("proveedor.estado !=", '1')
										->get();
		return count($query->custom_result_object("ClienteModel")) < 1;
	}

	public function ruleUniqueNIT($nombre)
	{
		$query=$this->db->select('proveedor.*')
										->from('proveedor')
										->where("proveedor.id !=",$this->id)
										->where("proveedor.NIT",$nombre)
										->where("proveedor.estado !=", '1')
										->get();
		return count($query->custom_result_object("ClienteModel")) < 1;
	}
	  public function validate($a)
    {
						if ($a) {
							$this->form_validation->set_rules('razonSocial', "razon social", 'required|is_unique[proveedor.razonSocial]',array('is_unique'=>'La %s ya esta en uso','required'=>'La %s es un campo obligatorio'));
							$this->form_validation->set_rules('NIT', "NIT", 'required|is_unique[proveedor.NIT]',array('is_unique'=>'El %s ya esta en uso','required'=>'El %s es un campo obligatorio'));
							# code...
						}else{
							$this->form_validation->set_rules('razonSocial', "razon social", 'required',array('required'=>'La %s es un campo obligatorio'));
							$this->form_validation->set_rules('NIT', "NIT", 'required',array('required'=>'El %s es un campo obligatorio'));

						}

				$this->form_validation->set_rules('razonSocial', "razon social", 'required',array('required'=>'La %s es un campo obligatorio'));
		    $this->form_validation->set_rules('NIT', "NIT", 'required',array('required'=>'El %s es un campo obligatorio'));
			//	$this->form_validation->set_rules('facebook', "facebook", 'required',array('required'=>'El %s es un campo obligatorio'));
			//	$this->form_validation->set_rules('twitter', "twitter", 'required',array('required'=>'Ingrese por lo menos un %s'));
			//	$this->form_validation->set_rules('estado', "estado", 'required',array('required'=>'El %s es un campo obligatorio'));
			  //  $this->form_validation->set_rules('paginaWeb', "paginaWeb", 'numeric|required',array('numeric'=>'Numeros en la %s porfavor','required'=>'La %s es un campo obligatorio'));
		  //  $this->form_validation->set_rules('fax', "fax", 'required',array('required'=>'El %s es un campo obligatorio'));
		  //  $this->form_validation->set_rules('fechaingreso', "fecha de ingreso", 'required',array('required'=>'El %s es un campo obligatorio'));
	  //  $this->form_validation->set_rules('logo', "logo", 'required',array('required'=>'El %s es un campo obligatorio'));
				return $this->form_validation->run();
    }

    public function insert()
    	{

				$today=getdate();
        $hoy=$today["year"]."-". $today["mon"]."-". $today["mday"];
        $this->db->set('razonSocial',mb_strtoupper ( $this->razonSocial));
        $this->db->set('NIT', $this->NIT);

				$this->db->set('estado', 1);
        $this->db->set('paginaWeb', $this->paginaWeb);
        $this->db->set('fax', $this->fax);
        $this->db->set('fechaingreso', $hoy);
				if($this->logo != 0){
							$this->db->set('logo', $this->logo);
				}
        $this->db->set('notas', $this->notas);
        $this->db->insert('proveedor');

			}

			public function update()
	    	{
          $this->db->set('razonSocial',mb_strtoupper($this->razonSocial));
          $this->db->set('NIT', $this->NIT);

  				$this->db->set('estado', $this->estado);
          $this->db->set('paginaWeb', $this->paginaWeb);
          $this->db->set('fax', $this->fax);

	        $this->db->set('notas', $this->notas);
      //    $this->db->set('fechaingreso', $hoy);
			if($this->logo != 0){
	          $this->db->set('logo', $this->logo);
			}
          $this->db->where("proveedor.id",$this->id);
					$this->db->update('proveedor');

				}



      public function selectAll()
      {

    		$query=$this->db->select('proveedor.*')
												->from('proveedor')
												->get();
				return $query->custom_result_object("ProveedorModel");
      }

			public function selectOne($id)
      {

				$query=$this->db->select('proveedor.*')
												->from('proveedor')
												->where("proveedor.id",$id)
												->get();
    		return $query->custom_result_object("ProveedorModel");
			}

public function obtenerID($nit){
	$query=$this->db->select('proveedor.*')
									->from('proveedor')
									->where("proveedor.NIT",$nit)
									->get();
	return $query->custom_result_object("ProveedorModel");

}

public function selectId($razonSocial)
{
	$query=$this->db->select('*')
									->where("razonSocial",$razonSocial)
									->from('proveedor')
									->get();
	return $query->custom_result_object("ProductoModel");
}

public function getProducts(){
	$query=$this->db->select('producto.*, productoxproveedor.costo as costo, productoxproveedor.CodProd as codProveedor')
									->where("productoxproveedor.idProveedor",$this->id)
									->where("producto.activo",1)
									->from('productoxproveedor')
									->join('producto', "producto.id = productoxproveedor.idProducto")
									->get();
$rs=$query->custom_result_object("ProductoModel");
  return $rs;

}

public function getAllProducts(){
	$query=$this->db->select('producto.*, productoxproveedor.costo as costo, productoxproveedor.CodProd as codProveedor')
									->where("productoxproveedor.idProveedor",$this->id)
									->from('productoxproveedor')
									->join('producto', "producto.id = productoxproveedor.idProducto")
									->get();
	return $query->custom_result_object("ProductoModel");
}

}
?>
