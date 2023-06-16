import router from "../router";
import {TOKEN_STORAGE_KEY} from "@/constants/storage_keys";
import jwt_decode from "jwt-decode";
export function authUser(to)
{
  let token = localStorage.getItem(TOKEN_STORAGE_KEY)
  if(token)
  {
    const decodetoken = jwt_decode(token);
    if (decodetoken.roles.includes("ROLE_STANDARD"))
    {
      return true
    }
    if (decodetoken.roles.includes("ROLE_ADMIN"))
    {
      return true
    }
  }

  router.push('/')
}
