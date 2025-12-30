import { cookies } from "next/headers";
import { APIResponse, MapaDTO } from "@/lib/types/types";

export async function getMapas(): Promise<APIResponse<MapaDTO[]>> {
  const cookie = cookies().get("token");
  if (!cookie) {
    throw new Error("Usuário não autenticado");
  }

  const res = await fetch(
    `${process.env.API_URL || "http://localhost:8000/api"}/mapas`,
    {
      headers: {
        Cookie: `token=${cookie.value}`,
        Accept: "application/json",
      },
      cache: "no-store",
    }
  );

  if (!res.ok) {
    throw new Error("Erro ao buscar mapas");
  }

  return res.json();
}