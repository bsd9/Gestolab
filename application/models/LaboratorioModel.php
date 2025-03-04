<?php
class LaboratorioModel extends CI_Model {

	private $id="";
	private $nombre="";
	private $idCliente="";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
		$this->nombre=$data['nombre'];
		$this->idCliente=$data['idCliente'];
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

	public function getIdCliente()
		{
		return $this->idCliente;
	}

		public function setIdCliente($id)
		{
		$this->idCliente=$id;
	}


    public function insert()
    	{
				$this->db->set('nombre', $this->nombre);
				$this->db->set('idCliente', $this->idCliente);
        $this->db->insert('laboratorio');
        return $this->db->insert_id();
    	}

			public function update()
				{
					$this->db->set('nombre', $this->nombre);
					$this->db->where("id",  $this->id);
					$this->db->update('laboratorio');
				}

      public function selectAll($id)
      {
    		$query=$this->db->select('laboratorio.*')
                        ->from('laboratorio')
                      ->where("responsable.idUsuario",$id)

                        ->join('responsable','responsable.idLaboratorio = laboratorio.id')
                        ->get();
    	return $query->custom_result_object("LaboratorioModel");

      }

			public function selectAllCliente($id)
			{
				$query=$this->db->select('laboratorio.*')
												->from('laboratorio')
											  ->where("laboratorio.idCliente",$id)
												->join('equipo','equipo.idLaboratorio = laboratorio.id')
												->join('solicitud', 'solicitud.idEquipo = equipo.id')
												->group_by('laboratorio.id')
												->get();
			return $query->custom_result_object("LaboratorioModel");

			}
      public function selectOne($id)
      {
    		$query=$this->db->select('laboratorio.*')
                        ->where("responsable.idUsuario",$id)
                        ->where("laboratorio.id",$this->id)
                        ->from('laboratorio')
                        ->join('responsable','responsable.idLaboratorio = laboratorio.id')
                        ->get();
    		return $query->custom_result_object("LaboratorioModel");
      }

			public function selectOneLab($id)
      {
    		$query=$this->db->select('laboratorio.*')
                        ->where("laboratorio.id",$id)
                        ->from('laboratorio')
                        ->get();
    		return $query->custom_result_object("LaboratorioModel");
      }

      public function selectOneAdmin()
      {
    		$query=$this->db->select('laboratorio.*')
                        ->where("laboratorio.id",$this->id)
                        ->from('laboratorio')
                        ->join('responsable','responsable.idLaboratorio = laboratorio.id')
                        ->get();
    		return $query->custom_result_object("LaboratorioModel");
      }


			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
