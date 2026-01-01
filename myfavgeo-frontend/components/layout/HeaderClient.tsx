"use client";

import { useState } from "react";
import Link from "next/link";
import { ThemeToggle } from "@/components/ThemeToggle";
import api from "@/lib/api";

type Props = {
  user: { nome: string } | null;
};

export default function HeaderClient({ user }: Props) {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  const handleLogout = async () => {
    try {
      await api.post("/logout");
      // Força recarregamento para limpar estado do servidor
      window.location.href = "/";
    } catch (error) {
      console.error("Erro ao fazer logout", error);
    }
  };

  return (
    <>
      {/* DESKTOP ACTIONS (Right Side) */}
      <div className="hidden md:flex items-center gap-4">
        {user ? (
          <div className="flex items-center gap-4">
            <span className="text-sm font-medium flex items-center gap-2">
              <i className="bi bi-person-circle text-lg"></i>
              <span>
                Olá, 
                <strong className="font-bold select-none"> {user.nome}</strong>
              </span>
            </span>
            <button
              onClick={handleLogout}
              className="text-sm font-semibold text-red-500 hover:cursor-pointer hover:text-red-800 transition-colors"
            >
              Sair
            </button>
          </div>
        ) : (
          <Link
            href="/login"
            className="text-sm font-semibold hover:text-primary transition-colors"
          >
            Entrar
          </Link>
        )}

        <ThemeToggle />
      </div>

      {/* MOBILE TOGGLE */}
      <div className="md:hidden flex items-center gap-2">
        <ThemeToggle />
        <button
          onClick={() => setIsMenuOpen(!isMenuOpen)}
          className="p-2 rounded-radius text-foreground hover:bg-secondary transition-colors"
        >
          <i className={`bi ${isMenuOpen ? "bi-x-lg" : "bi-list"} text-2xl`} />
        </button>
      </div>

      {/* MOBILE MENU */}
      <div
        className={`md:hidden absolute top-16 left-0 w-full bg-background/95 backdrop-blur-lg border-b border-border shadow-xl transition-all duration-300 origin-top ${
          isMenuOpen
            ? "scale-y-100 opacity-100"
            : "scale-y-0 opacity-0 pointer-events-none"
        }`}
      >
        <nav className="flex flex-col p-4 gap-3">
          <Link
            href="/"
            onClick={() => setIsMenuOpen(false)}
            className="py-2 hover:text-primary"
          >
            Home
          </Link>
          <Link
            href="/mapas"
            onClick={() => setIsMenuOpen(false)}
            className="py-2 hover:text-primary"
          >
            Meus Mapas
          </Link>

          <hr className="border-border" />

          {user ? (
            <>
              <div className="flex items-center gap-2 py-2">
                <i className="bi bi-person-circle"></i>
                <span className="font-medium">{user.nome}</span>
              </div>
              <button
                onClick={() => {
                  setIsMenuOpen(false);
                  handleLogout();
                }}
                className="text-left py-2 text-red-500 font-medium"
              >
                Sair
              </button>
            </>
          ) : (
            <Link
              href="/login"
              onClick={() => setIsMenuOpen(false)}
              className="py-2 font-medium"
            >
              Entrar
            </Link>
          )}
        </nav>
      </div>
    </>
  );
}
