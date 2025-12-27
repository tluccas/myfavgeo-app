import { APIResponse, MapaDTO } from "@/lib/types/types";
import api from "@/lib/api";
import "@/app/globals.css";
import { MapList } from "@/components/maps/MapList";
import { MapsHeader } from "@/components/maps/MapsHeader";

export default async function MapasPage(){

    const response = await api.get<APIResponse<MapaDTO[]>>('mapas/');
    const mapas = response.data;

    return (
      <main className="min-h-screen bg-background px-6 py-8 text-foreground">
      <MapsHeader />

        <section className="">
          <MapList mapas={mapas.data} />
        </section>
      </main>
    );
}