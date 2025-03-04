<?php
class DocumentoProductoModel extends CI_Model{

  private $id="";
	private $tipo ="";
	private $doc ="";
	private $fechaSubida ="";
	private $idProducto ="";
	function __construct(){
		parent::__construct();
	}

    public function setData($data){
    if(isset($data['id'])){$this->id=$data['id'];}
		$this->tipo=$data['tipo'];
    $this->doc=$data['doc'];
		if(isset($data['fechaSubida'])){$this->fechaSubida=$data['fechaSubida'];}
    $this->idProducto=$data['idProducto'];
  }

public function getDoc(){
return $this->doc;
}


  public function insert(){
      $today=getdate();
      $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
      $this->db->set('tipo', $this->tipo);
      $this->db->set('doc', $this->doc);
      $this->db->set('idProducto', $this->idProducto);
      $this->db->set('fechaSubida', $hoy);
      $this->db->insert('documentoproducto');
    }

  public function selectOne($id){
    $query=$this->db->select('*')
                    ->where("id",$id)
                    ->from('documentoproducto')
                    ->get();
    return $query->custom_result_object("DocumentoProductoModel");
  }

  public function selectAllOf($id,$tipo){
    $query=$this->db->select('documentoproducto.*')
                    ->where("idProducto",$id)
                    ->where("documentoproducto.tipo",$tipo)
                    ->from('documentoproducto')
                    ->order_by('fechaSubida','desc')
                    ->get();
    return $query->custom_result_object("DocumentoProductoModel");

  }


}




 ?>
