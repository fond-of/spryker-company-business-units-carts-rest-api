<?php

namespace FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\Cart;

use FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiClientInterface;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiConfig;
use FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\RestResponseBuilder\CartRestResponseBuilderInterface;
use Generated\Shared\Transfer\RestCompanyBusinessUnitCartListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CartReader implements CartReaderInterface
{
    /**
     * @var \FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiClientInterface
     */
    protected $client;

    /**
     * @var \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\RestResponseBuilder\CartRestResponseBuilderInterface
     */
    protected $cartRestResponseBuilder;

    /**
     * @param \FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiClientInterface $client
     * @param \FondOfSpryker\Glue\CompanyBusinessUnitsCartsRestApi\Processor\RestResponseBuilder\CartRestResponseBuilderInterface $cartRestResponseBuilder
     */
    public function __construct(
        CompanyBusinessUnitsCartsRestApiClientInterface $client,
        CartRestResponseBuilderInterface $cartRestResponseBuilder
    ) {
        $this->client = $client;
        $this->cartRestResponseBuilder = $cartRestResponseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findCarts(RestRequestInterface $restRequest): RestResponseInterface
    {
        if ($this->findCompanyBusinessUnitIdentifier($restRequest) === null) {
            return $this->cartRestResponseBuilder->createCompanyBusinessUnitIdentifierMissingErrorResponse();
        }

        $restCompanyBusinessUnitCartListTransfer = $this->createRestCompanyBusinessUnitCartListTransfer($restRequest);

        $companyBusinessUnitQuoteListTransfer = $this->client->findQuotes($restCompanyBusinessUnitCartListTransfer);

        return $this->cartRestResponseBuilder->createCartListRestResponse(
            $restCompanyBusinessUnitCartListTransfer,
            $companyBusinessUnitQuoteListTransfer
        );
    }

    /**
     * @param string $idCart
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getCart(string $idCart, RestRequestInterface $restRequest): RestResponseInterface
    {
        if ($this->findCompanyBusinessUnitIdentifier($restRequest) === null) {
            return $this->cartRestResponseBuilder->createCompanyBusinessUnitIdentifierMissingErrorResponse();
        }

        $restCompanyBusinessUnitCartListTransfer = $this->createRestCompanyBusinessUnitCartListTransfer($restRequest);
        $restCompanyBusinessUnitCartListTransfer->setCartUuid($idCart);

        $companyBusinessUnitQuoteListTransfer = $this->client->findQuotes($restCompanyBusinessUnitCartListTransfer);

        $quoteTransfers = $companyBusinessUnitQuoteListTransfer->getQuotes();

        if ($quoteTransfers->count() !== 1) {
            return $this->cartRestResponseBuilder->createCartNotFoundErrorResponse();
        }

        return $this->cartRestResponseBuilder->createCartRestResponse(
            $restCompanyBusinessUnitCartListTransfer,
            $quoteTransfers->offsetGet(0)
        );
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitCartListTransfer
     */
    protected function createRestCompanyBusinessUnitCartListTransfer(
        RestRequestInterface $restRequest
    ): RestCompanyBusinessUnitCartListTransfer {
        return (new RestCompanyBusinessUnitCartListTransfer())
            ->setIdCustomer($restRequest->getRestUser()->getSurrogateIdentifier())
            ->setCompanyBusinessUnitUuid($this->findCompanyBusinessUnitIdentifier($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    protected function findCompanyBusinessUnitIdentifier(RestRequestInterface $restRequest): ?string
    {
        $companyBusinessUnitsResource = $restRequest->findParentResourceByType(
            CompanyBusinessUnitsCartsRestApiConfig::PARENT_RESOURCE_COMPANY_BUSINESS_UNITS
        );

        if ($companyBusinessUnitsResource) {
            return $companyBusinessUnitsResource->getId();
        }

        return null;
    }
}
