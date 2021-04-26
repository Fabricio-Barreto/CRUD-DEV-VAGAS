<?php

namespace App\DB;

use \PDO;
use PDOException;

class Database{

    /**
     * Host de conexão com o banco de dados
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     */
    const NAME = 'vagas';

    /**
     * Usuário do banco
     */
    const USER = 'root';

    /**
     * Senha de acesso ao banco de dados
     */
    const PASS = '';

    /**
     * Nome da tablea a ser manipulada
     */
    private $table;

    /**
     * Instancia de conexão com o banco de dados
     * @var PDO
     */
    private $connection;
    
    /**
     * Define a tabela e instancia a conexão
     */
    public function __construct($table = null){ 
        $this -> table = $table;
        $this -> setConnection();
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados
     */
    private function setConnection(){
        try{
            $this -> connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this -> connection -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            die('ERROR'.$e -> getMessage());
        }
    }

    /**
     * Método responsável por executar queries dentro do banco de dados
     */
    public function execute($query, $params = []){
        try{
            $statement = $this -> connection -> prepare($query);
            $statement -> execute($params);
            return $statement;
        }
        catch(PDOException $e){
            die('ERROR'.$e -> getMessage());
        }
    }

    /**
     * Método responsável por inserir dados no banco
     */
    public function insert($values){
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');

        //MONTA A QUERY
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

        //EXECUTA O INSERT
        $this -> execute($query, array_values($values));

        //RETORNA O ID INSERIDO
        return $this -> connection -> lastInsertId();
    }

    /**
     * Método responsável por executar uma consulta no banco
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order= strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        //MONTA A QUERY
        $query = 'Select '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        //RETORNA A QUERY
        return $this ->execute($query);
    }

    /**
     * Método responsável por executar atualizações no banco de dados
     */
    public function update($where, $values){
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA A QUERY
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
        
        //EXECUTAR A QUERY
        $this->execute($query,array_values($values));

        //RETORNA SUCESSO
        return true;
    }

    /**
     * Método responsável por exluir dados no banco
     */
    public function delete($where){
        //MONTA A QUERY
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        //EXECUTA A QUERY
        $this->execute($query);

        //RETORNA SUCESSO
        return true;
    }

}