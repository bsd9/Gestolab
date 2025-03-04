<?php
class TransicionModel extends CI_Model {

  private $id = '';
  private $idResponsable = '';
  private $estado = '';
  private $idServicio = '';
  private $fecha = '';
  private $descripcion = '';

  function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    if(isset($data['idResponsable'])){$this->idResponsable = $data['idResponsable'];}
    if(isset($data['estado'])){$this->estado = $data['estado'];}
    if(isset($data['idServicio'])){$this->idServicio = $data['idServicio'];}
    if(isset($data['fecha'])){$this->fecha = $data['fecha'];}
    if(isset($data['descripcion'])){$this->descripcion = $data['descripcion'];}
  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

  public function getDescripcion()
    {
		return $this->descripcion;
	}

    public function setDescripcion  ($descripcion)
    {
		$this->descripcion=$descripcion;
	}

	public function getIdResponsable()
    {
		return $this->idResponsable;
	}

    public function setIdResponsable($idResponsable)
    {
		$this->idResponsable=$idResponsable;
	}

	public function getEstado()
    {
		return $this->estado;
	}

    public function setEstado($estado)
    {
		$this->estado=$estado;
	}

  	public function getIdServicio()
      {
  		return $this->idServicio;
  	}

      public function setIdServicio($idServicio)
      {
  		$this->idServicio=$idServicio;
  	}


    	public function getFecha()
        {
    		return $this->fecha;
    	}

        public function setFecha($fecha)
        {
    		$this->fecha=$fecha;
    	}

    public function insert()
    	{
        $this->db->set('idResponsable', $this->idResponsable);
        $this->db->set('estado', $this->estado);
        $this->db->set('idServicio', $this->idServicio);
        $this->db->set('fecha', $this->fecha);
        $this->db->set('descripcion', $this->descripcion);
        $this->db->insert('transicion');
    	}


      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('transicion');
    		return $query->custom_result_object("TransicionModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('transicion.*, empleado.nombre as Tecnico')
                        ->where("idServicio",$id)
                        ->from('transicion')
                        ->join('empleado', 'empleado.id = transicion.idResponsable')
                        ->get();
    		return $query->custom_result_object("TransicionModel");
      }



      public function histoService($id){
          $query=$this->db->select('transicion.*,
                                  CONCAT(usuario.nombre," ",usuario.apellidos) as Tecnico')
                            ->from('transicion')
                            ->join('usuario','usuario.id = transicion.idResponsable')
                            ->join('solicitud','solicitud.id = transicion.idServicio')
                            ->where('solicitud.id',$id)
                            ->get();
        return $query->custom_result_object("TransicionModel");
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
