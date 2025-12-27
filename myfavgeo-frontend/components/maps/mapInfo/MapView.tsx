"use client";
import { useEffect, useState, useCallback } from "react";
import { MapContainer, TileLayer, Marker, Popup } from "react-leaflet";
import MapClickHandle from "./event/MapClickHandle";
import L from "leaflet";
import CreatePontModal from "./ui/CreatePointModal";
import { PontoDTO } from "@/lib/types/types";
import api from "@/lib/api";
import PontoSlideBar from "./ui/PontoSlideBar";

// Configuração dos ícones padrão do Leaflet (Correção de ícones quebrados)
L.Icon.Default.mergeOptions({
  iconRetinaUrl:
    "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png",
  iconUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png",
  shadowUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",
});

type MapViewProps = {
  center?: [number, number];
  zoom?: number;
};

export default function MapView({
  center = [-23.55052, -46.633308],
  zoom = 13,
}: MapViewProps) {
  const [clickedPosition, setClickedPosition] = useState<
    [number, number] | null
  >(null);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [pontos, setPontos] = useState<PontoDTO[]>([]);
  const [loading, setLoading] = useState(true);
  const [isSidebarOpen, setIsSidebarOpen] = useState(true);
  const [mapaNome, setMapaNome] = useState("");

  // Busca de pontos
  const fetchPontos = useCallback(async () => {
    try {
      setLoading(true);
      // Nota: mapa_id fixo em 3 como no original
      const res = await api.get("/mapas/3");
      // Ajuste conforme a estrutura da sua API (res.data.data.pontos ou apenas res.data.pontos)
      setPontos(res.data.data?.pontos || res.data.pontos || []);
    } catch (error) {
      console.error("Erro ao buscar pontos:", error);
    } finally {
      setLoading(false);
    }
  }, []);

  const fetchMapaNome = useCallback(async () => {
    try {
      const res = await api.get("/mapas/3");
      setMapaNome(res.data.data.nome || "Desconhecido");
    } catch (error) {
      console.error("Erro ao buscar nome do mapa:", error);
    }
  }, []);

  useEffect(() => {
    fetchMapaNome();
  }, [fetchMapaNome]);

  useEffect(() => {
    fetchPontos();
  }, [fetchPontos]);

  // Handlers
  const handleEdit = (ponto: PontoDTO) => {
    console.log("Editar ponto:", ponto);
  };

  const handleDelete = async (pontoId: number) => {
    if (!confirm("Tem certeza que deseja excluir este ponto?")) return;
    try {
      await api.delete(`/pontos/${pontoId}`);
      setPontos((prev) => prev.filter((p) => p.id !== pontoId));
    } catch (error) {
      console.error("Erro ao deletar ponto:", error);
    }
  };

  const handleMapClick = (lat: number, lng: number) => {
    setClickedPosition([lat, lng]);
    setIsModalOpen(true);
  };

  const handleModalClose = () => {
    setIsModalOpen(false);
    setClickedPosition(null); // Limpa o marcador temporário ao fechar
    fetchPontos(); // Recarrega a lista
  };
  return (

    <div className="relative w-full h-screen overflow-hidden">
      {/* Caixa de instrução */}
      <div
        className="absolute top-4 right-4 md:left-auto md:right-14 z-1001 
      bg-white/95 backdrop-blur-sm text-black px-4 py-2 rounded shadow-lg border border-gray-300 
      text-sm md:text-base text-center pointer-events-none"
      >
        <i className="bi bi-hand-index-thumb mr-2"></i>
        <span className="hidden sm:inline">
          Clique no mapa para adicionar um novo ponto
        </span>
        <span className="sm:hidden">Toque no mapa para adicionar</span>
      </div>

      {/* Botão de Controle da Sidebar */}
      <button
        onClick={() => setIsSidebarOpen(!isSidebarOpen)}
        className="absolute bottom-6 left-4 md:left-14 z-1001
        bg-white text-black px-5 py-3 md:px-4 md:py-2 
        rounded-full md:rounded shadow-xl border border-gray-300 
        hover:bg-gray-100 active:scale-95 transition-all font-medium"
      >
        {isSidebarOpen ? "✕ Fechar Lista" : "☰ Ver Pontos"}
      </button>

      {/* Carregamento - Posicionado de forma discreta */}
      {loading && (
        <div className="absolute top-20 right-4 z-1001 bg-white/80 backdrop-blur-sm p-2 rounded shadow text-xs">
          <span className="flex items-center gap-2">
            <div className="w-3 h-3 border-2 border-primary border-t-transparent animate-spin rounded-full"></div>
            Carregando...
          </span>
        </div>
      )}

      <MapContainer
        center={center}
        zoom={zoom}
        scrollWheelZoom
        className="w-full h-full z-0"
      >
        <TileLayer
          attribution="&copy; OpenStreetMap"
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        />

        {pontos.map((ponto) => (
          <Marker key={ponto.id} position={[ponto.latitude, ponto.longitude]}>
            <Popup>
              <div className="flex flex-col gap-1 min-w-150px">
                <strong className="text-lg border-b pb-1">{ponto.nome}</strong>
                <p className="text-sm text-gray-600 leading-tight">
                  {ponto.descricao}
                </p>
              </div>
            </Popup>
          </Marker>
        ))}

        <MapClickHandle onClick={handleMapClick} />

        {clickedPosition && (
          <Marker position={clickedPosition}>
            <Popup>Novo ponto aqui!</Popup>
          </Marker>
        )}
      </MapContainer>

      {/* Sidebar */}
      <PontoSlideBar
        mapaNome={mapaNome}
        pontos={pontos}
        isOpen={isSidebarOpen}
        onClose={() => setIsSidebarOpen(false)}
        onEdit={handleEdit}
        onDelete={handleDelete}
      />

      {/* Modal de Criação */}
      {isModalOpen && clickedPosition && (
        <CreatePontModal
          open={isModalOpen}
          onClose={handleModalClose}
          latitude={clickedPosition[0]}
          longitude={clickedPosition[1]}
          mapa_id={3}
        />
      )}
    </div>
  );
}
