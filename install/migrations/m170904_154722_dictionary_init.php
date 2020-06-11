<?php

use yii\db\Migration;
use bttree\smydictionary\models\DictionaryItem;

/**
 * Class m170904_154722_dictionary_init
 * @package bttree\smydictionary\install\migrations
 */
class m170904_154722_dictionary_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%dictionary}}',
                           [
                               'id'          => $this->primaryKey(),
                               'name'        => $this->string()->notNull(),
                               'slug'        => $this->string()->unique()->notNull(),
                               'description' => $this->text()->null(),
                           ],
                           $tableOptions);

        $this->createTable('{{%dictionary_item}}',
                           [
                               'id'            => $this->primaryKey(),
                               'dictionary_id' => $this->integer()->notNull(),
                               'status'        => $this->integer()
                                                       ->notNull()
                                                       ->defaultValue(DictionaryItem::STATUS_ACTIVE),
                               'name'          => $this->string()->notNull(),
                               'slug'          => $this->string()->unique()->notNull(),
                               'value'         => $this->string()->notNull(),
                               'description'   => $this->text()->null(),
                           ],
                           $tableOptions);


        $this->addForeignKey('fk_dictionary_item',
                             '{{%dictionary_item}}',
                             'dictionary_id',
                             '{{%dictionary}}',
                             'id',
                             'CASCADE',
                             'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%dictionary_item}}', 'fk_dictionary_item');

        $this->dropTable('{{%dictionary_item}}');
        $this->dropTable('{{%dictionary}}');
    }
}
