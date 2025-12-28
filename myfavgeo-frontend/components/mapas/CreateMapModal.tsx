"use client";

import { useState } from "react";
import api from "@/lib/api";

type Props = {
  open: boolean;
  onClose: () => void;
};

export default function CreateMapModal({ open, onClose }: Props) {
  const [nome, setNome] = useState("");
  const [descricao, setDescricao] = useState("");
  const [urlImagem, setUrlImagem] = useState("");
  const [loading, setLoading] = useState(false);

  if (!open) return null;

  async function handleSubmit(e: React.FormEvent) {
    e.preventDefault();

    if (!nome.trim()) return;

    try {
      setLoading(true);

      await api.post("/mapas", {
        nome: nome.trim(),
        descricao: descricao.trim() || null,
        url_imagem: urlImagem.trim() || null,
      });

      onClose();
      setNome("");
      setDescricao("");
      setUrlImagem("");
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
      <div className="bg-white rounded-2xl w-full max-w-md p-6">
        <h2 className="text-xl font-bold mb-4">Criar novo mapa</h2>

        <form onSubmit={handleSubmit} className="space-y-4">
          {/* Nome */}
          <input
            type="text"
            placeholder="Nome do mapa"
            value={nome}
            onChange={(e) => setNome(e.target.value)}
            required
            className="w-full border rounded-lg px-3 py-2"
          />

          {/* Descrição */}
          <textarea
            placeholder="Descrição (opcional)"
            value={descricao}
            onChange={(e) => setDescricao(e.target.value)}
            className="w-full border rounded-lg px-3 py-2"
            rows={3}
          />

          {/* URL da imagem */}
          <input
            type="url"
            placeholder="URL da imagem (opcional)"
            value={urlImagem}
            onChange={(e) => setUrlImagem(e.target.value)}
            className="w-full border rounded-lg px-3 py-2"
          />

          {/* Ações */}
          <div className="flex justify-end gap-3 pt-4">
            <button
              type="button"
              onClick={onClose}
              disabled={loading}
              className="px-4 py-2 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 btn-hover-secondary"
            >
              Cancelar
            </button>

            <button
              type="submit"
              disabled={loading || !nome.trim()}
              className="px-4 py-2 text-sm rounded-lg bg-[rgb(var(--primary))] text-white hover:opacity-90 disabled:opacity-50 btn-hover-primary"
            >
              {loading ? "Criando..." : "Criar mapa"}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
