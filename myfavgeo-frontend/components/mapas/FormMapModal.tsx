"use client";

import { useState, useEffect } from "react";
import api from "@/lib/api";
import { MapaDTO } from "@/lib/types/types";

type Props = {
  open: boolean;
  onClose: () => void;
  onSuccess?: () => void;
  mapa?: MapaDTO | null;
};

export default function FormMapModal({
  open,
  onClose,
  onSuccess,
  mapa,
}: Props) {
  const [nome, setNome] = useState("");
  const [descricao, setDescricao] = useState("");
  const [urlImagem, setUrlImagem] = useState("");
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    if (open) {
      if (mapa) {
        setNome(mapa.nome);
        setDescricao(mapa.descricao);
        setUrlImagem(mapa.url_imagem || "");
      } else {
        setNome("");
        setDescricao("");
        setUrlImagem("");
      }
    }
  }, [open, mapa]);

  if (!open) return null;

  async function handleSubmit(e: React.FormEvent) {
    e.preventDefault();

    if (!nome.trim()) return;

    try {
      setLoading(true);

      const payload = {
        nome: nome.trim(),
        descricao: descricao.trim() || null,
        url_imagem: urlImagem.trim() || null,
      };

      if (mapa) {
        await api.put(`/mapas/${mapa.id}`, payload);
      } else {
        await api.post("/mapas", payload);
      }

      if (onSuccess) {
        onSuccess();
      } else {
        onClose();
      }

      if (!mapa) {
        setNome("");
        setDescricao("");
        setUrlImagem("");
      }
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="fixed inset-0 z-1200 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
      <div className="bg-background text-foreground rounded-2xl w-full max-w-md p-6 border border-border shadow-xl">
        <h2 className="text-xl font-bold mb-4">
          {mapa ? "Editar mapa" : "Criar novo mapa"}
        </h2>

        <form onSubmit={handleSubmit} className="space-y-4">
          {/* Nome */}
          <input
            type="text"
            placeholder="Nome do mapa"
            value={nome}
            onChange={(e) => setNome(e.target.value)}
            required
            className="w-full border border-border bg-background text-foreground placeholder:text-muted-foreground rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary/50 outline-none transition-all"
          />

          {/* Descrição */}
          <textarea
            placeholder="Descrição (opcional)"
            value={descricao}
            onChange={(e) => setDescricao(e.target.value)}
            className="w-full border border-border bg-background text-foreground placeholder:text-muted-foreground rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary/50 outline-none transition-all"
            rows={3}
          />

          {/* URL da imagem */}
          <input
            type="url"
            placeholder="URL da imagem (opcional)"
            value={urlImagem}
            onChange={(e) => setUrlImagem(e.target.value)}
            className="w-full border border-border bg-background text-foreground placeholder:text-muted-foreground rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary/50 outline-none transition-all"
          />

          {/* Ações */}
          <div className="flex justify-end gap-3 pt-4">
            <button
              type="button"
              onClick={onClose}
              disabled={loading}
              className="px-4 py-2 text-sm rounded-lg border border-border text-muted-foreground hover:bg-secondary hover:text-foreground transition-colors"
            >
              Cancelar
            </button>

            <button
              type="submit"
              disabled={loading || !nome.trim()}
              className="px-4 py-2 text-sm rounded-lg bg-primary text-white hover:opacity-90 disabled:opacity-50 btn-hover-primary transition-all"
            >
              {loading
                ? mapa
                  ? "Salvando..."
                  : "Criando..."
                : mapa
                ? "Salvar alterações"
                : "Criar mapa"}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
