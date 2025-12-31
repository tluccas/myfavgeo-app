import { cookies } from "next/headers";

export async function getAuthUser() {
  const token = cookies().get("token");
  if (!token) return null;

  const res = await fetch(
    `${process.env.NEXT_PUBLIC_API_URL || ""}/me`,
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
