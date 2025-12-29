"use client";

import * as React from "react";
import { useTheme } from "next-themes";

export function ThemeToggle() {
  const { setTheme, theme } = useTheme();
  const [mounted, setMounted] = React.useState(false);

  React.useEffect(() => {
    setMounted(true);
  }, []);

  if (!mounted) {
    return (
      <button
        className="p-2 rounded-full hover:bg-secondary transition-colors w-9 h-9 flex items-center justify-center"
        aria-label="Toggle Dark Mode"
      >
        <span className="sr-only">Toggle theme</span>
      </button>
    );
  }

  return (
    <button
      onClick={() => setTheme(theme === "dark" ? "light" : "dark")}
      className="p-2 rounded-full hover:bg-secondary transition-colors w-9 h-9 flex items-center justify-center"
      aria-label="Toggle Dark Mode"
    >
      <i
        className={`bi ${
          theme === "dark" ? "bi-sun-fill" : "bi-moon-fill"
        } text-xl text-foreground`}
      />
    </button>
  );
}
