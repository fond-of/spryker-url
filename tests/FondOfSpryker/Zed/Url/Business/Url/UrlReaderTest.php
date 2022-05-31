<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface;
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\UrlTransfer;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Spryker\Zed\Url\Persistence\UrlQueryContainerInterface;
use Spryker\Zed\Url\Persistence\UrlRepositoryInterface;

class UrlReaderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\UrlTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $urlTransferMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryContainerMock;

    /**
     * @var \Spryker\Zed\Url\Persistence\UrlRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $urlRepositoryMock;

    /**
     * @var \FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \Orm\Zed\Url\Persistence\SpyUrlQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $urlQueryMock;

    /**
     * @var \FondOfSpryker\Zed\Url\Business\Url\UrlReader
     */
    protected $reader;

    /**
     * @return void
     */
    public function _before()
    {
        $this->urlTransferMock = $this->getMockBuilder(UrlTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(UrlQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->urlRepositoryMock = $this->getMockBuilder(UrlRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(UrlToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->urlQueryMock = $this->getMockBuilder(SpyUrlQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new UrlReader($this->queryContainerMock, $this->urlRepositoryMock, $this->storeFacadeMock);
    }

    /**
     * @return void
     */
    public function testQueryUrlEntity()
    {
        $this->urlTransferMock->expects($this->atLeastOnce())
            ->method('getUrl')
            ->willReturn('url');
        $this->urlTransferMock->expects($this->atLeastOnce())
            ->method('getFkStore')
            ->willReturn(1);
        $this->urlTransferMock->expects($this->never())
            ->method('getIdUrl');

        $this->queryContainerMock->expects($this->once())
            ->method('queryUrls')
            ->willReturn($this->urlQueryMock);

        $this->urlQueryMock->expects($this->once())
            ->method('filterByFkStore')
            ->with(1)
            ->willReturnSelf();

        $this->urlQueryMock->expects($this->once())
            ->method('filterByUrl')
            ->willReturnSelf();

        $this->storeFacadeMock->expects($this->never())
            ->method('getCurrentStore');

        $this->reader->hasUrlOrRedirectedUrl($this->urlTransferMock);
    }

    /**
     * @return void
     */
    public function testQueryUrlEntityGetfkStoreFromFacade()
    {
        $this->urlTransferMock->expects($this->atLeastOnce())
            ->method('getUrl')
            ->willReturn('url');
        $this->urlTransferMock->expects($this->atLeastOnce())
            ->method('getFkStore');
        $this->urlTransferMock->expects($this->never())
            ->method('getIdUrl');

        $this->queryContainerMock->expects($this->once())
            ->method('queryUrls')
            ->willReturn($this->urlQueryMock);

        $this->urlQueryMock->expects($this->once())
            ->method('filterByFkStore')
            ->with(1)
            ->willReturnSelf();

        $this->urlQueryMock->expects($this->once())
            ->method('filterByUrl')
            ->willReturnSelf();

        $this->storeFacadeMock->expects($this->once())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects($this->once())
            ->method('getIdStore')
            ->willReturn(1);

        $this->reader->hasUrlOrRedirectedUrl($this->urlTransferMock);
    }
}
