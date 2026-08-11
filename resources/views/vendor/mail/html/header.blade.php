@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('assets/cashflowlight.svg') }}" class="logo" alt="CashFlow Logo">
            @else
                {!! $slot !!}
            @endif
        </a>
    </td>
</tr>