<?php
class ServicioClienteModel extends CI_Model{

  private $id = '';
  private $RazonSocialCliente= '';
  private $NumeroPedido= '';
  private $CantidadSlots= '';
  private $NombreAsesor= '';
  private $nombreServicio= '';
  private $estado= '';
  function __construct()
  {
    parent::__construct();
  }

  function getRazonSocialCliente(){
    return $this->RazonSocialCliente;
  }
  function getNumeroPedido(){
    return $this->NumeroPedido;
  }
  function getCantidadSlots(){
    return $this->CantidadSlots;
  }
  function getNombreAsesor(){
    return $this->NombreAsesor;
  }
  function getNombreServicio(){
    return $this->nombreServicio;
  }

  function getEstado(){
    return $this->estado;
  }

  function getId(){
    return $this->id;
  }

function setData($data){
  if(isset($data['RazonSocialCliente'])){$this->RazonSocialCliente = $data['RazonSocialCliente'];}
  if(isset($data['NumeroPedido'])){$this->NumeroPedido = $data['NumeroPedido'];}
  if(isset($data['CantidadSlots'])){$this->CantidadSlots = $data['CantidadSlots'];}
  if(isset($data['NombreAsesor'])){$this->NombreAsesor = $data['NombreAsesor'];}
  if(isset($data['nombreServicio'])){$this->nombreServicio = $data['nombreServicio'];}
}

  function insert(){
  $dbclient =   $this->cliente= $this->load->database('cliente', true);
  $dbclient->set('RazonSocialCliente',$this->RazonSocialCliente);
  $dbclient->set('NumeroPedido',$this->NumeroPedido);
  $dbclient->set('CantidadSlots',$this->CantidadSlots);
  $dbclient->set('NombreAsesor',$this->NombreAsesor);
  $dbclient->set('nombreServicio',$this->nombreServicio);
  $dbclient->insert('serviciocliente');

  }



}


 ?>
