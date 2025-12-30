"use client";

import Link from "next/link";

export function Hero() {
  return (
    <section className="w-full px-4">
      <div
        className="
          relative
          mx-auto
          w-full
          rounded-2xl
          bg-[url('/backgrounds/abillion-TefCcU-33MM-unsplash.jpg')]
          bg-cover
          bg-center
          bg-fixed
          py-24
          sm:py-42
        "
      >
        {/* Overlay */}
        <div className="absolute inset-0 rounded-2xl bg-black/55" />

        {/* Conteúdo */}
        <div className="relative z-10 flex flex-col items-center justify-center text-center px-6">
          <h1
            className="
              max-w-3xl
              font-sans
              text-3xl
              font-bold
              tracking-tight
              text-white
              sm:text-4xl
              md:text-5xl
              select-none
            "
          >
            Crie e organize seus mapas personalizados
          </h1>

          <p
            className="
              mt-4
              max-w-2xl
              text-sm
              text-white/80
              sm:text-base
              md:text-lg
                select-none
            "
          >
            Gerencie pontos geográficos, visualize tudo em um mapa interativo e
            mantenha suas informações organizadas, e o melhor de tudo: DE GRAÇA.
          </p>

          <Link
            href="/mapas"
            className="
            mt-8
            inline-flex
            items-center
            gap-1.5
            rounded-full
            border border-white/30
            bg-white/10
            px-6 py-2.5
            text-sm font-medium
            leading-none
            text-white
            backdrop-blur
            transition
            hover:bg-white/20
            "
          >
            <span>Começar Agora</span>
            <i className="bi bi-arrow-bar-right flex items-center" />
          </Link>
        </div>
      </div>
    </section>
  );
}
