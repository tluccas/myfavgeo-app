"use client";

import { useState } from "react";
import api from "@/lib/api";
import { MapaDTO } from "@/lib/types/types";

type Props = {
  open: boolean;
  mapa: MapaDTO | null;
  onClose: () => void;
  onSuccess: () => void;
};

export default function DeleteMapModal({
  open,
  mapa,
  onClose,
  onSuccess,
}: Props) {
  const [loading, setLoading] = useState(false);

  if (!open || !mapa) return null;

  async function handleDelete() {
    try {
      setLoading(true);
      await api.delete(`/mapas/${mapa!.id}`);
      onSuccess();
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="fixed inset-0 z-1200 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
      <div className="bg-background text-foreground rounded-2xl w-full max-w-md p-6 border border-border shadow-xl">
        <h2 className="text-xl font-bold mb-2">Excluir mapa</h2>

        <p className="text-muted-foreground mb-6">
          Tem certeza que deseja excluir o mapa{" "}
          <span className="font-semibold text-foreground">{mapa.nome}</span>?
          Esta ação não pode ser desfeita e todos os pontos associados serão
          removidos.
        </p>

        <div className="flex justify-end gap-3">
          <button
            type="button"
            onClick={onClose}
            disabled={loading}
            className="px-4 py-2 text-sm rounded-lg border border-border text-muted-foreground hover:bg-secondary hover:text-foreground transition-colors"
          >
            Cancelar
          </button>

          <button
            type="button"
            onClick={handleDelete}
            disabled={loading}
            className="px-4 py-2 text-sm rounded-lg bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 transition-colors"
          >
            {loading ? "Excluindo..." : "Excluir mapa"}
          </button>
        </div>
      </div>
    </div>
  );
}
