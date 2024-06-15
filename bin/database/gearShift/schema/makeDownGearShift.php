<?php 

namespace Epaphrodites\database\gearShift\schema;

trait makeDownGearShift{

    /**
     * Drop Column ip
     * create 25/01/2024 23:07:14
     */
    public function dropUsersAccountColumn()
    {
        return $this->dropTable('users', function ($table) {
            $table->db(1);
        });
    }                     
}