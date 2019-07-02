
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Nota Reservasi</title>
        <link rel="stylesheet" href="style.css" media="all" />
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 21cm;  
                height: 29.7cm; 
                margin: 0 auto; 
                color: #001028;
                background: #FFFFFF; 
                font-family: Arial, sans-serif; 
                font-size: 12px; 
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 52px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.8em;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;        
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;        
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="logo.png">
            </div>
            <h1>No. Reservasi #: {{ $reservation->reservation_number }}</h1>
            <div id="company" class="clearfix">
                <div>Company Name</div>
                <div>455 Foggy Heights,<br /> AZ 85004, US</div>
                <div>(602) 519-0450</div>
                <div><a href="mailto:company@example.com">company@example.com</a></div>
            </div>
            <div id="project">
                <div><span>Checkin</span> {{ $reservation->checkin_date }}</div>
                <div><span>Checkout</span> {{ $reservation->checkout_date }}</div>
                <div><span>Nama Pelanggan</span> {{ $reservation->name }}</div>
                <div><span>Email / No Telepon</span> <a href="mailto:john@example.com">john@example.com</a> / {{ $reservation->phone_number }}</div>
                <div><span>Alamat</span> {{ $reservation->address }}</div>
                <div><span>Tanggal</span> {{ \Carbon\Carbon::now() }}</div>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">Title</th>
                        <th class="desc">Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="service">Biaya Sewa</td>
                        <td class="desc">Harga Sewa</td>
                        <td class="unit">{{ 'Rp. ' . number_format($reservation->reservationCost->base_price, 0, ',', '.') }}</td>
                        <td class="qty">{{ $reservation->duration." /hari" }}</td>
                        <td class="total">{{ 'Rp. ' . number_format(($reservation->reservationCost->base_price * $reservation->duration), 0, ',', '.') }}</td>
                    </tr>
                    @if ($reservation->reservationCost->tax)
                        <tr>
                            <td class="service">Pajak</td>
                            <td class="desc"></td>
                            <td class="unit">{{ 'Rp. ' . number_format($reservation->reservationCost->tax, 0, ',', '.') }}</td>
                            <td class="qty">{{ $reservation->reservationCost->tax_percent."%" }}</td>
                            <td class="total">{{ 'Rp. ' . number_format(($reservation->reservationCost->tax), 0, ',', '.') }}</td>
                        </tr>
                    @endif
                    @if ($reservation->reservationCost->discount)
                        <tr>
                            <td class="service">Diskon</td>
                            <td class="desc"></td>
                            <td class="unit">{{ 'Rp. ' . number_format($reservation->reservationCost->discount, 0, ',', '.') }}</td>
                            <td class="qty">{{ $reservation->reservationCost->discount_percent."%" }}</td>
                            <td class="total">{{ 'Rp. ' . number_format(($reservation->reservationCost->discount), 0, ',', '.') }}</td>
                        </tr>
                    @endif
                    @foreach ($reservationAdditionalCosts as $additionalCost)
                        <tr>
                            <td class="service">{{ $additionalCost->name }}</td>
                            <td class="desc">{{ $additionalCost->description }}</td>
                            <td class="unit">{{ 'Rp. ' . number_format($additionalCost->price, 0, ',', '.') }}</td>
                            <td class="qty">{{ $additionalCost->quantity }}</td>
                            <td class="total">{{ 'Rp. ' . number_format($additionalCost->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="service"></td>
                        <td class="desc"></td>
                        <td class="unit"></td>
                        <td class="qty"></td>
                        <td class="total">Total: {{ 'Rp. ' . number_format($reservation->reservationCost->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
            </div>
        </main>
        <footer>
        Invoice was created on a computer and is valid without the signature and seal.
        </footer>
    </body>
</html>