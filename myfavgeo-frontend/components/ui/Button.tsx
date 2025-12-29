import React from "react";

export function Button({
  children,
  className = "",
  isLoading = false,
  ...props
// eslint-disable-next-line @typescript-eslint/no-explicit-any
}: any) {
  return (
    <button
      className={`
        flex items-center justify-center rounded-md px-4 py-2 font-medium transition-colors
        bg-primary text-white hover:bg-primary/90
        disabled:opacity-50 disabled:cursor-not-allowed
        ${className}
      `}
      disabled={isLoading || props.disabled}
      {...props}
    >
      {isLoading && (
        <span className="mr-2 h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent" />
      )}
      {children}
    </button>
  );
}
