<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence;

use Orm\Zed\Quote\Persistence\Map\SpyQuoteTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence\CompanyBusinessUnitsCartsRestApiPersistenceFactory getFactory()
 */
class CompanyBusinessUnitsCartsRestApiRepository extends AbstractRepository implements CompanyBusinessUnitsCartsRestApiRepositoryInterface
{
    /**
     * @param string $quoteUuid
     *
     * @return int|null
     */
    public function getIdQuoteByQuoteUuid(string $quoteUuid): ?int
    {
        return $this->getFactory()
            ->getQuoteQuery()
            ->clear()
            ->filterByUuid($quoteUuid)
            ->select(SpyQuoteTableMap::COL_ID_QUOTE)
            ->findOne();
    }
}
