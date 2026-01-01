import dynamic from "next/dynamic";
import type { Metadata } from "next";

export const metadata: Metadata = {
  title: "Seu Mapa",
  description: "Visualize e gerencie os pontos do seu mapa favorito",
};

type MapPageProps = {
  params: {
    id: string;
  };
};

const MapView = dynamic(() => import("@/components/mapas/mapInfo/MapView"), {
  ssr: false,
});

export default function MapPage({ params }: MapPageProps) {
  const mapaId = parseInt(params.id);

  return <MapView mapaId={mapaId} />;
}
