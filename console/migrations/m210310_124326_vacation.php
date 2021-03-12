<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m210310_124326_vacation
 */
class m210310_124326_vacation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%vacation}}', [

            'id'        =>  Schema::TYPE_PK,
            'user_id'   =>  $this->integer()->defaultValue(0),
            'fixed'     =>  $this->integer()->defaultValue(0),

            'from'      =>  Schema::TYPE_DATETIME,
            'to'        =>  Schema::TYPE_DATETIME,

            'title'     =>  $this->string(255)->null(),

        ], $tableOptions);

        $this->createIndex('vacation-user_id', '{{%vacation}}', 'user_id');
        $this->createIndex('vacation-fixed', '{{%vacation}}', 'fixed');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('vacation-user_id', '{{%vacation}}');
        $this->dropIndex('vacation-fixed', '{{%vacation}}');

        $this->dropTable('{{%vacation}}');
    }

}
