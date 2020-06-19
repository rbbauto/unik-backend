<?php
//error_reporting(0);
require __DIR__ . '/database_connection.php';

class Crud{

    protected $db;

    public function __construct()
    {
        $this->db = DB();
    }


    public function Read()
    {
        $query = $this->db->prepare("SELECT * FROM productos");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return json_encode(['productos' => $data]);
    }

     public function ReadCat()
    {
        $query = $this->db->prepare("SELECT nombre_categoria FROM categorias");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row['nombre_categoria'];
        }

        return json_encode(['categorias' => $data]);
    }


    public function Create($name, $description,$imagen,$color,$categoria,$stock,$activa,$precio)
    {   
        $imagen = isset($imagen) ? $imagen : "assets/imgDefault/default.png";
        $categoria = isset($categoria) ? $categoria : "Varios";

        $query = $this->db->prepare("INSERT INTO productos(nombre, descripcion, imagen,color,categoria,stock,activa,precio) VALUES (:nombre,:descripcion,:imagen,:color,:categoria,:stock,:activa,:precio)");
        $query->bindParam("nombre", $name, PDO::PARAM_STR);
        $query->bindParam("descripcion", $description, PDO::PARAM_STR);
        $query->bindParam("imagen", $imagen, PDO::PARAM_STR);
        $query->bindParam("color", $color, PDO::PARAM_STR);
        $query->bindParam("categoria", $categoria, PDO::PARAM_STR);
        $query->bindParam("stock", $stock, PDO::PARAM_STR);
        $query->bindParam("activa", $activa, PDO::PARAM_STR);
        $query->bindParam("precio", $precio, PDO::PARAM_STR);
        $query->execute();

        return json_encode(['producto' => [
            'id'            => $this->db->lastInsertId(),
            'nombre'        => $name,
            'descripcion'   => $description,
            'imagen'        => $imagen,
            'color'         => $color,
            'categoria'     => $categoria,
            'stock'         => $stock,
            'activa'        => $activa
        ]]);
    }
    
     public function CreateCat($categoria)
    {   
        $categoria = isset($categoria) ? $categoria : "Varios";
        
        try{
            $query = $this->db->prepare("INSERT INTO categorias (id, nombre_categoria) VALUES (NULL, :categoria)");
            $query->bindParam("categoria", $categoria, PDO::PARAM_STR);
            $query->execute();
            return json_encode([['errors' => ''], 'categoria'     => $categoria]);           
        }catch(Exception $e){
            http_response_code(400);
            return json_encode(['errors' => ["La Categoria : '$categoria' ya existe!"]]);
        }

        
        
    }

    public function Delete($product_id)
    {
        $query = $this->db->prepare("DELETE FROM productos WHERE id = :id");
        $query->bindParam("id", $product_id, PDO::PARAM_STR);
        $query->execute();
    }


    public function Update($name, $description, $product_id,$imagen,$color,$categoria,$stock,$activa,$precio)
    {
        $query = $this->db->prepare("UPDATE productos SET imagen = :imagen, nombre = :nombre, descripcion = :descripcion, color = :color, categoria = :categoria, stock = :stock, activa = :activa, precio = :precio  WHERE id = :id");
        $query->bindParam("nombre", $name, PDO::PARAM_STR);
        $query->bindParam("descripcion", $description, PDO::PARAM_STR);
        $query->bindParam("id", $product_id, PDO::PARAM_STR);
        $query->bindParam("imagen", $imagen, PDO::PARAM_STR);
        $query->bindParam("color", $color, PDO::PARAM_STR);
        $query->bindParam("categoria", $categoria, PDO::PARAM_STR);
        $query->bindParam("stock", $stock, PDO::PARAM_STR);
        $query->bindParam("activa", $activa, PDO::PARAM_STR);
        $query->bindParam("precio", $precio, PDO::PARAM_STR);
        
        return $query->execute();
    }

     public function setItemCart($id_producto, $nombre, $hostname, $precio, $cantidad, $subtotal)
    {   
        $categoria = isset($categoria) ? $categoria : "Varios";
        
        try{
            $query = $this->db->prepare(
                "   INSERT INTO carrito (id, id_producto, nombre, hostname, precio, cantidad, subtotal ) 
                    VALUES (NULL, :id_producto, :nombre, :hostname, :precio, :cantidad, :subtotal  )");
            $query->bindParam("id_producto", $id_producto, PDO::PARAM_STR);
            $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
            $query->bindParam("hostname", $hostname, PDO::PARAM_STR);
            $query->bindParam("precio", $precio, PDO::PARAM_STR);
            $query->bindParam("cantidad", $cantidad, PDO::PARAM_STR);
            $query->bindParam("subtotal", $subtotal, PDO::PARAM_STR);
            $query->execute();

        return $query;
                       
        }catch(Exception $e){
            http_response_code(400);
            echo "fallo query: ". $e->getMessage();
        }

        
        
    }

    public function checkHostnameExist($host)
    {
        $query = $this->db->prepare("SELECT * FROM carrito WHERE hostname = '$host'");
        $query->execute();
        if($query->rowCount() > 0){
            return true;

        }else{
            return false;
        }   
    }

    public function delAllCartItems(){
        $query = $this->db->prepare("DELETE FROM carrito WHERE hostname = '" . gethostname() . "'");
        if ($query->execute()) 
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function setCliente($nombre,$apellido,$email,$telefono,$empresa,$cuit,$direccion,$numero,$ciudad,$provincia,$pais,$cp,$pass,$isFactDir)
    {   
        $host= gethostname();
        $query = $this->db->prepare("INSERT INTO 
                                    logincliente(id,
                                                email,
                                                contrasenia,
                                                nombre,
                                                apellido,
                                                telefono,
                                                direccion,
                                                numero,
                                                ciudad,
                                                provincia,
                                                pais,
                                                empresa,
                                                cuit,
                                                cp,
                                                checkboxFacturarAca,
                                                hostname)
                                    VALUES (null,   :email,
                                                    :contrasenia,
                                                    :nombre,
                                                    :apellido,
                                                    :telefono,
                                                    :direccion,
                                                    :numero,
                                                    :ciudad,
                                                    :provincia,
                                                    :pais,
                                                    :empresa,
                                                    :cuit,
                                                    :cp,
                                                    :checkboxFacturarAca,
                                                    :hostname)");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("contrasenia", $pass, PDO::PARAM_STR);
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("apellido", $apellido, PDO::PARAM_STR);
        $query->bindParam("telefono", $telefono, PDO::PARAM_STR);
        $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
        $query->bindParam("numero", $numero, PDO::PARAM_STR);
        $query->bindParam("ciudad", $ciudad, PDO::PARAM_STR);
        $query->bindParam("provincia", $provincia, PDO::PARAM_STR);
        $query->bindParam("pais", $pais, PDO::PARAM_STR);
        $query->bindParam("empresa", $empresa, PDO::PARAM_STR);
        $query->bindParam("cuit", $cuit, PDO::PARAM_STR);
        $query->bindParam("cp", $cp, PDO::PARAM_STR);
        $query->bindParam("checkboxFacturarAca", $isFactDir, PDO::PARAM_STR);
        $query->bindParam("hostname",$host, PDO::PARAM_STR);
        
        
        if ($query->execute()) 
        {
            return true;
        }else{
            return false;
        }
    }

    public function updateCliente($nombre,$apellido,$email,$telefono,$empresa,$cuit,$direccion,$numero,$ciudad,$provincia,$pais,$cp,$pass,$isFactDir)
    {   
        var_dump(empty($pass));
        $host= gethostname();
        if (strlen($pass) > 0 ) { 
            $query = $this->db->prepare("INSERT INTO 
                                    logincliente(id,
                                                email,
                                                contrasenia,
                                                nombre,
                                                apellido,
                                                telefono,
                                                direccion,
                                                numero,
                                                ciudad,
                                                provincia,
                                                pais,
                                                empresa,
                                                cuit,
                                                cp,
                                                checkboxFacturarAca,
                                                hostname)
                                    VALUES (null,   :email,
                                                    :contrasenia,
                                                    :nombre,
                                                    :apellido,
                                                    :telefono,
                                                    :direccion,
                                                    :numero,
                                                    :ciudad,
                                                    :provincia,
                                                    :pais,
                                                    :empresa,
                                                    :cuit,
                                                    :cp,
                                                    :checkboxFacturarAca,
                                                        :hostname)");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("contrasenia", md5($pass), PDO::PARAM_STR);
            $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
            $query->bindParam("apellido", $apellido, PDO::PARAM_STR);
            $query->bindParam("telefono", $telefono, PDO::PARAM_STR);
            $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
            $query->bindParam("numero", $numero, PDO::PARAM_STR);
            $query->bindParam("ciudad", $ciudad, PDO::PARAM_STR);
            $query->bindParam("provincia", $provincia, PDO::PARAM_STR);
            $query->bindParam("pais", $pais, PDO::PARAM_STR);
            $query->bindParam("empresa", $empresa, PDO::PARAM_STR);
            $query->bindParam("cuit", $cuit, PDO::PARAM_STR);
            $query->bindParam("cp", $cp, PDO::PARAM_STR);
            $query->bindParam("checkboxFacturarAca", $isFactDir, PDO::PARAM_STR);
            $query->bindParam("hostname",$host, PDO::PARAM_STR);
            
            
            if ($query->execute()) 
            {
                return true;
            }else{
                return false;
            }
        }// end if (strlen($pass) > 0 )
        else
        {
            $query = $this->db->prepare("INSERT INTO 
                                    logincliente(id,
                                                email,
                                                nombre,
                                                apellido,
                                                telefono,
                                                direccion,
                                                numero,
                                                ciudad,
                                                provincia,
                                                pais,
                                                empresa,
                                                cuit,
                                                cp,
                                                checkboxFacturarAca,
                                                hostname)
                                    VALUES (null,   :email,
                                                    :nombre,
                                                    :apellido,
                                                    :telefono,
                                                    :direccion,
                                                    :numero,
                                                    :ciudad,
                                                    :provincia,
                                                    :pais,
                                                    :empresa,
                                                    :cuit,
                                                    :cp,
                                                    :checkboxFacturarAca,
                                                        :hostname)");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
            $query->bindParam("apellido", $apellido, PDO::PARAM_STR);
            $query->bindParam("telefono", $telefono, PDO::PARAM_STR);
            $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
            $query->bindParam("numero", $numero, PDO::PARAM_STR);
            $query->bindParam("ciudad", $ciudad, PDO::PARAM_STR);
            $query->bindParam("provincia", $provincia, PDO::PARAM_STR);
            $query->bindParam("pais", $pais, PDO::PARAM_STR);
            $query->bindParam("empresa", $empresa, PDO::PARAM_STR);
            $query->bindParam("cuit", $cuit, PDO::PARAM_STR);
            $query->bindParam("cp", $cp, PDO::PARAM_STR);
            $query->bindParam("checkboxFacturarAca", $isFactDir, PDO::PARAM_STR);
            $query->bindParam("hostname",$host, PDO::PARAM_STR);
            
            
            if ($query->execute()) 
            {
                return true;
            }else{
                return false;
            }
        } //end else
        
        
    }

    public function delPedido($email)
    {
        $query = $this->db->prepare("DELETE FROM logincliente WHERE email = '$email'");
        if ($query->execute()) 
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function checkLoginCliente($email,$pass)
    {
        $query = $this->db->query("SELECT * FROM logincliente WHERE email = '$email' AND contrasenia = '$pass'");
        $query->execute();
        if ($query->rowCount() > 0) 
        {
            http_response_code(200);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            http_response_code(400);
        }
    }   

}

?>