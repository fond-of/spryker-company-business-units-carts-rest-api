<?php

namespace FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiConfig;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiFactory;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Expander\CartItemByQuoteResourceRelationshipExpanderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CartItemsByQuoteResourceRelationshipPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiFactory
     */
    protected $companyBusinessUnitsCartsRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    protected $restResourceMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Expander\CartItemByQuoteResourceRelationshipExpanderInterface
     */
    protected $cartItemByQuoteResourceRelationshipExpanderMock;

    /**
     * @var \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Plugin\GlueApplicationExtension\CartItemsByQuoteResourceRelationshipPlugin
     */
    protected $cartItemsByQuoteResourceRelationshipPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitsCartsRestApiFactoryMock = $this->getMockBuilder(CompanyBusinessUnitsCartsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMocks = [
            $this->getMockBuilder(RestResourceInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->cartItemByQuoteResourceRelationshipExpanderMock = $this->getMockBuilder(CartItemByQuoteResourceRelationshipExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartItemsByQuoteResourceRelationshipPlugin = new class(
            $this->companyBusinessUnitsCartsRestApiFactoryMock
        ) extends CartItemsByQuoteResourceRelationshipPlugin {
            /**
             * @var \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiFactory
             */
            protected $companyBusinessUnitsCartsRestApiFactory;

            /**
             * @param \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiFactory $companyBusinessUnitsCartsRestApiFactory
             */
            public function __construct(
                CompanyBusinessUnitsCartsRestApiFactory $companyBusinessUnitsCartsRestApiFactory)
            {
                $this->companyBusinessUnitsCartsRestApiFactory = $companyBusinessUnitsCartsRestApiFactory;
            }

            /**
             * @return \Spryker\Glue\Kernel\AbstractFactory
             */
            protected function getFactory(): AbstractFactory {
                return $this->companyBusinessUnitsCartsRestApiFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->companyBusinessUnitsCartsRestApiFactoryMock->expects(self::atLeastOnce())
            ->method('createCartItemByQuoteResourceRelationshipExpander')
            ->willReturn($this->cartItemByQuoteResourceRelationshipExpanderMock);

        $this->cartItemByQuoteResourceRelationshipExpanderMock->expects(self::atLeastOnce())
            ->method('addResourceRelationships')
            ->with($this->restResourceMocks, $this->restRequestMock);

        $this->cartItemsByQuoteResourceRelationshipPlugin->addResourceRelationships(
            $this->restResourceMocks,
            $this->restRequestMock
        );
    }

    /**
     * @return void
     */
    public function testGetRelationshipResourceType(): void
    {
        self::assertEquals(
            CompanyBusinessUnitsCartsRestApiConfig::RESOURCE_CART_ITEMS,
            $this->cartItemsByQuoteResourceRelationshipPlugin->getRelationshipResourceType()
        );
    }
}
