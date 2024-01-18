import { buildRefs, getJSON  } from '@/assets/scripts/helpers'
import { Loader } from "@googlemaps/js-api-loader"
import style from './style.json'

export default function (el) {

  const refs = buildRefs(el, false, {
  })

  const data = getJSON(el).options
  const mapPosition = { lat: data.map.lat, lng: data.map.lng };

  const loader = new Loader({
    apiKey: import.meta.env.VITE_MAPS_API_KEY,
    version: "weekly",
  });

  loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");

    const map = new Map(refs.map, {
      center: mapPosition,
      zoom: data.map.zoom,
      styles: style
    });

    // https://developers.google.com/maps/documentation/javascript/examples/icon-simple
    // If we need to add a custom icon
    new google.maps.Marker({
      position: mapPosition,
      map,
      title: data.map.name,
    });

  });

  return () => {
  }
}
