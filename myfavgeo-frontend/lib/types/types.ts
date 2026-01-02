export interface MapaDTO{
    id: number;
    nome: string;
    descricao: string;
    url_imagem?: string;
    pontos_count: number;
    updated_at: string;
}

export interface APIResponse<T>{
   sucess: boolean;
   message: string;
   data: T;
}

export interface PontoDTO{
    id: number,
    nome: string,
    descricao: string,
    latitude: number,
    longitude: number,
    mapa_id: number,
    created_at: string,
    updated_at: string,
}