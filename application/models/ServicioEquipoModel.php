<?php
class ServicioEquipoModel extends CI_Model{

  private $id= '';
  private $equipo= '';
  private $marca= '';
  private $modelo= '';
  private $serial= '';
  private $fallaReportada= '';
  private $idServicio= '';
  private $ubicacion= '';
  private $codigoInt= '';
  function __construct()
  {
    parent::__construct();
  }


  function getId(){
      return $this->id;
    }
    function getEquipo(){
      return $this->equipo;
    }
    function getMarca(){
      return $this->marca;
    }
    function getModelo(){
      return $this->modelo;
    }
    function getSerial(){
      return $this->serial;
    }

    function getFallaReportada(){
      return $this->fallaReportada;
    }

    function getIdServicio(){
      return $this->idServicio;
    }

    function getUbicacion(){
      return $this->ubicacion;
    }

    function getCodigoInt(){
      return $this->codigoInt;
    }

  function setData($data){
    if (isset($data['id'])) { $this->id = $data['id'];}
    if (isset($data['equipo'])) { $this->equipo = $data['equipo'];}
    if (isset($data['marca'])) { $this->marca = $data['marca'];}
    if (isset($data['modelo'])) { $this->modelo = $data['modelo'];}
    if (isset($data['serial'])) { $this->serial = $data['serial'];}
    if (isset($data['fallaReportada'])) { $this->fallaReportada = $data['fallaReportada'];}
    if (isset($data['idServicio'])) { $this->idServicio = $data['idServicio'];}
    if (isset($data['ubicacion'])) { $this->ubicacion = $data['ubicacion'];}
    if (isset($data['codigoInt'])) { $this->codigoInt = $data['codigoInt'];}
  }


  function insert(){
    $this->db->set('equipo',$this->equipo);
    $this->db->set('marca',$this->marca);
    $this->db->set('modelo',$this->modelo);
    $this->db->set('serial',$this->serial);
    $this->db->set('fallaReportada',$this->fallaReportada);
    $this->db->set('ubicacion',$this->ubicacion);
    $this->db->set('codigoInt',$this->codigoInt);
    $this->db->set('idServicio',$this->idServicio);
    $this->db->insert('servicioequipo');
    return $this->db->insert_id();
  }

  function update(){
    $this->db->set('equipo',$this->equipo);
    $this->db->set('marca',$this->marca);
    $this->db->set('modelo',$this->modelo);
    $this->db->set('serial',$this->serial);
    $this->db->set('ubicacion',$this->ubicacion);
    $this->db->set('codigoInt',$this->codigoInt);
    $this->db->set('fallaReportada',$this->fallaReportada);
    $this->db->set('idServicio',$this->idServicio);
    $this->db->where('id',$this->id);
    $this->db->update('servicioequipo');
  }


function selectOne($id){
  $query=$this->db->select('*')
                  ->where("idServicio",$id)
                  ->from('servicioequipo')
                  ->get();
  return $query->custom_result_object("ServicioEquipoModel");

}


  function moveInfo(){
    $dbclient =   $this->cliente= $this->load->database('cliente', true);
    $dbclient->distinct();
    $dbclient->select('NumeroPedido');
    $dbclient->where('estado', 0);
    $query = $dbclient->get('serviciocliente');

    foreach ($query as $idpedidoobj) {
      $idpedido= $idpedidoobj->NumeroPedido;
      $model = new PedidoModel();
      $pedido = $model->selectOne($idpedido);
      $model = new DetallePedidoModel();
      $detalles = $model->selectOne($pedido[0]->getId());
      $i = 0;
      $model = new ServicioModel();
      $query = $dbclient->select('servicioequipo.*')
                        ->from('servicioequipo')
                        ->join('serviciocliente','serviciocliente.id = servicioequipo.idServicioCliente')
                        ->where('serviciocliente.estado', 0)
                        ->where('serviciocliente.NumeroPedido',$idpedido )
                        ->get();
      $resultado = $query->result();
      foreach ($detalles as $detalle) {

        $servicio = $model->selectByDetails($detalle->getId());
    $data['equipo'] = $resultado[$i]->equipo;
    $data['marca'] = $resultado[$i]->marca;
    $data['modelo'] = $resultado[$i]->modelo;
    $data['serial'] = $resultado[$i]->serial;
    $data['fallaReportada'] = $resultado[$i]->fallaReportada;
    $data['idServicio'] = $servicio[0]->getId();
    $this->setData($data);
    $this->insert();
      }
    }


    $dbclient->where('estado', 1);
    $dbclient->delete('serviciocliente');
    $dbclient->delete('servicioequipo');

  }


}


 ?>
