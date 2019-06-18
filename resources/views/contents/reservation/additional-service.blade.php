@if (!empty($additionalServiceCache))
    <tr>
        <th>Titel</th>
        <th style="width: 40px">Jumlah</th>
        <th>Harga</th>
        <th style="width: 40px">Diskon (%)</th>
        <th>Keterangan</th>
    </tr>
    @foreach ($additionalServiceCache as $serviceCache)
    <tr>
        <td>
            {{ $serviceCache['service'] }}
        </td>
        <td>
            {{ $serviceCache['quantity'] }}
        </td>
        <td>
            {{ $serviceCache['price'] }}
        </td>
        <td>
            {{ $serviceCache['discount'] }}
        </td>
        <td>
            {{ $serviceCache['description'] }}
        </td>
    </tr>
    @endforeach
@endif