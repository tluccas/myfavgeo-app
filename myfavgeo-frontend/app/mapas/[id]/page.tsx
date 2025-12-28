import dynamic from "next/dynamic";

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
