<?php

namespace FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi;

use FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\Dependency\Client\CompanyBusinessUnitsCartsRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\Zed\CompanyBusinessUnitsCartsRestApiZedStub;
use FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\Zed\CompanyBusinessUnitsCartsRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompanyBusinessUnitsCartsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\Zed\CompanyBusinessUnitsCartsRestApiZedStubInterface
     */
    public function createCompanyBusinessUnitsCartsRestApiZedStub(): CompanyBusinessUnitsCartsRestApiZedStubInterface
    {
        return new CompanyBusinessUnitsCartsRestApiZedStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\Dependency\Client\CompanyBusinessUnitsCartsRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompanyBusinessUnitsCartsRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitsCartsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
