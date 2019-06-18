<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Reservasi</title>
    
    <style>
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
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
                            </td>
                            <td>
                                No. Reservasi #: {{ $reservation->reservation_number }}<br>
                                Checkin: {{ $reservation->checkin_date }}<br>
                                Checkout: {{ $reservation->checkout_date }} <br>
                                Operator<br>
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
                                {{ $reservation->name }}<br>
                                {{ $reservation->address }}<br>
                                {{ $reservation->phone_number }}
                            </td>
                            
                            <td>
                                {{-- Acme Corp.<br>
                                John Doe<br>
                                john@example.com --}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="4">Biaya Sewa</td>
                <td>Harga</td>
            </tr>
            
            <tr class="details" colspan="5">
                <td>
                    Harga Sewa @ {{ 'Rp. ' . number_format($reservation->reservationCost->base_price, 0, ',', '.') }}
                </td>
                <td colspan="4">
                    {{ 'Rp. ' . number_format(($reservation->reservationCost->base_price * $reservation->duration), 0, ',', '.') }}
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Biaya Lainnya
                </td>
                <td colspan="4">
                    Total
                </td>
            </tr>
            
            @foreach ($reservationAdditionalCosts as $additionalCost)
            <tr class="item">
                <td>{{ $additionalCost->name }} </td>
                <td colspan="5">{{ 'Rp. ' . number_format($additionalCost->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            
            <tr class="total">
                <td></td>              
                <td colspan="4">
                   Total: {{ 'Rp. ' . number_format($reservation->reservationCost->total_price, 0, ',', '.') }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>