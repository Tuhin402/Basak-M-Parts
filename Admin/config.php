<?php
class db
{
    protected $server = "localhost";
    protected $user = "root";
    protected $pass = "";
    protected $db = "";
    protected $con;
    
    public function connect()
    {
        $this->con = mysqli_connect($this->server, $this->user, $this->pass, $this->db);
        if ($this->con) {
            // echo "connected";
        } else {
            echo "not connected" . mysqli_error($this->con);
        }
    }
    
    public function getConnection() {
        return $this->con;
    }

    public function close()
    {
        if ($this->con) {
            mysqli_close($this->con);
            //echo "connection closed";
        }
    }

    public function query($sql)
    {
        // $que = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        // return 1;
        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            echo "Error: " . mysqli_error($this->con);
            return false; 
        }
        return $result;
    }

    public function row($check)
    {
        $que = mysqli_query($this->con, $check);
        $result = mysqli_num_rows($que);
        return $result;
    }

    public function arr($value)
    {
        $ar = mysqli_query($this->con, $value);
        $result = mysqli_fetch_array($ar);
        return $result;
    }

    public function num($value)
    {
        $ar = mysqli_query($this->con, $value);
        $result = mysqli_num_rows($ar);
        return $result;
    }

    public function fetch($query)
    {
        $abc = array();
        $res = mysqli_query($this->con, $query);
        while ($result = mysqli_fetch_assoc($res)) {
            $abc[] = $result;
        }
        return $abc;
    }

    public function amount($number) {
        if ($number >= 10000000) { 
            return number_format($number / 10000000, 2) . ' Cr';
        } elseif ($number >= 100000) { 
            return number_format($number / 100000, 2) . ' L';
        } elseif ($number >= 1000) { 
            return number_format($number / 1000, 2) . ' K';
        }
        return number_format($number, 2);
    }
}

$obj = new db();
$obj->connect();

// ... (perform database operations)

// Add this line to close the connection when you're done with it
//$obj->close();
?>