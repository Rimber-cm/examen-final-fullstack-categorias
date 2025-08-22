export interface Categoria {
  id?: number;
  nombre: string;
  created_at?: string;
  updated_at?: string;
}

// Interface para la respuesta de la API
export interface ApiResponse<T> {
  success: boolean;
  data?: T;
  message?: string;
  errors?: any;
}