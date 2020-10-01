<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model;

use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence\CompanyBusinessUnitsCartsRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitQuoteListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitCartListTransfer;

class QuoteReader implements QuoteReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\CompanyBusinessUnitReaderInterface
     */
    protected $companyBusinessUnitReader;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\RestCompanyBusinessUnitCartListMapperInterface
     */
    protected $restCompanyBusinessUnitCartListMapper;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence\CompanyBusinessUnitsCartsRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface
     */
    protected $companyBusinessUnitQuoteConnectorFacade;

    /**
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\CompanyBusinessUnitReaderInterface $companyBusinessUnitReader
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\RestCompanyBusinessUnitCartListMapperInterface $restCompanyBusinessUnitCartListMapper
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence\CompanyBusinessUnitsCartsRestApiRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface $companyBusinessUnitQuoteConnectorFacade
     */
    public function __construct(
        CompanyBusinessUnitReaderInterface $companyBusinessUnitReader,
        RestCompanyBusinessUnitCartListMapperInterface $restCompanyBusinessUnitCartListMapper,
        CompanyBusinessUnitsCartsRestApiRepositoryInterface $repository,
        CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface $companyBusinessUnitQuoteConnectorFacade
    ) {
        $this->companyBusinessUnitReader = $companyBusinessUnitReader;
        $this->restCompanyBusinessUnitCartListMapper = $restCompanyBusinessUnitCartListMapper;
        $this->repository = $repository;
        $this->companyBusinessUnitQuoteConnectorFacade = $companyBusinessUnitQuoteConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyBusinessUnitCartListTransfer $restCompanyBusinessUnitCartListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitQuoteListTransfer
     */
    public function find(
        RestCompanyBusinessUnitCartListTransfer $restCompanyBusinessUnitCartListTransfer
    ): CompanyBusinessUnitQuoteListTransfer {
        $companyBusinessUnitQuoteListRequestTransfer = $this->restCompanyBusinessUnitCartListMapper
            ->mapToCompanyBusinessUnitQuoteListRequestTransfer($restCompanyBusinessUnitCartListTransfer);

        $companyBusinessUnitTransfer = $this->companyBusinessUnitReader->getByRestCompanyBusinessUnitCartList(
            $restCompanyBusinessUnitCartListTransfer
        );

        if ($companyBusinessUnitTransfer !== null) {
            $companyBusinessUnitQuoteListRequestTransfer->setIdCompanyBusinessUnit(
                $companyBusinessUnitTransfer->getIdCompanyBusinessUnit()
            );
        }

        $idQuote = $this->getIdQuoteByRestCompanyBusinessUnitCartList($restCompanyBusinessUnitCartListTransfer);

        $companyBusinessUnitQuoteListRequestTransfer->setIdQuote($idQuote);

        return $this->companyBusinessUnitQuoteConnectorFacade->findQuotes($companyBusinessUnitQuoteListRequestTransfer);
    }

    /**
     * @param $restCompanyBusinessUnitCartListTransfer
     *
     * @return int|null
     */
    protected function getIdQuoteByRestCompanyBusinessUnitCartList(
        RestCompanyBusinessUnitCartListTransfer $restCompanyBusinessUnitCartListTransfer
    ): ?int {
        if ($restCompanyBusinessUnitCartListTransfer->getCartUuid() === null) {
            return null;
        }

        return $this->repository->getIdQuoteByQuoteUuid($restCompanyBusinessUnitCartListTransfer->getCartUuid());
    }
}
