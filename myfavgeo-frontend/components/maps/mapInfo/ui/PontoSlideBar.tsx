"use client";
import { PontoDTO } from "@/lib/types/types";
import Image from "next/image";

type PointsSidebarProps = {
  pontos: PontoDTO[];
  onEdit: (ponto: PontoDTO) => void;
  onDelete: (pontoId: number) => void;
  isOpen: boolean;
  onClose: () => void;
  mapaNome: string;
};

export default function PontoSlideBar({
  pontos,
  onEdit,
  onDelete,
  isOpen,
  onClose,
  mapaNome,
}: PointsSidebarProps) {
  return (
    <>
      {/* Overlay para mobile*/}
      {isOpen && (
        <div
          className="fixed inset-0 bg-black/30 z-[1040] md:hidden transition-opacity"
          onClick={onClose}
        />
      )}

      <div
        className={`fixed top-0 left-0 h-full bg-[rgb(var(--secondary))] shadow-2xl z-[1050] 
          transition-transform duration-300 ease-in-out
          w-[85%] sm:w-80 p-4 flex flex-col ${
            isOpen ? "translate-x-0" : "-translate-x-full"
          }`}
      >
        {/* Cabeçalho fixo na Sidebar */}
        <div className="flex justify-between items-start mb-1">
          <div className="min-w-0 flex-1">
            <h2 className="text-lg font-bold truncate">Pontos em {mapaNome}</h2>
            <h4 className="text-sm text-gray-500 mb-4">
              Pontos salvos: {pontos.length}
            </h4>
          </div>
          {/* Botão de fechar visível apenas mobile */}
          <button
            onClick={onClose}
            className="md:hidden p-2 -mt-1 text-gray-500 hover:text-black"
          >
            <i className="bi bi-x-lg text-xl"></i>
          </button>
        </div>

        {/* Lista de Pontos */}
        <ul className="space-y-2 overflow-y-auto flex-1 pr-1 custom-scrollbar">
          {pontos.map((ponto) => (
            <li
              key={ponto.id}
              className="flex justify-between items-center border-b rounded-lg border-gray-300 py-3 md:py-2 hover:bg-gray-300/50 transition-colors px-2 gap-2"
            >
              {/* Nome */}
              <span className="flex items-center shrink-0 font-medium max-w-[100px] sm:max-w-[120px]">
                <Image
                  src={ponto.url_imagem || "/favicon.ico"}
                  alt={ponto.nome}
                  width={20}
                  height={20}
                  className="w-5 h-5 object-cover rounded-full mr-2"
                />
                <span className="truncate text-sm">{ponto.nome}</span>
              </span>

              {/* Descrição */}
              <p className="text-xs text-gray-500 truncate flex-1 min-w-0 text-left">
                {ponto.descricao}
              </p>

              {/* Botões */}
              <div className="flex gap-2 shrink-0 ml-auto">
                <button
                  onClick={() => onEdit(ponto)}
                  className="text-[rgb(var(--primary))] p-1 hover:scale-110 transition-transform"
                  aria-label="Editar ponto"
                >
                  <i className="bi bi-pencil"></i>
                </button>
                <button
                  onClick={() => onDelete(ponto.id)}
                  className="text-red-500 p-1 hover:scale-110 transition-transform"
                  aria-label="Excluir ponto"
                >
                  <i className="bi bi-trash"></i>
                </button>
              </div>
            </li>
          ))}
        </ul>
      </div>
    </>
  );
}
