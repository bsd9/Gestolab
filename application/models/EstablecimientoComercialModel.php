<?php
class EstablecimientoComercialModel extends CI_Model {

	private $id="";
	private $nombre="";
	private $estado = '';
	private $logoFacturacion=0;
	private $logoCotizacion=0;
	private $idGrupoEmpresarial='';
	private $fondoCotizacion=0;
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->nombre=$data['nombre'];
    if(isset($data['logoFacturacion'])){$this->logoFacturacion=$data['logoFacturacion'];}
		$this->estado=$data['estado'];
    if(isset($data['logoCotizacion'])){$this->logoCotizacion=$data['logoCotizacion'];}
		$this->idGrupoEmpresarial=$data['idGrupoEmpresarial'];
		if(isset($data['fondoCotizacion'])){$this->fondoCotizacion=$data['fondoCotizacion'];}

  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getEstado()
    {
		return $this->estado;
	}

    public function setEstado($estado)
    {
		$this->estado=$estado;
	}

	public function getNombre()
    {
		return $this->nombre;
	}

    public function setNombre($nombre)
    {
		$this->nombre=$nombre;
	}

	public function getLogoFacturacion()
    {
		return $this->logoFacturacion;
	}

    public function setLogoFacturacion($logoFacturacion)
    {
		$this->logoFacturacion=$logoFacturacion;
	}

	public function getLogoCotizacion()
		{
		return $this->logoCotizacion;
	}

		public function setLogoCotizacion($logoCotizacion)
		{
		$this->logoCotizacion=$logoCotizacion;
	}

	public function getIdGrupoEmpresarial()
		{
		return $this->idGrupoEmpresarial;
	}

		public function setIdGrupoEmpresarial($idGrupoEmpresarial)
		{
		$this->idGrupoEmpresarial=$idGrupoEmpresarial;
	}

	public function getFondoCotizacion()
		{
		return $this->fondoCotizacion;
	}

		public function setFondoCotizacion($fondoCotizacion)
		{
		$this->fondoCotizacion=$lfondoCotizacion;
	}


    public function insert()
    	{
        $this->db->set('nombre', $this->nombre);
			  $this->db->set(	'idGrupoEmpresarial' , $this->idGrupoEmpresarial);
				if($this->logoFacturacion != 0){
	      $this->db->set('logoFacturacion', $this->logoFacturacion );
				}
				if($this->logoCotizacion  != 0){
	      $this->db->set('logoCotizacion', $this->logoCotizacion );
				}
				if($this->fondoCotizacion  != 0){
				$this->db->set('fondoCotizacion', $this->fondoCotizacion );
				}
        $this->db->insert('establecimientocomercial');
    	}

			public function update()
				{
					$this->db->set('nombre', $this->nombre);
				  $this->db->set(	'idGrupoEmpresarial' , $this->idGrupoEmpresarial);
					if($this->logoFacturacion != 0){
		      $this->db->set('logoFacturacion', $this->logoFacturacion );
					}
					if($this->logoCotizacion  != 0){
		      $this->db->set('logoCotizacion', $this->logoCotizacion );
					}
					if($this->fondoCotizacion  != 0){
					$this->db->set('fondoCotizacion', $this->fondoCotizacion );
					}
		      $this->db->set('estado', $this->estado );
					$this->db->where("id",  $this->id);
					$this->db->update('establecimientocomercial');
				}

      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('establecimientocomercial');
    		return $query->custom_result_object("EstablecimientoComercialModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->where("id",$id)
                        ->from('establecimientocomercial')
                        ->get();
    		return $query->custom_result_object("EstablecimientoComercialModel");
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }

		


}
?>
