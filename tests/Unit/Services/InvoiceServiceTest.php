<?php

namespace Services;

use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{

    /** @test  */
    public function it_processes_invoice(): void
    {
        // create test doubles
        $salesTaxServiceMock    = $this->createMock(SalesTaxService::class);
        $gatewayServiceMock     = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock       = $this->createMock(EmailService::class);

        // stub our test doubles methods to return the desired values
        $gatewayServiceMock->method('charge')->willReturn(true);

        // given invoice service
        $invoiceService = new InvoiceService($salesTaxServiceMock, $gatewayServiceMock, $emailServiceMock);

        $customer = ['name' => 'Franklin'];
        $amount = 250;

        // when process is called
        $result = $invoiceService->process($customer, $amount);

        // then assert invoice is processed successfully
        $this->assertTrue($result);

    }

    /** @test  */
    public function it_sends_receipt_email_when_invoice_is_processed(): void
    {
        // create test doubles
        $salesTaxServiceMock    = $this->createMock(SalesTaxService::class);
        $gatewayServiceMock     = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock       = $this->createMock(EmailService::class);

        // stub our test doubles methods to return the desired values
        $gatewayServiceMock->method('charge')->willReturn(true);

        $emailServiceMock
            ->expects($this->once())
            ->method('send')
            ->with(['name' => 'Franklin'], 'receipt')
        ;

        // given invoice service
        $invoiceService = new InvoiceService($salesTaxServiceMock, $gatewayServiceMock, $emailServiceMock);

        $customer = ['name' => 'Franklin'];
        $amount = 250;

        // when process is called
        $result = $invoiceService->process($customer, $amount);

        // then assert invoice is processed successfully
        $this->assertTrue($result);

    }
}
