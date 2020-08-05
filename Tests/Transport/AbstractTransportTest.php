<?php

namespace Lexik\Bundle\PayboxBundle\Tests\Transport;

use Lexik\Bundle\PayboxBundle\Paybox\RequestInterface;
use Lexik\Bundle\PayboxBundle\Transport\AbstractTransport;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

/**
 * Test class for Abstract Transport
 *
 * @author Fabien Pomerol <fabien.pomerol@gmail.com>
 */
class AbstractTransportTest extends TestCase
{
    /**
     * @var AbstractTransport
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new MockTransport();
    }

    /**
     */
    public function testExceptionSetEndpoint()
    {
        $this->expectException('InvalidArgumentException');
        $this->object->setEndpoint(3243204);
    }

    public function testSetEndpoint()
    {
        $this->object->setEndpoint('http://www.hello.fr/hey.cgi');

        // This is how to test a private or protected attribute. Value expected,
        // Attribute name, Object
        Assert::assertEquals(
            'http://www.hello.fr/hey.cgi',
            Assert::getObjectAttribute($this->object, 'endpoint')
        );
    }

    public function testGetEndpoint()
    {
        $this->object->setEndpoint('http://www.hello.fr/hey.cgi');
        $this->assertTrue(is_string($this->object->getEndpoint()));
        $this->assertEquals('http://www.hello.fr/hey.cgi', $this->object->getEndpoint());
    }

    /**
     */
    public function testCheckEndpoint()
    {
        $this->expectException('RunTimeException');
        $method = new \ReflectionMethod('Lexik\Bundle\PayboxBundle\Transport\AbstractTransport', 'checkEndpoint');
        $method->setAccessible(TRUE);
        $method->invoke($this->object);
    }

}

class MockTransport extends AbstractTransport
{
    public function call(RequestInterface $request)
    {
        return;
    }
}
