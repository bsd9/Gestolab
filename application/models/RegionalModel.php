<?php

class RegionalModel extends CI_Model
{

    private $id = "";
    private $nombre = "";
    private $estado = "";

    function __construct()
    {
        parent::__construct();
    }

    public function setData($data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->nombre = $data['nombre'];
        if (isset($data['estado'])) {
            $this->estado = $data['estado'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($nombre)
    {
        $this->estado = $nombre;
    }

    public function insert()
    {
        $this->db->set('nombre', $this->nombre);
        $this->db->set('estado', 1);
        $this->db->insert('regional');
    }

    public function update()
    {
        $this->db->set('nombre', $this->nombre);
        $this->db->set('estado', $this->estado);
        $this->db->where("id", $this->id);
        $this->db->update('regional');
    }

    public function selectAll()
    {
        $query = $this->db->select('*')
            ->get('regional');
        return $query->custom_result_object("RegionalModel");
    }

    public function selectOne($id)
    {
        $query = $this->db->select('*')
            ->where("id", $id)
            ->from('regional')
            ->get();
        return $query->custom_result_object("RegionalModel");
    }

    public function validate()
    {
        $this->form_validation->set_rules('nombre', "nombre", 'required', array('required' => 'El %s es un campo obligatorio'));
        return $this->form_validation->run();
    }

    public function InformeVentas($fechaIni, $fechaFin)
    {
        $query = $this->db->select('regional.nombre as Regional ,
																	sum(detallepedido.precioFinal) as totalVentas')
            ->from('detallepedido')
            ->from('cliente')
            ->from('regional')
            ->from('pedido')
            ->from('factura')
            ->where("pedido.id=detallepedido.idPedido")
            ->where("pedido.idCliente=cliente.id")
            ->where("cliente.idRegional=regional.id")
            ->where("factura.idPedido=pedido.id")
            ->where("pedido.estado >=", 3)
            ->where("factura.fecha <=", $fechaFin)
            ->where("factura.fecha >=", $fechaIni)
            ->group_by('regional.id')
            ->get();
        $result = $query->result();
        return $result;

    }

    public function DatosGrafico($id)
    {
        $query = $this->db->query('select idRegional,date(factura.fecha) as fecha,sum(cantidadFinal) as cantidad from
(select presupuesto.*, detallepedido.precioFinal as cantidadFinal, pedido.id as pedidoId, regional.nombre as idRegional from presupuesto
left join pedido on pedido.idEmpleado = presupuesto.idEmpleado and pedido.estado >= 3
left join detallepedido on detallepedido.idPedido = pedido.id
left join cliente on cliente.id = pedido.idCliente
left join regional on cliente.idRegional = regional.id
where cliente.idRegional in (select idRegional from regionalxempleado where idEmpleado =  '.$id.')
) as presu
join factura on presu.pedidoId = factura.idPedido  and factura.fecha between presu.fechaInicio and presu.fechaFin 
group by date(factura.fecha), idRegional
order by  idRegional, fecha ');
        $result = $query->result();
        return $result;
    }


}

?>
