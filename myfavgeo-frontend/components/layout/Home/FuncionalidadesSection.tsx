"use client";

export function FuncionalidadesSection() {
  const features = [
    {
      title: "Criar mapas personalizados",
      icon: "bi-map",
    },
    {
      title: "Adicionar pontos geográficos",
      icon: "bi-geo-alt",
    },
    {
      title: "Visualizar pontos em mapa interativo",
      icon: "bi-globe-americas",
    },
    {
      title: "Editar e remover pontos facilmente",
      icon: "bi-pencil-square",
    },
  ];

  return (
    <section className="w-full px-4 py-24">
      <div className="mx-auto max-w-6xl">
        {/* Título */}
        <h2 className="text-center text-3xl sm:text-4xl font-bold tracking-tight mb-16">
          O que você pode fazer
        </h2>

        {/* Grid */}
        <div className="grid gap-6 md:grid-cols-2 select-none">
          {features.map((feature, index) => (
            <div
              key={index}
              className="
                flex items-center gap-4
                rounded-xl
                border border-border
                bg-secondary/30
                p-6
                transition
                hover:bg-secondary
                hover:shadow-md
              "
            >
              <div
                className="
                  flex h-12 w-12 shrink-0 items-center justify-center
                  rounded-full
                  bg-accent
                  text-primary
                "
              >
                <i className={`bi ${feature.icon} text-xl`} />
              </div>
              <h3 className="text-lg font-medium">{feature.title}</h3>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
