<?php

namespace Guysolamour\Administrable\Extensions\Shop\Contracts;

interface HasPdfInvoiceContract
{
    public function generatePdf(bool $send_email = true);

    public function command();
}
