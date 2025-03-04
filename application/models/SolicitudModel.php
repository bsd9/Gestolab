
<?php
class SolicitudModel extends CI_Model {
private $id= "";
private $idEquipo= "";
private $fecha_solicitud= "";
private $fecha_servicio= "";
private $servicio= "";
private $descripcion= "";
private $codigoServicio="";
private $idCotizacion="";
private $idResponsable="";
private $estado="";
private $idOrdenes="";


	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->idEquipo=$data['idEquipo'];
		$this->fecha_solicitud=$data['fecha_solicitud'];
		$this->servicio=$data['servicio'];
		$this->idOrdenes=$data['idOrdenes'];
		//$this->fecha_servicio=$data['fecha_servicio'];
    //$this->descripcion=$data['descripcion'];
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

	public function getServicio()
    {
		return $this->servicio;
	}

    public function setServicio($fecha)
    {
		$this->servicio=$fecha;
	}

	public function getFechaServicio()
    {
		return $this->fecha_servicio;
	}

    public function setFechaServicio($fecha)
    {
		$this->fecha_servicio=$fecha;
	}


  public function getFechaSolicitud()
    {
		return $this->fecha_solicitud;
	}

    public function setFechaSolicitud($fecha)
    {
		$this->fecha_solicitud=$fecha;
	}

  public function getDescripcion()
    {
		return $this->descripcion;
	}

    public function setDescripcion($descripcion)
    {
		$this->descripcion=$descripcion;
	}


	 public function getEstado()
    {
		return $this->estado;
	}

    public function setEstado($estado)
    {
		$this->estado=$estado;
	}

	 public function getIdResponsable()
    {
		return $this->idResponsable;
	}

    public function setIdResponsable($idResponsable)
    {
		$this->idResponsable=$idResponsable;
	}

	public function getIdCotizacion()
	 {
	 return $this->idCotizacion;
 }

	 public function setIdCotizacion($idCotizacion)
	 {
	 $this->idCotizacion=$idCotizacion;
 }


	public function getCodigoservicio()
	 {
	 return $this->$codigoServicio;
 }

	 public function setCodigoServicio($codigoServicio)
	 {
	 $this->codigoServicio=$codigoServicio;
 }

 public function getIdOrdenes()
 {
 return $this->$idOrdenes;
}

 public function setIdOrdenes($idOrdenes)
 {
 $this->idOrdenes=$idOrdenes;
}


  public function getValor(){
	 return	$this->valor;
	}



    public function insert()
    	{
        $this->db->set('idEquipo', $this->idEquipo);
        $this->db->set('fecha_solicitud', $this->fecha_solicitud);
        $this->db->set('servicio', $this->servicio);
        $this->db->set('descripcion', $this->descripcion);
        $this->db->set('idOrdenes', $this->idOrdenes);
        $this->db->insert('solicitud');
        return $this->db->insert_id();
    	}

		public function update(){
			$this->db->set('idEquipo', $this->idEquipo);
	        $this->db->set('fecha_solicitud', $this->fecha_solicitud);
	        $this->db->set('servicio', $this->servicio);
	        $this->db->set('descripcion', $this->descripcion);
			$this->db->where("id",  $this->id);
			$this->db->update('solicitud');

		}



		public function estadoservicio(){

  			$this->db->set('idResponsable',  $this->idResponsable);
  			$this->db->set('estado',  $this->estado );
  			$this->db->where('id',  $this->id );
  			$this->db->update('solicitud');
		}


	public function serviciofinalizado(){

  			$this->db->set('idResponsable',  $this->idResponsable);
  			$this->db->set('fecha_servicio', $this->fecha_servicio);
  			$this->db->set('estado',  $this->estado );
  			$this->db->where('id',  $this->id );
  			$this->db->update('solicitud');
		}

