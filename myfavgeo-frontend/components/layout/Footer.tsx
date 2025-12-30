import Link from "next/link";
import Image from "next/image";

export default function Footer() {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="w-full border-t border-border bg-background/95 backdrop-blur-sm transition-colors duration-300 mt-auto">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="flex flex-col md:flex-row justify-between items-center gap-6">
          {/* Logo e Copyright */}
          <div className="flex flex-col items-center md:items-start gap-2">
            <Link href="/" className="flex items-center gap-2 group">
              <div className="p-1.5 bg-secondary rounded-radius group-hover:bg-accent transition-colors">
                <Image src="/favicon.ico" alt="Logo" width={24} height={24} />
              </div>
              <span className="text-lg font-bold tracking-tight text-foreground">
                MyFav<span className="text-primary">Geo</span>
              </span>
            </Link>
            <p className="text-sm text-foreground/60">
              © {currentYear} MyFavGeo. Todos os direitos reservados.
            </p>
          </div>

          {/* Links */}
          <div className="flex items-center gap-4">
            <a
              href="https://github.com/tluccas"
              target="_blank"
              rel="noopener noreferrer"
              className="p-2 rounded-full hover:bg-secondary text-foreground/70 hover:text-primary transition-colors"
              aria-label="GitHub"
            >
              <i className="bi bi-github text-xl"></i>
            </a>
            <a
              href="https://www.linkedin.com/in/lucasalvesz/"
              target="_blank"
              rel="noopener noreferrer"
              className="p-2 rounded-full hover:bg-secondary text-foreground/70 hover:text-primary transition-colors"
              aria-label="LinkedIn"
            >
              <i className="bi bi-linkedin text-xl"></i>
            </a>
            <a
              href="https://tluccas.github.io/Portfolio/"
              target="_blank"
              rel="noopener noreferrer"
              className="p-2 rounded-full hover:bg-secondary text-foreground/70 hover:text-primary transition-colors"
              aria-label="Portfolio"
            >
              <i className="bi bi-globe text-xl"></i>
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}
