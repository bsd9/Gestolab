<?php
class ClasificacionModel extends CI_Model {

	private $id="";
	private $nombre="";
	private $familia="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->nombre=$data['nombre'];
	$this->familia=$data['familia'];
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

	public function getFamilia()
    {
		return $this->familia;
	}

    public function setFamilia($familia)
    {
		$this->familia=$familia;
	}

    public function insert()
    	{
        $this->db->set('nombre', $this->nombre);
		$this->db->set('familia', $this->familia);
        $this->db->insert('clasificacion');
        return $this->db->insert_id();
    	}

			public function update()
				{
					$this->db->set('nombre', $this->nombre);
					$this->db->set('familia', $this->familia);
					$this->db->where("id",  $this->id);
					$this->db->update('clasificacion');
				}

       public function selectAll()
       {
    	 	$query=$this->db->select('clasificacion.*')
                         ->from('clasificacion')
                         ->get();
     	return $query->custom_result_object("ClasificacionModel");
       }

       public function selectOne($id)
       {
    	 	$query=$this->db->select('clasificacion.*')
                         ->from('clasificacion')
                         ->where("clasificacion.id =" . $id )
                         ->get();
     	return $query->custom_result_object("ClasificacionModel");
       }


			 public function getbyNombre($id){
				 $query=$this->db->select('clasificacion.*')
													->from('clasificacion')
													->where('nombre',$id)
													->get();
			 	return $query->custom_result_object("ClasificacionModel");

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
