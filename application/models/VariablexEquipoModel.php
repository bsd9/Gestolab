<?php
class VariablexEquipoModel extends CI_Model {

	private $id="";
	private $idEquipo="";
  private $idVariable="";
  private $cantidad="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->idEquipo=$data['idEquipo'];
    $this->idVariable=$data['idVariable'];
    $this->cantidad=$data['cantidad'];

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

  public function getIdVariable()
    {
    return $this->idVariable;
  }

    public function setIdVariable($idVariable)
    {
    $this->idVariable=$idVariable;
  }

public function getCantidad()
    {
    return $this->cantidad;
  }

    public function setCantidad($cantidad)
    {
    $this->cantidad=$cantidad;
  }

    public function insert()
    	{

	      $this->db->set('idEquipo', $this->idEquipo);
        $this->db->set('idVariable', $this->idVariable);
        $this->db->set('cantidad', $this->cantidad);
        $this->db->insert('variablexequipo');
        return $this->db->insert_id();
    	}

			public function update()
				{

		      $this->db->set('idEquipo', $this->idEquipo);
          $this->db->set('idVariable', $this->idVariable);
          $this->db->set('cantidad', $this->cantidad);
					$this->db->where("id",  $this->id);
					$this->db->update('variablexequipo');
				}

      public function selectAll()
      {
    		$query=$this->db->select('variablexequipo.*')
                        ->from('variablexequipo')
          //              ->join('dependencia','cargo.idDependencia = dependencia.id')
                        ->get();
    		return $query->custom_result_object("VariablexEquipoModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('variablexequipo.*, variable.titulo as nombre')
                        ->where("variablexequipo.idEquipo",$id)
                        ->from('variablexequipo')
												->join('variable','variable.id = variablexequipo.idVariable')
                        ->get();
    		return $query->custom_result_object("VariablexEquipoModel");
      }


			public function delete($id)
			{

					$query=$this->db->where('variablexequipo.idEquipo', $id)
													->delete('variablexequipo');

			}


			public function validate()
	    {
	        $this->form_validation->set_rules('titulo', "titulo", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
