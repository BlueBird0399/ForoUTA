<?php
class connection
{
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $connection;
    public function __construct($host,$user,$pass,$dbname)
    {
       $this->host=$host;
       $this->user=$user;
       $this->pass=$pass;
       $this->dbname=$dbname;
    }

    public function getConnection(){
        $connection=mysqli_connect($this->host,$this->user,$this->pass,$this->dbname);
        if($connection)
        {
            return  $connection;
        }

        echo '<script>alert("No se pudo establecer coexión con el servidor o la base de datos");location.href="index.html";</script>'; 
    }
}
?>