<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set("america/bogota");
  }

	public function logueado()
	{
    if(!$this->session->has_userdata('id')){
    $this->session->set_flashdata('message', 'Logueate para acceder');
    redirect('Inicio/index');
    exit();
	 }
  }

    // $this->load->model('AccesoModel');
    // $accesomodel = new AccesoModel();
    // $accesos = $accesomodel->selectOne($this->session->userdata("idCargo"));
    // $permisos = [];
    // foreach ($accesos as $acceso) {
    //   $permisos[]=$acceso->nombrePermiso;
    // }
    // $this->session->set_userdata('permisos',$permisos);
    // if(!in_array($nombre,$permisos)){
    // $this->session->set_flashdata('message', 'Zona no autorizada');
    // redirect('Inicio/home');
    // exit();





  public function permiso($nombre)
  {
    $this->load->model('AccesoModel');
    $accesomodel = new AccesoModel();
    $accesos = $accesomodel->selectOne($this->session->userdata("idCargo"));
    $permisos = [];
    foreach ($accesos as $acceso) {
      $permisos[]=$acceso->nombrePermiso;
    }
    $this->session->set_userdata('permisos',$permisos);
    if(!in_array($nombre,$permisos)){
    $this->session->set_flashdata('message', 'Zona no autorizada');
    redirect('Inicio/home');
    exit();
   }
  }

  public function getPermisos(){
    $this->load->model('AccesoModel');
    $accesomodel = new AccesoModel();
    $accesos = $accesomodel->selectOne($this->session->userdata("idCargo"));
    $permisos = [];
    foreach ($accesos as $acceso) {
      $permisos[]=$acceso->nombrePermiso;
    }
    return $permisos;
  }


  }


