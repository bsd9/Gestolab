<?php
class GrupoEmpresarialModel extends CI_Model {

	private $id="";
	private $razonSocial="";
	private $NIT="";
	private $telefono="";
	private $direccion="";
	private $fax="";
	private $correo="";
	private $web="";
	private $estado="";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
		$this->razonSocial=$data['razonSocial'];
		$this->NIT=$data['NIT'];
		$this->telefono=$data['telefono'];
		$this->direccion=$data['direccion'];
		$this->fax=$data['fax'];
		$this->correo=$data['correo'];
		$this->web=$data['web'];
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

		public function getWeb()
	    {
			return $this->web;
		}

	    public function setWeb($web)
	    {
			$this->web=$web;
		}

	public function getEstado()
    {
		return $this->estado;
	}

    public function setEstado($estado)
    {
		$this->estado=$estado;
	}

	public function getRazonSocial()
    {
		return strtoupper ($this->razonSocial);
	}

    public function setRazonSocial($razonSocial)
    {
		$this->razonSocial= strtoupper ($razonSocial);
	}

	public function getNIT()
    {
		return $this->NIT;
	}

    public function setNIT($NIT)
    {
		$this->NIT=$NIT;
	}

	public function getTelefono()
    {
		return $this->telefono;
	}

    public function setTelefono($telefono)
    {
		$this->telefono=$telefono;
	}

	public function getDireccion()
    {
		return $this->direccion;
	}

    public function setDireccion($direccion)
    {
		$this->direccion=$direccion;
	}

	public function getFax()
    {
		return $this->fax;
	}

    public function setFax($fax)
    {
		$this->fax=$fax;
	}

	public function getCorreo()
    {
		return $this->correo;
	}

    public function setCorreo($correo)
    {
		$this->correo=$correo;
	}



    /**public function insert()
    	{
        $this->db->set('razonSocial', strtoupper ($this->razonSocial));
	      $this->db->set('NIT', $this->NIT );
	      $this->db->set('telefono', $this->telefono );
				$this->db->set('direccion', $this->direccion );
				$this->db->set('fax', $this->fax );
				$this->db->set('correo', $this->correo );
				$this->db->set('web', $this->web );
				$this->db->set('estado', 1 );
        $this->db->insert('grupoempresarial');
    	}**/

			public function update()
				{
					$this->db->set('razonSocial', strtoupper ($this->razonSocial));
		      $this->db->set('NIT', $this->NIT );
		      $this->db->set('telefono', $this->telefono );
					$this->db->set('direccion', $this->direccion );
					$this->db->set('fax', $this->fax );
					$this->db->set('correo', $this->correo );
					$this->db->set('estado', $this->estado );
					$this->db->set('web', $this->web );
					$this->db->where("id",  $this->id);
					$this->db->update('grupoempresarial');
				}

      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('grupoempresarial');
    		return $query->custom_result_object("GrupoEmpresarialModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->where("id",$id)
                        ->from('grupoempresarial')
                        ->get();
    		return $query->custom_result_object("GrupoEmpresarialModel");
      }

			public function validate()
	    {

$this->form_validation->set_rules('razonSocial', "Razon social", 'required',array('required'=>'La %s es un campo obligatorio'));
$this->form_validation->set_rules('NIT', "NIT", 'required',array('required'=>'El %s es un campo obligatorio'));
$this->form_validation->set_rules('telefono', "telefono", 'required',array('required'=>'El %s es un campo obligatorio'));
$this->form_validation->set_rules('direccion', "direccion", 'required',array('required'=>'La %s es un campo obligatorio'));
//$this->form_validation->set_rules('fax', "fax", 'required',array('required'=>'El %s es un campo obligatorio'));
$this->form_validation->set_rules('correo', "correo", 'required',array('required'=>'El %s es un campo obligatorio'));
		return $this->form_validation->run();
	    }


}
?>
