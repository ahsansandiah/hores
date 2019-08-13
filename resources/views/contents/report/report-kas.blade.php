
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Laporan Transaksi Reservasi</title>
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
                width: 25cm;  
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
                height: 10px;
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
                {{-- <img src="logo.png"> --}}
            </div>
            <h1>Laporan KAS</h1>
            <div id="company" class="clearfix">
                

            </div>
            <div id="project">
                <div>Hotel Al-Ikhlas</div>
                <div>Jl. Budi Utomo - Pekkabata, Polewali Mandar<br /></div>
                <div>081290868876</div>
                <div><a href="mailto:company@example.com"></a></div>
                <div><a href="mailto:company@example.com">{{ \Carbon\Carbon::now()->format('d-m-y H:i:s') }}</a></div>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">No</th>
                        <th class="desc">Tanggal</th>
                        <th>No Faktur</th>
                        <th>Keterangan</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @php($totalPrice = null)
                    @php($no = 1)
                    @foreach ($reservations as $item)
                        <tr>
                            <td class="service">{{ $no++ }}</td>
                            <td class="desc">{{ \Carbon\Carbon::parse($item->checkin_date)->format("d-m-Y") }}</td>
                            <td class="service">{{ $item->reservation_number }}</td>
                            <td class="service">{{ $item->description }}</td>
                            <td class="desc">
                                @if (!is_null($item->reservationCost))
                                    @if ($item->reservationCost->payment_type == "Tunai")
                                        {{ $item->total_price }}
                                    @endif
                                @endif
                            </td>
                            <td class="desc">
                                @if (!is_null($item->reservationCost))
                                    @if ($item->reservationCost->payment_type == "Kredit")
                                        {{ $item->total_price }}
                                    @endif
                                @endif
                            </td>
                            <td class="desc"></td>
                        </tr>
                        @php($totalPrice += $item->total_price)
                    @endforeach
                    <tr>
                        <!-- <td class="service" colspan="5"></td>
                        <td class="service" colspan="2"><b>Total : </b></td>
                        <td class="desc"><b></b></td> -->
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 262px;"><center>Mengetahui</center></td>
                        <td style="width: 261px;">&nbsp;</td>
                        <td style="width: 259px;"><center>Operator</center></td>
                    </tr>
                    <tr>
                        <td style="width: 262px;">&nbsp;</td>
                        <td style="width: 261px;">&nbsp;</td>
                        <td style="width: 259px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width: 262px;"><center>Nama Pemilik</center></td>
                        <td style="width: 261px;">&nbsp;</td>
                        <td style="width: 259px;">
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- DivTable.com -->
            <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
            </div>
        </main>
        <!-- <footer>
        Invoice was created on a computer and is valid without the signature and seal.
        </footer> -->
    </body>
</html>