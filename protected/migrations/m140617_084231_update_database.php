<?php

class m140617_084231_update_database extends CDbMigration
{
    public function up()
    {
        $this->addColumn('g_payroll', 'is_prorate_id', 'TINYINT(1) DEFAULT 1 AFTER basic_salary');
    }

    public function down()
    {
        echo "m140617_084231_update_database does not support migration down.\n";
        return false;
    }

    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}