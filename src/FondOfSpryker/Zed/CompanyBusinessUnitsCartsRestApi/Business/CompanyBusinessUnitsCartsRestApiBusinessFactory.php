<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business;

use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\CompanyBusinessUnitReader;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\CompanyBusinessUnitReaderInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\QuoteReader;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\QuoteReaderInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\RestCompanyBusinessUnitCartListMapper;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\RestCompanyBusinessUnitCartListMapperInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiDependencyProvider;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence\CompanyBusinessUnitsCartsRestApiRepositoryInterface getRepository()
 */
class CompanyBusinessUnitsCartsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\QuoteReaderInterface
     */
    public function createQuoteReader(): QuoteReaderInterface
    {
        return new QuoteReader(
            $this->createCompanyBusinessUnitReader(),
            $this->createRestCompanyBusinessUnitCartListMapper(),
            $this->getRepository(),
            $this->getCompanyBusinessUnitQuoteConnectorFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\CompanyBusinessUnitReaderInterface
     */
    protected function createCompanyBusinessUnitReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitReader(
            $this->getCompanyBusinessUnitFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface
     */
    protected function getCompanyBusinessUnitFacade(): CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitsCartsRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface
     */
    protected function getCompanyBusinessUnitQuoteConnectorFacade(): CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitsCartsRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT_QUOTE_CONNECTOR);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\RestCompanyBusinessUnitCartListMapperInterface
     */
    protected function createRestCompanyBusinessUnitCartListMapper(): RestCompanyBusinessUnitCartListMapperInterface
    {
        return new RestCompanyBusinessUnitCartListMapper();
    }
}
