export function BackgroundBlobs() {
  return (
    <div className="fixed inset-0 -z-10 overflow-hidden pointer-events-none bg-dot-pattern">
      <div className="absolute top-0 left-1/4 w-[500px] h-[500px] bg-[rgb(var(--primary)/0.2)] rounded-full blur-3xl mix-blend-multiply animate-blob" />
      <div className="absolute top-0 right-1/4 w-[500px] h-[500px] bg-[rgb(var(--accent)/0.3)] rounded-full blur-3xl mix-blend-multiply animate-blob animation-delay-2000" />
      <div className="absolute -bottom-32 left-1/3 w-[500px] h-[500px] bg-[rgb(var(--secondary)/0.4)] rounded-full blur-3xl mix-blend-multiply animate-blob animation-delay-4000" />
      <div className="absolute top-1/2 left-1/2 w-[600px] h-[600px] bg-[rgb(var(--primary)/0.15)] rounded-full blur-3xl mix-blend-multiply animate-blob animation-delay-2000" />
    </div>
  );
}
