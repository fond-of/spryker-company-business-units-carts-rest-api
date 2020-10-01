<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\Model\QuoteReader;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\CompanyBusinessUnitsCartsRestApiDependencyProvider;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface;
use FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence\CompanyBusinessUnitsCartsRestApiRepository;
use Spryker\Zed\Kernel\Container;

class CompanyBusinessUnitsCartsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Dependency\Facade\CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface
     */
    protected $companyBusinessUnitQuoteConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Persistence\CompanyBusinessUnitsCartsRestApiRepository
     */
    protected $repositoryMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitsCartsRestApi\Business\CompanyBusinessUnitsCartsRestApiBusinessFactory
     */
    protected $companyBusinessUnitsCartsRestApiBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitQuoteConnectorFacadeMock = $this->getMockBuilder(CompanyBusinessUnitsCartsRestApiToCompanyBusinessUnitQuoteConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitsCartsRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitsCartsRestApiBusinessFactory = new CompanyBusinessUnitsCartsRestApiBusinessFactory();
        $this->companyBusinessUnitsCartsRestApiBusinessFactory->setContainer($this->containerMock);
        $this->companyBusinessUnitsCartsRestApiBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyBusinessUnitsCartsRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT],
                [CompanyBusinessUnitsCartsRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT_QUOTE_CONNECTOR]
            )
            ->willReturnOnConsecutiveCalls(
                $this->companyBusinessUnitFacadeMock,
                $this->companyBusinessUnitQuoteConnectorFacadeMock
            );

        self::assertInstanceOf(
            QuoteReader::class,
            $this->companyBusinessUnitsCartsRestApiBusinessFactory->createQuoteReader()
        );
    }
}
