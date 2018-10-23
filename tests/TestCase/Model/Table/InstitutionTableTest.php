<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InstitutionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InstitutionTable Test Case
 */
class InstitutionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InstitutionTable
     */
    public $Institution;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.institution'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Institution') ? [] : ['className' => InstitutionTable::class];
        $this->Institution = TableRegistry::getTableLocator()->get('Institution', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Institution);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
