'use client'

import { useState } from 'react';
import CreateMapModal from './CreateMapModal';

export function MapsHeader() {
  const [open, setOpen] = useState(false);


  return (
    <header className="mb-8 flex flex-col gap-4 items-center justify-between sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h1 className="text-xl sm:text-2xl font-semibold tracking-tight">
          Meus Mapas
        </h1>
        <p className="mt-1 text-sm text-muted">
          Gerencie e visualize seus mapas personalizados
        </p>
      </div>

      <button
        onClick={() => setOpen(true)}
        className="
        rounded-lg
        bg-neutral-secondary-medium 
        border 
        border-gray-300
        px-4 py-2
        text-sm font-medium
        text-background
        transition
        btn-hover-primary
        flex items-center gap-2
      "
      >
        Criar mapa <i className="bi bi-plus-lg" />
      </button>

      <CreateMapModal open={open} onClose={() => setOpen(false)} />
    </header>
  );

}