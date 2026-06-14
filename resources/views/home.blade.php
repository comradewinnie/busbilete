<x-layouts.app>
    <x-slot name="title">
        Sākums
    </x-slot>

    <h1>Meklēt reisus</h1>

    <x-searchbar :stops="$stops" />

    <h1>Reāllaika autobusu karte</h1>

    <div id="map" style="height: 500px;"></div>

    <script>
        const map = L.map('map').setView([56.9496, 24.1052], 9);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        const stopIcon = L.circleMarker;

        const busIcon  = L.icon({
            iconUrl: "{{ asset('images/bus_icon.png') }}",
            iconSize: [30, 30],
        });

        const stops = @json($stops->values());
        stops.forEach(stop => {
            L.circleMarker([stop.latitude, stop.longitude], {
                radius: 6,
                color: '#0066cc',
                fillColor: '#0066cc',
                fillOpacity: 0.8,
            }).addTo(map).bindPopup(stop.name);
        });

        const busMarkers = {};
        function updateBusLocations() {
            fetch('{{ route('map.busLocations') }}')
                .then(response => response.json())
                .then(buses => {
                    buses.forEach(bus => {
                        const latlng = [bus.latitude, bus.longitude];
                        if (busMarkers[bus.bus_id]) {
                            busMarkers[bus.bus_id].setLatLng(latlng);
                        } else {
                            busMarkers[bus.bus_id] = L.marker(latlng, { icon: busIcon })
                                .addTo(map)
                                .bindPopup('Autobuss: ' + bus.plate + 
                                           '<br>Maršruts: ' + bus.route + 
                                           '<br>Atjaunots: ' + bus.timestamp);
                        }
                    });
                });
        }

        updateBusLocations();
        setInterval(updateBusLocations, 30000);
    </script>
</x-layouts.app>