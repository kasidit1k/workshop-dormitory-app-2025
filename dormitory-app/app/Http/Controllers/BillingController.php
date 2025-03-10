<?php

namespace App\Http\Controllers;

use App\Models\BillingModel;
use App\Models\OrganizationModel;

class BillingController extends Controller
{
    public function index()
    {
        return view('billing');
    }

    // ส่วนของการปริ้นใบแจ้งหนี้ โดยใช้ Route และส่งค่าไปยัง Controller ด้วย {billingId} ที่ระบุ
    public function printBilling($billingId)
    {
        $billing = BillingModel::find($billingId);
        $organization = OrganizationModel::first();

        return view('print-billing', compact('billing', 'organization'));
    }

    // ส่วนของการปริ้นใบแจ้งหนี้ โดยใช้ Route และส่งค่าไปยัง Controller ด้วย {billingId} ที่ระบุ
    public function printInvoice($billingId)
    {
        $billing = BillingModel::find($billingId);
        $organization = OrganizationModel::first();

        return view('print-invoice', compact('billing', 'organization'));
    }
}
