"use client";

import { useMapEvents } from "react-leaflet";

type MapClickHandleProps = {
  onClick: (lat: number, lng: number) => void;
};

export default function MapClickHandle({ onClick }: MapClickHandleProps) {
  useMapEvents({
    click(e) {
      onClick(e.latlng.lat, e.latlng.lng);
    },
  });

  return null;
}
