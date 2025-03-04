<?php

class ProductoModel extends CI_Model
{

    private $id = "";
    private $nombre = "";
    private $tipo = "";
    private $codProveedor = "";
    private $codigoInterno = "";
    private $unidadNegocio = "";
    private $unidadMedida = "";
    private $presentacionSalida = "";
    private $presentacionEntrada = "";
    private $cantidadSalida = "";
    private $cantidadEntrada = "";
    private $posicion = "";
    private $gravamenArancelario = "";
    private $gravamenIva = "";
    private $notasInteres = "";
    private $fechaCreacion = "";
    private $iva = "";
    private $peso = "";
    private $activo = "";
    private $marca = "";
    private $modelo = "";
    private $precioPiso = "";
    private $precioTecho = "";
    private $idEstablecimiento = "";
    private $CantidadInventario = "";

    public function getIdEstablecimiento()
    {
        return $this->idEstablecimiento;
    }

    /**
     * @param string $id
     */
    public function setIdEstablecimiento($idEstablecimiento)
    {
        $this->idEstablecimiento = $idEstablecimiento;
    }

    /**
     * @return string
     */
    public function getCantidadInventario()
    {
        return $this->CantidadInventario;
    }

    /**
     * @param string $id
     */
    public function setCantidadInventario($CantidadInventario)
    {
        $this->CantidadInventario = $CantidadInventario;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPrecioTecho()
    {
        return $this->precioTecho;
    }

    /**
     * @param string $precioMin
     */
    public function setPrecioTecho($precioTecho)
    {
        $this->precioTecho = $precioTecho;
    }

    public function getPrecioPiso()
    {
        return $this->precioPiso;
    }

    /**
     * @param string $precioMin
     */
    public function setPrecioPiso($precioPiso)
    {
        $this->precioPiso = $precioPiso;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getCodProveedor()
    {
        return $this->codProveedor;
    }

    /**
     * @param string $codProveedor
     */
    public function setCodProveedor($codProveedor)
    {
        $this->codProveedor = $codProveedor;
    }

    /**
     * @return string
     */
    public function getCodigoInterno()
    {
        return $this->codigoInterno;
    }

    /**
     * @param string $codigoInterno
     */
    public function setCodigoInterno($codigoInterno)
    {
        $this->codigoInterno = $codigoInterno;
    }

    /**
     * @return string
     */
    public function getUnidadNegocio()
    {
        return $this->unidadNegocio;
    }

    /**
     * @param string $unidadNegocio
     */
    public function setUnidadNegocio($unidadNegocio)
    {
        $this->unidadNegocio = $unidadNegocio;
    }

    /**
     * @return string
     */
    public function getUnidadMedida()
    {
        return $this->unidadMedida;
    }

    /**
     * @param string $unidadMedida
     */
    public function setUnidadMedida($unidadMedida)
    {
        $this->unidadMedida = $unidadMedida;
    }

    /**
     * @return string
     */
    public function getPresentacionSalida()
    {
        return $this->presentacionSalida;
    }

    /**
     * @param string $presentacionSalida
     */
    public function setPresentacionSalida($presentacionSalida)
    {
        $this->presentacionSalida = $presentacionSalida;
    }

    /**
     * @return string
     */
    public function getPresentacionEntrada()
    {
        return $this->presentacionEntrada;
    }

    /**
     * @param string $presentacionEntrada
     */
    public function setPresentacionEntrada($presentacionEntrada)
    {
        $this->presentacionEntrada = $presentacionEntrada;
    }

    /**
     * @return string
     */
    public function getCantidadSalida()
    {
        return $this->cantidadSalida;
    }

    /**
     * @param string $cantidadSalida
     */
    public function setCantidadSalida($cantidadSalida)
    {
        $this->cantidadSalida = $cantidadSalida;
    }

    /**
     * @return string
     */
    public function getPosicion()
    {
        return $this->posicion;
    }

    /**
     * @param string $posicion
     */
    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;
    }

    /**
     * @return string
     */
    public function getCantidadEntrada()
    {
        return $this->cantidadEntrada;
    }

    /**
     * @param string $cantidadEntrada
     */
    public function setCantidadEntrada($cantidadEntrada)
    {
        $this->cantidadEntrada = $cantidadEntrada;
    }

    /**
     * @return string
     */
    public function getGravamenArancelario()
    {
        return $this->gravamenArancelario;
    }

    /**
     * @param string $gravamenArancelario
     */
    public function setGravamenArancelario($gravamenArancelario)
    {
        $this->gravamenArancelario = $gravamenArancelario;
    }

    /**
     * @return string
     */
    public function getGravamenIva()
    {
        return $this->gravamenIva;
    }

    /**
     * @param string $gravamenIva
     */
    public function setGravamenIva($gravamenIva)
    {
        $this->gravamenIva = $gravamenIva;
    }

    /**
     * @return string
     */
    public function getNotasInteres()
    {
        return $this->notasInteres;
    }

    /**
     * @param string $notasInteres
     */
    public function setNotasInteres($notasInteres)
    {
        $this->notasInteres = $notasInteres;
    }

    /**
     * @return string
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param string $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * @return string
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * @param string $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * @return string
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * @param string $peso
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    /**
     * @return string
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param string $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }


    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param string $activo
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param string $activo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $data['id'] = $this->id;
        $data['nombre'] = $this->nombre;
        $data['tipo'] = $this->tipo;
        //    $this->codProveedor =$data['codProveedor'];
        $data['codigoInterno'] = $this->codigoInterno;
        $data['unidadNegocio'] = $this->unidadNegocio;
        $data['unidadMedida'] = $this->unidadMedida;
        $data['presentacionSalida'] = $this->presentacionSalida;
        $data['presentacionEntrada'] = $this->presentacionEntrada;
        $data['cantidadSalida'] = $this->cantidadSalida;
        $data['cantidadEntrada'] = $this->cantidadEntrada;
        $data['posicion'] = $this->posicion;
        $data['gravamenArancelario'] = $this->gravamenArancelario;
        $data['gravamenIva'] = $this->gravamenIva;
        $data['notasInteres'] = $this->notasInteres;
        $data['fechaCreacion'] = $this->fechaCreacion;
        $data['idEstablecimiento'] = $this->idEstablecimiento;
        $data['iva'] = $this->iva;
        $data['marca'] = $this->marca;
        $data['modelo'] = $this->modelo;
        $data['peso'] = $this->peso;
        $data['activo'] = $this->activo;
        return $data;
    }


    public function setData($data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->nombre = $data['nombre'];
        $this->tipo = $data['tipo'];
//    $this->codProveedor =$data['codProveedor'];
        if (isset($data['codigoInterno'])) {
            $this->codigoInterno = $data['codigoInterno'];
        }
        $this->unidadNegocio = $data['unidadNegocio'];
        $this->unidadMedida = $data['unidadMedida'];
        if (isset($data['presentacionSalida'])) {
            $this->presentacionSalida = $data['presentacionSalida'];
        }
        if (isset($data['presentacionEntrada'])) {
            $this->presentacionEntrada = $data['presentacionEntrada'];
        }
        if (isset($data['cantidadSalida'])) {
            $this->cantidadSalida = $data['cantidadSalida'];
        }
        if (isset($data['cantidadEntrada'])) {
            $this->cantidadEntrada = $data['cantidadEntrada'];
        }
        if (isset($data['posicion'])) {
            $this->posicion = $data['posicion'];
        }
        if (isset($data['gravamenArancelario'])) {
            $this->gravamenArancelario = $data['gravamenArancelario'];
        }
        if (isset($data['gravamenIva'])) {
            $this->gravamenIva = $data['gravamenIva'];
        }
        if (isset($data['notasInteres'])) {
            $this->notasInteres = $data['notasInteres'];
        }
        if (isset($data['fechaCreacion'])) {
            $this->fechaCreacion = $data['fechaCreacion'];
        }
        if (isset($data['idEstablecimiento'])) {
            $this->idEstablecimiento = $data['idEstablecimiento'];
        }
        $this->iva = $data['iva'];
        $this->marca = $data['marca'];
        $this->modelo = $data['modelo'];
        $this->peso = $data['peso'];


        if (isset($data['activo'])) {
            $this->activo = $data['activo'];
        }
    }


    public function insert()
    {
        $this->codigoInterno = $this->generateCodigoInterno($this->unidadNegocio);
        $today = getdate();
        $hoy = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"];

        $this->db->set('idEstablecimiento', $this->idEstablecimiento);
        $this->db->set('nombre', $this->nombre);
        $this->db->set('tipo', $this->tipo);
        //    $this->db->set('codProveedor', $this->codProveedor);
        $this->db->set('codigoInterno', $this->codigoInterno);
        $this->db->set('unidadNegocio', $this->unidadNegocio);
        $this->db->set('unidadMedida', $this->unidadMedida);
        $this->db->set('presentacionSalida', $this->presentacionSalida, FALSE);
        $this->db->set('presentacionEntrada', $this->presentacionEntrada, FALSE);
        $this->db->set('cantidadSalida', $this->cantidadSalida);
        $this->db->set('cantidadEntrada', $this->cantidadEntrada);
        $this->db->set('posicion', $this->posicion);
        $this->db->set('gravamenArancelario', $this->gravamenArancelario);
        $this->db->set('gravamenIva', $this->gravamenIva);
        $this->db->set('notasInteres', $this->notasInteres);
        $this->db->set('fechaCreacion', $hoy);
        $this->db->set('iva', $this->iva);
        $this->db->set('peso', $this->peso);
        $this->db->set('marca', $this->marca);
        $this->db->set('modelo', $this->modelo);
        $this->db->set('precioTecho', 0);
        $this->db->set('precioPiso', 0);
        $this->db->set('activo', 1);
        $this->db->insert('producto');
    }

    public function update()
    {
        $this->db->set('nombre', $this->nombre);
        $this->db->set('tipo', $this->tipo);
        //    $this->db->set('codProveedor', $this->codProveedor);
        $this->db->set('idEstablecimiento', $this->idEstablecimiento);
        $this->db->set('unidadNegocio', $this->unidadNegocio);
        $this->db->set('unidadMedida', $this->unidadMedida);
        $this->db->set('presentacionSalida', $this->presentacionSalida);
        $this->db->set('presentacionEntrada', $this->presentacionEntrada);
        $this->db->set('cantidadSalida', $this->cantidadSalida);
        $this->db->set('cantidadEntrada', $this->cantidadEntrada);
        $this->db->set('posicion', $this->posicion);
        $this->db->set('gravamenArancelario', $this->gravamenArancelario);
        $this->db->set('gravamenIva', $this->gravamenIva);
        $this->db->set('notasInteres', $this->notasInteres);
        $this->db->set('fechaCreacion', $this->fechaCreacion);
        $this->db->set('iva', $this->iva);
        $this->db->set('peso', $this->peso);
        $this->db->set('activo', $this->activo);
        $this->db->set('marca', $this->marca);
        $this->db->set('modelo', $this->modelo);
        $this->db->where("id", $this->id);
        $this->db->update('producto');
    }

    public function selectAll()
    {
        $query = $this->db->select('producto.*,
        														Entrada.nombre as presentacionEntrada,
        														Salida.nombre as presentacionSalida,
        														unidadmedida.nombre as unidadMedida,
        														unidadnegocio.nombre as unidadNegocio,
        														(sum(lote.cantidad * lote.cantidadEntrada) )/ producto.cantidadSalida as CantidadInventario,
        														min(lote.fechaVencimiento) as fechaVencimiento
        													')
            ->from('producto')
            ->where('producto.tipo !=', 'Servicio')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("lote", "producto.id=lote.idProducto")
            ->group_by("producto.id")
            ->get();
        $ans1 = $query->custom_result_object("ProductoModel");
        $query = $this->db->select('producto.*,
          										Entrada.nombre as presentacionEntrada,
          										Salida.nombre as presentacionSalida,
          										unidadmedida.nombre as unidadMedida,
          										unidadnegocio.nombre as unidadNegocio,
          										(sum(equipo.cantidad * equipo.cantidadEntrada)) / producto.cantidadSalida as CantidadInventario,
          										"No tiene" as fechaVencimiento
          									')
            ->from('producto')
            ->where('producto.tipo !=', 'Servicio')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("equipo", "producto.id=equipo.idProducto")
            ->group_by("producto.id")
            ->get();
        $ans2 = $query->custom_result_object("ProductoModel");
        $ans = array_merge($ans1, $ans2);
        $query = $this->db->select('producto.*,
        														Entrada.nombre as presentacionEntrada,
        														Salida.nombre as presentacionSalida,
        														unidadmedida.nombre as unidadMedida,
        														unidadnegocio.nombre as unidadNegocio,
        														sum(detallepedido.cantidad * detallepedido.cantidadSalida) / producto.cantidadSalida   as CantidadInventario,
        	                          "No aplica" as fechaVencimiento
        													')
            ->where('pedido.estado >', 1)
            ->where('producto.tipo !=', 'Servicio')
            ->from('producto')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("detallepedido", "producto.id=detallepedido.idProducto")
            ->join("pedido", "pedido.id=detallepedido.idPedido")
            ->group_by("producto.id")
            ->get();
        $ans3 = $query->custom_result_object("ProductoModel");


        $query = $this->db->select('producto.*,
									Entrada.nombre as presentacionEntrada,
									Salida.nombre as presentacionSalida,
									unidadmedida.nombre as unidadMedida,
									unidadnegocio.nombre as unidadNegocio,
									sum(muestra.cantidad * muestra.cantidadSalida) / producto.cantidadSalida   as CantidadInventario,
									"No aplica" as fechaVencimiento')
            ->where('grupomuestras.estado >', 1)
            ->where('producto.tipo !=', 'Servicio')
            ->from('producto')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("muestra", "producto.id=muestra.idProducto")
            ->join("grupomuestras", "grupomuestras.id=muestra.idGrupo")
            ->group_by("producto.id")
            ->get();
        $ans4 = $query->custom_result_object("ProductoModel");
        $ans3 = array_merge($ans3, $ans4);
        foreach ($ans as $prod1) {
            foreach ($ans3 as $prod2) {
                if ($prod1->getId() == $prod2->getId()) {
                    $prod1->CantidadInventario = round($prod1->getCantidadInventario() - $prod2->getCantidadInventario(), 5);
                }
            }
        }

        $id = [-1];
        foreach ($ans as $p) {
            $id[] = $p->getId();
        }

        $query = $this->db->select('producto.*,
														Entrada.nombre as presentacionEntrada,
														Salida.nombre as presentacionSalida,
														unidadmedida.nombre as unidadMedida,
														unidadnegocio.nombre as unidadNegocio,
														0 as CantidadInventario,
														"no aplica" as fechaVencimiento
													')
            ->from('producto')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->where_not_in("producto.id", $id)
            ->get();
        $ans3 = $query->custom_result_object("ProductoModel");

        $ans = array_merge($ans, $ans3);


        $query = $this->db->select('productoxproveedor.*')
            ->from('productoxproveedor')
            ->get();
        $productoxproveedor = $query->result();
        $nuevos = [];
        foreach ($ans as $prod) {
            $prod->codProveedor = '';
            foreach ($productoxproveedor as $rela) {
                if ($prod->getId() == $rela->idProducto) {
                    if ($prod->codProveedor == '') {
                        $prod->codProveedor = $rela->CodProd;
                        $prod->costo = $rela->CodProd;
                    } else {
                        $nuevo = new ProductoModel();
                        $nuevo->setData($prod->getData());
                        $nuevo->CantidadInventario = $prod->CantidadInventario;
                        $nuevo->fechaVencimiento = $prod->fechaVencimiento;
                        $nuevo->costo = $prod->costo;
                        $nuevo->codProveedor = $rela->CodProd;
                        $nuevos[] = $nuevo;
                    }
                }
            }
        }
        $ans = array_merge($ans, $nuevos);
        return $ans;
    }


    public function selectCosto($id, $idProv)
    {
        $query = $this->db->select('productoxproveedor.costo as costo')
            ->where("productoxproveedor.idProducto", $id)
            ->where("productoxproveedor.idProveedor", $idProv)
            ->from('productoxproveedor')
            ->get();
        $costo = $query->result();
        if (count($costo) != 1) {
            return "error";
        } else {
            return $costo[0]->costo;
        }
    }
	
	
	
    public function selectInforme()
    {
        $query = $this->db->select('
		now(),
		producto.id,
		producto.nombre,
		producto.codigoInterno,
		CONCAT(Salida.nombre,"x", producto.cantidadSalida," ", unidadmedida.nombre) presentacionSalida,
        (sum(lote.cantidad * lote.cantidadEntrada) )/ producto.cantidadSalida as CantidadInventario
        													')
            ->from('producto')
            ->where('producto.tipo !=', 'Servicio')
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("lote", "producto.id=lote.idProducto")
            ->group_by("producto.id")
            ->get();
        $ans1 = $query->result();
        $query = $this->db->select('		now(),
		producto.id,
									producto.nombre,
		producto.codigoInterno,
		CONCAT(Salida.nombre,"x", producto.cantidadSalida," ", unidadmedida.nombre) presentacionSalida,
          										(sum(equipo.cantidad * equipo.cantidadEntrada)) / producto.cantidadSalida as CantidadInventario
          									')
            ->from('producto')
            ->where('producto.tipo !=', 'Servicio')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("equipo", "producto.id=equipo.idProducto")
            ->group_by("producto.id")
            ->get();
        $ans2 = $query->result();
        $ans = array_merge($ans1, $ans2);
        $query = $this->db->select('now(),
		producto.id,
									producto.nombre,
		producto.codigoInterno,
		CONCAT(Salida.nombre,"x", producto.cantidadSalida," ", unidadmedida.nombre) presentacionSalida,
        														sum(detallepedido.cantidad * detallepedido.cantidadSalida) / producto.cantidadSalida   as CantidadInventario
        													')
            ->where('pedido.estado >', 1)
            ->where('producto.tipo !=', 'Servicio')
            ->from('producto')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("detallepedido", "producto.id=detallepedido.idProducto")
            ->join("pedido", "pedido.id=detallepedido.idPedido")
            ->group_by("producto.id")
            ->get();
        $ans3 = $query->result();


        $query = $this->db->select('now(),
		producto.id,
									producto.nombre,
		producto.codigoInterno,
		CONCAT(Salida.nombre,"x", producto.cantidadSalida," ", unidadmedida.nombre) presentacionSalida,
									sum(muestra.cantidad * muestra.cantidadSalida) / producto.cantidadSalida   as CantidadInventario
									')
            ->where('grupomuestras.estado >', 1)
            ->where('producto.tipo !=', 'Servicio')
            ->from('producto')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("muestra", "producto.id=muestra.idProducto")
            ->join("grupomuestras", "grupomuestras.id=muestra.idGrupo")
            ->group_by("producto.id")
            ->get();
        $ans4 = $query->result();
        $ans3 = array_merge($ans3, $ans4);
		$idProducto = [ ];
		$prod = [];
        foreach ($ans as $prod1) {
            foreach ($ans3 as $prod2) {
                if ($prod1->id == $prod2->id) {
                    $prod1->CantidadInventario = round($prod1->CantidadInventario - $prod2->CantidadInventario, 5);
					if($prod1->CantidadInventario < 0){
						$prod1->CantidadInventario = -1 * $prod1->CantidadInventario;
						$prod[] = $prod1;
						$idProducto[] = $prod1->id;
					}else{
						
					}
				
				}
            }
        }
		if(count($idProducto)> 0){
			$query = $this->db->select('detallepedido.idProducto, detallepedido.idPedido, pedido.FechaSolicitud,  empleado.usuario empleado ,empleado.emailInst ')
            ->where('pedido.estado', 2)
            ->where_in("detallepedido.idProducto", $idProducto)
            ->from('pedido')
            ->join("detallepedido", "detallepedido.idPedido=pedido.id")
            ->join("empleado", "empleado.id=pedido.idEmpleado")
            ->get();	
		$data = $query->result();
		
		foreach ($prod as $prod1) {
            foreach ($data as $row) {
                if ($prod1->id == $row->idProducto) {
                    $prod1->idPedido  = $row->idPedido ;
					$prod1->FechaSolicitud  = $row->FechaSolicitud ;
					$prod1->empleado  = $row->empleado ;
					$prod1->emailInst  = $row->emailInst ;			
				}
            }
        }
		}
        return $prod;
		
	
    }



    public function selectProductoxProveedor($id, $idProv)
    {
        $query = $this->db->select('productoxproveedor.*')
            ->where("productoxproveedor.idProducto", $id)
            ->where("productoxproveedor.idProveedor", $idProv)
            ->from('productoxproveedor')
            ->get();
        $costo = $query->result();
        return $costo;
    }

    public function selectOne($id)
    {
        $query = $this->db->select('producto.*,
                                  proveedor.razonSocial,
                                  productoxproveedor.costo,
                                  productoxproveedor.divisa,
                                  productoxproveedor.CodProd,
                                  Entrada.nombre as presentacionEntradaT,
                                  Salida.nombre as presentacionSalidaT,
                                  unidadmedida.nombre as unidadMedidaT,
                                  unidadnegocio.nombre as unidadNegocioT
                                  ')
            ->where("producto.id", $id)
            ->from('producto')
            ->join("productoxproveedor", "producto.id=productoxproveedor.idProducto")
            ->join("proveedor", "proveedor.id=productoxproveedor.idProveedor")
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->get();
        $result = $query->custom_result_object("ProductoModel");
        if (count($result) === 0) {

            return "nada";
        }
        $prod = $result[0];
        $prod->razonSocials = [];
        $prod->costos = [];
        $prod->divisas = [];
        $prod->CodsProd = [];
        foreach ($result as $res) {
            $prod->razonSocials[] = $res->razonSocial;
            $prod->costos[] = $res->costo;
            $prod->divisas[] = $res->divisa;
            $prod->CodsProd[] = $res->CodProd;
        }
        unset($prod->razonSocial);
        unset($prod->costo);
        unset($prod->divisa);
        unset($prod->CodProd);
        if ($prod->getTipo() == "Compuesto") {
            $query = $this->db->select('producto.*, productocompuesto.cantidad as cantidad')
                ->where("productocompuesto.idProducto", $id)
                ->from('productocompuesto')
                ->join("producto", "producto.id=productocompuesto.subproducto")
                ->get();
            $result = $query->custom_result_object("ProductoModel");
            $prod->subproductos = $result;
        }

        return $prod;
    }

    public function selectId($nombre)
    {
        $query = $this->db->select('producto.*,
                                  Salida.nombre as presentacionSalida,
                                  unidadmedida.nombre as unidadMedida')
            ->where("producto.nombre", $nombre)
            ->from('producto')
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->get();
        return $query->custom_result_object("ProductoModel");
    }

    public function ruleUniqueName($nombre)
    {
        $query = $this->db->select('producto.*,
																	Salida.nombre as presentacionSalida,
																	unidadmedida.nombre as unidadMedida')
            ->where("producto.nombre", $nombre)
            ->where("producto.id !=", $this->id)
            ->where("producto.activo !=", '1')
            ->from('producto')
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->get();
        return count($query->custom_result_object("ProductoModel")) < 1;
    }


    public function validate($a)
    {

        if ($a) {
            $this->form_validation->set_rules('nombre', "nombre", 'required|is_unique[producto.nombre]', array('is_unique' => 'ese %s ya esta en uso', 'required' => 'El %s es un campo obligatorio'));
            # code...
        } else {
            $this->form_validation->set_rules('nombre', "nombre", array('required', array('uniqueRule', array($this, 'ruleUniqueName'))), array('required' => 'El %s es un campo obligatorio', 'uniqueRule' => 'ese %s ya esta en uso'));

        }

        $this->form_validation->set_rules('proveedorh', "Proveedores", 'required', array('required' => 'Agrege almenos un proveedor'));
        return $this->form_validation->run();
    }

    public function generateCodigoInterno($id)
    {
        $query = $this->db->select('max(id) as result')
            ->from('producto')
            ->get();
        $ans = $query->result();

        $unmodel = new UnidadNegocioModel();
        $un = $unmodel->selectOne($id);
        $result = $ans[0]->result + 1;
        return $un[0]->getSigla() . "-" . $result;
    }

    public function updatePrecio()
    {
        $this->db->set('precioPiso', $this->precioPiso);
        $this->db->set('precioTecho', $this->precioTecho);
        $this->db->where("id", $this->id);
        $this->db->update('producto');
    }


    public function selectRange($rango)
    {
        $query = $this->db->select('producto.*,
        														Entrada.nombre as presentacionEntrada,
        														Salida.nombre as presentacionSalida,
        														unidadmedida.nombre as unidadMedida,
        														unidadnegocio.nombre as unidadNegocio,
        														(sum(lote.cantidad * lote.cantidadEntrada) )/ producto.cantidadSalida as CantidadInventario,
        														min(lote.fechaVencimiento) as fechaVencimiento
        													')
            ->from('producto')
            ->where('producto.tipo !=', 'Servicio')
            ->where_in("producto.id", $rango)
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("lote", "producto.id=lote.idProducto")
            ->group_by("producto.id")
            ->get();
        $ans1 = $query->custom_result_object("ProductoModel");
        $query = $this->db->select('producto.*,
          										Entrada.nombre as presentacionEntrada,
          										Salida.nombre as presentacionSalida,
          										unidadmedida.nombre as unidadMedida,
          										unidadnegocio.nombre as unidadNegocio,
          										(sum(equipo.cantidad * equipo.cantidadEntrada)) / producto.cantidadSalida as CantidadInventario,
          										"No tiene" as fechaVencimiento
          									')
            ->from('producto')
            ->where('producto.tipo !=', 'Servicio')
            ->where_in("producto.id", $rango)
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("equipo", "producto.id=equipo.idProducto")
            ->group_by("producto.id")
            ->get();
        $ans2 = $query->custom_result_object("ProductoModel");
        $ans = array_merge($ans1, $ans2);
        $query = $this->db->select('producto.*,
        														Entrada.nombre as presentacionEntrada,
        														Salida.nombre as presentacionSalida,
        														unidadmedida.nombre as unidadMedida,
        														unidadnegocio.nombre as unidadNegocio,
        														sum(detallepedido.cantidad * detallepedido.cantidadSalida) / producto.cantidadSalida   as CantidadInventario,
        	                          "No aplica" as fechaVencimiento
        													')
            ->where('pedido.estado >', 1)
            ->where_in("producto.id", $rango)
            ->where('producto.tipo !=', 'Servicio')
            ->from('producto')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("detallepedido", "producto.id=detallepedido.idProducto")
            ->join("pedido", "pedido.id=detallepedido.idPedido")
            ->group_by("producto.id")
            ->get();
        $ans3 = $query->custom_result_object("ProductoModel");


        $query = $this->db->select('producto.*,
									Entrada.nombre as presentacionEntrada,
									Salida.nombre as presentacionSalida,
									unidadmedida.nombre as unidadMedida,
									unidadnegocio.nombre as unidadNegocio,
									sum(muestra.cantidad * muestra.cantidadSalida) / producto.cantidadSalida   as CantidadInventario,
									"No aplica" as fechaVencimiento')
            ->where('grupomuestras.estado >', 1)
            ->where('producto.tipo !=', 'Servicio')
            ->where_in("producto.id", $rango)
            ->from('producto')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join("muestra", "producto.id=muestra.idProducto")
            ->join("grupomuestras", "grupomuestras.id=muestra.idGrupo")
            ->group_by("producto.id")
            ->get();
        $ans4 = $query->custom_result_object("ProductoModel");
        $ans3 = array_merge($ans3, $ans4);
        foreach ($ans as $prod1) {
            foreach ($ans3 as $prod2) {
                if ($prod1->getId() == $prod2->getId()) {
                    $prod1->CantidadInventario = round($prod1->getCantidadInventario() - $prod2->getCantidadInventario(), 5);
                }
            }
        }
        return $ans;
    }

    public function InformeVentasUnidadNegocio($idUnidad, $fechaIni, $fechaFin)
    {
        $query = $this->db->select('producto.nombre as Producto ,
													sum(detallepedido.precioFinal) as totalVentas')
            ->from('detallepedido')
            ->from('producto')
            ->from('pedido')
            ->from('factura')
            ->where("pedido.id=detallepedido.idPedido")
            ->where("detallepedido.idProducto=producto.id")
            ->where("factura.idPedido=pedido.id")
            ->where("pedido.estado >=", 3)
            ->where("factura.fecha <=", $fechaFin)
            ->where("factura.fecha >=", $fechaIni)
            ->where('producto.unidadNegocio', $idUnidad)
            ->group_by('producto.id')
            ->get();
        $result = $query->result();
        return $result;
    }

    public function productosMuestra()
    {
        $query = $this->db->select('producto.*,
	                          Entrada.nombre as presentacionEntrada,
	                          Salida.nombre as presentacionSalida,
	                          unidadmedida.nombre as unidadMedida,
	                          unidadnegocio.nombre as unidadNegocio,
	                          sum(muestraxlote.cantidad * muestraxlote.cantidadSalida) as CantidadInventario,
	                          "no aplica" as fechaVencimiento
	                        ')
            ->from('producto')
            ->join("unidadnegocio", "producto.unidadNegocio=unidadnegocio.id")
            ->join("unidadmedida", "producto.unidadMedida=unidadmedida.id")
            ->join("unidadempaque as Entrada", "producto.presentacionEntrada=Entrada.id")
            ->join("unidadempaque as Salida", "producto.presentacionSalida=Salida.id")
            ->join('muestraxlote', 'muestraxlote.idProducto = producto.id')
            ->group_by('producto.id')
            ->get();
        $result = $query->custom_result_object("ProductoModel");
        return $result;
    }

}

?>
