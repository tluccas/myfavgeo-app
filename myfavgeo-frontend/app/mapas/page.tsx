import { APIResponse, MapaDTO } from "@/lib/types/types";
import api from "@/lib/api";
import "@/app/globals.css";
import { MapList } from "@/components/mapas/MapList";
import { MapsHeader } from "@/components/mapas/MapsHeader";
import { BackgroundBlobs } from "@/components/layout/Home/BackgroundBlobs";

export default async function MapasPage() {
  const response = await api.get<APIResponse<MapaDTO[]>>("mapas/");
  const mapas = response.data;

  return (
    <main className="min-h-screen px-6 py-8 text-foreground relative overflow-hidden">
      <BackgroundBlobs />
      <div className="relative z-10">
        <MapsHeader />

        <section className="">
          <MapList mapas={mapas.data} />
        </section>
      </div>
    </main>
  );
}
