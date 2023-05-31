import { TOKEN_STORAGE_KEY } from "../constants/storage_keys.js";

export default function authHeader(){
  const token = localStorage.getItem(TOKEN_STORAGE_KEY);
  if(token){
    return { Authorization: 'Bearer ' + token};
  }else{
    return {};
  }
}
