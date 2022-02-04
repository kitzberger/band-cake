<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LocationsMailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LocationsMailsTable Test Case
 */
class LocationsMailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LocationsMailsTable
     */
    public $LocationsMails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LocationsMails',
        'app.Locations',
        'app.Mails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LocationsMails') ? [] : ['className' => LocationsMailsTable::class];
        $this->LocationsMails = TableRegistry::getTableLocator()->get('LocationsMails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LocationsMails);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
