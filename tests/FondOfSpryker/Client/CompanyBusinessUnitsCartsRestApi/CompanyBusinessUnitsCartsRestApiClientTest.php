<?php

namespace FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\Zed\CompanyBusinessUnitsCartsRestApiZedStubInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitQuoteListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitCartListTransfer;

class CompanyBusinessUnitsCartsRestApiClientTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiFactory
     */
    protected $companyBusinessUnitsCartsRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\Zed\CompanyBusinessUnitsCartsRestApiZedStubInterface
     */
    protected $companyBusinessUnitsCartsRestApiZedStubMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompanyBusinessUnitCartListTransfer
     */
    protected $restCompanyBusinessUnitCartListTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitQuoteListTransfer
     */
    protected $companyBusinessUnitQuoteListTransferMock;

    /**
     * @var \FondOfSpryker\Client\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiClient
     */
    protected $companyBusinessUnitsCartsRestApiClient;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitsCartsRestApiFactoryMock = $this->getMockBuilder(CompanyBusinessUnitsCartsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitsCartsRestApiZedStubMock = $this->getMockBuilder(CompanyBusinessUnitsCartsRestApiZedStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitCartListTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitCartListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitQuoteListTransferMock = $this->getMockBuilder(CompanyBusinessUnitQuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitsCartsRestApiClient = new CompanyBusinessUnitsCartsRestApiClient();
        $this->companyBusinessUnitsCartsRestApiClient->setFactory($this->companyBusinessUnitsCartsRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindQuotes(): void
    {
        $this->companyBusinessUnitsCartsRestApiFactoryMock->expects(self::atLeastOnce())
            ->method('createCompanyBusinessUnitsCartsRestApiZedStub')
            ->willReturn($this->companyBusinessUnitsCartsRestApiZedStubMock);

        $this->companyBusinessUnitsCartsRestApiZedStubMock->expects(self::atLeastOnce())
            ->method('findQuotes')
            ->with($this->restCompanyBusinessUnitCartListTransferMock)
            ->willReturn($this->companyBusinessUnitQuoteListTransferMock);

        $companyBusinessUnitQuoteListTransfer = $this->companyBusinessUnitsCartsRestApiClient->findQuotes(
            $this->restCompanyBusinessUnitCartListTransferMock
        );

        self::assertEquals($this->companyBusinessUnitQuoteListTransferMock, $companyBusinessUnitQuoteListTransfer);
    }
}
