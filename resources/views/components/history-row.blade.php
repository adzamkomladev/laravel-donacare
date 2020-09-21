<tr>
    <td>
        {{ $iteration }}
    </td>
    <td>
        {{ $history->type }}
    </td>
    <td>
        {{ $details() }}
    </td>
    <td>
        {{ $history->created_at->toDateString() }}
    </td>
</tr>
