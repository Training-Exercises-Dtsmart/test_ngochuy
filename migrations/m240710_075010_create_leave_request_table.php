<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%leave_request}}`.
 */
class m240710_075010_create_leave_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%leave_request}}', [
            'id' => $this->primaryKey(),
            'content' => $this->text(),
            'request_date' => $this->dateTime(),
            'status' => $this->string()->defaultValue('Pending'), // Pending, Approved, Disapproved
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(),
        ]);

        // Create index for column `user_id`
        $this->createIndex(
            'idx-leave_request-created_by',
            '{{%leave_request}}',
            'created_by'
        );

        // Add foreign key for table `user`
        $this->addForeignKey(
            'fk-leave_request-created_by',
            '{{%leave_request}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        // Drop foreign key for table `user`
        $this->dropForeignKey(
            'fk-leave_request-created_by',
            '{{%leave_request}}'
        );

        // Drop index for column `user_id`
        $this->dropIndex(
            'idx-leave_request-created_by',
            '{{%leave_request}}'
        );


        $this->dropTable('{{%leave_request}}');
    }
}
