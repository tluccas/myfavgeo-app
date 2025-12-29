import React from "react";

// eslint-disable-next-line @typescript-eslint/no-explicit-any
export function Input({ label, error, className = "", ...props }: any) {
  return (
    <div className="w-full">
      {label && (
        <label className="mb-2 block text-sm font-medium text-foreground">
          {label}
        </label>
      )}

      <input
        className={`
          w-full rounded-md border bg-background px-3 py-2 text-sm outline-none
          focus:ring-2 focus:ring-primary
          disabled:opacity-50
          ${error ? "border-red-500 focus:ring-red-500" : "border-border"}
          ${className}
        `}
        {...props}
      />

      {error && <p className="mt-1 text-xs text-red-500">{error}</p>}
    </div>
  );
}
