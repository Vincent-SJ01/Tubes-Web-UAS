<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr >
                            <td class="title" style="padding-bottom:0px">
                                Resi
                                
                            </td>
                            
                            <td rowspan="2" style="vertical-align:middle">
                                Invoice #: 123<br>
                                Created: January 1, 2015<br>
                                Due: February 1, 2015
                            </td>
                        </tr>
                        {{ $paket[0]}}
                        <tr>
                            <td>
                                <p style="padding-top:0px;margin-bottom:10px">{!! DNS1D::getBarcodeHTML($paket[0]->noResi, 'C128B') !!}</p>
                                <p style="font-size:small; margin-top:0px">No. Resi {{$paket[0]->noResi}}</p>
                            </td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Ngurir Corp.<br>
                                Jl. Babarsari<br>
                                Sleman, YIA 58571
                            </td>
                            <td>
                                {{ $paket[0]->jenis_paket->namaJenisPaket }}<br>
                                {{ $paket[0]->service->nama }}<br>
                                {{ $paket[0]->service->estimatedTime }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    Nama Pengirim
                </td>
                <td>
                    {{ $paket[0]->pengirim->nama }}
                </td>
            </tr>
            <tr>
                <td>
                    Asal
                </td>
                <td>
                    {{ $paket[0]->pengirim->alamat }}
                </td>
            </tr>
            <tr>
                <td>
                    Nama Penerima
                </td>
                <td>
                    {{ $paket[0]->namaPenerima }} <br>
                    {{ $paket[0]->alamatTujuan }} <br>
                    {{ $paket[0]->noTelpPenerima }}
                </td>
            </tr>
        </table>
        <hr>
        <table style="width: 50%;">
            <tr class="header">
                <td>
                    Berat
                </td>
                <td>
                    Volume
                </td>
            </tr>
            <tr>
                <td>
                    {{ $paket[0]->berat }} Kg
                </td>
                <td>
                    {{ $paket[0]->volume }} cm^3
                </td>
            </tr>
        </table>
        <div style="margin-top:50px; text-align:center; transform: translateX(30%)">
            {!! DNS2D::getBarcodeHTML($url, 'QRCODE', 7, 7) !!}
        </div>
        
        <!-- {{ $paket[0]}} -->
    </div>
</body>
</html>
