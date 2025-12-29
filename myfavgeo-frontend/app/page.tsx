import { ComoFuncionaSection } from "@/components/layout/Home/ComoFuncionaSection";
import { Hero } from "@/components/layout/Home/Hero";
import { FuncionalidadesSection } from "@/components/layout/Home/FuncionalidadesSection";
import { TecnologiasSection } from "@/components/layout/Home/TecnologiasSection";
import { CtaSection } from "@/components/layout/Home/CtaSection";
import { BackgroundBlobs } from "@/components/layout/Home/BackgroundBlobs";

export default function Home() {
  return (
    <div className="relative min-h-screen overflow-hidden">
      <BackgroundBlobs />
      <div className="relative z-10">
        <Hero />
        <FuncionalidadesSection />
        <ComoFuncionaSection />
        <TecnologiasSection />
        <CtaSection />
      </div>
    </div>
  );
}
