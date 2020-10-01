<?php

namespace FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi;

use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Cart\CartReader;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Cart\CartReaderInterface;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Expander\CartItemByQuoteResourceRelationshipExpander;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Expander\CartItemByQuoteResourceRelationshipExpanderInterface;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Mapper\CartItemMapper;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Mapper\CartItemMapperInterface;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Mapper\CartMapper;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Mapper\CartMapperInterface;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\RestResponseBuilder\CartItemRestResponseBuilder;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\RestResponseBuilder\CartItemRestResponseBuilderInterface;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\RestResponseBuilder\CartRestResponseBuilder;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\RestResponseBuilder\CartRestResponseBuilderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiClientInterface getClient()
 */
class CompanyBusinessUnitsCartsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Cart\CartReaderInterface
     */
    public function createCartReader(): CartReaderInterface
    {
        return new CartReader(
            $this->getClient(),
            $this->createCartRestResponseBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\RestResponseBuilder\CartRestResponseBuilderInterface
     */
    protected function createCartRestResponseBuilder(): CartRestResponseBuilderInterface
    {
        return new CartRestResponseBuilder(
            $this->getResourceBuilder(),
            $this->createCartMapper()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Mapper\CartMapperInterface
     */
    protected function createCartMapper(): CartMapperInterface
    {
        return new CartMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Expander\CartItemByQuoteResourceRelationshipExpanderInterface
     */
    public function createCartItemByQuoteResourceRelationshipExpander(): CartItemByQuoteResourceRelationshipExpanderInterface
    {
        return new CartItemByQuoteResourceRelationshipExpander(
            $this->createCartItemRestResponseBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\RestResponseBuilder\CartItemRestResponseBuilderInterface
     */
    protected function createCartItemRestResponseBuilder(): CartItemRestResponseBuilderInterface
    {
        return new CartItemRestResponseBuilder(
            $this->getResourceBuilder(),
            $this->createCartItemMapper()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Mapper\CartItemMapperInterface
     */
    protected function createCartItemMapper(): CartItemMapperInterface
    {
        return new CartItemMapper();
    }
}
