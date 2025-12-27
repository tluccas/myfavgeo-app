"use client";

import Image from "next/image";
import { useRouter } from "next/navigation";
import { timeAgo } from "@/lib/date";

type MapCardProps = {
  id: number;
  nome: string;
  descricao: string;
  url_imagem: string;
  pontos_count: number;
  atualizadoEm: string;
};
export default function MapCard({
  id,
  nome,
  descricao,
  url_imagem,
  pontos_count,
  atualizadoEm,
}: MapCardProps) {
  const router = useRouter();

  function handleOpenMap() {
    router.push(`/maps/${id}`);
  }

  return (
    <div
      className="bg-neutral-primary-soft h-full w-full p-6 border border-gray-300 rounded-2xl shadow-xs flex flex-col hover:shadow-2xl duration-200 hover:scale-103 transition-transform ease-in hover:border-[rgb(var(--primary))]"
      onClick={handleOpenMap}
    >
      {/* Header */}
      <div className="flex justify-between h-6 overflow-hidden mb-3">
        <h6 className="truncate">MyFavGeo</h6>
        <span className="text-sm whitespace-nowrap">
          <i className="bi bi-geo-fill not-italic" /> {pontos_count} Pontos
        </span>
      </div>

      {/* Imagem */}
      <div className="relative h-52 w-full rounded-2xl overflow-hidden mb-4">
        {url_imagem ? (
          <Image src={url_imagem} alt={nome} fill className="object-cover" />
        ) : (
          <div className="bg-neutral-tertiary-soft h-full w-full" />
        )}
      </div>

      {/* Título */}
      <h5 className="mb-2 text-xl font-bold text-heading line-clamp-1">
        {nome}
      </h5>

      {/* Descrição */}
      <p className="text-body line-clamp-3 mb-4">{descricao}</p>

      {/* Spacer controlado */}
      <div className="flex-1" />

      {/* Footer */}
      <div className="flex justify-between items-center h-10 gap-4">
        <p className="text-xs text-muted">{timeAgo(atualizadoEm)}</p>

        <button className="inline-flex items-center bg-neutral-secondary-medium border border-gray-300 rounded-2xl px-4 py-2 text-sm gap-2 hover:bg-[rgb(var(--primary))] transition hover:text-white hover:shadow-md hover:cursor-pointer">
          Ver Mapa
          <i className="bi bi-arrow-right-square-fill" />
        </button>
      </div>
    </div>
  );
}
