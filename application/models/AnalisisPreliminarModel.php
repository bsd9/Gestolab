
<?php
class AnalisisPreliminarModel extends CI_Model {
private $id= "";
private $idIncidencia= "";
private $fecha= "";
private $descripcion= "";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->idIncidencia=$data['idIncidencia'];
    $this->fecha=$data['fecha'];
    $this->descripcion=$data['descripcion'];

  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getIdIncidencia()
    {
		return $this->idIncidencia;
	}

    public function setIdIncidencia($idIncidencia)
    {
		$this->idIncidencia=$idIncidencia;
	}

  public function getFecha()
    {
		return $this->fecha;
	}

    public function setFecha($fecha)
    {
		$this->fecha=$fecha;
	}

  public function getDescripcion()
    {
		return $this->descripcion;
	}

    public function setDescripcion($descripcion)
    {
		$this->descripcion=$descripcion;
	}


    public function insert()
    	{
        $this->db->set('idIncidencia', $this->idIncidencia);
        $this->db->set('fecha', $this->fecha);
        $this->db->set('descripcion', $this->descripcion);
        $this->db->insert('analisisprelimiar');
        return $this->db->insert_id();
    	}

			public function update()
				{
					$this->db->set('idIncidencia', $this->idIncidencia);
          $this->db->set('fecha', $this->fecha);
          $this->db->set('descripcion', $this->descripcion);
					$this->db->where("id",  $this->id);
					$this->db->update('analisisprelimiar');
				}

       public function selectAll($id)
       {
    	 	$query=$this->db->select('analisisprelimiar.*')
                         ->from('analisisprelimiar')
                        ->join("incidencia","incidencia.id = analisisprelimiar.idIncidencia")
                         ->where('idEquipo',$id)

                         ->get();
     	return $query->custom_result_object("AnalisisPrelimiarModel");
       }

      // public function selectOne($id)
      // {
    	// 	$query=$this->db->select('laboratorio.*')
      //                   ->where("responsable.idUsuario",$id)
      //                   ->where("laboratorio.id",$this->id)
      //                   ->from('laboratorio')
      //                   ->join('responsable','responsable.idLaboratorio = laboratorio.id')
      //                   ->get();
    	// 	return $query->custom_result_object("LaboratorioModel");
      // }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
