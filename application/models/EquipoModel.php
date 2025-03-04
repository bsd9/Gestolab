<?php
class EquipoModel extends CI_Model {

  private $idClasificacion="";
  private $marca="";
  private $modelo="";
  private $serial="";
  private $observacion="";
  private $idLaboratorio="";
  private $id="";
  private $nombre="";
  private $costo="";
  private $fechaCompra="";
  private $codigo="";
  private $funcional=0;
  function __construct()
  {
    parent::__construct();
  }

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->idClasificacion=$data['idClasificacion'];
    $this->marca=$data['marca'];
    $this->modelo=$data['modelo'];
    $this->serial=$data['serial'];
    $this->observacion=$data['observacion'];
    $this->idLaboratorio=$data['idLaboratorio'];
    $this->nombre=$data['nombre'];
    $this->costo=$data['costo'];
    $this->fechaCompra=$data['fechaCompra'];
    $this->codigo=$data['codigo'];
    $this->funcional=$data['funcional'];
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

  public function getIdClasificacion()
    {
    return $this->idClasificacion;
  }

    public function setIdClasificacion($idClasificacion)
    {
    $this->idClasificacion=$idClasificacion;
  }

  public function getMarca()
    {
    return $this->marca;
  }

    public function setMarca($marca)
    {
    $this->marca=$marca;
  }

  public function getModelo()
    {
    return $this->modelo;
  }

    public function setModelo($modelo)
    {
    $this->modelo=$modelo;
  }

    public function getSerial()
      {
      return $this->serial;
    }

      public function setSerial($serial)
      {
      $this->serial=$serial;
    }

      public function getObservacion()
        {
        return $this->observacion;
      }

        public function setObservacion($observacion)
        {
        $this->observacion=$observacion;
      }

      public function getIdLaboratorio()
        {
        return $this->idLaboratorio;
      }

        public function setIdLaboratorio($idLaboratorio)
        {
        $this->idLaboratorio=$idLaboratorio;
      }


        public function getFuncional()
        {
          return $this->funcional;
        }

        public function setFuncional($idLaboratorio)
        {
          $this->funcional=$idLaboratorio;
        }


                public function getCosto()
                {
                  return $this->costo;
                }

                public function setCosto($idLaboratorio)
                {
                  $this->costo=$idLaboratorio;
                }


                public function getCodigo()
                {
                  return $this->codigo;
                }

                public function setCodigo($idLaboratorio)
                {
                  $this->codigo=$idLaboratorio;
                }

                public function getFechaCompra()
                {
                  return $this->fechaCompra;
                }

                public function setFechaCompra($idLaboratorio)
                {
                  $this->fechaCompra=$idLaboratorio;
                }


                public function estado(){
                  if ($this->funcional == 0){
                    return "Dado de baja";
                  }if ($this->funcional == 1){
                    return "Funcional";
                  }if ($this->funcional == 3){
                    return "Incidente";
                }if ($this->funcional == 4){
                    return "Proceso Tecnico";
                  }
                }



            public function reportarInciden($id){
              $this->db->set('funcional','3');
              $this->db->where("id",  $id);
              $this->db->update('equipo');
            }




    public function insert()
      {
        $this->db->set('idClasificacion',$this->idClasificacion);
        $this->db->set('marca',$this->marca);
        $this->db->set('modelo',$this->modelo);
        $this->db->set('serial',$this->serial);
        $this->db->set('observacion',$this->observacion);
        $this->db->set('idLaboratorio',$this->idLaboratorio);
        $this->db->set('funcional',$this->funcional);
        $this->db->set('costo',$this->costo);
        $this->db->set('fechaCompra',$this->fechaCompra);
        $this->db->set('codigo',$this->codigo);
        $this->db->insert('equipo');
        return $this->db->insert_id();
      }

      public function update()
        {
          $this->db->set('idClasificacion',$this->idClasificacion);
          $this->db->set('marca',$this->marca);
          $this->db->set('modelo',$this->modelo);
          $this->db->set('serial',$this->serial);
          $this->db->set('observacion',$this->observacion);
          $this->db->set('idLaboratorio',$this->idLaboratorio);
          $this->db->set('funcional',$this->funcional);
          $this->db->set('costo',$this->costo);
          $this->db->set('fechaCompra',$this->fechaCompra);
          $this->db->set('codigo',$this->codigo);
          $this->db->where("id",  $this->id);
          $this->db->update('equipo');
        }

