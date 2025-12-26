export interface Mapa{
    id: number;
    nome: string;
    descricao: string;
    url_imagem?: string;
    pontos_count: number;
}

export interface APIResponse<T>{
   sucess: boolean;
   message: string;
   data: T;
}