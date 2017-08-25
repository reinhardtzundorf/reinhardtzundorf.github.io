<?php

/* -------------------------------------------------------------------- *
 *  Web Folders - CMS Backend 						*
 *  ------------------------------------------------------------------- *
 *  Library Class			DB.php                          *
 *  Last Updated			29 June 2017                    *
 *  Author 				Reinhardt Zündorf               *
 * -------------------------------------------------------------------- */
class DB
{

    /* ------------------------------------------------------------------------ *
     * 	Class variables								*
     * ------------------------------------------------------------------------ */
    private static $_instance = null;
    private $_pdo,
             $_query,
             $_error = false,
             $_results,
             $_count = 0;

    /* ------------------------------------------------------------------------ *
     * 	Default Constructor							*
     * ------------------------------------------------------------------------ */
    private function __construct()
    {
        try
        {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') 
                                 . ';dbname='   . Config::get('mysql/db'), 
                                                  Config::get('mysql/username'), 
                                                  Config::get('mysql/password'));
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }

    /** ---------------------------------------------------------------------- **
     * 	DB-getInstance() 														*
     * * ---------------------------------------------------------------------- * */
    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    /** ---------------------------------------------------------------------- **
     * 	DB->query($sql, $paramtersArr())										*
     * * ---------------------------------------------------------------------- * */
    public function query($sql, $params = array())
    {
        $this->_error = false;

        /* -----------------------------------------------------------------------  *
         * 	Prepare the statement 													*
         * -----------------------------------------------------------------------  */
        if($this->_query === $this->_pdo->prepare($sql))
        {
            $x = 1;

            if(count($params))
            {
                foreach($params as $param)
                {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            $logMsg = "EduBoard: DB.php - Function query() has finished building the query. '$this->_query'";
            error_log($logMsg . PHP_EOL, LOG_INFO);

            /* -----------------------------------------------------------------------  *
             * 	Execute the query, set '_error' true if the query fails.				*
             * -----------------------------------------------------------------------  */
            if($this->_query->execute())
            {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count   = $this->_query->rowCount();

                error_log("EduBoard: DB.php - SQL query successful." . PHP_EOL, LOG_WARNING);
            }
            else
            {
                error_log("EduBoard: DB.php - SQL query in query() failed." . PHP_EOL, LOG_WARNING);
                $this->_error = true;
            }

            error_log($logMsg, LOG_INFO);
        }

        /* -----------------------------------------------------------------------  *
         * 	Return results        													*
         * -----------------------------------------------------------------------  */
        return $this;
    }

    /** ---------------------------------------------------------------------- **
     * 	DB->action($action, $table, $where)										*
     * 	Performs an action on a given 'ctc_admin' table. 						*
     * -----------------------------------------------------------------------  *
     * 	- $actionType  			SELECT, UPDATE, DELETE							*
     *  - $onTable 				'member', 'group', 'policy' 					*
     *  - $whereArray			{ table.field } and '=', '<', '>'				*
     * * ---------------------------------------------------------------------- * */
    public function action2($action, $table, $where = array())
    {
        if(count($where) === 3)
        {
            $operators = array('=', '>', '<', '>=', '<=');
            $field     = $where[0];
            $operator  = $where[1];
            $value     = $where[2];

            error_log("EduBoard: DB.php - Assigning array position to respective operators." . PHP_EOL, LOG_ALERT);

            /* ------------------------------------------------------------ *
             * 	Build SQL query and execute 								*
             * ------------------------------------------------------------ */
            if(in_array($operator, $operators))
            {
                // $sql = "{$action} FROM {$table} WHERE {$field} {$operator} {$value}";
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                error_log("EduBoard: DB.php - Function action running query. SQL: {$sql}.");

                if(!$this->query($sql, array($value))->error())
                {
                    $logMsg = "EduBoard: DB.php - Function action successfully ran.";
                    return $this;
                }
                else
                {
                    $logMsg = "EduBoard: DB.php - Database action on {$table} failed.";
                }
            }
        }
        error_log($logMsg, LOG_ALERT);
        return false;
    }

    public function action($action, $table, $where = array())
    {
        if(count($where) === 3)
        {
            $operators = array('=', '>', '<', '>=', '<=');

            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];

            if(in_array($operator, $operators))
            {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error())
                {
                    return $this;
                }
            }
        }

        return false;
    }