      public function selectAll($id)
      {

        $query=$this->db->select('equipo.*,max(incidencia.fecha) as fecha ,clasificacion.nombre as nombre, laboratorio.nombre as laboratorio')
                        ->from('equipo')
                        ->where("responsable.idUsuario",$id)
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                        ->join('responsable','responsable.idLaboratorio = laboratorio.id')
                        ->join('incidencia','incidencia.idEquipo = equipo.id')
                        ->group_by('equipo.id')
                        ->get();
        $dañados = $query->custom_result_object("EquipoModel");
        $query=$this->db->select('equipo.*, max(fecha_solicitud) as fecha_solicitud, fecha_servicio, clasificacion.nombre as nombre, laboratorio.nombre as laboratorio')
                        ->from('equipo')
                        ->where("responsable.idUsuario",$id)
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                        ->join('responsable','responsable.idLaboratorio = laboratorio.id')
                        ->join('solicitud','solicitud.idEquipo = equipo.id')
                        ->group_by('equipo.id')
                        ->get();
        $conservicios = $query->custom_result_object("EquipoModel");

        $today=getdate();
        $hoy=new DateTime($today["year"] . "-" . $today["mon"]. "-" . $today["mday"]);
        $ids = [-1];

$equipos = [];
foreach ($conservicios as $conservicio) {
  foreach ($dañados as $dañado) {
    if ($conservicio->getId() == $dañado->getId()) {
      if(new DateTime($dañado->fecha) > new DateTime($conservicio->fecha_solicitud)){
        $equipo = $dañado;
      }else {
        $equipo = $conservicio;
        if(!is_null($conservicio->fecha_servicio)){
          if (new DateTime($conservicio->fecha_servicio) > $hoy) {
            $equipo ->estado ='Esperando servicio: ' . $conservicio->fecha_servicio;
          }else {
            $equipo ->estado ='Sin procesos';
          }
        }
      }
      $equipos[] = $equipo;
      $ids[] = $conservicio->getId();
    }
  }
}


$query=$this->db->select('equipo.*,max(incidencia.fecha) as fecha,clasificacion.nombre as nombre, laboratorio.nombre as laboratorio')
                ->from('equipo')
                ->where("responsable.idUsuario",$id)
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                ->join('responsable','responsable.idLaboratorio = laboratorio.id')
                ->join('incidencia','incidencia.idEquipo = equipo.id')
                ->where_not_in('equipo.id',$ids)
                ->group_by('equipo.id')
                ->get();
$dañados = $query->custom_result_object("EquipoModel");
$query=$this->db->select('equipo.*, max(fecha_solicitud) as fecha_solicitud, fecha_servicio, clasificacion.nombre as nombre, laboratorio.nombre as laboratorio')
                ->from('equipo')
                ->where("responsable.idUsuario",$id)
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                ->join('responsable','responsable.idLaboratorio = laboratorio.id')
                ->join('solicitud','solicitud.idEquipo = equipo.id')
                ->where_not_in('equipo.id',$ids)
                ->group_by('equipo.id')
                ->get();
$conservicios = $query->custom_result_object("EquipoModel");
foreach ($conservicios as  $p) {
  $ids[] = $p->getId();
  if(!is_null($p->fecha_servicio)){
    if (new DateTime($p->fecha_servicio) > $hoy) {
      $p ->estado ='Esperando servicio: ' . $conservicio->fecha_servicio;
    }else {
      $p ->estado ='Sin procesos';
    }
  }
}
foreach ($dañados as  $p) {
  $ids[] = $p->getId();
}

$query=$this->db->select('equipo.*,clasificacion.nombre as nombre, laboratorio.nombre as laboratorio')
                ->from('equipo')
                ->where("responsable.idUsuario",$id)
                ->where_not_in('equipo.id',$ids)
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                ->join('responsable','responsable.idLaboratorio = laboratorio.id')
                ->get();
$nuevo = $query->custom_result_object("EquipoModel");

$equipos =  array_merge($equipos,$dañados);
$equipos =  array_merge($equipos,$conservicios);
$equipos =  array_merge($equipos,$nuevo);

return $equipos;
      }



public function selectAllAdmin()
      {

        $query=$this->db->select('equipo.*,max(incidencia.fecha) as fecha ,clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                        ->from('equipo')

                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                        ->join('incidencia','incidencia.idEquipo = equipo.id')
                        ->group_by('equipo.id')
                        ->get();
        $dañados = $query->custom_result_object("EquipoModel");
        $query=$this->db->select('equipo.*, max(fecha_solicitud) as fecha_solicitud, fecha_servicio, clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                        ->from('equipo')
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')

                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                        ->join('solicitud','solicitud.idEquipo = equipo.id')
                        ->group_by('equipo.id')
                        ->get();
        $conservicios = $query->custom_result_object("EquipoModel");

        $today=getdate();
        $hoy=new DateTime($today["year"] . "-" . $today["mon"]. "-" . $today["mday"]);
        $ids = [-1];

$equipos = [];
foreach ($conservicios as $conservicio) {
  foreach ($dañados as $dañado) {
    if ($conservicio->getId() == $dañado->getId()) {
      if(new DateTime($dañado->fecha) > new DateTime($conservicio->fecha_solicitud)){
        $equipo = $dañado;
      }else {
        $equipo = $conservicio;
        if(!is_null($conservicio->fecha_servicio)){
          if (new DateTime($conservicio->fecha_servicio) > $hoy) {
            $equipo ->estado ='Esperando servicio: ' . $conservicio->fecha_servicio;
          }else {
            $equipo ->estado ='Sin procesos';
          }
        }
      }
      $equipos[] = $equipo;
      $ids[] = $conservicio->getId();
    }
  }
}


$query=$this->db->select('equipo.*,max(incidencia.fecha) as fecha,clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                ->from('equipo')
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')

                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                ->join('incidencia','incidencia.idEquipo = equipo.id')
                ->where_not_in('equipo.id',$ids)
                ->group_by('equipo.id')
                ->get();
$dañados = $query->custom_result_object("EquipoModel");
$query=$this->db->select('equipo.*, max(fecha_solicitud) as fecha_solicitud, fecha_servicio, clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                ->from('equipo')
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')

                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                ->join('solicitud','solicitud.idEquipo = equipo.id')
                ->where_not_in('equipo.id',$ids)
                ->group_by('equipo.id')
                ->get();
$conservicios = $query->custom_result_object("EquipoModel");
foreach ($conservicios as  $p) {
  $ids[] = $p->getId();
  if(!is_null($p->fecha_servicio)){
    if (new DateTime($p->fecha_servicio) > $hoy) {
      $p ->estado ='Esperando servicio: ' . $conservicio->fecha_servicio;
    }else {
      $p ->estado ='Sin procesos';
    }
  }
}
foreach ($dañados as  $p) {
  $ids[] = $p->getId();
}

$query=$this->db->select('equipo.*,clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                ->from('equipo')
                ->where_not_in('equipo.id',$ids)
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')

                ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')

                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                ->get();
$nuevo = $query->custom_result_object("EquipoModel");

$equipos =  array_merge($equipos,$dañados);
$equipos =  array_merge($equipos,$conservicios);
$equipos =  array_merge($equipos,$nuevo);

return $equipos;
      }


      public function selectAllClienteEquipo($id)
      {

        $query=$this->db->select('equipo.*,max(incidencia.fecha) as fecha ,clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                        ->from('equipo')

                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                        ->join('incidencia','incidencia.idEquipo = equipo.id')
                        ->where('cliente.id',$id )
                        ->group_by('equipo.id')
                        ->get();
        $dañados = $query->custom_result_object("EquipoModel");
        $query=$this->db->select('equipo.*, max(fecha_solicitud) as fecha_solicitud, fecha_servicio, clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                        ->from('equipo')
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')

                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                        ->join('solicitud','solicitud.idEquipo = equipo.id')
                        ->where('cliente.id',$id )
                        ->group_by('equipo.id')
                        ->get();
        $conservicios = $query->custom_result_object("EquipoModel");

        $today=getdate();
        $hoy=new DateTime($today["year"] . "-" . $today["mon"]. "-" . $today["mday"]);
        $ids = [-1];

$equipos = [];
foreach ($conservicios as $conservicio) {
  foreach ($dañados as $dañado) {
    if ($conservicio->getId() == $dañado->getId()) {
      if(new DateTime($dañado->fecha) > new DateTime($conservicio->fecha_solicitud)){
        $equipo = $dañado;
      }else {
        $equipo = $conservicio;
        if(!is_null($conservicio->fecha_servicio)){
          if (new DateTime($conservicio->fecha_servicio) > $hoy) {
            $equipo ->estado ='Esperando servicio: ' . $conservicio->fecha_servicio;
          }else {
            $equipo ->estado ='Sin procesos';
          }
        }
      }
      $equipos[] = $equipo;
      $ids[] = $conservicio->getId();
    }
  }
}


$query=$this->db->select('equipo.*,max(incidencia.fecha) as fecha,clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                ->from('equipo')
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')

                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                ->join('incidencia','incidencia.idEquipo = equipo.id')
                ->where('cliente.id',$id )
                ->where_not_in('equipo.id',$ids)
                ->group_by('equipo.id')
                ->get();
$dañados = $query->custom_result_object("EquipoModel");
$query=$this->db->select('equipo.*, max(fecha_solicitud) as fecha_solicitud, fecha_servicio, clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                ->from('equipo')
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')

                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                ->join('solicitud','solicitud.idEquipo = equipo.id')
                ->where('cliente.id',$id )
                ->where_not_in('equipo.id',$ids)
                ->group_by('equipo.id')
                ->get();
$conservicios = $query->custom_result_object("EquipoModel");
foreach ($conservicios as  $p) {
  $ids[] = $p->getId();
  if(!is_null($p->fecha_servicio)){
    if (new DateTime($p->fecha_servicio) > $hoy) {
      $p ->estado ='Esperando servicio: ' . $conservicio->fecha_servicio;
    }else {
      $p ->estado ='Sin procesos';
    }
  }
}
foreach ($dañados as  $p) {
  $ids[] = $p->getId();
}

$query=$this->db->select('equipo.*,clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial')
                ->from('equipo')
                ->where_not_in('equipo.id',$ids)
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')

                ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')

                        ->join('cliente','laboratorio.idCliente =   cliente.id')
                        ->where('cliente.id',$id )        
                ->get();
$nuevo = $query->custom_result_object("EquipoModel");

$equipos =  array_merge($equipos,$dañados);
$equipos =  array_merge($equipos,$conservicios);
$equipos =  array_merge($equipos,$nuevo);

return $equipos;
      }



      public function selectOne($id)
      {
        $query=$this->db->select('equipo.*,clasificacion.nombre as nombre')
                        ->from('equipo')
                        ->where("equipo.id",$this->id)
                        ->where("responsable.idUsuario",$id)
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                        ->join('responsable','responsable.idLaboratorio = laboratorio.id')
                        ->get();
        return $query->custom_result_object("EquipoModel");
      }

      public function selectOneEquipo($id)
      {
        $query=$this->db->select('equipo.*,clasificacion.nombre as nombre')
                        ->from('equipo')
                        ->where("equipo.id",$id)
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                        ->get();
        return $query->custom_result_object("EquipoModel");
      }

      public function selectOneAdmin()
      {
        $query=$this->db->select('equipo.*,clasificacion.nombre as nombre')
                        ->from('equipo')
                        ->where("equipo.id",$this->id)
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->get();
        return $query->custom_result_object("EquipoModel");
      }


      public function selectCountIncidencia()
      {
        $query=$this->db->select('equipo.*')
                        ->from('equipo')
                        ->where("equipo.funcional",3)
                        ->get();
        return $query->num_rows();
      }

      public function selectOneEqui($id)
      {
        $query=$this->db->select('equipo.*')
                        ->from('equipo')
                        ->where("equipo.id",$id)
                        ->get();
        return $query->custom_result_object("EquipoModel");
      }

      public function updateEstado(){

          $this->db->set('funcional',$this->funcional);
          $this->db->where("id",  $this->id);
          $this->db->update('equipo');

      }


      public function informeEquipo($id){

           $query= $this->db->select('clasificacion.nombre as NombreEquipo,
                                      equipo.marca as Marca,
                                      equipo.modelo as Modelo,
                                      equipo.serial as Serial,
                                      equipo.codigo as CodigoInterno,
                                      laboratorio.nombre as Dependencia,
                                      (CASE
                                        WHEN equipo.funcional = 0 THEN "Dado de baja"
                                        WHEN equipo.funcional = 1 THEN "Funcional"
                                        WHEN equipo.funcional = 3 THEN "Incidente"
                                        WHEN equipo.funcional = 4 THEN "Proceso Tecnico"
                                      END) as Estado,
                                    (Case 
	                                      WHEN solicitud.servicio is Null THEN "No Tiene"
	                                      WHEN solicitud.servicio is not null THEN solicitud.servicio 
                                        END) as servicio,
                                      (Case 
	                                            WHEN solicitud.fecha_servicio  is Null THEN "Sin Fecha"
	                                            WHEN solicitud.fecha_servicio is not null THEN solicitud.fecha_servicio 
                                            END) as FechaServicio,                                       
                                      (CASE
                                        WHEN solicitud.estado = 0 THEN "Solicitado"
                                        WHEN solicitud.estado = 1 THEN "Iniciado"
                                       WHEN solicitud.estado = 2 THEN "Iniciado"
                                        WHEN solicitud.estado = 3 THEN "Pausado"
                                       WHEN solicitud.estado = 4 THEN "Detenido"
                                       WHEN solicitud.estado = 5 THEN "Finalizado"
                                       WHEN solicitud.estado is Null THEN "Sin Estado"
                                       END) as EstadoServicio,
                                       CASE WHEN COUNT(imagen.id) > 0 THEN "si" ELSE "no" END as Imagen,
                                      (Case 
	                                         WHEN variable.titulo  is Null THEN "Sin Magnitud"
	                                         WHEN variable.titulo is not null THEN variable.titulo
                                    END) as Magnitud ,
                                    (Case 
                                    WHEN solicitud.id is Null THEN "No Tiene"
                                    WHEN solicitud.id is not null THEN solicitud.id 
                                    END) as OrdenDeTrabajo,
                                    (Case 
                                    WHEN solicitud.idOrdenes is Null THEN "No Tiene"
                                    WHEN solicitud.idOrdenes is not null THEN solicitud.idOrdenes 
                                    END) as OrdenDeServicio,
                                    (Case 
                                    WHEN solicitud.valor is Null THEN "No Tiene"
                                    WHEN solicitud.valor is not null THEN solicitud.valor 
                                    END) as Valor,
                                    ( CASE 
                                      WHEN solicitud.cantidadCobrar is null then 0
			                                WHEN solicitud.cantidadCobrar is not Null then solicitud.cantidadCobrar
                                      END ) as Cantidad, 
                                    ( CASE 
                                      WHEN solicitud.valor is null then 0
			                                WHEN solicitud.valor is not Null then (solicitud.valor * solicitud.cantidadCobrar)
                                      END ) as ValorTotal, 
                                   ( CASE 
                                      WHEN  clasificacion.familia is null then "No asignada"
			                                WHEN  clasificacion.familia is not Null then  clasificacion.familia
                                      END ) as Familia
                                    ')  
                            ->from('equipo')
                            ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                            ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                            ->join('cliente','cliente.id = laboratorio.idCliente')
                            ->join('solicitud' , 'solicitud.idEquipo = equipo.id', 'left')
                            ->join('imagen','imagen.idEquipo = equipo.id','left')
                            ->join('variablexequipo','variablexequipo.idEquipo = equipo.id','left')
                            ->join('variable','variable.id =variablexequipo.idVariable','left')
                            ->group_by('equipo.id, clasificacion.nombre, equipo.marca, equipo.modelo, equipo.serial, equipo.codigo, laboratorio.nombre, equipo.funcional, solicitud.servicio, solicitud.fecha_servicio, solicitud.estado, variable.titulo')
                            ->where('cliente.id',$id)
                            ->get();

              return $query->result();

      }

      public function informeEquipototal(){

        $query= $this->db->select('cliente.razonSocial as Cliente,
                                   clasificacion.nombre as NombreEquipo,
                                   equipo.marca as Marca,
                                   equipo.modelo as Modelo,
                                   equipo.serial as Serial,
                                   equipo.codigo as CodigoInterno,
                                   laboratorio.nombre as Dependencia,
                                   (CASE
                                     WHEN equipo.funcional = 0 THEN "Dado de baja"
                                     WHEN equipo.funcional = 1 THEN "Funcional"
                                     WHEN equipo.funcional = 3 THEN "Incidente"
                                     WHEN equipo.funcional = 4 THEN "Proceso Tecnico"
                                   END) as Estado,
                                    (Case 
	                                      WHEN solicitud.servicio is Null THEN "No Tiene"
	                                      WHEN solicitud.servicio is not null THEN solicitud.servicio 
                                        END) as servicio,
                                      (Case 
	                                            WHEN solicitud.fecha_servicio  is Null THEN "Sin Fecha"
	                                            WHEN solicitud.fecha_servicio is not null THEN solicitud.fecha_servicio 
                                            END) as FechaServicio, 
                                   (CASE
                                     WHEN solicitud.estado = 0 THEN "Solicitado"
                                     WHEN solicitud.estado = 1 THEN "Iniciado"
                                    WHEN solicitud.estado = 2 THEN "Iniciado"
                                     WHEN solicitud.estado = 3 THEN "Pausado"
                                    WHEN solicitud.estado = 4 THEN "Detenido"
                                    WHEN solicitud.estado = 5 THEN "Finalizado"
                                    WHEN solicitud.estado is Null THEN "Sin Estado"
                                    END) as EstadoServicio ,
                                    CASE WHEN COUNT(imagen.id) > 0 THEN "si" ELSE "no" END as Imagen,
                                      (Case 
	                                         WHEN variable.titulo  is Null THEN "Sin Magnitud"
	                                         WHEN variable.titulo is not null THEN variable.titulo
                                    END) as Magnitud ,
                                    (Case 
                                    WHEN solicitud.id is Null THEN "No Tiene"
                                    WHEN solicitud.id is not null THEN solicitud.id 
                                    END) as OrdenDeTrabajo,
                                    (Case 
                                    WHEN solicitud.idOrdenes is Null THEN "No Tiene"
                                    WHEN solicitud.idOrdenes is not null THEN solicitud.idOrdenes 
                                    END) as OrdenDeServicio,
                                    (Case 
                                    WHEN solicitud.valor is Null THEN 0
                                    WHEN solicitud.valor is not null THEN solicitud.valor 
                                    END) as Valor,
                                    ( CASE 
                                      WHEN solicitud.cantidadCobrar is null then 0
			                                WHEN solicitud.cantidadCobrar is not Null then solicitud.cantidadCobrar
                                      END ) as Cantidad, 
                                    ( CASE 
                                      WHEN solicitud.valor is null then 0
			                                WHEN solicitud.valor is not Null then (solicitud.valor * solicitud.cantidadCobrar)
                                      END ) as ValorTotal, 
                                   ( CASE 
                                      WHEN  clasificacion.familia is null then "No asignada"
			                                WHEN  clasificacion.familia is not Null then  clasificacion.familia
                                      END ) as Familia
                                    ')
                         ->from('equipo')
                         ->join('clasificacion','clasificacion.id = equipo.idClasificacion','left')
                         ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                         ->join('cliente','cliente.id = laboratorio.idCliente')
                         ->join('solicitud' , 'solicitud.idEquipo = equipo.id', 'left')
                         ->join('imagen','imagen.idEquipo = equipo.id','left')
                         ->join('variablexequipo','variablexequipo.idEquipo = equipo.id','left')
                         ->join('variable','variable.id =variablexequipo.idVariable','left')
                         ->group_by('cliente.razonSocial,equipo.id, clasificacion.nombre, equipo.marca, equipo.modelo, equipo.serial, equipo.codigo, laboratorio.nombre, equipo.funcional, solicitud.servicio, solicitud.fecha_servicio, solicitud.estado, variable.titulo')
                         ->order_by('cliente.razonSocial')
                         ->get();

           return $query->result();

   }


      public function selectEquiposCliente($id){

        $query=$this->db->select('equipo.* ,clasificacion.nombre as nombre')
                        ->from('equipo')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                        ->join('solicitud','solicitud.idEquipo = equipo.id')
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('cliente','cliente.id = laboratorio.idCliente')
                        ->where('cliente.id',$id)
                        ->group_by('equipo.id')
                        ->get();

              return $query->custom_result_object("EquipoModel");
      }

      public function selectEquiposClienteProcesoTecnico($id){

        $query=$this->db->select('equipo.* ,clasificacion.nombre as nombre')
                        ->from('equipo')
                        ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                        ->join('solicitud','solicitud.idEquipo = equipo.id')
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('cliente','cliente.id = laboratorio.idCliente')
                        ->where('cliente.id',$id)
                        ->where('equipo.funcional', 4)
                        ->group_by('equipo.id')
                        ->get();

              return $query->custom_result_object("EquipoModel");
      }


      public function selectLab($id)
      {

        $query=$this->db->select('equipo.*,max(incidencia.fecha) as fecha ,clasificacion.nombre as nombre')
                        ->from('equipo')
                        ->where("equipo.idLaboratorio",$id)
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('incidencia','incidencia.idEquipo = equipo.id')
                        ->group_by('equipo.id')
                        ->get();
        $dañados = $query->custom_result_object("EquipoModel");
        $query=$this->db->select('equipo.*, max(fecha_solicitud) as fecha_solicitud, fecha_servicio, clasificacion.nombre as nombre')
                        ->from('equipo')
                        ->where("equipo.idLaboratorio",$id)
                        ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                        ->join('solicitud','solicitud.idEquipo = equipo.id')
                        ->group_by('equipo.id')
                        ->get();
        $conservicios = $query->custom_result_object("EquipoModel");

        $today=getdate();
        $hoy=new DateTime($today["year"] . "-" . $today["mon"]. "-" . $today["mday"]);
        $ids = [-1];

$equipos = [];
foreach ($conservicios as $conservicio) {
  foreach ($dañados as $dañado) {
    if ($conservicio->getId() == $dañado->getId()) {
      if(new DateTime($dañado->fecha) > new DateTime($conservicio->fecha_solicitud)){
        $equipo = $dañado;
      }else {
        $equipo = $conservicio;
        if(!is_null($conservicio->fecha_servicio)){
          if (new DateTime($conservicio->fecha_servicio) > $hoy) {
            $equipo ->estado ='Esperando servicio: ' . $conservicio->fecha_servicio;
          }else {
            $equipo ->estado ='Sin procesos';
          }
        }
      }
      $equipos[] = $equipo;
      $ids[] = $conservicio->getId();
    }
  }
}


$query=$this->db->select('equipo.*,max(incidencia.fecha) as fecha,clasificacion.nombre as nombre')
                ->from('equipo')
                ->where("equipo.idLaboratorio",$id)
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->join('incidencia','incidencia.idEquipo = equipo.id')
                ->where_not_in('equipo.id',$ids)
                ->group_by('equipo.id')
                ->get();
$dañados = $query->custom_result_object("EquipoModel");
$query=$this->db->select('equipo.*,max(fecha_solicitud) as fecha_solicitud, fecha_servicio, clasificacion.nombre as nombre')
                ->from('equipo')
                ->where("equipo.idLaboratorio",$id)
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->join('solicitud','solicitud.idEquipo = equipo.id')
                ->where_not_in('equipo.id',$ids)
                ->group_by('equipo.id')
                ->get();
$conservicios = $query->custom_result_object("EquipoModel");
foreach ($conservicios as  $p) {
  $ids[] = $p->getId();
  if(!is_null($p->fecha_servicio)){
    if (new DateTime($p->fecha_servicio) > $hoy) {
      $p ->estado ='Esperando servicio: ' . $conservicio->fecha_servicio;
    }else {
      $p ->estado ='Sin procesos';
    }
  }
}
foreach ($dañados as  $p) {
  $ids[] = $p->getId();
}

$query=$this->db->select('equipo.*,clasificacion.nombre as nombre')
                ->from('equipo')
                ->where_not_in('equipo.id',$ids)
                ->where("equipo.idLaboratorio",$id)
                ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
                ->get();
$nuevo = $query->custom_result_object("EquipoModel");

$equipos =  array_merge($equipos,$dañados);
$equipos =  array_merge($equipos,$conservicios);
$equipos =  array_merge($equipos,$nuevo);

return $equipos;

      }
      public function validate()
      {
      //    $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
          return TRUE;//$this->form_validation->run();
      }


}
?>
