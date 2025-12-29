"use client";

import { useState } from "react";
import { MapContainer, TileLayer, Marker } from "react-leaflet";
import api from "@/lib/api";
import L from "leaflet";

// Configura ícones padrão do Leaflet (para não quebrar o marker)
// eslint-disable-next-line @typescript-eslint/no-explicit-any
delete (L.Icon.Default.prototype as any)._getIconUrl;
L.Icon.Default.mergeOptions({
  iconRetinaUrl:
    "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png",
  iconUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png",
  shadowUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",
});

type Props = {
  open: boolean;
  onClose: () => void;
  latitude: number;
  longitude: number;
  mapa_id: number;
};

export default function CreatePontModal({
  open,
  onClose,
  latitude,
  longitude,
  mapa_id,
}: Props) {
  const [nome, setNome] = useState("");
  const [descricao, setDescricao] = useState("");
  const [loading, setLoading] = useState(false);

  if (!open) return null;

  async function handleSubmit(e: React.FormEvent) {
    e.preventDefault();
    if (!nome.trim()) return;

    try {
      setLoading(true);
      await api.post("/pontos", {
        nome: nome.trim(),
        descricao: descricao.trim() || null,
        latitude,
        longitude,
        mapa_id,
      });

      onClose();
      setNome("");
      setDescricao("");
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
      <div className="bg-background text-foreground rounded-2xl w-full max-w-md p-6 border border-border shadow-xl">
        <h2 className="text-xl font-bold mb-4 flex items-center gap-2">
          <i className="bi bi-geo-fill text-primary"></i> Adicionar novo ponto
        </h2>

        {/* Mini mapa */}
        <div className="w-full h-48 rounded-lg overflow-hidden border border-border mb-4">
          <MapContainer
            center={[latitude, longitude]}
            zoom={16}
            scrollWheelZoom={false}
            dragging={false}
            doubleClickZoom={false}
            attributionControl={false}
            className="w-full h-full"
          >
            <TileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
            <Marker position={[latitude, longitude]} />
          </MapContainer>
        </div>

        {/* Informações da posição */}
        <div className="mb-4 text-sm text-muted-foreground bg-secondary/50 p-3 rounded-lg border border-border">
          <strong>Latitude:</strong> {latitude.toFixed(5)} <br />
          <strong>Longitude:</strong> {longitude.toFixed(5)}
        </div>

        {/* Formulário */}
        <form onSubmit={handleSubmit} className="space-y-4">
          <input
            type="text"
            placeholder="Nome do ponto"
            value={nome}
            onChange={(e) => setNome(e.target.value)}
            required
            className="w-full border border-border bg-background text-foreground placeholder:text-muted-foreground rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary/50 outline-none transition-all"
          />
          <textarea
            placeholder="Descrição (opcional)"
            value={descricao}
            onChange={(e) => setDescricao(e.target.value)}
            className="w-full border border-border bg-background text-foreground placeholder:text-muted-foreground rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary/50 outline-none transition-all"
            rows={3}
          />

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
              {loading ? "Criando..." : "Adicionar Ponto"}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
