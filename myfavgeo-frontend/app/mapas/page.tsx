import "@/app/globals.css";
import { MapList } from "@/components/mapas/MapList";
import { MapsHeader } from "@/components/mapas/MapsHeader";
import { BackgroundBlobs } from "@/components/layout/Home/BackgroundBlobs";
import { getMapas } from "@/lib/mapas/get-mapas";
import { redirect } from "next/navigation";
import type { Metadata } from "next";

export const metadata: Metadata = {
  title: "Meus Mapas",
  description: "Lista de mapas do usuário",
};

export default async function MapasPage() {
  let response;

  try {
    response = await getMapas();
  } catch {
    redirect("/login");
  }

  return (
    <main className="min-h-screen px-6 py-8 text-foreground relative overflow-hidden">
      <BackgroundBlobs />
      <div className="relative z-10">
        <MapsHeader />

        <section className="">
          <MapList mapas={response.data} />
        </section>
      </div>
    </main>
  );
}
