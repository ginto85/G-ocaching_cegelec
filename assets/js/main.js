import Map from './class/Map.js';
import Location from './class/Location.js';
import Filter from './class/Filter.js';

const MapClass = new Map();
const LocationClass = new Location();

let geoCachesList = document.getElementById('geoCacheList');

document.addEventListener('DOMContentLoaded', () => {

    // initialize the map with Map.js
    if (document.getElementById('map')) {
        MapClass.initMap();
    };

    document.addEventListener('click', (e) => {
        // initialize the filter with Filter.js
        new Filter(e.target.dataset.filter);
        // adds the current latitude and longitude 
        // to the geocache form in Admin Page
        if (e.target.matches('.currentPosition')) {
            LocationClass.getLocation();
        }

    });
    // if the page is the map page
    if (geoCachesList != null) {
        geoCachesList.addEventListener('click', (e) => {

            // display the itemForm when the user clicks on the button
            if (e.target.classList == 'itemList') {

                let itemListId = e.target.dataset.id;
                let buttonClose = document.querySelectorAll('button.close');
                for (let i = 0; i < buttonClose.length; i++) {
                    if (buttonClose[i].dataset.id == itemListId) {
                        buttonClose[i].classList.remove('close');
                        e.target.classList.add('close');
                        let geocacheListItem = geoCachesList.getElementsByTagName('li');
                        for (let i = 0; i < geocacheListItem.length; i++) {
                            if (geocacheListItem[i].className == itemListId) {
                                let geocacheItem = geocacheListItem[i];
                                let itemForm = geocacheItem.getElementsByTagName('form')[0];
                                itemForm.style.display = 'block';
                            }
                        }
                    };
                }
            } else if (e.target.classList == 'itemForm') {
                let itemFormId = e.target.dataset.id;
                let buttonClose = document.querySelectorAll('button.close');
                for (let i = 0; i < buttonClose.length; i++) {
                    if (buttonClose[i].dataset.id == itemFormId) {
                        buttonClose[i].classList.remove('close');
                        e.target.classList.add('close');
                        let geocacheListItem = geoCachesList.getElementsByTagName('li');
                        for (let i = 0; i < geocacheListItem.length; i++) {
                            if (geocacheListItem[i].className == itemFormId) {
                                let geocacheItem = geocacheListItem[i];
                                let itemForm = geocacheItem.getElementsByTagName('form')[0];
                                itemForm.style.display = 'none';
                            }
                        }
                    };
                }
            } else {
                return;
            }
        });
    }

});