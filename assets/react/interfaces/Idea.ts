import { ApiResource } from "../utils/types";

export interface Idea extends ApiResource {
  id: number;
  title?: string;
  createdAt?: string;
  created_at?: string;
}