    /** ---------------------------------------------------------------------- **
     * 	DB->insert($tableName, $fieldsArray())									*
     * 	Inserts fields into a table                      						*
     * -----------------------------------------------------------------------  *
     * 	- $fieldsArray			key-value pairs, i.e. 'pName' => 'Frank'		*
     * * ---------------------------------------------------------------------- * */
    public function insert($table, $fields = array())
    {
        $keys   = array_keys($fields);
        $values = null;
        $x      = 1;

        foreach($fields as $field)
        {
            $values .= '?';

            if($x < count($fields))
            {
                $values .= ', ';
            }

            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        if(!$this->query($sql, $fields)->error())
        {
            error_log("EduBoard: Member.php - SQL insert on table: '{$table}' with values: '{$values}' failed." . PHP_EOL, LOG_ALERT);
            return true;
        }

        return false;
    }

    /**
     * 	Update($table, $id, $fieldsValues)
     *
     * 	@return statusCode
     * 	@author Reinhardt Zündorf
     */
    public function update($table, $id, $fields)
    {
        /* ---------------------------------------------------- *
         * 	$set = the trailing inverted commas. (see ln. 189)	*
         *  $x   = loop count variable 							*
         * ---------------------------------------------------- */
        $set = '';
        $x   = 1;

        /* ------------------------------------------------------------------------------------------------------------ *
         * Update a table in the DB with the values of the '$fields' array. 											*
         * Names of fields in the table concerned are stored as the key and values as the $value for each iteration.	*
         * ------------------------------------------------------------------------------------------------------------ */
        foreach($fields as $name => $value)
        {
            /* ------------------------------------------------------- *
             * 	Format each key-value pair into a SQL statement 	   *
             * ------------------------------------------------------- */
            $set .= "{$name} = ?";

            /* ---------------------------------------------------------------------------- *
             * Add ', ' in between the key-value pairs if we have more than one condition.	*
             * ---------------------------------------------------------------------------- */
            if($x < count($fields))
            {
                $set .= ', ';
            }

            $x++;
        }

        /* ---------------------------------------------------------------- *
         * 	Build the UPDATE query     						 	   			*
         * ---------------------------------------------------------------- */
        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if(!$this->query($sql, $fields)->error())
        {
            $logMsg = "EduBoard: DB - Successfully updated {$table} in the DB.";
            error_log($logMsg . PHP_EOL, LOG_ALERT);

            return true;
        }

        $logMsg = "EduBoard: DB - Failed to update the '{$table}' in the DB.";
        error_log($logMsg . PHP_EOL, LOG_ALERT);

        return false;
    }

    /* ---------------------------------------------------- *
     * 	Helper function that returns a DELETE action 		*
     * ---------------------------------------------------- */
    public function delete($table, $where)
    {
        return $this->action('DELETE ', $table, $where);
    }

    /* ---------------------------------------------------- *
     * 	Helper function that returns a SELECT action 		*
     * ---------------------------------------------------- */
    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    /* ---------------------------------------------------- *
     * 	Accessor for $_results                              *
     * ---------------------------------------------------- */
    public function results()
    {
        return $this->_results;
    }

    /* ---------------------------------------------------------------- *
     * 	Return the first iteration of the structure $data[0]  			*
     * ---------------------------------------------------------------- */
    public function first()
    {
        $data = $this->results();
        return $data[0];
    }

    /* ---------------------------------------------------- *
     * 	Accessor for $_count                                *
     * ---------------------------------------------------- */
    public function count()
    {
        return $this->_count;
    }

    /* ---------------------------------------------------- *
     * 	Accessor for $_error                                *
     * ---------------------------------------------------- */
    public function error()
    {
        return $this->_error;
    }

}

