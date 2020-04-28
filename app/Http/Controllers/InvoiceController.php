<?php

namespace App\Http\Controllers;

use App\Models\Representative;
use App\Models\SaleOrder;
use App\Models\Supplier;
use App\Models\SupplierAddress;
use App\Models\SupplierEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class InvoiceController extends Controller
{
    //

    public function show($id)
    {
        echo $id;

        $saleorder = SaleOrder::where('id', $id)->first();

//        {"id":153,"supplierId":2,"representativeId":1,"billingAddressId":1,"shippingAddressId":1,"shippingMethod":"STANDARD","created_at":"2020-03-19 00:52:41","updated_at":"2020-04-03 04:37:59","deleted_at":null,"sender_id":2,"discount":"0.00","shipping_charge":"0.00","shipping_method":"STANDARD","supplierInvoiceEmailId":1,"supplierTrackingEmailId":1,"whlocation_id":1,"required_date":"2020-03-19 11:52:41","shipped":"partial","invoiced":null,"packed":"partial","link_ebay":"http:\/\/hello","status":"confirm","itemPackedId":null}
        $supplier = Supplier::where('id', $saleorder -> supplierId) -> first();
        $representative = Representative::where('supplierId', $saleorder -> supplierId) -> first();
        $supplierEmail = SupplierEmail::where('supplierId', $saleorder -> supplierId) -> first();
        $supplierAddress = SupplierAddress::where('id', $saleorder -> shippingAddressId) ->first();

        $customer = new Buyer([
            'name'          => $supplier -> name,
            'custom_fields' => [
                'representative' => $representative -> fullName,
                'address' => $supplierAddress -> street . ' '. $supplierAddress -> city . ' '. $supplierAddress -> state . ' '. $supplierAddress -> postcode .' '. $supplierAddress -> country,
                'email' => $supplierEmail -> email,
                'phone' => $representative -> phoneNumber
            ],
        ]);

        $customer2 = new Buyer([

        ]);



        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->shipping(1.99)
            ->addItem($item)
            ->logo(public_path('vendor/invoices/sample-logo.png'));

        return $invoice->stream();
    }
}
