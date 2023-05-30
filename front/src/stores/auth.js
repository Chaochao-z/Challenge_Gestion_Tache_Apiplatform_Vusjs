import {API_URL} from "../constants/urls";
import {defineStore} from "pinia";
import AuthService from "../services/authService";
import jwtDecode from "jwt-decode";

const checkToken = (token) => {
  try {
    const decoded = jwtDecode(token);
    const current_time = Date.now() / 1000;
    const hasExpired = decoded.exp < current_time;
    if(!!hasExpired) throw new Error("Token has expired");
    return decoded;
  } catch (e) {
    console.error(e.message);
    return null;
  }
};

const UserData = {
  id:null,
  username:null,
  email:null,
  roles:[],
  token:null,
}

export const userAuthStore = defineStore("auth",()=>{

  async function login(username, password){
    if (!username || !password){
      return;
    }

    const res = await AuthService.login(username,password)
    if (res && res?.token) {
      const decoded = checkToken(res.token)
      if (decoded){
        localStorage.setItem(TOKEN_STORAGE_KEY, res.token)
        userData.value = { ...decoded, token: res.token}
        return true
      }
    }
    return false
  }

  return {login}
})
