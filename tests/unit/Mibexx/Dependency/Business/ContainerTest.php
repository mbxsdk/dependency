<?php
namespace Mibexx\Dependency\Business;


use Mibexx\Kernel\Business\Config\ConfigInterface;

class ContainerTest extends \Codeception\Test\Unit
{

    public function testGetAndSetConfig()
    {
        $config = $this->getMockBuilder(ConfigInterface::class)
            ->setMethods(['set', 'get'])
            ->getMock();

        $container = new Container();
        $container->setConfig($config);
        $this->assertEquals($config, $container->getConfig());
    }
}