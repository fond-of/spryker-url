<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\UrlTransfer;
use Orm\Zed\Url\Persistence\SpyUrl;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Spryker\Zed\Url\Business\Url\UrlActivatorInterface;
use Spryker\Zed\Url\Business\Url\UrlReaderInterface;
use Spryker\Zed\Url\Persistence\UrlQueryContainerInterface;

class UrlCreatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\UrlTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $urlTransferMock;

    /**
     * @var \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryContainerMock;

    /**
     * @var \FondOfSpryker\Zed\Url\Business\Url\UrlReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $urlReaderMock;

    /**
     * @var \Spryker\Zed\Url\Business\Url\UrlActivatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $urlActivatorMock;

    /**
     * @var \Orm\Zed\Url\Persistence\SpyUrlQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $urlQueryMock;

    /**
     * @var \Orm\Zed\Url\Persistence\SpyUrl|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $urlEntityMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerFactoryMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerMock;

    /**
     * @var \FondOfSpryker\Zed\Url\Business\Url\UrlCreator
     */
    protected $creator;

    /**
     * @return void
     */
    public function _before()
    {
        $this->urlTransferMock = $this->getMockBuilder(UrlTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(UrlQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->urlReaderMock = $this->getMockBuilder(UrlReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->urlActivatorMock = $this->getMockBuilder(UrlActivatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->urlQueryMock = $this->getMockBuilder(SpyUrlQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->urlEntityMock = $this->getMockBuilder(SpyUrl::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerFactoryMock = $this->getMockBuilder(TransactionHandlerFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerFactoryMock->method('createHandler')->willReturn($this->transactionHandlerMock);

        $this->creator = new class ($this->queryContainerMock, $this->urlReaderMock, $this->urlActivatorMock, $this->transactionHandlerFactoryMock) extends UrlCreator{
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory
             */
            protected $transactionHandlerFactoryMock;

            /**
             * @param \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface $urlQueryContainer
             * @param \Spryker\Zed\Url\Business\Url\UrlReaderInterface $urlReader
             * @param \Spryker\Zed\Url\Business\Url\UrlActivatorInterface $urlActivator
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory $transactionHandlerFactoryMock
             */
            public function __construct(
                UrlQueryContainerInterface $urlQueryContainer,
                UrlReaderInterface $urlReader,
                UrlActivatorInterface $urlActivator,
                TransactionHandlerFactory $transactionHandlerFactoryMock
            ) {
                parent::__construct($urlQueryContainer, $urlReader, $urlActivator);
                $this->transactionHandlerFactoryMock = $transactionHandlerFactoryMock;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected function createTransactionHandlerFactory()
            {
                return $this->transactionHandlerFactoryMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testPersistUrlEntity()
    {
        $this->urlTransferMock->expects($this->atLeastOnce())
            ->method('requireUrl')
            ->willReturnSelf();
        $this->urlTransferMock->expects($this->atLeastOnce())
            ->method('requireFkLocale')
            ->willReturnSelf();
        $this->urlTransferMock->expects($this->atLeastOnce())
            ->method('requireFkStore')
            ->willReturnSelf();
        $this->urlTransferMock->expects($this->once())
            ->method('getUrl')
            ->willReturn('url');
        $this->urlTransferMock->expects($this->once())
            ->method('getFkStore')
            ->willReturn(1);
        $this->urlTransferMock->expects($this->once())
            ->method('getFkLocale')
            ->willReturn(1);
        $this->urlTransferMock->expects($this->once())
            ->method('modifiedToArray')
            ->willReturn(['test']);
        $this->urlTransferMock->expects($this->once())
            ->method('fromArray')->with(['test'], true)
            ->willReturnSelf();

        $this->queryContainerMock->expects($this->once())
            ->method('queryUrl')
            ->with('url')
            ->willReturn($this->urlQueryMock);

        $this->urlQueryMock->expects($this->once())
            ->method('filterByFkStore')
            ->with(1)
            ->willReturnSelf();

        $this->urlQueryMock->expects($this->once())
            ->method('filterByFkLocale')
            ->with(1)
            ->willReturnSelf();

        $this->urlQueryMock->expects($this->once())
            ->method('findOneOrCreate')
            ->willReturn($this->urlEntityMock);

        $this->urlEntityMock->expects($this->once())
            ->method('getIdUrl')
            ->willReturn(1);

        $this->urlEntityMock->expects($this->once())
            ->method('fromArray')->with(['test']);

        $this->urlEntityMock->expects($this->once())
            ->method('setIdUrl')->with(1);

        $this->urlEntityMock->expects($this->once())
            ->method('save');

        $this->urlEntityMock->expects($this->once())
            ->method('toArray')->willReturn(['test']);

        $this->transactionHandlerMock->expects($this->atLeastOnce())
            ->method('handleTransaction')->willReturnCallback(static function (callable $callable) {
                $callable();
            });

        $this->creator->createUrl($this->urlTransferMock);
    }
}
