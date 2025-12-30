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
    <div className="flex min-h-[calc(100vh-5rem)] w-full items-center justify-center bg-background px-4 mb-8">
      <div className="flex flex-col items-center gap-2 sm:gap-4 text-center">
        <div className="pointer-events-none w-full max-w-250px sm:max-w-300px">
          <Lottie options={defaultOptions} height={"auto"} width={"100%"} />
        </div>
        <p className="text-base sm:text-lg font-medium text-muted-foreground animate-pulse">
          Aguarde enquanto preparamos sua experiência...
        </p>
      </div>
    </div>
  );
}
