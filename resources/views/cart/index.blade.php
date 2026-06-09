<x-layouts.app>
    <x-slot name="title">
        Grozs
    </x-slot>

    <h1>Grozs</h1>

    @if(empty($items))
        <p>Grozs ir tukšs.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Maršruts</th>
                    <th>No</th>
                    <th>Laiks</th>
                    <th>Līdz</th>
                    <th>Laiks</th>
                    <th>Datums</th>
                    <th>Kategorija</th>
                    <th>Cena</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key => $item)
                    <tr>
                        <td>{{ $item['trip']->tripPlan->route->name }}</td>
                        <td>{{ $item['tariff']->fromStop->name }}</td>
                        <td>{{ $item['trip']->tripPlan->stops->firstWhere('stop_id', $item['tariff']->from_stop_id)->departure_time }}</td>
                        <td>{{ $item['tariff']->toStop->name }}</td>
                        <td>{{ $item['trip']->tripPlan->stops->firstWhere('stop_id', $item['tariff']->to_stop_id)->departure_time }}</td>
                        <td>{{ $item['trip']->date->format('d.m.Y') }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.updateCategory', $key) }}">
                                @csrf
                                @method('PATCH')
                                <select name="ticket_category_id" onchange="this.form.submit()">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $item['category']->id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>{{ number_format($item['price'], 2) }} €</td>
                        <td>
                            <form method="POST" action="{{ route('cart.remove', $key) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Noņemt</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>Kopā: {{ number_format(collect($items)->sum('price'), 2) }} €</p>

        <form method="POST" action="{{ route('checkout.create') }}">
            @csrf
            <button type="submit">Maksāt</button>
        </form>
    @endif

    <a href="{{ route('home') }}">Turpināt iepirkšanos</a>
</x-layouts.app>