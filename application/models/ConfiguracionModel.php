<?php
class ConfiguracionModel extends CI_Model {

	private $id="";
	private $diaInventario="";
	private $diaVacaciones="";
  private $footerFactura="";
	private $observacionesCompra = '';
	private $observacionesCotizacion = '';
	private $footerCotizacion = '';
	private $observacionesPreforma= '';
	private $observacionesFactura= '';
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
		if(isset($data['id'])){$this->id=$data['id'];}
    if(isset($data['diaInventario'])){$this->diaInventario=$data['diaInventario'];}
    if(isset($data['diaVacaciones'])){$this->diaVacaciones=$data['diaVacaciones'];}
    if(isset($data['footerFactura'])){$this->footerFactura=$data['footerFactura'];}
		if(isset($data['observacionesCompra'])){$this->observacionesCompra=$data['observacionesCompra'];}
		if(isset($data['observacionesCotizacion'])){$this->observacionesCotizacion=$data['observacionesCotizacion'];}
		if(isset($data['observacionesFactura'])){$this->observacionesFactura=$data['observacionesFactura'];}
		if(isset($data['observacionesPreforma'])){$this->observacionesPreforma=$data['observacionesPreforma'];}
		if(isset($data['footerCotizacion'])){$this->footerCotizacion=$data['footerCotizacion'];}
  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getObservacionesFactura()
		{
		return $this->observacionesFactura;
	}

		public function setObservacionesFactura($obersvacionesFactura)
		{
		$this->observacionesFactura=$obersvacionesFactura;
	}

	public function getObservacionesPreforma()
		{
		return $this->observacionesPreforma;
	}

		public function setObservacionesPreforma($obersvacionesPreforma)
		{
		$this->observacionesPreforma=$obersvacionesPreforma;
	}


	public function getObservacionesCotizacion()
		{
		return $this->observacionesCotizacion;
	}

		public function setObservacionesCotizacion($obersvacionesCotizacion)
		{
		$this->observacionesCotizacion=$obersvacionesCotizacion;
	}

	public function getObservacionesCompra()
		{
		return $this->observacionesCompra;
	}

		public function setObservacionesCompra($obersvacionesCompra)
		{
		$this->observacionesCompra=$obersvacionesCompra;
	}

	public function getFooterCotizacion()
		{
		return $this->footerCotizacion;
	}

		public function setFooterCotizacion($footerCotizacion)
		{
		$this->footerCotizacion=$footerCotizacion;
	}

	public function getFooterFactura()
		{
		return $this->footerFactura;
	}

		public function setFooterFactura($footerFactura)
		{
		$this->footerFactura=$footerFactura;
	}

	public function getDiaInventario()
    {
		return $this->diaInventario;
	}

    public function setDiaInventario($diaInventario)
    {
		$this->diaInventario=$diaInventario;
	}

	public function getDiaVacaciones()
    {
		return $this->diaVacaciones;
	}

    public function setDiaVacaciones($diaVacaciones)
    {
		$this->diaVacaciones=$diaVacaciones;
	}

      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('configuracion');
    		return $query->custom_result_object("ConfiguracionModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->where("id",$id)
                        ->from('configuracion')
                        ->get();
    		$rs= $query->custom_result_object("ConfiguracionModel");
return $rs[0];
      }

			public function updateFormatos()
	    	{
			    $this->db->set('footerFactura',$this->footerFactura);
					$this->db->set('observacionesCompra',$this->observacionesCompra);
					$this->db->set('observacionesCotizacion',$this->observacionesCotizacion);
					$this->db->set('observacionesFactura',$this->observacionesFactura);
					$this->db->set('observacionesPreforma',$this->observacionesPreforma);
					$this->db->set('footerCotizacion',$this->footerCotizacion);
					$this->db->where('id', 1);
					$this->db->update('configuracion');
				}

				public function updateFechas(){
					$this->db->set('diaInventario',$this->diaInventario);
					$this->db->set('diaVacaciones',$this->diaVacaciones);
					$this->db->where('id', 1);
					$this->db->update('configuracion');
				}

}
?>
