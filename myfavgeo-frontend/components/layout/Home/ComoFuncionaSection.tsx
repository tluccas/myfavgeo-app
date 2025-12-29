"use client";

export function ComoFuncionaSection() {
  return (
    <section className="w-full px-4 py-24">
      <div className="mx-auto max-w-6xl">
        {/* Título */}
        <h2 className="text-center text-3xl sm:text-4xl font-bold tracking-tight">
          Como funciona
        </h2>

        {/* Cards */}
        <div className="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3 select-none">
          {/* Card 1 */}
          <div
            className="
              group
              rounded-2xl
              border border-border
              bg-secondary
              p-8
              text-center
              transition
              hover:-translate-y-1
              hover:shadow-xl
            "
          >
            <div
              className="
                mx-auto mb-4
                flex h-12 w-12 items-center justify-center
                rounded-full
                bg-accent
                text-primary
                transition
                group-hover:scale-110
              "
            >
              <i className="bi bi-map text-xl" />
            </div>

            <h3 className="text-lg font-semibold">Crie um mapa</h3>

            <p className="mt-2 text-sm text-foreground/85">
              Crie mapas personalizados para organizar seus pontos geográficos.
            </p>
          </div>

          {/* Card 2 */}
          <div
            className="
              group
              rounded-2xl
              border border-border
              bg-secondary
              p-8
              text-center
              transition
              hover:-translate-y-1
              hover:shadow-xl
            "
          >
            <div
              className="
                mx-auto mb-4
                flex h-12 w-12 items-center justify-center
                rounded-full
                bg-accent
                text-primary
                transition
                group-hover:scale-110
              "
            >
              <i className="bi bi-geo-alt text-xl" />
            </div>

            <h3 className="text-lg font-semibold">Adicione pontos</h3>

            <p className="mt-2 text-sm text-foreground/85">
              Clique no mapa e cadastre pontos com latitude e longitude
              automaticamente.
            </p>
          </div>

          {/* Card 3 */}
          <div
            className="
              group
              rounded-2xl
              border border-border
              bg-secondary
              p-8
              text-center
              transition
              hover:-translate-y-1
              hover:shadow-xl
            "
          >
            <div
              className="
                mx-auto mb-4
                flex h-12 w-12 items-center justify-center
                rounded-full
                bg-accent
                text-primary
                transition
                group-hover:scale-110
              "
            >
              <i className="bi bi-layers text-xl" />
            </div>

            <h3 className="text-lg font-semibold">Visualize e gerencie</h3>

            <p className="mt-2 text-sm text-foreground/85">
              Edite, remova e acompanhe todos os pontos em um mapa interativo.
            </p>
          </div>
        </div>
      </div>
    </section>
  );
}
