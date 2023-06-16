import router from "../router";
import {TOKEN_STORAGE_KEY} from "@/constants/storage_keys";
import jwt_decode from "jwt-decode";
export function authObservateur(to)
{
  let token = localStorage.getItem(TOKEN_STORAGE_KEY)
  if(token)
  {
    return true
  }

  router.push('/')
}
