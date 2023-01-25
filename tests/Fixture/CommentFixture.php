<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CommentFixture
 */
class CommentFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'comment';
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
                'post_id' => 1,
                'user_id' => 1,
                'comment' => 'Lorem ipsum dolor sit amet',
                'commented_at' => '2023-01-17 10:01:08',
            ],
        ];
        parent::init();
    }
}
