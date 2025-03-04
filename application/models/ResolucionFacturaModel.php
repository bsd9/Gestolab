<?php
 class ResolucionFacturaModel extends CI_Model {


	private $id="";
	private $resolucion="";
	private $fechaExpedicion="";
	private $fechaVencimiento="";
	private $tipo="";
  private $prefijo="";
	private $desde="";
	private $hasta="";
	private $ultimo="";
	private $estado="";
	private $idEstablecimiento="";
	function __construct()
	{
		parent::__construct();
	}

	public function setData($data)
	{
		if(isset($data['id'])){$this->id=$data['id'];}
		if(isset($data['resolucion'])){$this->resolucion=$data['resolucion'];}
		if(isset($data['fechaExpedicion'])){$this->fechaExpedicion=$data['fechaExpedicion'];}
		if(isset($data['fechaVencimiento'])){$this->fechaVencimiento=$data['fechaVencimiento'];}
		if(isset($data['tipo'])){$this->tipo=$data['tipo'];}
		if(isset($data['prefijo'])){$this->prefijo=$data['prefijo'];}
		if(isset($data['desde'])){$this->desde=$data['desde'];}
		if(isset($data['hasta'])){$this->hasta=$data['hasta'];}
		if(isset($data['ultimo'])){$this->ultimo=$data['ultimo'];}
		if(isset($data['estado'])){$this->estado=$data['estado'];}
		if(isset($data['idEstablecimiento'])){$this->idEstablecimiento=$data['idEstablecimiento'];}
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
	 public function getResolucion()
	 {
		 return $this->resolucion;
	 }

	 /**
	  * @param string $resolucion
	  */
	 public function setResolucion($resolucion)
	 {
		 $this->resolucion = $resolucion;
	 }

	 /**
	  * @return string
	  */
	 public function getFechaExpedicion()
	 {
		 return $this->fechaExpedicion;
	 }

	 /**
	  * @param string $fechaExpedicion
	  */
	 public function setFechaExpedicion($fechaExpedicion)
	 {
		 $this->fechaExpedicion = $fechaExpedicion;
	 }

	 /**
	  * @return string
	  */
	 public function getFechaVencimiento()
	 {
		 return $this->fechaVencimiento;
	 }

	 /**
	  * @param string $fechaVencimiento
	  */
	 public function setFechaVencimiento($fechaVencimiento)
	 {
		 $this->fechaVencimiento = $fechaVencimiento;
	 }

	 /**
	  * @return string
	  */
	 public function getTipo()
	 {
		 return $this->tipo;
	 }

	 /**
	  * @param string $tipo
	  */
	 public function setTipo($tipo)
	 {
		 $this->tipo = $tipo;
	 }

	 /**
	  * @return string
	  */
	 public function getPrefijo()
	 {
		 return $this->prefijo;
	 }

	 /**
	  * @param string $prefijo
	  */
	 public function setPrefijo($prefijo)
	 {
		 $this->prefijo = $prefijo;
	 }

	 /**
	  * @return string
	  */
	 public function getDesde()
	 {
		 return $this->desde;
	 }

	 /**
	  * @param string $desde
	  */
	 public function setDesde($desde)
	 {
		 $this->desde = $desde;
	 }

	 /**
	  * @return string
	  */
	 public function getHasta()
	 {
		 return $this->hasta;
	 }

	 /**
	  * @param string $hasta
	  */
	 public function setHasta($hasta)
	 {
		 $this->hasta = $hasta;
	 }

	 /**
	  * @return string
	  */
	 public function getUltimo()
	 {
		 return $this->ultimo;
	 }

	 /**
	  * @param string $ultimo
	  */
	 public function setUltimo($ultimo)
	 {
		 $this->ultimo = $ultimo;
	 }

	 /**
	  * @return string
	  */
	 public function getEstado()
	 {
		 return $this->estado;
	 }

	 /**
	  * @param string $estado
	  */
	 public function setEstado($estado)
	 {
		 $this->estado = $estado;
	 }

	 /**
	  * @return string
	  */
	 public function getIdEstablecimiento()
	 {
		 return $this->idEstablecimiento;
	 }

	 /**
	  * @param string $idEstablecimiento
	  */
	 public function setIdEstablecimiento($idEstablecimiento)
	 {
		 $this->idEstablecimiento = $idEstablecimiento;
	 }



	public function insert()
	{
    if ($this->estado) {
  $this->db->set('estado',0);
  $this->db->where('idEstablecimiento',$this->idEstablecimiento);
  $this->db->update('resolucionfactura');
    }
		$this->db->set('resolucion',$this->resolucion);
		$this->db->set('fechaExpedicion',$this->fechaExpedicion);
		$this->db->set('fechaVencimiento',$this->fechaVencimiento);
		$this->db->set('tipo',$this->tipo);
		$this->db->set('prefijo',$this->prefijo);
		$this->db->set('desde',$this->desde);
		$this->db->set('hasta',$this->hasta);
		$this->db->set('ultimo',$this->ultimo);
		$this->db->set('estado',$this->estado);
    $this->db->set('idEstablecimiento',$this->idEstablecimiento);
		$this->db->insert('resolucionfactura');
		return $this->db->insert_id();
	}

	public function update()
	{
    if ($this->estado) {
  $this->db->set('estado',0);
  $this->db->where('idEstablecimiento',$this->idEstablecimiento);
  $this->db->update('resolucionfactura');
    }
    $this->db->set('resolucion',$this->resolucion);
		$this->db->set('fechaExpedicion',$this->fechaExpedicion);
		$this->db->set('fechaVencimiento',$this->fechaVencimiento);
		$this->db->set('tipo',$this->tipo);
		$this->db->set('prefijo',$this->prefijo);
		$this->db->set('desde',$this->desde);
		$this->db->set('hasta',$this->hasta);
		$this->db->set('ultimo',$this->ultimo);
		$this->db->set('estado',$this->estado);
    $this->db->set('idEstablecimiento',$this->idEstablecimiento);
			$this->db->where("id",  $this->id);
			$this->db->update('resolucionfactura');
		}

	public function selectAll()
	{
		$query=$this->db->select('resolucionfactura.*, establecimientocomercial.nombre as Establecimiento')
										->from('resolucionfactura')
                    ->join('establecimientocomercial','establecimientocomercial.id = resolucionfactura.idEstablecimiento')
										->get();
		return $query->custom_result_object("ResolucionFacturaModel");
	}

	public function selectOne($id)
	{
    $query=$this->db->select('*')
                    ->from('resolucionfactura')
										->where("resolucionfactura.id",$id)
										->get();
		return $query->custom_result_object("ResolucionFacturaModel");
	}


	public function validate()
	{


		$this->form_validation->set_rules('resolucion', "resolucion", 'required',array('required'=>'La %s es un campo obligatorio'));
    $this->form_validation->set_rules('fechaExpedicion', "fecha de Expedicion", 'required',array('required'=>'La %s es un campo obligatorio'));
    $this->form_validation->set_rules('fechaVencimiento', "fecha de Vencimiento", 'required',array('required'=>'La %s es un campo obligatorio'));
    $this->form_validation->set_rules('tipo', "tipo", 'required',array('required'=>'El %s es un campo obligatorio'));
    $this->form_validation->set_rules('prefijo', "prefijo", 'required',array('required'=>'El %s es un campo obligatorio'));
    $this->form_validation->set_rules('desde', "desde", 'required',array('required'=>'Coloque %s va el rango de facturacion'));
    $this->form_validation->set_rules('hasta', "hasta", 'required',array('required'=>'Coloque %s va el rango de facturacion'));
    $this->form_validation->set_rules('ultimo', "ultimo", 'required',array('required'=>'Coloque el %s numero donde va el rango de facturacion'));

		return $this->form_validation->run();
	}

  public function proximaFactura($id){

    $query=$this->db->select('*')
                    ->from('resolucionfactura')
                    ->where('estado', 1)
                    ->where('idEstablecimiento', $id)
                    ->get();
    $ans= $query->result();
    if(count($ans) < 1){
        return "";
    }

    $this->db->set('ultimo',($ans[0]->ultimo) + 1);
      $this->db->where("id",  $ans[0]->id);
      $this->db->update('resolucionfactura');
    return $ans[0];
  }

  public function ResolucionUsada($idEstablecimiento){
    $query=$this->db->select('*')
                    ->from('resolucionfactura')
                    ->where('estado', 1)
                    ->where('ultimo < hasta')
                    ->where("idEstablecimiento", $idEstablecimiento)
                    ->get();
    $ans= $query->result();
    if(count($ans) < 1){
        return "";
    }
    return $ans[0];
  }

}
?>
