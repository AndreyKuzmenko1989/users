<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m161127_151552_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id_post' => $this->primaryKey(),
            'title' => $this->string(200)->notNull(),
            'text' => $this->string(5000)->notNull(),
            'date_add' => $this->datetime()->notNull(),
            'date_upd' => $this->datetime(),
            'pub_key' => $this->integer()->notNull()->defaultValue('0'),
            'id_user' => $this->integer()->notNull(),
            
        ]);
        
        $this->createIndex(
            'idx-post-id_user',
            'post',
            'id_user'
        );

        
        $this->addForeignKey(
            'fk-post-id_user',
            'post',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('post');
    }
}
