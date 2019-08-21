<html>
    <body>
        <table style="width: 545px;">
            <tbody>
                <tr style="height: 15px;">
                    <td style="width: 296px; height: 15px;">
                        <div>
                            <div>HOTEL AL-IKHLAS</div>
                        </div>
                    </td>
                    <td style="width: 261px; height: 15px;"> NO {{ $reservation->reservation_number }}</td>
                </tr>
                <tr style="height: 15px;">
                    <td style="width: 296px; height: 15px;">
                        <div>
                            <div> JL. BUDI UTOMO - PEKKABATA</div>
                            <div>
                                <div>POLEWALI MANDAR</div>
                                <div>No Hp. 082190868876</div>
                            </div>
                        </div>
                    </td>
                    <td style="width: 261px; height: 15px;"> </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 545px;">
            <tbody>
                <tr>
                    <td style="width: 545px;"> --------------------------------------- Reservasi {{ $room->room_number }} ---------------------------------</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 545px;">
            <tbody>
                <tr style="height: 23px;">
                    <td style="width: 102px; height: 23px;">Tanggal</td>
                    <td style="width: 10px; height: 23px;">:</td>
                    <td style="width: 342px; height: 23px;">{{ \Carbon\Carbon::parse($reservation->created_at)->format("d-m-Y H:i:s") }}</td>
                    <td style="width: 174px; height: 23px;"> 
                        {{ $reservation->name }} <br>
                        {{ $reservation->identity_card }} <br>
                        {{ $reservation->phone_number }}
                    </td>
                </tr>
                <tr style="height: 23px;">
                    <td style="width: 102px; height: 23px;">Checkin</td>
                    <td style="width: 10px; height: 23px;">:</td>
                    <td style="width: 342px; height: 23px;">{{ \Carbon\Carbon::parse($reservation->checkin_date)->format("d-m-Y H:i:s") }}</td>
                    <td style="width: 174px; height: 23px;"> </td>
                </tr>
                <tr style="height: 23px;">
                    <td style="width: 102px; height: 23px;">Checkout</td>
                    <td style="width: 10px; height: 23px;">:</td>
                    <td style="width: 342px; height: 23px;">{{ \Carbon\Carbon::parse($reservation->checkout_date)->format("d-m-Y H:i:s") }}</td>
                    <td style="width: 174px; height: 23px;"> </td>
                </tr>
                <tr style="height: 23px;">
                    <td style="width: 102px; height: 23px;">Operator</td>
                    <td style="width: 10px; height: 23px;">:</td>
                    <td style="width: 342px; height: 23px;">{{ Auth::user()->name }}</td>
                    <td style="width: 174px; height: 23px;"> </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 545px;">
            <tbody>
                <tr>
                    <td> ============================================================</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 545px;">
            <tbody>
                <tr style="height: 1px;">
                    <td style="width: 30; height: 1px;">No</td>
                    <td style="width: 10px; height: 1px;">|</td>
                    <td style="width: 300x; height: 1px;">Deskripsi</td>
                    <td style="width: 10px; height: 1px;">|</td>
                    <td style="width: 155px; height: 1px;">Subtotal</td>
                    <td style="width: 10px; height: 1px;">|</td>
                </tr>
                <tr style="height: 23px;">
                    <td style="width: 56px; height: 23px;">1</td>
                    <td style="width: 56px; height: 23px;">|</td>
                    <td style="width: 471px; height: 23px;">Ruangan {{ $room->roomType->name }} {{ $room->roomBedType->name }} /hari {{ 'Rp. ' . number_format($room->price_day, 0, ',', '.') }}</td>
                    <td style="width: 17px; height: 23px;">|</td>
                    <td style="width: 355px; height: 23px;">{{ 'Rp. ' . number_format(($room->price_day * $reservation->duration), 0, ',', '.') }}</td>
                    <td style="width: 10px; height: 23px;">|</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 545px;">
            <tbody>
                <tr>
                    <td style="width: 529px;"></td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 214px;">Pajak</td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 204px;">{{ 'Rp. ' . number_format($reservation->reservationCost->tax, 0, ',', '.') }}</td>
                    <td style="width: 15px;">|</td>
                </tr>
                <tr>
                    <td style="width: 529px;"></td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 214px;">Servis</td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 204px;">{{ 'Rp. ' . number_format($reservation->reservationCost->service_tip, 0, ',', '.') }}</td>
                    <td style="width: 14px;">|</td>
                </tr>
                <tr>
                    <td style="width: 529px;"></td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 214px;">Subtotal</td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 204px;">{{ 'Rp. ' . number_format($reservation->reservationCost->tax + $reservation->reservationCost->service_tip + ($room->price_day * $reservation->duration), 0, ',', '.') }}</td>
                    <td style="width: 14px;">|</td>
                </tr>
                <tr>
                    <td style="width: 529px;"></td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 214px;">Diskon</td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 204px;">{{ 'Rp. ' . number_format($reservation->reservationCost->discount, 0, ',', '.') }}</td>
                    <td style="width: 14px;">|</td>
                </tr>
                <tr>
                    <td style="width: 529px;"></td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 214px;">Deposit</td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 204px;">{{ 'Rp. ' . number_format($reservation->reservationCost->deposit, 0, ',', '.') }}</td>
                    <td style="width: 14px;">|</td>
                </tr>
                <tr>
                    <td style="width: 529px;"></td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 214px;">Grand Total</td>
                    <td style="width: 10px;">|</td>
                    <td style="width: 204px;">{{ 'Rp. ' . number_format($reservation->reservationCost->total_price, 0, ',', '.') }}</td>
                    <td style="width: 14px;">|</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 545px;">
            <tbody>
                <tr style="height: 23px;">
                    <td style="height: 23px; width: 263px;"> </td>
                    <td style="height: 23px; width: 281px;"> </td>
                </tr>
                <tr style="height: 23px;">
                    <td style="height: 23px; width: 263px;"><center>Tamu</center></td>
                    <td style="height: 23px; width: 281px;"><center>Kasir</center></td>
                </tr>
                <tr style="height: 23px;">
                    <td style="height: 23px; width: 263px;"> </td>
                    <td style="height: 23px; width: 281px;"> </td>
                </tr>
                <tr style="height: 23px;">
                    <td style="height: 23px; width: 263px;"> </td>
                    <td style="height: 23px; width: 281px;"> </td>
                </tr>
                <tr style="height: 23px;">
                    <td style="height: 23px; width: 263px;"> </td>
                    <td style="height: 23px; width: 281px;"> </td>
                </tr>
                <tr style="height: 23px;">
                    <td style="height: 23px; width: 263px;"><center>( {{ $reservation->name }} )</center></td>
                    <td style="height: 23px; width: 281px;"><center>( {{ Auth::user()->name }} )</center></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>