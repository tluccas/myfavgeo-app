import Link from "next/link";
import Image from "next/image";
import { getAuthUser } from "@/lib/auth/get-auth-user";
import HeaderClient from "./HeaderClient";

export default async function Header() {
  const user = await getAuthUser();

  return (
    <header className="sticky top-0 z-1100 w-full h-16 bg-background/80 backdrop-blur-md border-b border-border/50 shadow-sm transition-colors duration-300">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div className="flex justify-between items-center h-full">
          {/* LOGO */}
          <Link href="/" className="flex items-center gap-2 group flex-1">
            <div className="p-1.5 bg-secondary rounded-radius group-hover:bg-accent transition-colors">
              <Image src="/favicon.ico" alt="Logo" width={28} height={28} />
            </div>
            <span className="text-xl font-extrabold tracking-tight text-foreground">
              MyFav<span className="text-primary">Geo</span>
            </span>
          </Link>

          {/* CENTER NAV */}
          <nav className="hidden md:flex items-center justify-center gap-3 flex-1">
            <Link
              href="/"
              className="px-5 py-2 text-sm font-semibold transition-all rounded-3xl flex items-center justify-center bg-secondary text-primary border-border border hover:bg-secondary/80"
            >
              Home
            </Link>

            <Link
              href="/mapas"
              className="px-5 py-2 text-sm font-semibold transition-all rounded-4xl flex items-center justify-center bg-primary text-white hover:bg-primary/90 shadow-sm"
            >
              Meus Mapas
            </Link>
          </nav>

          {/* CLIENT ACTIONS */}
          <div className="flex-1 flex justify-end">
            <HeaderClient user={user} />
          </div>
        </div>
      </div>
    </header>
  );
}
