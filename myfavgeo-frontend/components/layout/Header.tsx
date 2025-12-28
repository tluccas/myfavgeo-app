"use client";

import { useState } from "react";
import Link from "next/link";
import Image from "next/image";

export default function Header() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  const toggleMenu = () => setIsMenuOpen(!isMenuOpen);

  // Estilos base
  const navLinkBase =
    "px-5 py-2 text-sm font-semibold transition-all rounded-radius flex items-center justify-center";

  return (
    <header className="sticky top-0 z-1100 w-full h-16 bg-white/80 backdrop-blur-md border-b border-gray-200/50 shadow-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          {/* LOGO */}
          <div className="shrink-0">
            <Link href="/" className="flex items-center gap-2 group">
              <div className="p-1.5 bg-secondary rounded-radius group-hover:bg-accent transition-colors">
                <Image src="/favicon.ico" alt="Logo" width={28} height={28} />
              </div>
              <span className="text-xl font-extrabold tracking-tight text-foreground">
                MyFav<span className="text-primary">Geo</span>
              </span>
            </Link>
          </div>

          {/* DESKTOP NAV */}
          <nav className="hidden md:flex items-center gap-3">
            <Link
              href="/"
              className={`${navLinkBase} bg-secondary text-primary border-gray-300 border rounded-3xl hover:text-black btn-hover-secondary`}
            >
              Home
            </Link>
            <Link
              href="/mapas"
              className={`${navLinkBase} bg-primary text-primary border border-gray-300 rounded-4xl btn-hover-primary shadow-sm`}
            >
              Meus Mapas
            </Link>
          </nav>

          {/* MOBILE MENU BUTTON */}
          <div className="md:hidden flex items-center">
            <button
              onClick={toggleMenu}
              className="p-2 rounded-radius text-foreground hover:bg-secondary transition-colors"
            >
              <i
                className={`bi ${isMenuOpen ? "bi-x-lg" : "bi-list"} text-2xl`}
              />
            </button>
          </div>
        </div>
      </div>

      {/* MOBILE MENU */}
      <div
        className={`md:hidden absolute w-full bg-white/95 backdrop-blur-lg border-b border-gray-200 shadow-xl transition-all duration-300 ease-in-out origin-top ${
          isMenuOpen
            ? "scale-y-100 opacity-100"
            : "scale-y-0 opacity-0 pointer-events-none"
        }`}
      >
        <nav className="flex flex-col p-4 gap-3">
          <Link
            href="/"
            onClick={() => setIsMenuOpen(false)}
            className={`${navLinkBase} bg-secondary text-primary  hover:bg-gray-300 rounded-3xl py-4 `}
          >
            Home
          </Link>
          <Link
            href="/mapas"
            onClick={() => setIsMenuOpen(false)}
            className={`${navLinkBase} bg-primary text-primary hover:bg-gray-300 rounded-3xl py-4`}
          >
            Meus Mapas
          </Link>
        </nav>
      </div>
    </header>
  );
}
