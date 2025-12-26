import { APIResponse, Mapa } from "@/lib/types/types";
import api from "@/lib/api";
import "@/app/globals.css";

export default async function MapasPage(){

    const response = await api.get<APIResponse<Mapa[]>>('mapas/');
    const mapas = response.data;

    return (
      <main className="min-h-screen bg-background px-6 py-8 text-foreground">
        <header className="mb-8 flex items-center justify-between">
          <div>
            <h1 className="text-2xl font-semibold tracking-tight">
              Meus Mapas
            </h1>
            <p className="mt-1 text-sm text-muted">
              Gerencie e visualize seus mapas personalizados
            </p>
          </div>

          <button
            className="
        rounded-lg
        bg-primary
        px-4 py-2
        text-sm font-medium
        text-background
        transition
        hover:opacity-90
      "
          >
            Criar mapa
          </button>
        </header>

        <section className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {mapas.data.map((map) => (
            <article
              key={map.id}
              className="
          group
          overflow-hidden
          rounded-xl
          border border-border
          bg-secondary/40
          transition
          hover:bg-secondary/60
        "
            >
              {map.url_imagem && (
                <div className="overflow-hidden">
                  <img
                    src={map.url_imagem}
                    alt={map.nome}
                    className="
                h-44 w-full object-cover
                transition-transform
                duration-300
                group-hover:scale-105
              "
                  />
                </div>
              )}

              <div className="flex h-full flex-col p-4">
                <h2 className="text-base font-medium leading-tight">
                  {map.nome}
                </h2>

                <p className="mt-1 line-clamp-2 text-sm text-muted">
                  {map.descricao}
                </p>

                <div className="mt-auto pt-4">
                  <span
                    className="
                inline-flex items-center
                rounded-md
                bg-accent/40
                px-2 py-1
                text-xs font-medium
                text-foreground
              "
                  >
                    {map.pontos_count} pontos
                  </span>
                </div>
              </div>
            </article>
          ))}
        </section>
      </main>
    );
}