<?php
class ImagenModel extends CI_Model {

  private $id="";
  private $nombre="";
  private $idEquipo="";
  private $fecha="";
  private $tipo="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->nombre=$data['nombre'];
    $this->idEquipo=$data['idEquipo'];
    $this->fecha=$data['fecha'];
    $this->tipo=$data['tipo'];
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

  public function getFecha()
    {
		return $this->fecha;
	}

    public function setFecha($fecha)
    {
		$this->fecha=$fecha;
	}

    public function getTipo()
      {
  		return $this->tipo;
  	}

      public function setTipo($tipo)
      {
  		$this->tipo=$tipo;
  	}

    public function insert()
    	{
        $this->db->set('nombre',$this->nombre);
        $this->db->set('idEquipo',$this->idEquipo);
        $this->db->set('fecha',$this->fecha);
        $this->db->set('tipo',$this->tipo);
        $this->db->insert('imagen');
        return $this->db->insert_id();
    	}

			public function update()
				{
          $this->db->set('nombre',$this->nombre);
          $this->db->set('idEquipo',$this->idEquipo);
          $this->db->set('fecha',$this->fecha);
          $this->db->set('tipo',$this->tipo);
					$this->db->where("id",  $this->id);
					$this->db->update('imagen');
				}

      public function selectAll($id)
      {
    		$query=$this->db->select('imagen.*')
                        ->from('imagen')
                        ->where("imagen.idEquipo",$id)
                        ->get();
    		return $query->custom_result_object("ImagenModel");
      }



       public function deleteArray($id)
       {
         $query=$this->db->where_not_in('imagen.id',$id)
                          ->where("imagen.idEquipo", $this->idEquipo)
                         ->delete('imagen');
    	// 	return $query->custom_result_object("ImagenModel");
       }

			public function validate()
	    {
	    //    $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
