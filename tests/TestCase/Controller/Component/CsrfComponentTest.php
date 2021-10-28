<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CsrfComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CsrfComponent Test Case
 */
class CsrfComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\CsrfComponent
     */
    protected $Csrf;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Csrf = new CsrfComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Csrf);

        parent::tearDown();
    }
}
