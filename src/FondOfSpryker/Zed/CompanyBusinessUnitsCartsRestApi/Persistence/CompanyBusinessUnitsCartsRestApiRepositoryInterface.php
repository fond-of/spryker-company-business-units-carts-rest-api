<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence;

interface CompanyBusinessUnitsCartsRestApiRepositoryInterface
{
    /**
     * @param string $quoteUuid
     *
     * @return int|null
     */
    public function getIdQuoteByQuoteUuid(string $quoteUuid): ?int;
}
