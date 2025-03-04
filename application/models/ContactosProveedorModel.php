<?php

class ContactosProveedorModel extends CI_Model {

	private $id="";
	private $nombre="";
	private $apellido="";
  private $cargo="";
  private $telefono="";
  private $ext="";
	private $celular="";
	private $email="";
	private $email2="";

	private $id_proveedor="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {

      if(isset($data['id'])){$this->id=$data['id'];}
			if(isset($data['nombre'])){$this->nombre=$data['nombre'];}
      if(isset($data['apellido'])){$this->apellido=$data['apellido'];}
      if(isset($data['cargo'])){$this->cargo=$data['cargo'];}
      if(isset($data['telefono'])){$this->telefono=$data['telefono'];}
      if(isset($data['ext'])){$this->ext=$data['ext'];}
      if(isset($data['celular'])){$this->celular=$data['celular'];}
      if(isset($data['email'])){$this->email=$data['email'];}
      if(isset($data['email2'])){$this->email2=$data['email2'];}

      if(isset($data['id_proveedor'])){$this->id_proveedor=$data['id_proveedor'];}

}


	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	/**
	 * return string
	 */
	public function getNombre()
	{
		return ucwords(mb_strtolower($this->nombre));
	}

	/**
	 * param string $nombre
	 */
	public function setNombre($nombre)
	{
		$this->nombre = ucwords(mb_strtolower($nombre));
	}

	/**
	 * return string
	 */
	public function getApellido()
	{
		return ucwords(mb_strtolower($this->apellido));
	}

	/**
	 * param string $apellido
	 */
	public function setApellido($apellido)
	{
		$this->apellido = ucwords(mb_strtolower($apellido));
	}

	/**
	 * return string
	 */
	public function getCargo()
	{
		return ucwords(mb_strtolower($this->cargo));
	}

	/**
	 * param string $cargo
	 */
	public function setCargo($cargo)
	{
		$this->cargo = ucwords(mb_strtolower($cargo));
	}

	/**
	 * return string
	 */
	public function getIdProveedor()
	{
		return $this->id_proveedor;
	}

	/**
	 * param string $id_proveedor
	 */
	public function setIdProveedor($id_proveedor)
	{
		$this->id_proveedor = $id_proveedor;
	}

	/**
	 * return string
	 */
	public function getTelefono()
	{
		return $this->telefono;
	}

	/**
	 * param string $telefono
	 */
	public function setTelefono($telefono)
	{
		$this->telefono = $telefono;
	}

	/**
	 * return string
	 */
	public function getExt()
	{
		return $this->ext;
	}

	/**
	 * param string $ext
	 */
	public function setExt($ext)
	{
		$this->ext = $ext;
	}

	/**
	 * return string
	 */
	public function getCelular()
	{
		return $this->celular;
	}

	/**
	 * param string $celular
	 */
	public function setCelular($celular)
	{
		$this->celular = $celular;
	}

	/**
	 * return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * return string
	 */
	public function getEmail2()
	{
		return $this->email2;
	}

	/**
	 * param string $email2
	 */
	public function setEmail2($email2)
	{
		$this->email2 = $email2;
	}



	  public function validate()
    {
      	$this->form_validation->set_rules('usuario', "usuario", 'required',array('required'=>'El %s es un campo obligatorio'));
		    $this->form_validation->set_rules('password', "password", 'required',array('required'=>'La %s es un campo obligatorio'));
		    $this->form_validation->set_rules('razonSocial', "razon social", 'required',array('required'=>'La %s es un campo obligatorio'));
		    $this->form_validation->set_rules('NIT', "NIT", 'required',array('required'=>'El %s es un campo obligatorio'));
			//	$this->form_validation->set_rules('facebook', "facebook", 'required',array('required'=>'El %s es un campo obligatorio'));
			//	$this->form_validation->set_rules('twitter', "twitter", 'required',array('required'=>'Ingrese por lo menos un %s'));
				$this->form_validation->set_rules('estado', "estado", 'required',array('required'=>'El %s es un campo obligatorio'));
		    $this->form_validation->set_rules('sector', "sector", 'required',array('required'=>'El %s es un campo obligatorio'));
		    $this->form_validation->set_rules('paginaWeb', "paginaWeb", 'numeric|required',array('numeric'=>'Numeros en la %s porfavor','required'=>'La %s es un campo obligatorio'));
		    $this->form_validation->set_rules('fax', "fax", 'required',array('required'=>'El %s es un campo obligatorio'));
		  //  $this->form_validation->set_rules('fechaingreso', "fecha de ingreso", 'required',array('required'=>'El %s es un campo obligatorio'));
		    $this->form_validation->set_rules('asesor', "asesor", 'required',array('required'=>'La %s es un campo obligatorio'));
		    $this->form_validation->set_rules('logo', "logo", 'required',array('required'=>'El %s es un campo obligatorio'));
				return $this->form_validation->run();
    }

    public function insert()
    	{
        $this->db->set('nombre', ucwords(mb_strtolower($this->nombre)));
        $this->db->set('apellido', ucwords(mb_strtolower($this->apellido)));
        $this->db->set('cargo', ucwords(mb_strtolower($this->cargo)));
        $this->db->set('telefono', $this->telefono);
        $this->db->set('ext', $this->ext);
				$this->db->set('celular', $this->celular);
				$this->db->set('email', $this->email);
        $this->db->set('email2', $this->email2);

        $this->db->set('id_proveedor', $this->id_proveedor);
        $this->db->insert('contactoproveedor');

			}

			public function update()
	    	{
					$this->db->set('nombre', ucwords(mb_strtolower($this->nombre)));
	        $this->db->set('apellido', ucwords(mb_strtolower($this->apellido)));
	        $this->db->set('cargo', ucwords(mb_strtolower($this->cargo)));
	        $this->db->set('telefono', $this->telefono);
	        $this->db->set('ext', $this->ext);
					$this->db->set('celular', $this->celular);
					$this->db->set('email', $this->email);
	        $this->db->set('email2', $this->email2);

	        $this->db->set('id_proveedor', $this->id_proveedor);
	        $this->db->update('contactoproveedor');

				}



				public function deleteProveedorContacto($id)
	      {
	    		$query=$this->db->where("id_proveedor",$id)
	                        ->delete('contactoproveedor');
	      }

			public function selectOne($id)
      {

				$query=$this->db->select('*')
												->from('contactoproveedor')
												->where("id_proveedor",$id)
												->get();
    		return $query->custom_result_object("ContactosProveedorModel");
			}





}
?>
