<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\PageBundle\Tests\Block;

use Sonata\PageBundle\Block\BlockContextManager;

/**
 * Class BlockContextManagerTest.
 *
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
class BlockContextManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetWithValidData()
    {
        $service = $this->getMock('Sonata\BlockBundle\Block\BlockServiceInterface');
        $service->expects($this->once())->method('setDefaultSettings');

        $blockLoader = $this->getMock('Sonata\BlockBundle\Block\BlockLoaderInterface');

        $serviceManager = $this->getMock('Sonata\BlockBundle\Block\BlockServiceManagerInterface');
        $serviceManager->expects($this->once())->method('get')->will($this->returnValue($service));

        $block = $this->getMock('Sonata\BlockBundle\Model\BlockInterface');
        $block->expects($this->once())->method('getSettings')->will($this->returnValue(array()));

        $manager = new BlockContextManager($blockLoader, $serviceManager);

        $blockContext = $manager->get($block);

        $this->assertInstanceOf('Sonata\BlockBundle\Block\BlockContextInterface', $blockContext);

        $this->assertEquals(array(
            'manager'          => false,
            'page_id'          => false,
            'use_cache'        => true,
            'extra_cache_keys' => array(),
            'attr'             => array(),
            'template'         => false,
            'ttl'              => 0,
        ), $blockContext->getSettings());
    }
}
