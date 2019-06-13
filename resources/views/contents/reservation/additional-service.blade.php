@if (!empty($additionalServiceCache))
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