       public function selectAllService()
       {
    	 	$query=$this->db->select('solicitud.*,
    	 		CONCAT(equipo.marca,"-",equipo.modelo) as MarcaModelo,
    	 							equipo.serial as serial,clasificacion.nombre as equipo,
    	 							  laboratorio.nombre as Dependencia,
        								cliente.razonSocial as Cliente')
                         ->from('solicitud')
                      	 ->join('equipo','solicitud.idEquipo = equipo.id')
                      	 ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
						 ->join('ordenes','ordenes.id=solicitud.idOrdenes')
						 ->join ('laboratorio','equipo.idLaboratorio = laboratorio.id')
                         ->join('cliente',' laboratorio.idCliente = cliente.id')
						 ->where('ordenes.estado', 2)
						 ->where(['solicitud.mostrar' => '1'])
						 ->order_by('solicitud.id','DESC')
                         ->get();
     	return $query->custom_result_object("SolicitudModel");
       }

			 public function selectServiceP()
			 {
			
			$variables = array(0,1)	;
			$query=$this->db->select('solicitud.*, ordenes.id as idOrden,
				 CONCAT(equipo.marca,"-",equipo.modelo) as MarcaModelo,
									 equipo.serial as serial,clasificacion.nombre as equipo,
									 equipo.codigo as codigo,
										 laboratorio.nombre as Dependencia,
											 cliente.razonSocial as Cliente')
												 ->from('solicitud')
												->join('equipo','solicitud.idEquipo = equipo.id')
												->join('clasificacion','clasificacion.id = equipo.idClasificacion')
						->join('ordenes','ordenes.id=solicitud.idOrdenes')
						->join ('laboratorio','equipo.idLaboratorio = laboratorio.id')
												 ->join('cliente',' laboratorio.idCliente = cliente.id')
						->where('ordenes.estado', 2)
						->where_in('solicitud.estado' , $variables)	
						->where(['solicitud.mostrar' => '1'])
						->order_by('solicitud.id','DESC')
												 ->get();
			 return $query->custom_result_object("SolicitudModel");
			 }

			 public function selectServiceF()
			{

			$variables = array(5,6)	;
			$query=$this->db->select('solicitud.*, ordenes.id as idOrden,
				CONCAT(equipo.marca,"-",equipo.modelo) as MarcaModelo,
									equipo.serial as serial,clasificacion.nombre as equipo,
									equipo.codigo as codigo,
										laboratorio.nombre as Dependencia,
										CONCAT(usuario.nombre," ",usuario.apellidos) as Tecnico,
											cliente.razonSocial as Cliente')
												->from('solicitud')
											 ->join('equipo','solicitud.idEquipo = equipo.id')
											 ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
					 ->join('ordenes','ordenes.id=solicitud.idOrdenes')
					 ->join('usuario','solicitud.idResponsable = usuario.id','left')
					 ->join ('laboratorio','equipo.idLaboratorio = laboratorio.id')
												->join('cliente',' laboratorio.idCliente = cliente.id')
					 ->where_in('solicitud.estado' , $variables)							
					 ->where('ordenes.estado', 2)
					 ->where(['solicitud.mostrar' => '1'])
					 ->order_by('solicitud.id','DESC')
												->get();
			return $query->custom_result_object("SolicitudModel");
			}

			public function selectServiceE()
			{
		   
		   $variables = array(2,3,4)	;
		   $query=$this->db->select('solicitud.*, ordenes.id as idOrden,
				CONCAT(equipo.marca,"-",equipo.modelo) as MarcaModelo,
									equipo.serial as serial,clasificacion.nombre as equipo,
									equipo.codigo as codigo,
										laboratorio.nombre as Dependencia,
										CONCAT(usuario.nombre," ",usuario.apellidos) as Tecnico,
											cliente.razonSocial as Cliente')
												->from('solicitud')
											   ->join('equipo','solicitud.idEquipo = equipo.id')
											   ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
					   ->join('ordenes','ordenes.id=solicitud.idOrdenes')
					   ->join('usuario','solicitud.idResponsable = usuario.id','left')
					   ->join ('laboratorio','equipo.idLaboratorio = laboratorio.id')
												->join('cliente',' laboratorio.idCliente = cliente.id')
					   ->where('ordenes.estado', 2)
					   ->where_in('solicitud.estado' , $variables)	
					   ->where(['solicitud.mostrar' => '1'])
					   ->order_by('solicitud.id','DESC')
												->get();
			return $query->custom_result_object("SolicitudModel");
			}


			 public function selectOneService($id)
			 {
			 $query=$this->db->select('solicitud.*,
				 CONCAT(equipo.marca,"-",equipo.modelo) as MarcaModelo,
									 equipo.serial as serial,clasificacion.nombre as equipo,
									 equipo.codigo as codigo		 ')
												 ->from('solicitud')
												->join('equipo','solicitud.idEquipo = equipo.id')
												->join('clasificacion','clasificacion.id = equipo.idClasificacion')
												->where('solicitud.idOrdenes', $id)
												->where(['solicitud.mostrar' => '1'])
												 ->get();
			 return $query->custom_result_object("SolicitudModel");
			 }


			  public function equipoInfo($id)
       {
    	 	$query=$this->db->select('CONCAT(equipo.marca,"-",equipo.modelo) as MarcaModelo,
    	 							equipo.serial as serial,clasificacion.nombre as equipo,
									equipo.codigo as Codigointerno,
    	 							equipo.funcional as Estado,
    	 							  laboratorio.nombre as Dependencia,
        								cliente.razonSocial as Cliente')
                         ->from('solicitud')
                      	 ->join('equipo','solicitud.idEquipo = equipo.id')
                      	 ->join('clasificacion','clasificacion.id = equipo.idClasificacion')
						 ->join('ordenes','ordenes.id=solicitud.idOrdenes')
						 ->join ('laboratorio','equipo.idLaboratorio = laboratorio.id')
                         ->join('cliente',' laboratorio.idCliente = cliente.id')
						 ->where('ordenes.estado', 2)
						 ->where(['solicitud.mostrar' => '1'])
						 ->where('solicitud.id', $id)
                         ->get();
     	return $query->custom_result_object("SolicitudModel");
       }



public function deleteAllService($id){

	$query=$this->db->where('solicitud.idOrdenes', $id)
									->delete('solicitud');

}

			 public function selectAll($id)
		{
		 $query=$this->db->select('solicitud.* , solicitud.idOrdenes as Servicio, solicitud.id as Trabajo')
											->from('solicitud')
											->where('idEquipo',$id)
											->where(['solicitud.mostrar' => '1'])
											->where(['solicitud.estado' => '5'])
											->get();
	 return $query->custom_result_object("SolicitudModel");
		}


			 public function selectOne($id)
		{
		 $query=$this->db->select('solicitud.*')
											->from('solicitud')
											->where('id',$id)
											->where(['solicitud.mostrar' => '1'])
											->get();
	 return $query->custom_result_object("SolicitudModel");
		}

		public function selectOneOrden($idOrden)
 {
	$query=$this->db->select('solicitud.*')
									 ->from('solicitud')
									 ->where(['solicitud.mostrar' => '1'])
									 ->where('idOrdenes',$idOrden)
									 ->get();
return $query->custom_result_object("SolicitudModel");
 }

 public function selectServiceEquipo($id)
 {
 $query=$this->db->select('solicitud.*,
	 CONCAT(equipo.marca,"-",equipo.modelo) as MarcaModelo,
						 equipo.serial as serial,clasificacion.nombre as equipo	,
						 equipo.codigo as codigo		 ')
									 ->from('solicitud')
									->join('equipo','solicitud.idEquipo = equipo.id')
									->join('clasificacion','clasificacion.id = equipo.idClasificacion')
									->where('equipo.id', $id)
									 ->get();
 return $query->custom_result_object("SolicitudModel");
 }
 
 public function selectServiceEquipoPendientes($id)
 {
	$variables = array(0,1,2,3,4);

 $query=$this->db->select('solicitud.*,
	 CONCAT(equipo.marca,"-",equipo.modelo) as MarcaModelo,
						 equipo.serial as serial,clasificacion.nombre as equipo	,
						 equipo.codigo as codigo		 ')
									 ->from('solicitud')
									->join('equipo','solicitud.idEquipo = equipo.id')
									->join('clasificacion','clasificacion.id = equipo.idClasificacion')
									->where('equipo.id', $id)
									->where_in('solicitud.estado', $variables)
									 ->get();
 return $query->custom_result_object("SolicitudModel");
 }

			public function selectAllCotizacion($id)
			{
			  $query=$this->db->select('clasificacion.id as idNombre,
clasificacion.nombre as nombre,
solicitud.servicio as servicio,
count(DISTINCT equipo.id) as cantidadEquipos,
(CASE
	WHEN solicitud.valor is not NULL THEN solicitud.valor
	WHEN  solicitud.valor is NULL THEN
(CASE
    WHEN administrarservicio.variable is not NULL THEN variable.precioPublico
    WHEN administrarservicio.variable is NULL THEN administrarservicio.precioPublico
END)
END) as valor,
(CASE
    WHEN administrarservicio.variable is not NULL THEN variable.precioPiso
    WHEN administrarservicio.variable is NULL THEN administrarservicio.precioPiso
END) as piso,
administrarservicio.unidadMedida as Medida,
AVG(iva) as iva,
SUM(solicitud.cantidadCobrar) as cantidadTotal, 
solicitud.cantidadCobrar as cantidad')
			                  ->from('solicitud')
												->join('equipo','solicitud.idEquipo = equipo.id')
												->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
												->join('cliente','cliente.id = laboratorio.idCliente')
												->join('clasificacion','clasificacion.id = equipo.idClasificacion')
											->join('administrarservicio','STRCMP(TRIM(SUBSTRING_INDEX(solicitud.servicio, "-", 1)),administrarservicio.nombre) = 0','left')
		
											->join('variable','STRCMP(TRIM(SUBSTRING_INDEX(solicitud.servicio, "-", -1)),variable.titulo) = 0','left')
											->join('ordenes','ordenes.id = solicitud.idOrdenes')
												->where(['solicitud.idCotizacion' => NULL])
												->where(['solicitud.mostrar' => '1'])
												->where("ordenes.id",$id)
												->group_by(['clasificacion.nombre', 'solicitud.servicio'])
												
			                  ->get();
			      	return $query->result();
			}

			public function selectEquiposCotizados($id)
			{
			  $query=$this->db->distinct()
												->select('equipo.*, clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial as cliente, cliente.id as idCliente')
			                  ->from('solicitud')
												->join('equipo','solicitud.idEquipo = equipo.id')
												->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
				  							->join('cliente','cliente.id = laboratorio.idCliente')

												->join('clasificacion','clasificacion.id = equipo.idClasificacion')
												->join('ordenes','ordenes.id = solicitud.idOrdenes')
												->where(['solicitud.idCotizacion' => $id])
												->where(['solicitud.mostrar' => '1'])
												->order_by("laboratorio.nombre")
			                  ->get();
			      	return $query->result();
			}

			public function selectByCotizacion($id)
			{
				$query=$this->db->select('clasificacion.id as idNombre,
clasificacion.nombre as nombre,
solicitud.servicio as servicio,
count(*) as cantidadEquipos,
solicitud.valor as valor,
administrarservicio.unidadMedida as Medida,
AVG(iva) as iva,
SUM(solicitud.cantidadCobrar) as cantidadTotal, 
solicitud.cantidadCobrar as cantidad,
equipo.marca as marca , 
equipo.serial as serial,
equipo.codigo as codigo , 
equipo.modelo as modelo, 
laboratorio.nombre as laboratorio')
			                  ->from('solicitud')
												->join('equipo','solicitud.idEquipo = equipo.id')
												->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
	//											->join('cliente','cliente.id = laboratorio.idCliente')

	->join('administrarservicio','STRCMP(TRIM(SUBSTRING_INDEX(solicitud.servicio, "-", 1)),administrarservicio.nombre) = 0','left')
	->join('variable','STRCMP(TRIM(SUBSTRING_INDEX(solicitud.servicio, "-", -1)),variable.titulo) = 0','left')
												->join('clasificacion','clasificacion.id = equipo.idClasificacion')
												->where(['solicitud.idCotizacion' => $id])							
												->where(['solicitud.mostrar' => '1'])
												->group_by(['equipo.serial', 'solicitud.servicio'])
												->order_by('laboratorio','ASC')
												->order_by('equipo.serial','ASC')
												->order_by('servicio','ASC')
												
			                  ->get();
			      	return $query->result();
			}

			public function updatePrices($valor, $cantidadCotizar,$iva,$id){
				$query=$this->db->select('equipo.*')
												->from('equipo')
												->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
												->join('ordenes','ordenes.idCliente = laboratorio.idCliente')
												->where('equipo.idClasificacion', $this->idEquipo)												
												->where("ordenes.id",$id)

												->get();
				$afectados = $query->custom_result_object("EquipoModel");
				$idequipo = [];
				foreach ($afectados as  $equipo) {
					$idequipo[] = $equipo->getId();
				}
				$this->db->set('solicitud.iva', $iva);
				$this->db->set('solicitud.valor', $valor);
				$this->db->set('solicitud.cantidadCobrar', $cantidadCotizar);
				$this->db->where('REPLACE(solicitud.servicio," ","") like', $this->servicio);
				$this->db->where_in('solicitud.idEquipo', $idequipo);
				$this->db->where(['idCotizacion' => NULL]);
				$this->db->where(['solicitud.mostrar' => '1']);
				$this->db->update('solicitud');
			}

			public function updatePricesDefault($cantidadCotizar,$idcliente,$idOrden){
				$query=$this->db->select('equipo.*')
												->from('equipo')
												->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
												->where('equipo.idClasificacion', $this->idEquipo)
												->where("laboratorio.idCliente",$idcliente)

												->get();
				$afectados = $query->custom_result_object("EquipoModel");

				$query2=$this->db->select('solicitud.servicio, (CASE
    												WHEN administrarservicio.variable is not NULL THEN variable.precioPublico
    												WHEN administrarservicio.variable is NULL THEN administrarservicio.precioPublico
														END) as valor')
											->from('solicitud')
											->join('administrarservicio','STRCMP(TRIM(SUBSTRING_INDEX(solicitud.servicio, "-", 1)),administrarservicio.nombre) = 0','left')
 											->join('variable','STRCMP(TRIM(SUBSTRING_INDEX(solicitud.servicio, "-", -1)),variable.titulo) = 0','left')
											//->where("solicitud.servicio",$this->servicio)
											->get();
				$preciosdefecto = $query2->custom_result_object("SolicitudModel");
				$idprecios = [];
				foreach ($preciosdefecto as  $precios) {
					$idprecios[] = $precios->getValor();
				}

				$idequipo = [];
				foreach ($afectados as  $equipo) {
					$idequipo[] = $equipo->getId();
				}

				$this->db->set('solicitud.iva', 19);
				$this->db->set('solicitud.valor', $idprecios[0]);
				$this->db->set('solicitud.cantidadCobrar', $cantidadCotizar);
				$this->db->where('REPLACE(solicitud.servicio," ","") like', $this->servicio);
				$this->db->where(['solicitud.valor' => NULL]);
				$this->db->where_in('solicitud.idEquipo', $idequipo);
				$this->db->update('solicitud');
			}

			public function colocarCotizacion($id){
				$query=$this->db->select('equipo.*')
												->from('equipo')
												->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
												->join('ordenes','ordenes.idCliente = laboratorio.idCliente')
												->where("ordenes.id",$id)
												->get();
				$afectados = $query->custom_result_object("EquipoModel");
				$idequipo = [];
				foreach ($afectados as  $equipo) {
					$idequipo[] = $equipo->getId();
				}

				$this->db->set('idCotizacion',$id);
				$this->db->where(['idCotizacion' => NULL]);
				$this->db->where('solicitud.valor !=', 0);
				$this->db->where_in('solicitud.idEquipo', $idequipo);
				$this->db->update('solicitud');

			}



			public function selectPreviewCotizacion($id)
			{
				$query=$this->db->select('clasificacion.id as idNombre,  clasificacion.nombre as nombre,
													solicitud.servicio as servicio, count(*) as cantidadEquipos,administrarservicio.unidadMedida as Medida,
													 AVG(valor) as valor, AVG(iva) as iva, SUM(solicitud.cantidadCobrar) as cantidadTotal, ,solicitud.cantidadCobrar as cantidad,
													 equipo.marca as marca , equipo.serial as serial, equipo.modelo as modelo, equipo.codigo as codigo ,laboratorio.nombre as laboratorio')
												->from('solicitud')
												->join('equipo','solicitud.idEquipo = equipo.id')
												->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
	//											->join('cliente','cliente.id = laboratorio.idCliente')
												->join('clasificacion','clasificacion.id = equipo.idClasificacion')
												->join('ordenes','solicitud.idOrdenes = ordenes.id ')
												->where(['solicitud.idCotizacion' => NULL])
												->where(['solicitud.mostrar' => '1'])
												->where(['ordenes.id' => $id])
												->join('administrarservicio','STRCMP(TRIM(SUBSTRING_INDEX(solicitud.servicio, "-", 1)),administrarservicio.nombre) = 0','left')
												->join('variable','STRCMP(TRIM(SUBSTRING_INDEX(solicitud.servicio, "-", -1)),variable.titulo) = 0','left')
												->where('solicitud.valor !=', 0)
												->group_by(['equipo.serial', 'solicitud.servicio'])
												->order_by('laboratorio','ASC')
												->order_by('equipo.serial','ASC')
												->order_by('servicio','ASC')
												->get();
							return $query->result();
			}


			public function selectEquiposCotizadosPreview($id)
			{
				$query=$this->db->distinct()
												->select('equipo.*, clasificacion.nombre as nombre, laboratorio.nombre as laboratorio, cliente.razonSocial as cliente')
												->from('solicitud')
												->join('equipo','solicitud.idEquipo = equipo.id')
												->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
												->join('cliente','cliente.id = laboratorio.idCliente')
												->join('clasificacion','clasificacion.id = equipo.idClasificacion')
												->join('ordenes','solicitud.idOrdenes = ordenes.id ')
												->where(['solicitud.mostrar' => '1'])
												->where(['solicitud.idCotizacion' => NULL])
												->where(['ordenes.id' => $id])
												->where('solicitud.valor !=', 0)
												->order_by("laboratorio.nombre")
												->get();
							return $query->result();
			}

		public function borrarSuave($id){
			$query=$this->db->select('equipo.*')
			->from('equipo')
			->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
			->where("laboratorio.idCliente",$id)
			->get();
$afectados = $query->custom_result_object("EquipoModel");
$idequipo = [];
foreach ($afectados as  $equipo) {
$idequipo[] = $equipo->getId();
}

$this->db->set('mostrar','0');
$this->db->where(['idCotizacion' => NULL]);
$this->db->where('solicitud.valor !=', 0);
$this->db->where_in('solicitud.idEquipo', $idequipo);
$this->db->update('solicitud');
		}

			public function validate()
	    {
	        $this->form_validation->set_rules('idServico', "Id", 'required',array('required'=>'El %s es un campo obligatorio'));
	        $this->form_validation->set_rules('Documento', "Archivo", 'required',array('required'=>'No agrego el %s  '));
					return $this->form_validation->run();
	    }



}
?>
