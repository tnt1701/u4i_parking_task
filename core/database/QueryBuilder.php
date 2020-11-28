<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function findBy($table, $column, $parameter, $value)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$column}=:{$parameter}");

        $statement->execute([$parameter => $value]);

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function getSumBy($table, $column)
    {
        $statement = $this->pdo->prepare("SELECT SUM({$column}) FROM {$table}");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public function create($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            die('Something went wrong.');
        }
    }

    public function delete($table, $column, $parameter, $value)
    {
        $sql = sprintf(
            'delete from %s WHERE %s=:%s',
            $table,
            $column,
            $parameter
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$parameter => $value]);
        } catch (Exception $e) {
            die('Something went wrong.');
        }
    }
}
