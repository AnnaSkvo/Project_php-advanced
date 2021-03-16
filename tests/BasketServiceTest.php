<?php

namespace app\tests;

use app\repositories\GoodRepository;
use app\services\BasketService;
use app\services\Request;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BasketServiceTest extends TestCase
{

    public function testAddEmptyGood()
    {
        /** @var GoodRepository|MockObject $goodRepository */
        $goodRepository = $this->getMockBuilder(GoodRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $goodRepository->method('getOne')
            ->willReturn(false);
        $goodRepository
            ->expects(self::once())
            ->method('getOne');

        $mockRequest = $this->createMock(Request::class);

        $basketServices = new BasketService();
        $result = $basketServices->add(12, $goodRepository, $mockRequest);
        $this->assertEquals('Нет товара', $result);
    }

    public function testAddEmptyId()
    {
        $mockRequest = $this->createMock(Request::class);

        /** @var GoodRepository|MockObject $goodRepository */
        $goodRepository = $this->getMockBuilder(GoodRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $goodRepository->method('getOne')
            ->willReturn(false);
        $goodRepository
            ->expects(self::never())
            ->method('getOne');

        $basketServices = new BasketService();
        $result = $basketServices->add(0, $goodRepository, $mockRequest);
        $this->assertEquals('Нет id', $result);
    }

    /**
     * @param $priceReal
     * @param $tax
     * @param $expected
     *
     * @dataProvider getDataForTestGetPrice
     */
    public function testGetPrivatePrice($priceReal, $tax, $expected)
    {
        $method = new \ReflectionMethod(
            BasketService::class,
            'getPrivatePrice'
        );
        $method->setAccessible(true);

        $price = $method->invoke(new BasketService(), $priceReal, $tax);
        $this->assertEquals($expected, $price);
    }

    /**
     * @param $priceReal
     * @param $tax
     * @param $expected
     *
     * @dataProvider getDataForTestGetPrice
     */
    public function testGetPrice($priceReal, $tax, $expected)
    {
        $basketServices = new BasketService();
        $price = $basketServices->getPrice($priceReal, $tax);

        $this->assertEquals($expected, $price);
    }

    public function getDataForTestGetPrice()
    {
        return [
            [100, 0.5, 150],
            [100, 0.7, 170],
            [100456, 0.27, 127579],
        ];
    }
}
