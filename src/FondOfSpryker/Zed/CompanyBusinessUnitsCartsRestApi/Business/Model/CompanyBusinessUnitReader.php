<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model;

use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitCartListTransfer;

class CompanyBusinessUnitReader implements CompanyBusinessUnitReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     */
    public function __construct(
        CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
    ) {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyBusinessUnitCartListTransfer $restCompanyBusinessUnitCartListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getByRestCompanyBusinessUnitCartList(
        RestCompanyBusinessUnitCartListTransfer $restCompanyBusinessUnitCartListTransfer
    ): ?CompanyBusinessUnitTransfer {
        $companyBusinessUnitUuid = $restCompanyBusinessUnitCartListTransfer->getCompanyBusinessUnitUuid();

        if ($companyBusinessUnitUuid === null) {
            return null;
        }

        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
            ->setUuid($companyBusinessUnitUuid);

        $companyBusinessUnitResponseTransfer = $this->companyBusinessUnitFacade
            ->findCompanyBusinessUnitByUuid($companyBusinessUnitTransfer);

        if ($companyBusinessUnitResponseTransfer->getIsSuccessful() !== true) {
            return null;
        }

        return $companyBusinessUnitResponseTransfer->getCompanyBusinessUnitTransfer();
    }
}
