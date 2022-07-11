export default class Location {


   // show the location
   showLocation(position) {
      let latitude = position.coords.latitude;
      let longitude = position.coords.longitude;

      document.getElementById('lat').setAttribute('value', latitude);
      document.getElementById('lng').setAttribute('value', longitude);
   }

   // error handler
   errorHandler(err) {
      if (err.code == 1) {
         alert("Error: Accès à la localisation refusé!");
      } else if (err.code == 2) {
         alert("Error:La position est indisponible!");
      }
   }
   getLocation() {
      if (navigator.geolocation) {
         let options = {
            maximumAge: 10000,
            enableHighAccuracy: true,
         };
         navigator.geolocation.watchPosition(this.showLocation, this.errorHandler, options);
      } else {
         alert("Votre navigateur ne prend pas en compte la géolocalisation");
      }
   }
}