<?php
class CargoModel extends CI_Model {

	private $id="";
	private $nombre="";

	private $activo="";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->nombre=$data['nombre'];

    if(isset($data['activo'])){$this->activo=$data['activo'];}
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

	public function getActivo()
    {
		return $this->activo;
	}

    public function setActivo($nombre)
    {
		$this->activo=$nombre;
	}

    public function insert()
    	{
        $this->db->set('nombre', $this->nombre);
        $this->db->set('activo', 1);
        $this->db->insert('cargo');
        return $this->db->insert_id();
    	}

			public function update()
				{
					$this->db->set('nombre', $this->nombre);
    			$this->db->set('activo', $this->activo);
					$this->db->where("id",  $this->id);
					$this->db->update('cargo');
				}

      public function selectAll()
      {
    		$query=$this->db->select('cargo.*')
                        ->from('cargo')
                      	->get();
    		return $query->custom_result_object("CargoModel");
      }


	  public function selectNoAdmin()
      {
    		$query=$this->db->select('cargo.*')
                        ->from('cargo')
						->where('tipoUsuario', 0)
                      	->get();
    		return $query->custom_result_object("CargoModel");
      }


      public function selectOne($id)
      {
    		$query=$this->db->select('cargo.*')
                        ->where("cargo.id",$id)
                        ->from('cargo')
                        ->get();
    		return $query->custom_result_object("CargoModel");
      }

     

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
