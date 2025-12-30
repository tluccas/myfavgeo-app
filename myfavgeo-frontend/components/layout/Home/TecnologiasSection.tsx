"use client";

import Image from "next/image";

export function TecnologiasSection() {
  const technologies = [
    { name: "Next.js", src: "/badges/nextjs-svgrepo-com.svg" },
    { name: "React", src: "/badges/react-svgrepo-com.svg" },
    { name: "TailwindCSS", src: "/badges/tailwind-svgrepo-com.svg" },
    { name: "Laravel", src: "/badges/laravel-svgrepo-com.svg" },
    { name: "Leaflet.js", src: "/badges/leaf-solid-svgrepo-com.svg" },
    { name: "OpenStreetMap", icon: "bi-globe" },
  ];

  return (
    <section className="w-full px-4 py-20">
      <div className="mx-auto max-w-4xl text-center">
        {/* Título */}
        <h2 className="text-2xl sm:text-3xl font-bold tracking-tight mb-10 text-foreground">
          Tecnologias utilizadas
        </h2>

        {/* Lista de Badges */}
        <div className="flex flex-wrap justify-center gap-3 select-none">
          {technologies.map((tech, index) => (
            <span
              key={index}
              className="
                flex items-center gap-2
                rounded-full
                border border-border
                bg-background
                px-4 py-2
                text-sm font-medium
                text-foreground/80
                shadow-sm
                transition
                hover:border-primary
                hover:text-primary
              "
            >
              {tech.src ? (
                <Image
                  src={tech.src}
                  alt={tech.name}
                  width={20}
                  height={20}
                  className="w-5 h-5"
                />
              ) : (
                <i className={`bi ${tech.icon} text-lg`} />
              )}
              {tech.name}
            </span>
          ))}
        </div>
      </div>
    </section>
  );
}
