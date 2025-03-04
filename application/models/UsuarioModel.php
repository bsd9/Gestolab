<?php

class UsuarioModel extends CI_Model {
	private $id="";
	private $usuario="";
  private $password="";
	private $nombre="";
	private $apellidos="";
	private $email="";
	private $fijo="";
	private $celular="";
	private $activo="";
	private $idCliente="";
	private $token="";
	private $idCargo="";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
	  if(isset($data['id'])){$this->id=$data['id'];}
        $this->usuario = $data['usuario'];
        if (isset($data['password'])) {
            $this->password = $data['password'];
        }
        $this->nombre = $data['nombre'];
        $this->apellidos = $data['apellidos'];
        $this->email = $data['email'];
        $this->fijo = $data['fijo'];
        $this->celular = $data['celular'];
        $this->idCargo = $data['idCargo'];
				if(isset($data['idCliente'])){$this->idCliente = $data['idCliente'];}
      if(isset($data['activo'])){$this->activo = $data['activo'];}
      if(isset($data['token'])){$this->token = $data['token'];}
}
public function getTipo(){
	return $this->tipo;
}

public function getToken()
	{
	return $this->token;
}

public function getIdCliente()
  {
  return $this->idCliente;
}


	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getUsuario()
    {
		return $this->usuario;
	}

    public function setUsuario($usuario)
    {
		$this->usuario=$usuario;
	}

	public function getNombre()
    {
		return $this->nombre;
	}

    public function setNombre($nombre)
    {
		$this->nombre=$nombre;
	}

	public function getApellidos()
		{
		return $this->apellidos;
	}

		public function setApellidos($apellidos)
		{
		$this->apellidos=$apellidos;
	}

	public function getEmail()
    {
		return $this->email;
	}

    public function setEmail($email)
    {
		$this->email=$email;
	}


	public function getPassword()
    {
		return $this->password;
	}

    public function setPassword($password)
    {
		$this->password=$password;
	}

	public function getActivo()
    {
		return $this->activo;
	}

    public function setActivo($activo)
    {
		$this->activo=$activo;
	}

	public function getFijo()
    {
		return $this->fijo;
	}

    public function setFijo($fijo)
    {
		$this->fijo=$fijo;
	}

	public function getCelular()
		{
		return $this->celular;
	}

		public function setCelular($celular)
		{
		$this->celular=$celular;
	}

	 public function getidCargo()
    {
        return $this->idCargo;
    }

    public function setidCargo($idCargo)
    {
        $this->idCargo = $idCargo;
    }

	  public function validate($a)
    {
        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
		    $this->form_validation->set_rules('usuario', "usuario", 'required',array('required'=>'El %s es un campo obligatorio'));
		    $this->form_validation->set_rules('apellidos', "apellidos", 'required',array('required'=>'El %s es un campo obligatorio'));
		    $this->form_validation->set_rules('email', "email", 'required',array('required'=>'El %s es un campo obligatorio'));
            $this->form_validation->set_rules('cargo', "cargo", 'required',array('required'=>'El %s es un campo obligatorio'));
//		    $this->form_validation->set_rules('duracioncontrato', "duración contrato", 'required',array('required'=>'La %s es un campo obligatorio'));


				return $this->form_validation->run();
    }

    public function insert()
    	{

    	$passwordHasher = new PasswordHash(8, false);
        $password = $passwordHasher->HashPassword($this->password);


          $this->db->set('usuario', $this->usuario);
          $this->db->set('password', $password);
          $this->db->set('nombre', $this->nombre);
          $this->db->set('apellidos', $this->apellidos);
          $this->db->set('email', $this->email);
          $this->db->set('fijo', $this->fijo);
          $this->db->set('celular', $this->celular);
          $this->db->set('token', $this->token);
          $this->db->set('activo',$this->activo);
          $this->db->set('idCliente', $this->idCliente);
          $this->db->set('idCargo', $this->idCargo);
          $this->db->insert('usuario');


        }

			public function update()
	    	{

          $this->db->set('usuario', $this->usuario);
          $this->db->set('nombre', $this->nombre);
          $this->db->set('apellidos', $this->apellidos);
          $this->db->set('email', $this->email);
          $this->db->set('fijo', $this->fijo);
          $this->db->set('celular', $this->celular);
          $this->db->set('activo',$this->activo);
          $this->db->set('idCargo', $this->idCargo);
					$this->db->where('id', $this->id);
					$this->db->update('usuario');

				}

				public function validatelogin()
		    {
		        //si los dos campos son obligatorios en el login por eso (y solo existen esos dos campos)
		        $this->form_validation->set_rules('usuario','usuario','required',array('required'=>"El usuario es obligatorio"));
		        $this->form_validation->set_rules('password', "password",'required',array('required'=>"Es necesario que tenga una contraseña"));
		        return $this->form_validation->run();
		    }

		    public function loguearse(){
		      //saco todo lo de ese usuario PD:podria sacar nada mas el rol y el nombre para que solo sea acceder a el con $this->session->userdata('nombre'); y asi con los demas datos
					$query=$this->db->select('usuario.* , cargo.nombre as cargoNombre, cliente.razonSocial as clienteNombre')
													->from('usuario')
													->join("cargo", "cargo.id = usuario.idCargo", "left")
													->join("cliente","cliente.id = usuario.idCliente", "left")
													->where("usuario.usuario",$this->usuario)
													->where("usuario.activo",1)
													->get();
					$result= $query->custom_result_object("UsuarioModel");
		           if(count($result)>0){
								 $passwordHasher = new PasswordHash(8,false);
								 $passwordMatch = $passwordHasher->CheckPassword($this->password, $result[0]->getPassword());
		             if($passwordMatch){

		             	$this->load->model('AccesoModel');
                	$accesomodel = new AccesoModel();
                	$accesos = $accesomodel->selectOne($result[0]->idCargo);
                	$permisos = [];
                	foreach ($accesos as $acceso) {
                    $permisos[] = $acceso->nombrePermiso;
                	}


									$this->load->model('EstablecimientoComercialModel');
	                $Establecimiento = new EstablecimientoComercialModel();
	                $Establecimiento = $Establecimiento->selectOne(1);

		             //aca es donde se setean los datos en las variables de sesion (piensen en setear como ponerlos a dispocicion de culquier php recuerden que php solo se ejecuta en el servidor)
          $this->session->set_userdata('ncliente',$result[0]->clienteNombre);
					$this->session->set_userdata('permisos', $permisos);
					$this->session->set_userdata("apellidos",$result[0]->getApellidos());
          $this->session->set_userdata("tipo",$result[0]->cargoNombre);
		      $this->session->set_userdata("nombre",$result[0]->getNombre());
		      $this->session->set_userdata("id",$result[0]->getId());
		      $this->session->set_userdata("idCliente",$result[0]->getIdCliente());
		      $this->session->set_userdata("idCargo",$result[0]->getidCargo());
					$this->session->set_userdata("Establecimiento",$Establecimiento[0]->getId());


								 return true;
               }return false;
             }return false;
		    }


      public function selectAll($id)
      {

    		$query=$this->db->select('usuario.*, cargo.nombre as tipo')
												->from('usuario')
												->join('cargo', "cargo.id = usuario.idCargo")
      									->where("usuario.idCliente",$id)
												->get();
				return $query->custom_result_object("UsuarioModel");

      }

			public function selectUser($id)
			{
			    		$query=$this->db->select('usuario.*, cargo.nombre as tipo')
												->from('usuario')

												->join('cargo', "cargo.id = usuario.idCargo")
												->where('usuario.idCliente',$id)
											  ->join('cliente', 'usuario.idCliente = cliente.id')

												->get();
		 return $query->custom_result_object("UsuarioModel");
			}




			public function selectOne($id)
      {
    		$query=$this->db->select('usuario.*')
										->from('usuario')
      									->where("usuario.id",$id)
												->get();
    		return $query->custom_result_object("UsuarioModel");
			}



