<?php
class ServicioModel extends CI_Model {
  private $id ="";
  private $idResponsable ="";
  private $idDetallePedido ="";
  private $nombre ="";
  private $estado ="";
  private $titulo ="";
  private $codigo ="";
  private $fechaEjecucion ="";
  private $fecha ="";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['idResponsable'])){$this->idResponsable = $data['idResponsable'];}
    if(isset($data['idDetallePedido'])){$this->idDetallePedido = $data['idDetallePedido'];}
    if(isset($data['nombre'])){$this->nombre = $data['nombre'];}
    if(isset($data['estado'])){$this->estado = $data['estado'];}
    if(isset($data['id'])){$this->id=$data['id'];}
    if(isset($data['codigo'])){$this->codigo=$data['codigo'];}
    if(isset($data['fechaEjecucion'])){$this->fechaEjecucion=$data['fechaEjecucion'];}
    if(isset($data['fecha'])){$this->fecha=$data['fecha'];}
  }


      	public function getFechaEjecucion()
          {
      		return $this->fechaEjecucion;
      	}

          public function setFechaEjecucion($fecha)
          {
      		$this->fechaEjecucion=$fecha;
      	}

    	public function getFecha()
        {
    		return $this->fecha;
    	}

        public function setFecha($fecha)
        {
    		$this->fecha=$fecha;
    	}

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}



  public function getIdDetallePedido()
    {
    return $this->idDetallePedido;
  }

    public function setIdDetallePedido($idDetallePedido)
    {
    $this->idDetallePedido=$idDetallePedido;
  }

  public function getNombre()
    {
    return $this->nombre;
  }

    public function setNombre($nombre)
    {
    $this->nombre=$nombre;
  }

  public function getEstado()
    {
    return $this->estado;
  }

    public function setEstado($estado)
    {
    $this->estado=$estado;
  }

  public function getTitulo()
    {
    return $this->titulo;
  }

    public function setTitulo($estado)
    {
    $this->titulo=$estado;
  }

  public function getCodigo()
    {
    return $this->codigo;
  }

    public function setCodigo($estado)
    {
    $this->codigo=$estado;
  }

    public function insert()
    	{

        //$this->db->set('idResponsable',  $this->idResponsable );
        $this->db->set('idDetallePedido',  $this->idDetallePedido );
        $this->db->set('nombre',  $this->nombre );
        $this->db->set('estado',  $this->estado );
        $this->db->insert('servicio');
        return $this->db->insert_id();
    	}

public function update(){
  if($this->idResponsable != ''){
    $this->db->set('idResponsable',  $this->idResponsable, false );
  }
  $this->db->set('estado',  $this->estado );
  $this->db->where('id',  $this->id );
  $this->db->update('servicio');
}

      public function selectAll()
      {
    		$query=$this->db->select('servicio.*,servicioequipo.equipo as equipo')
                        ->from('servicio')
                        ->join('servicioequipo','servicioequipo.idServicio = servicio.id')
                        ->get();
    		$ans1 = $query->custom_result_object("ServicioModel");
        $id = [-1];
        foreach ($ans1 as $servicio) {
          array_push($id,$servicio->getId());
        }
        $query=$this->db->select('*, "Sin Llenar" as equipo')
                        ->from('servicio')
                        ->where_not_in('servicio.id',$id)
                        ->get();
    		$ans2 = $query->custom_result_object("ServicioModel");
        return array_merge($ans1,$ans2);
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->from('servicio')
                        ->where('id',$id)
                        ->get();
    		return $query->custom_result_object("ServicioModel");
      }

      public function selectByDetails($ids)
      {
    		$query=$this->db->select('*')
                        ->from('servicio')
                        ->where('idDetallePedido',$ids)
                        ->get();
    		return $query->custom_result_object("ServicioModel");
      }

			public function validate()
	    {
	  //      $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
			//		return $this->form_validation->run();
	    }

public function putTitulo($titulo){
  $this->db->set('titulo',  $titulo );
  $this->db->where('id',  $this->id );
  $this->db->update('servicio');
}

public function putInform(){
  $this->db->set('titulo',  $this->titulo );
  $this->db->set('codigo',  $this->codigo );
  $this->db->set('fecha',  $this->fecha );
  $this->db->set('fechaEjecucion',  $this->fechaEjecucion );
  $this->db->where('id',  $this->id );
  $this->db->update('servicio');
}

public function InformeVentas($fechaini, $fechafin){



  $query=$this->db->select('solicitud.id as IdSolicitud,
  CONCAT(usuario.nombre,"-",usuario.apellidos) as Tecnico,
  transicion.fecha as Fecha,
  transicion.estado as EstadoSolicitud,
  transicion.descripcion as Descripcion,
  ordenes.id as OrdenServicio,
  solicitud.fecha_solicitud as fecha_solicitud,
  ordenes.razonSocialcliente as RazonSocialCliente,
  clasificacion.nombre as Nombre,
  equipo.serial as Serial,
  solicitud.servicio as Servicio,
  solicitud.fecha_servicio as FechaFin')
->from('solicitud')
->join('transicion',"transicion.idServicio = solicitud.id",'left')
->join('ordenes',"ordenes.id = solicitud.idOrdenes",'left')
->join('usuario',"usuario.id = transicion.idResponsable",'left')
->join('equipo',"equipo.id = solicitud.idEquipo",'left')
->join('clasificacion',"clasificacion.id = equipo.idClasificacion",'left')
->where('ordenes.estado', 2)
->where('solicitud.fecha_solicitud  BETWEEN  TIMESTAMP('."'".$fechaini."'".') and TIMESTAMP('."'".$fechafin."'".')')
->order_by('solicitud.fecha_servicio')
->get();
return $query->result();
}

}
?>
