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
    router.push(`/mapas/${id}`);
  }

  return (
    <div
      className="
        group
        relative
        flex flex-col
        h-full w-full
        p-5
        bg-background
        border border-border
        rounded-2xl
        shadow-sm
        transition-all
        duration-300
        hover:shadow-xl
        hover:border-primary/50
        hover:-translate-y-1
        cursor-pointer
        overflow-hidden
      "
      onClick={handleOpenMap}
    >
      {/* Header */}
      <div className="flex justify-between items-center mb-3 text-xs font-medium text-muted-foreground">
        <span className="bg-secondary px-2 py-1 rounded-md text-primary">
          MyFavGeo
        </span>
        <span className="flex items-center gap-1">
          <i className="bi bi-geo-alt-fill text-primary" />
          {pontos_count} {pontos_count === 1 ? "Ponto" : "Pontos"}
        </span>
      </div>

      {/* Imagem */}
      <div className="relative h-48 w-full rounded-xl overflow-hidden mb-4 bg-secondary">
        {url_imagem ? (
          <Image
            src={url_imagem}
            alt={nome}
            fill
            className="object-cover transition-transform duration-500 group-hover:scale-110"
          />
        ) : (
          <div className="flex items-center justify-center h-full w-full text-muted-foreground/30">
            <i className="bi bi-map text-6xl" />
          </div>
        )}
        
        {/* Overlay on hover */}
        <div className="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300" />
      </div>

      {/* Título */}
      <h5 className="mb-2 text-xl font-bold text-foreground line-clamp-1 group-hover:text-primary transition-colors">
        {nome}
      </h5>

      {/* Descrição */}
      <p className="text-sm text-muted-foreground line-clamp-2 mb-4 leading-relaxed">
        {descricao || "Sem descrição definida."}
      </p>

      {/* Spacer controlado */}
      <div className="flex-1" />

      {/* Footer */}
      <div className="flex justify-between items-center pt-4 border-t border-border mt-2">
        <p className="text-xs text-muted-foreground flex items-center gap-1">
          <i className="bi bi-clock" /> {timeAgo(atualizadoEm)}
        </p>

        <button className="
          inline-flex items-center gap-2
          px-4 py-2
          rounded-full
          text-xs font-semibold
          bg-secondary text-foreground
          transition-all
          group-hover:bg-primary group-hover:text-white
          shadow-sm
        ">
          Ver Mapa
          <i className="bi bi-arrow-right transition-transform group-hover:translate-x-1" />
        </button>
      </div>
    </div>
  );
}