public function selectCorreo($correo){
	$query=$this->db->select('*')
									->from('usuario')
									->where('email', $correo)
								->get();
	return $query->custom_result_object("UsuarioModel");
}
public function searchToken($token){
	$query=$this->db->select('token')
									->from('usuario')
									->where('token', $token)
								->get();
$result=$query->result();
foreach($result as $resu){
	if($resu->token === $token){
		return TRUE;
	}
}
return FALSE;
}


public static function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
public function ponerToken($correo){
$str = $this->generateRandomString(30);
while($this->searchToken($str)){
	$str = $this->generateRandomString(30);
}
	$this->db->set('token',  $str);
	$this->db->where('email', $correo);
	$this->db->update('usuario');
	return $str;
}

public function destroyToken($token){
	$this->db->set('token','NULL', false);
	$this->db->where('token', $token);
	$this->db->update('usuario');
}

public function existToken($token){
	$query=$this->db->select('*')
									->from('usuario')
									->where('token', $token)
								->get();
	$ans=$query->custom_result_object("UsuarioModel");
	return count($ans) == 1;
}


public function UpdatePassword($token,$password){
	$passwordHasher = new PasswordHash(8,false);
	$password = $passwordHasher->HashPassword($password);
	$this->db->set('password',  $password);
	$this->db->where('token', $token);
	$this->db->update('usuario');
}

public function UpdateContrasena($id,$oldpass,$password){
	$passwordHasher = new PasswordHash(8,false);
	$password = $passwordHasher->HashPassword($password);
	$query=$this->db->select('usuario.*')
									->from('usuario')
									->where("id",$id)
									->where("usuario.activo","1")
									->get();
	$result= $query->custom_result_object("UsuarioModel");
	$passwordMatch = $passwordHasher->CheckPassword($oldpass, $result[0]->getPassword());
	if($passwordMatch){
		$this->db->set('password',  $password);
		$this->db->where('id', $id);
		$this->db->update('usuario');
		return true;
	}
	return false;
}



}
?>
