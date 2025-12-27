'use client'

import { MapaDTO } from '@/lib/types/types';
import MapCard from './MapCard';

type MapaListProps = {
    mapas: MapaDTO[];
    isLoading?: boolean;
}

export function MapList({ mapas, isLoading = false }: MapaListProps) {
  if (isLoading) {
    return <p>Carregando mapas...</p>;
  }

  if (mapas.length === 0) {
    return <p>Nenhum mapa disponível.</p>;
  }

  return (
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
        />
      ))}
    </div>
  );
}
