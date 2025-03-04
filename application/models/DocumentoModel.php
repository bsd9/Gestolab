<?php
class DocumentoModel extends CI_Model {

  private $id="";
  private $nombre="";
  private $idEquipo="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->nombre=$data['nombre'];
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

  public function getNombre()
    {
		return $this->nombre;
	}

    public function setNombre($nombre)
    {
		$this->nombre=$nombre;
	}

  public function getIdEquipo()
    {
		return $this->idEquipo;
	}

    public function setIdEquipo($idEquipo)
    {
		$this->idEquipo=$idEquipo;
	}



    public function insert()
    	{
        $this->db->set('nombre',$this->nombre);
        $this->db->set('idEquipo',$this->idEquipo);
        $this->db->insert('documento');
        return $this->db->insert_id();
    	}

			public function update()
				{
          $this->db->set('nombre',$this->nombre);
          $this->db->set('idEquipo',$this->idEquipo);
					$this->db->where("id",  $this->id);
					$this->db->update('documento');
				}

      public function selectAll($id)
      {
    		$query=$this->db->select('documento.*')
                        ->from('documento')
                        ->where("documento.idEquipo",$id)
                        ->get();
    		return $query->custom_result_object("DocumentoModel");
      }



       public function deleteArray($id)
       {
         $query=$this->db->where_not_in('documento.id',$id)
                          ->where("documento.idEquipo", $this->idEquipo)
                         ->delete('documento');
    	// 	return $query->custom_result_object("ImagenModel");
       }

			public function validate()
	    {
	    //    $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
