<?php 

namespace Epaphrodites\database\gearShift\schema;

trait makeUpGearShift{

    /**
     * Create table useraccount
     * create 25/01/2024 23:07:14
     */
    public function createUsersAccountTable()
    {
        return $this->createTable('usersaccount', function ($table) {
                $table->addColumn('_id', 'INTEGER', ['PRIMARY KEY', 'AUTOINCREMENT']);
                $table->addColumn('login', 'TEXT' , ['NOT NULL']);
                $table->addColumn('password', 'TEXT' , ['NOT NULL']);
                $table->addColumn('namesurname', 'TEXT' , ['DEFAULT NULL']);
                $table->addColumn('contact', 'TEXT' , ['DEFAULT NULL']);
                $table->addColumn('email', 'TEXT' , ['DEFAULT NULL']);
                $table->addColumn('ip', 'TEXT' , ['DEFAULT NULL']);
                $table->addColumn('usersgroup', 'INTEGER' , ['NOT NULL', 'DEFAULT 1']);
                $table->addColumn('state', 'INTEGER' , ['NOT NULL', 'DEFAULT 1']);
                $table->addIndex('login');
                $table->db(1);
        });
    }    
    /**
    * Create table users
    * create 12/06/2024 23:46:45
    */
    public function createUsersTable()
    {
        return $this->createTable('users', function ($table) {

               $table->addColumn('_id', 'INTEGER', ['PRIMARY KEY']);
               $table->addColumn('Firstname', 'VARCHAR(100)', ['NOT NULL']);
               $table->addColumn('Surname', 'VARCHAR(100)', ['NOT NULL']);
               $table->addColumn('phone', 'VARCHAR(100)', ['NOT NULL']);
               $table->addColumn('email', 'TEXT', ['NOT NULL']);
               $table->db(1);
        });
    }     
}