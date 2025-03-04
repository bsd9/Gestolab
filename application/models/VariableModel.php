<?php
class VariableModel extends CI_Model {

	private $id="";
	private $titulo="";
  private $precioPiso="";
  private $precioPublico="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->precioPiso=$data['precioPiso'];
    $this->precioPublico=$data['precioPublico'];
    $this->titulo=$data['titulo'];

  }


	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getTitulo()
    {
		return $this->titulo;
	}

    public function setTitulo($titulo)
    {
		$this->titulo=$titulo;
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
    public function insert()
    	{

	      $this->db->set('titulo', $this->titulo);
        $this->db->set('precioPiso', $this->precioPiso);
        $this->db->set('precioPublico', $this->precioPublico);
        $this->db->insert('variable');
        return $this->db->insert_id();
    	}

			public function update()
				{
          $this->db->set('titulo', $this->titulo);
          $this->db->set('precioPiso', $this->precioPiso);
          $this->db->set('precioPublico', $this->precioPublico);
					$this->db->where("id",  $this->id);
					$this->db->update('variable');
				}

      public function selectAll()
      {
    		$query=$this->db->select('variable.*')
                        ->from('variable')
                        ->get();
    		return $query->custom_result_object("VariableModel");
      }


      public function selectVariableCliente($id)
      {
    		$query=$this->db->select('variable.titulo')
                        ->from('variable')
                        ->join('variablexequipo','variablexequipo.idVariable = variable.id')
                        ->join('equipo','equipo.id = variablexequipo.idEquipo')
                        ->join('laboratorio','equipo.idLaboratorio = laboratorio.id')
                        ->join('cliente','cliente.id = laboratorio.idCliente')
                        ->where('cliente.id',$id)
                        ->group_by('variable.titulo')
                        ->order_by('variable.titulo')
                        ->get();
    		return $query->custom_result_object("VariableModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('variable.*')
                        ->where("variable.id",$id)
                        ->from('variable')
                        ->get();
    		return $query->custom_result_object("VariableModel");
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('titulo', "titulo", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
