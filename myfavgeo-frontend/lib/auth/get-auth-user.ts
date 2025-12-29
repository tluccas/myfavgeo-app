import { cookies } from "next/headers";

export async function getAuthUser() {
  const token = cookies().get("token");
  if (!token) return null;

  const res = await fetch(
    `${process.env.API_URL || "http://localhost:8000/api"}/me`,
    {
      headers: {
        // Envia o token de autenticação via cookie para o backend
        Cookie: `token=${token.value}`,
      },
      cache: "no-store",
    }
  );

  if (!res.ok) return null;
  return res.json();
}
