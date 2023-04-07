<?php

class Database extends PDO
{
    private $table = '';
    private $select = [];
    private $join = [];
    private $leftJoin = [];
    private $rightJoin = [];
    private $condition = [];
    private $sort = [];
    private $take = '';

    public function __construct($connect, $username, $password, $table) 
    {
        parent::__construct($connect, $username, $password);
        $this->table = $table;
    }

    public static function table($table) 
    {
        $host = MYSQL_HOST; 
        $port = MYSQL_PORT;
        $username = MYSQL_USERNAME;
        $password = MYSQL_PASSWORD;
        $database = MYSQL_DATABASE;

        $connect = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database;

        try {
            $database = new Database($connect, $username, $password, $table);
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $database;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function raw($sql)
    {
        $host = MYSQL_HOST; 
        $port = MYSQL_PORT;
        $username = MYSQL_USERNAME;
        $password = MYSQL_PASSWORD;
        $database = MYSQL_DATABASE;

        $connect = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database;

        try {
            $database = new Database($connect, $username, $password, null);
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $database->query($sql, PDO::FETCH_ASSOC); 
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function insertRaw($sql)
    {
        $host = MYSQL_HOST; 
        $port = MYSQL_PORT;
        $username = MYSQL_USERNAME;
        $password = MYSQL_PASSWORD;
        $database = MYSQL_DATABASE;

        $connect = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database;

        try {
            $database = new Database($connect, $username, $password, null);
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $database->exec($sql);
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function get()
    {
        list($select_str, $join_str, $condition_str, $condition_data, $sort_str) = $this->additional();

        $sql = '
            SELECT ' . 
            $select_str . 
            ' FROM '. 
            $this->table . 
            $join_str .
            $condition_str . 
            $sort_str . 
            $this->take .
            ';
        ';

        $stmt = $this->prepare($sql);
        $result = $stmt->execute($condition_data);
        if (!$result) {
            return false;
        }
            
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first()
    {
        list($select_str, $join_str, $condition_str, $condition_data, $sort_str) = $this->additional();
        
        $sql = '
            SELECT ' . 
            $select_str . 
            ' FROM '. 
            $this->table . 
            $join_str .
            $condition_str . 
            $sort_str . 
            ' LIMIT 1;
        ';
        $stmt = $this->prepare($sql);
        $result = $stmt->execute($condition_data);
        if (!$result) {
            return false;
        }
            
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function count($countData = 'id')
    {
        list($select_str, $join_str, $condition_str, $condition_data, $sort_str) = $this->additional();
        
        $sql = '
            SELECT COUNT(' . $countData . ') FROM '. 
            $this->table . 
            $condition_str . 
            $sort_str . 
            ';
        ';

        $stmt = $this->prepare($sql);
        $result = $stmt->execute($condition_data);
        if (!$result) {
            return false;
        }
            
        return $stmt->fetch(PDO::FETCH_ASSOC)['COUNT('. $countData . ')'];
    }

    public function select($data)
    {
        $this->select = $data;
        return $this;
    }

    public function insert($data)
    {
        $col_name = '';
        $col_holder = '';

        foreach ($data as $key => $value) {
            $col_name .= $key . ',';
            $col_holder .= ':' . $key . ',';
        }

        $col_name = substr($col_name, 0, -1);
        $col_holder = substr($col_holder, 0, -1);

        $sql = 'INSERT INTO ' . $this->table . '(' . $col_name . ') VALUES(' . $col_holder . ');' ;
        $stmt = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        return $stmt->execute();
    }

    public function insertId($data)
    {
        $col_name = '';
        $col_holder = '';

        foreach ($data as $key => $value) {
            $col_name .= $key . ',';
            $col_holder .= ':' . $key . ',';
        }

        $col_name = substr($col_name, 0, -1);
        $col_holder = substr($col_holder, 0, -1);

        $sql = 'INSERT INTO ' . $this->table . '(' . $col_name . ') VALUES(' . $col_holder . ');';
        $stmt = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindParam(':' . $key, $value);
        }

        $result = $stmt->execute();

        if (!$result) {
            return false;
        }
        return $this->lastInsertId();
    }

    public function update($data)
    {
        list(,, $condition_str, $condition_data,) = $this->additional();

        $update_statement = '';
        
        foreach ($data as $key => $value) {
            $update_statement .= $key . ' = ?, ';
        }

        $update_statement = substr($update_statement, 0, -2);

        $sql = 'UPDATE ' . $this->table . ' SET ' . $update_statement . $condition_str . ';';

        $data = array_merge(array_values($data), $condition_data);
        $stmt = $this->prepare($sql);

        return $stmt->execute($data);
    }

    public function delete()
    {
        list(,, $condition_str, $condition_data,) = $this->additional();

        $sql = 'DELETE FROM ' . $this->table . $condition_str . ';';
        $stmt = $this->prepare($sql);

        return $stmt->execute($condition_data);
    }

    public function join($table2, $data, $operator, $data2)
    {
        $this->join[] = [$table2, $data, $operator, $data2];
        return $this;
    }

    public function where($data)
    {
        $this->condition = $data;
        return $this;
    }

    public function orderBy($data)
    {
        $this->sort = $data;
        return $this;
    }

    private function additional()
    {
        $select_str = '*';
        $join_str = '';
        $condition_str = '';
        $condition_data = [];
        $sort_str = '';

        if (!empty($this->select)) {
            $select_str = implode(',', $this->select);
        }

        if (!empty($this->join)) {
            foreach ($this->join as $j) {
                $join_str .= ' JOIN ' . $j[0] . ' ON ' . $j[1] . ' ' . $j[2] . ' ' . $j[3];
            }
        }

        if (!empty($this->condition)) {
            $condition_str = ' WHERE ';
            
            foreach ($this->condition as $cond) {
                $tmp = $cond[0] . ' ' . $cond[1] . ' ? AND ';
                $condition_data[] = $cond[2];
                $condition_str .= $tmp;
            }
            $condition_str = substr($condition_str, 0, -5);
        }

        if (!empty($this->sort)) {
            $sort_str = ' ORDER BY ';
            foreach ($this->sort as $key => $sr) {
                $tmp = $key . ' ' . $sr . ', ';
                $sort_str .= $tmp;
            }
            $sort_str = substr($sort_str, 0, -2) ;
        }

        return [
            $select_str,
            $join_str, 
            $condition_str, 
            $condition_data, 
            $sort_str
        ];
    }

    public function take($limit = '', $offset = 0) {
        $this->take = ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        return $this; 
    } 

    public function paginate($limit = 10)
    {
        $currentPage = 1;
        if (isset($_GET['page'])) {
            $currentPage = $_GET['page'];
        }

        $rowPerPage = $limit;
        $totalRow = $this->count();
        $totalPage = ceil($totalRow / $rowPerPage);

        list($select_str, $join_str, $condition_str, $condition_data, $sort_str) = $this->additional();
        $take_str = ' LIMIT ' . $rowPerPage . ' OFFSET ' . $rowPerPage * ($currentPage - 1);
        $sql = 'SELECT ' . 
            $select_str . 
            ' FROM '. 
            $this->table . 
            $join_str .
            $condition_str . 
            $sort_str . 
            $take_str . ';';

        $stmt = $this->prepare($sql);
        $result = $stmt->execute($condition_data);
        if (!$result) {
            return false;
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new Paginator([
            'totalPage' => $totalPage, 
            'currentPage' => $currentPage, 
            'totalRow' => $totalRow, 
            'rowPerPage' => $rowPerPage, 
            'data' => $data
        ]);
    }
}

class Paginator
{
    public $totalPage;
    public $currentPage;
    public $totalRow;
    public $rowPerPage;
    public $data;

    public function __construct($dataArray)
    {
        foreach ($dataArray as $key => $value) {
            $this->$key = $value;
        }
    }

    public function link()
    {
        $firstPage = 1;
        $lastPage = $this->totalPage;

        $distance = 5;

        $leftCurrentPage = $firstPage + 1;
        if ($this->currentPage - $distance > $leftCurrentPage) {
            $leftCurrentPage = $this->currentPage - $distance;
        }

        $rightCurrentPage = $lastPage - 1;
        if ($this->currentPage + $distance < $rightCurrentPage) {
            $rightCurrentPage = $this->currentPage + $distance;
        }

        $query = $_SERVER['QUERY_STRING'];
        if (empty($query)) {
            $query = '?page=';
        } else {
            if (str_contains($query, 'page')) {
                $query = '?' . preg_replace('/page=[0-9]+/', '', $query) . 'page=';
            } else {
                $query = '?' . $query . '&page=';
            }

        }
        if ($this->totalRow > 0 && $this->totalRow > $this->rowPerPage) {
            ?>
                <nav>
                    <ul class="pagination">
                    <?php
                        if ($this->currentPage == $firstPage) {
                            ?>
                                <li class="page-item disabled"><a class="page-link" tabindex="-1">Previous</a></li>
                                <li class="page-item disabled"><a class="page-link" tabindex="-1"><?=$firstPage?></a></li>
                            <?php
                        } else {
                            ?>
                                <li class="page-item"><a class="page-link" href="<?=$query?><?=$this->currentPage - 1?>">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="<?=$query?><?=$firstPage?>"><?=$firstPage?></a></li>
                            <?php
                        }
                        if ($leftCurrentPage > $firstPage + 1) {
                            ?>
                                <li class="page-item"><span class="page-link">...</span></li>
                            <?php
                        } 
                        for ($i = $leftCurrentPage; $i <= $this->currentPage - 1; $i++) { 
                            ?>
                                <li class="page-item"><a class="page-link" href="<?=$query?><?=$i?>"><?=$i?></a></li>
                            <?php
                        }
                        if ($this->currentPage != $firstPage && $this->currentPage != $lastPage) {
                            ?>
                                <li class="page-item disabled"><a class="page-link" tabindex="-1"><?=$this->currentPage?></a></li>
                            <?php
                        }
                        for ($i = $this->currentPage + 1; $i <= $rightCurrentPage; $i++) { 
                            ?>
                                <li class="page-item"><a class="page-link" href="<?=$query?><?=$i?>"><?=$i?></a></li>
                            <?php
                        }
                        if ($rightCurrentPage < $lastPage - 1) {
                            ?>
                                <li class="page-item"><span class="page-link">...</span></li>
                            <?php
                        } 
                        if ($this->currentPage == $lastPage) {
                            ?>
                                <li class="page-item disabled"><a class="page-link" tabindex="-1"><?=$lastPage?></a></li>
                                <li class="page-item disabled"><a class="page-link" tabindex="-1">Next</a></li>
                            <?php
                        } else {
                            ?>
                                <li class="page-item"><a class="page-link" href="<?=$query?><?=$lastPage?>"><?=$lastPage?></a></li>
                                <li class="page-item"><a class="page-link" href="<?=$query?><?=$this->currentPage + 1?>">Next</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
            <?php
        }

    }
}