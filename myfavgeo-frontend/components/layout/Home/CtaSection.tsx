"use client";

import Link from "next/link";

export function CtaSection() {
  return (
    <section className="w-full px-4 py-24">
      <div className="mx-auto max-w-3xl text-center">
        <h2 className="text-3xl sm:text-4xl font-bold tracking-tight mb-8">
          Pronto para criar seu primeiro mapa?
        </h2>

        <Link
          href="/mapas"
          className="
            inline-flex items-center justify-center
            rounded-lg
            bg-primary
            px-8 py-3
            text-lg font-semibold text-white
            shadow-md
            transition
            hover:bg-primary/90
            hover:scale-105
            hover:border
            hover:border-gray-400
            hover:text-secondary
          "
        >
          Acessar aplicação
        </Link>
      </div>
    </section>
  );
}
