export default class Map {

    // show the location
    showLocation(position) {

        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;

    }

    // error handler
    errorHandler(err) {
        if (err.code == 1) {
            alert("Error: Accès à la localisation refusé!");
        } else if (err.code == 2) {
            alert("Error:La position est indisponible!");
        }
    }

    // initialize the map
    initMap() {

        let latlngs = [];

        let geoCacheList = {};
        let geoloc;
        let options = {
            enableHighAccuracy: true,
        };
        // verify if geolocation is available
        if (navigator.geolocation) {
            geoloc = navigator.geolocation;
            geoloc.getCurrentPosition(this.showLocation,
                this.errorHandler, options);
        } else {
            alert("Votre navigateur ne prend pas en compte la géolocalisation");
        }

        // list position of the geocache
        let geoCache = document.getElementById('geoCacheList').getElementsByTagName('li');
        for (let i = 0; i < geoCache.length; i++) {
            let geoCacheName = geoCache.item(i).childNodes[1].innerHTML;
            let lat = geoCache.item(i).childNodes[3].attributes[0].value;
            let lon = geoCache.item(i).childNodes[3].attributes[1].value;
            geoCacheList[geoCacheName] = { 'lat': lat, 'lon': lon };
        };


        // initialize MapView
        let map = L.map('map', { center: [47.359407, -1.193588], zoomControl: false });
        // test des points
        // let map = L.map('map').setView([47.359407, -1.193588], 17);
        // track the user
        map.locate({
            setView: true,
            watch: true,
            timeout: 1000,
            enableHighAccuracy: true,
            maxZoom: 16
        });
        // add the tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        // add marker GeocachesList on the map
        for (let cache in geoCacheList) {
            const marker1 = L.marker([geoCacheList[cache].lat, geoCacheList[cache].lon]).addTo(map)
                .bindPopup(cache)
                .openPopup();
            // Add circle of research on marker 
            let circleCache = L.circle([geoCacheList[cache].lat, geoCacheList[cache].lon], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 7
            }).addTo(map);
            // get the position of the marker in array
            latlngs.push([geoCacheList[cache].lat, geoCacheList[cache].lon]);

        };
        // add the polygon on map with the array of positions
        let polygon = L.polygon(latlngs, { color: 'red', fill: false }).addTo(map);
    };

}