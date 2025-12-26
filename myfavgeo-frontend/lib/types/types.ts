export interface MapaDTO{
    id: number;
    nome: string;
    descricao: string;
    url_imagem?: string;
    pontos_count: number;
    created_at: string;
}

export interface APIResponse<T>{
   sucess: boolean;
   message: string;
   data: T;
}