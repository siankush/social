<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostFixture
 */
class PostFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'post';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'users_id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'body' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2023-01-17 09:53:51',
            ],
        ];
        parent::init();
    }
}
