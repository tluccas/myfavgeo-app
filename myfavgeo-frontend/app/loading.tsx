"use client";

import Lottie from "react-lottie";
import LoadingAnimation from "@/public/lotties/Loading-Map.json";

export default function Loading() {
  const defaultOptions = {
    loop: true,
    autoplay: true,
    animationData: LoadingAnimation,
    rendererSettings: {
      preserveAspectRatio: "xMidYMid slice",
    },
  };

  return (
    <div className="flex h-screen w-full items-center justify-center bg-background ">
      <div className="flex flex-col items-center gap-4">
        <div className="pointer-events-none">
          <Lottie options={defaultOptions} height={"auto"} width={400} />
        </div>
        <p className="text-lg font-medium text-muted-foreground animate-pulse">
          Aguarde enquanto preparamos sua experiência...
        </p>
      </div>
    </div>
  );
}
