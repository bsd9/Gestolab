<?php
class AdministradorServicioModel extends CI_Model {

	private $id="";
	private $nombre="";
  private $variable="";
  private $unidadMedida="";
 
  private $precioPiso="";
  private $precioPublico="";
  private $estado="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->nombre=$data['nombre'];
    $this->variable=$data['variable'];
    $this->unidadMedida=$data['unidadMedida'];

    $this->precioPiso=$data['precioPiso'];
    $this->precioPublico=$data['precioPublico'];
    $this->estado=$data['estado'];

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

    public function getVariable()
    {
    return $this->variable;
  }

    public function setVariable($variable)
    {
    $this->variable=$variable;
  }

    public function getUnidadMedida()
    {
    return $this->unidadMedida;
  }

    public function setUnidadMedida($unidadMedida)
    {
    $this->unidadMedida=$unidadMedida;
  }


    public function getPrecioPiso()
    {
    return $this->precioPiso;
  }

    public function setPrecioPiso($precioPiso)
    {
    $this->precioPiso=$precioPiso;
  }

    public function getPrecioPublico()
    {
    return $this->precioPublico;
  }

    public function setPrecioPublico($precioPublico)
    {
    $this->precioPublico=$precioPublico;
  }

     public function getEstado()
    {
    return $this->estado;
  }

    public function setEstado($estado)
    {
    $this->estado=$estado;
  }





    public function insert()
    	{

	      $this->db->set('nombre', $this->nombre);
        $this->db->set('variable', $this->variable);
        $this->db->set('unidadMedida', $this->unidadMedida);
       
        $this->db->set('precioPiso', $this->precioPiso);
        $this->db->set('precioPublico', $this->precioPublico);
        $this->db->set('estado', $this->estado);
        $this->db->insert('administrarservicio');
        return $this->db->insert_id();
    	}

			public function update()
				{

          $this->db->set('nombre', $this->nombre);
          $this->db->set('variable', $this->variable);
          $this->db->set('unidadMedida', $this->unidadMedida);
     
          $this->db->set('precioPiso', $this->precioPiso);
          $this->db->set('precioPublico', $this->precioPublico);
		      $this->db->set('estado', $this->estado);
					$this->db->where("id",  $this->id);
					$this->db->update('administrarservicio');
				}

      public function selectAll()
      {
    		$query=$this->db->select('administrarservicio.*')
                        ->from('administrarservicio')
                        ->get();
    		return $query->custom_result_object("AdministradorServicioModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('administrarservicio.*')
                        ->where("administrarservicio.id",$id)
                        ->from('administrarservicio')
                        ->get();
    		return $query->custom_result_object("AdministradorServicioModel");
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "Nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
    
					return $this->form_validation->run();
	    }


}
?>