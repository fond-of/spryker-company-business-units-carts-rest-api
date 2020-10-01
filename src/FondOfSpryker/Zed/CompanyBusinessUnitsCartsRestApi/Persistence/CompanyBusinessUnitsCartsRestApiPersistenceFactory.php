<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence;

use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiDependencyProvider;
use Orm\Zed\Quote\Persistence\SpyQuoteQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence\CompanyBusinessUnitsCartsRestApiRepositoryInterface getRepository()
 */
class CompanyBusinessUnitsCartsRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Quote\Persistence\SpyQuoteQuery
     */
    public function getQuoteQuery(): SpyQuoteQuery
    {
        return $this->getProvidedDependency(
            CompanyBusinessUnitsCartsRestApiDependencyProvider::PROPEL_QUERY_QUOTE
        );
    }
}
