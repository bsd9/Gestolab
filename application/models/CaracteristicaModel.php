<?php
class CaracteristicaModel extends CI_Model {

	private $id="";
	private $nombre= "";
	private $valor= "";
	private $idEquipo = "";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->nombre=$data['nombre'];
    $this->valor=$data['valor'];
    $this->idEquipo=$data['idEquipo'];
  }


	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getIdEquipo()
		{
		return $this->idEquipo;
	}

		public function setIdEquipo($idEquipo)
		{
		$this->idEquipo=$idEquipo;
	}



	public function getNombre()
    {
		return $this->nombre;
	}

    public function setNombre($nombre)
    {
		$this->nombre=$nombre;
	}


	public function getValor()
    {
		return $this->valor;
	}

    public function setValor($nombre)
    {
		$this->valor=$nombre;
	}


	public function delete($id)
		{
			$this->db->where('idEquipo', $id);
			$this->db->delete('caracteristica');
		}
    public function insert()
    	{
        $this->db->set('idEquipo', $this->idEquipo);
		    $this->db->set('valor', $this->valor);
	      $this->db->set('nombre', $this->nombre);
        $this->db->insert('caracteristica');
        return $this->db->insert_id();
    	}

			public function update()
				{
		      $this->db->set('nombre', $this->nombre);
			    $this->db->set('valor', $this->valor);
					$this->db->where("id",  $this->id);
					$this->db->update('caracteristica');
				}

      public function selectAll()
      {
    		$query=$this->db->select('caracteristica.*')
                        ->from('caracteristica')
          //              ->join('dependencia','cargo.idDependencia = dependencia.id')
                        ->get();
    		return $query->custom_result_object("CaracteristicaModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('caracteristica.*')
                        ->where("caracteristica.idEquipo",$id)
                        ->from('caracteristica')
                        ->get();
    		return $query->custom_result_object("CaracteristicaModel");
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
