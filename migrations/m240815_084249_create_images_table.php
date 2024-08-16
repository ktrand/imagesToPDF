<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles the creation of table `{{%images}}`.
 */
class m240815_084249_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'path' => $this->string(),
            'batch_token' => $this->string(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%images}}');
    }
}
