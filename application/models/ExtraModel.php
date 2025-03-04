<?php
class ExtraModel extends CI_Model {

	private $id="";
	private $nombre= "";
	private $valor= "";
	private $idServicio = "";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->nombre=$data['nombre'];
    $this->valor=$data['valor'];
    $this->idServicio=$data['idServicio'];
  }


	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getIdServicio()
		{
		return $this->idServicio;
	}

		public function setIdServicio($idServicio)
		{
		$this->idServicio=$idServicio;
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
			$this->db->where('idServicio', $id);
			$this->db->delete('extra');
		}
    public function insert()
    	{
        $this->db->set('idServicio', $this->idServicio);
		    $this->db->set('valor', $this->valor);
	      $this->db->set('nombre', $this->nombre);
        $this->db->insert('extra');
        return $this->db->insert_id();
    	}

			public function update()
				{
		      $this->db->set('nombre', $this->nombre);
			    $this->db->set('valor', $this->valor);
					$this->db->where("id",  $this->id);
					$this->db->update('extra');
				}

      public function selectAll()
      {
    		$query=$this->db->select('extra.*')
                        ->from('extra')
          //              ->join('dependencia','cargo.idDependencia = dependencia.id')
                        ->get();
    		return $query->custom_result_object("ExtraModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('extra.*')
                        ->where("extra.idServicio",$id)
                        ->from('extra')
                        ->get();
    		return $query->custom_result_object("ExtraModel");
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
