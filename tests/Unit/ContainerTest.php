<?php

namespace Tests\Unit;

use App\Container;
use App\Services\InvoiceService;
use App\Services\PaddlePaymentService;
use App\Services\PaymentGatewayService;
use App\Services\PaymentGatewayServiceInterface;
use App\Services\StripePaymentService;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container();
    }

    /** @test */
    public function it_sets_a_class()
    {
        $depId = PaymentGatewayServiceInterface::class;

        $this->container->set($depId, PaddlePaymentService::class);

        $expected = [
            $depId => PaddlePaymentService::class
        ];

        $this->assertSame($expected, $this->container->getEntries());
    }

    /** @test  */
    public function it_gets_a_class()
    {
        $id = InvoiceService::class;
        $this->container->set($id, InvoiceService::class);
        $this->container->set(PaymentGatewayServiceInterface::class, PaddlePaymentService::class);

        $expected = InvoiceService::class;

        $this->assertInstanceOf($expected, $this->container->get($id));
    }

    /** @test */
    public function it_resolves_a_class()
    {

        $res = $this->container->resolve(StripePaymentService::class);

        $this->assertInstanceOf(StripePaymentService::class, $res);
    }
}
