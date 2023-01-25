<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentTable Test Case
 */
class CommentTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentTable
     */
    protected $Comment;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Comment',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Comment') ? [] : ['className' => CommentTable::class];
        $this->Comment = $this->getTableLocator()->get('Comment', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Comment);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CommentTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
