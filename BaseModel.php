<?php

class BaseModel
{
    private $db;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=abchosting", "root", null);
        }
        catch (PDOException $e)
        {
            print $e->getMessage();
        }
    }

    /**
     * Select query
     *
     * @param null $tableName
     * @param null $secondTable
     * @param null $where
     * @param null $whereField
     * @param null $where2
     * @param null $whereField2
     * @return bool|PDOStatement|string
     */
    public function get($tableName = null, $secondTable = null, $where = null, $whereField = null, $where2 = null, $whereField2 = null)
    {
        $query = "SELECT * FROM $tableName";

        if($where)
        {
            $query .= " WHERE $where = $whereField";
        }

        if ($where2){

            $query .= " AND $where2 = $whereField2";

//            $query .= " LEFT JOIN $secondTable ON ($tableName.$table1Field=$secondTable.$table2Field)";
//            $query .= " GROUP BY $secondTable.product_id";
//            $query .= " GROUP BY $tableName.$table1Field";
        }

        $query = $this->db->prepare($query);
        $query->execute();

        if ($query->rowCount())
        {
            return $query->fetchAll();
        }
    }

    /**
     * Update Query for user balance
     *
     * @param null $tableName
     * @param null $data
     * @return array
     */
    public function update($tableName = null, $data = null)
    {
        $query = "UPDATE $tableName SET balance=balance-$data,charge_balance = $data WHERE id = ". $_SESSION['userId'];

        $query = $this->db->prepare($query);
        $query->execute();

        if ($query->rowCount())
        {
            return $query->fetchAll();
        }
    }

    /**
     * Get product ratings
     *
     * @return array
     */
    public function getRatings()
    {
        $query = "SELECT product_id, sum(rating) / count(product_id) AS rate FROM product_ratings GROUP BY product_id";
        $query = $this->db->prepare($query);
        $query->execute();

        if ($query->rowCount())
        {
            return $query->fetchAll();
        }


    }

    /**
     * Get cart items
     * @param null $tableName
     * @param null $productIds
     * @return array
     */
    public function getCartItems($tableName = null, $productIds = null)
    {
        $productIds = implode(",", $productIds);
        $query = "SELECT * FROM $tableName WHERE id IN($productIds)";

        $query = $this->db->prepare($query);
        $query->execute();

        if ($query->rowCount())
        {
            return $query->fetchAll();
        }
    }


    /**
     * Insert proces
     *
     * @param null $tableName
     * @param null $fields
     * @param null $values
     * @return integer
     */
    public function insert($tableName = null, $fields = null, $values = null)
    {
        $newSqlString = '';
        foreach ($fields as $field) {
            $newSqlString .= "$field = ?,";
        }
        $newSqlString = rtrim($newSqlString, ",");


        $query = $this->db->prepare("INSERT INTO $tableName SET $newSqlString");
        $insert = $query->execute($values);
        if ($insert)
        {
            $last_id = $this->db->lastInsertId();
//            print "insert successfully!";
            return $last_id;
        }
    }


    public function getUserBalance()
    {
        $user = $this->get('users', null, 'id', $_SESSION['userId']);
        $userBalance = reset($user)['balance'];
        $_SESSION['userBalance'] = $userBalance;
    }
}
