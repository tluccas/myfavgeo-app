/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  swcMinify: true,
  experimental: {
    appDir: true, // Required for Next.js 14 app directory
  },
  compiler: {
    // Enable CSS Modules and Tailwind support
    styledComponents: false,
  },
  typescript: {
    ignoreBuildErrors: false, // Will stop build if there are TS errors
  },
  eslint: {
    ignoreDuringBuilds: true, // Optional: ignore ESLint errors on build
  },
};

export default nextConfig;
