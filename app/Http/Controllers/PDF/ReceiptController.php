<?php

namespace App\Http\Controllers\PDF;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function show_receipt(\Codedge\Fpdf\Fpdf\Fpdf $pdf) {  
        $setting = Setting::all()->first();  

        $pdf->AddPage('P', array(80,200));
        $pdf->SetFont('Courier','',15);
        $pdf->Cell(60,5,'HOTPLATE',0,1,'C');
        $pdf->SetFont('Courier','',7);

        $address_array = explode(", ", $setting->address);
        $new_address = "";
        for ($i = 0; $i < count($address_array); $i++) {
            $new_address .= $address_array[$i];
            if (($i + 1) % 2 == 0) {
                $new_address .= "\n";
            } else {
                $new_address .= ", ";
            }
        }

        $address_lines = explode("\n", $new_address);

        $pdf->Cell(60,3.5,$address_lines[0],0,1,'C');
        $pdf->Cell(60,3.5,$address_lines[1],0,1,'C');
        $pdf->Cell(60,3.5,$address_lines[2],0,1,'C');
        $pdf->Cell(60,3.5, $setting->URL ,0,1,'C');
        $pdf->Cell(60,3.5,$setting->email ,0,1,'C');
        $pdf->Cell(60,3.5,'+63 ' .  $setting->contact_no ,0,1,'C');
        $pdf->Cell(60,3.5,'BUS. TIN : ' .  $setting->business_tin ,0,1,'C');

        // $pdf->SetX(7);
        $pdf->SetFont('courier','',12);
        $pdf->Cell(20,3,'- - - - - - - - - - - - - ',0,1,'');

        //Line break
        $pdf->Ln(1);

        $pdf->SetFont('Courier','',8);
        $pdf->Cell(20,4,'Cashier : ',0,0,'');

        $pdf->SetFont('Courier','',8);
        $pdf->Cell(10,4, Auth::user()->name, 0,1,'');

        $table = str_replace("Table ", "#", session('customer'));

        $pdf->SetFont('Courier','',10);
        $pdf->Cell(20,4,'Bill To: ',0,0,'');

        $pdf->SetFont('Courier','B',15);
        $pdf->Cell(10,4,$table,0,1,'');

        $pdf->SetFont('Courier','',8);
        $pdf->Cell(20,4,'Type : ',0,0,'');

        $service = session('service') == 'DN' ? 'Dine in' : 'Take out';

        $pdf->SetFont('Courier','',8);
        $pdf->Cell(10,4,$service,0,1,'');

        $pdf->SetFont('Courier','',8);
        $pdf->Cell(20,4,'Invoice no. ',0,0,'');
        $pdf->SetFont('Courier','',8);
        $pdf->Cell(40,4, session('invoice_no'),0,1,'');

        $pdf->SetFont('Courier','',8);
        // $pdf->Cell(8,4,'Date: ',0,0,'');
        $pdf->Cell(20,4,date("d/m/Y"),0,0,'');


        // $pdf->Cell(10,4,'Time: ',0,0,'');
        $pdf->SetFont('Courier','',8);
        $pdf->Cell(60,4,date("g:i a"),0,1,'');

        $pdf->SetX(7);
        $pdf->SetFont('courier','',12);
        $pdf->Cell(20,4,'- - - - - - - - - - - - - ',0,1,'');

        // Product
        $pdf->SetX(7);
        $pdf->SetFont('Courier','',8);
        $pdf->SetFillColor(208,208,208);
        $pdf->Cell(34,5,'PRODUCT',1,0,'C'); 
        $pdf->Cell(11,5,'QTY',1,0,'C');
        $pdf->Cell(8,5,'PRC',1,0,'C');
        $pdf->Cell(12,5,'TOTAL',1,1,'C');

        foreach(session('data') as $row){
            $pdf->SetX(7);   
            $pdf->SetFont('Courier','',8);
            $pdf->Cell(34,5,$row['name'],1,0,'L');
            $pdf->Cell(11,5,$row['quantity'],1,0,'C');
            $pdf->Cell(8,5,(int)$row['price']/(int)$row['quantity'],1,0,'C');
            $pdf->Cell(12,5,$row['price'],1,1,'C');
        }

        $dis = session('discount') ?? '0';
        $discount = floatval(session('total')) * floatval($dis) / 100;

        if (session()->has('discount') && session('discount') !== '0' && session('discount') !== '0.00') {
            $pdf->SetX(7);
            $pdf->SetFont('courier','',8);
            $pdf->Cell(20,5,'',0,0,'L');
            $pdf->Cell(25,5,'DISCOUNT',1,0,'C');
            $pdf->Cell(20,5,'-' . $discount,1,1,'C');
        }

        if (session()->has('discount_amount')) {
            $pdf->SetX(7);
            $pdf->SetFont('courier','',8);
            $pdf->Cell(20,5,'',0,0,'L');
            $pdf->Cell(25,5,'DISCOUNT',1,0,'C');
            $pdf->Cell(20,5,'-' . session('discount_amount'),1,1,'C');
        }

        $grandtotal = floatval(session('total')) - $discount;

        $pdf->SetX(7);
        $pdf->SetFont('courier','B',10);
        $pdf->Cell(20,5,'',0,0,'L');
        $pdf->Cell(25,5,'TOTAL DUE',1,0,'C');
        $pdf->Cell(20,5,$grandtotal,1,1,'C');

        $pdf->SetX(7);
        $pdf->SetFont('courier','',8);
        $pdf->Cell(20,5,'',0,0,'L');
        $pdf->Cell(25,5,'CASH',1,0,'C');
        $pdf->Cell(20,5,empty(session('payment_amount')) ? 'Not paid' : session('payment_amount'),1,1,'C');

        if (!empty(session('payment_change')) && session('payment_change') !== '0' && session('payment_change') !== '0.00') {
            $pdf->SetX(7);
            $pdf->SetFont('courier','',8);
            $pdf->Cell(20,5,'',0,0,'L');
            $pdf->Cell(25,5,'CHANGE',1,0,'C');
            $pdf->Cell(20,5,abs($_SESSION['payment_change']),1,1,'C');
        }

        $pdf->SetX(7);
        $pdf->SetFont('courier','',12);
        $pdf->Cell(20,5,'- - - - - - - - - - - - - ',0,1,'');

        $pdf->Cell(20,0,'',0,1,'');

        $pdf->SetX(7);
        $pdf->SetFont('Courier','',10);
        $pdf->Cell(65,5,'Thankyou for choosing',0,1,'C');

        $pdf->SetX(3);
        $pdf->SetFont('Courier','',12);
        $pdf->Cell(75,5,'Hot Plate Sizzling House',0,1,'C');

        $pdf->SetX(3);
        $pdf->SetFont('Courier','',12);
        $pdf->Cell(75,5,"Hope you liked it!",0,1,'C');

        $pdf->SetX(3);
        $pdf->SetFont('Courier','',6);
        $pdf->Cell(75,5,'Developed : fb.com/jay.bayron900',0,1,'C');

        $pdf->SetX(3);
        $pdf->SetFont('Courier','',6);
        $pdf->Cell(75,3,'Contact at : +62 9504523523',0,1,'C');

        $pdf->Output();
        exit;
    }
}
