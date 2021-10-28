<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('name', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('username', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('createdAt', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('updatedAt', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex(['email', 'username'], [
            'unique'=> true,
            'name'=> 'idx_users_email',
            'order'=> ['email'=> 'DESC', 'username'=> 'ASC']
        ]);
        $table->create();
    }
}
