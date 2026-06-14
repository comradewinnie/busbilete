<x-layouts.app>
    <x-slot name="title">
        {{ __('cart.title') }}
    </x-slot>

    <h1>{{ __('cart.title') }}</h1>

    @if(empty($items))
        <p>{{ __('cart.empty') }}</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>{{ __('cart.route') }}</th>
                    <th>{{ __('cart.from') }}</th>
                    <th>{{ __('cart.time') }}</th>
                    <th>{{ __('cart.to') }}</th>
                    <th>{{ __('cart.time') }}</th>
                    <th>{{ __('cart.date') }}</th>
                    <th>{{ __('cart.category') }}</th>
                    <th>{{ __('cart.price') }}</th>
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
                                <button type="submit">{{ __('cart.remove') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>Kopā: {{ number_format(collect($items)->sum('price'), 2) }} €</p>

        <form method="POST" action="{{ route('checkout.create') }}">
            @csrf
            <button type="submit">{{ __('cart.checkout') }}</button>
        </form>
    @endif

    <a href="{{ route('home') }}">{{ __('cart.continue') }}</a>
</x-layouts.app>