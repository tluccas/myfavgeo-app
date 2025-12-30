"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { MapaDTO } from "@/lib/types/types";
import MapCard from "./MapCard";
import FormMapModal from "./FormMapModal";
import DeleteMapModal from "./DeleteMapModal";

type MapaListProps = {
  mapas: MapaDTO[];
  isLoading?: boolean;
};

export function MapList({ mapas, isLoading = false }: MapaListProps) {
  const router = useRouter();
  const [editingMap, setEditingMap] = useState<MapaDTO | null>(null);
  const [deletingMap, setDeletingMap] = useState<MapaDTO | null>(null);

  if (isLoading) {
    return <p>Carregando mapas...</p>;
  }

  if (mapas.length === 0) {
    return <p>Nenhum mapa disponível.</p>;
  }

  return (
    <>
      <div
        className="
          w-full
          grid
          sm:grid-cols-2
          lg:grid-cols-3
          gap-6
          grid-cols-[repeat(auto-fit,minmax(320px,1fr))]
          auto-rows-[420px]
        "
      >
        {mapas.map((map) => (
          <MapCard
            key={map.id}
            id={map.id}
            nome={map.nome}
            descricao={map.descricao}
            url_imagem={map.url_imagem || ""}
            pontos_count={map.pontos_count}
            atualizadoEm={map.updated_at}
            onEdit={() => setEditingMap(map)}
            onDelete={() => setDeletingMap(map)}
          />
        ))}
      </div>

      <FormMapModal
        open={!!editingMap}
        mapa={editingMap}
        onClose={() => setEditingMap(null)}
        onSuccess={() => {
          setEditingMap(null);
          router.refresh();
        }}
      />

      <DeleteMapModal
        open={!!deletingMap}
        mapa={deletingMap}
        onClose={() => setDeletingMap(null)}
        onSuccess={() => {
          setDeletingMap(null);
          router.refresh();
        }}
      />
    </>
  );
}
