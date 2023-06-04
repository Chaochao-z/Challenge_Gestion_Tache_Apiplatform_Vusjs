import {API_URL} from "@/constants/urls";
import {defineStore} from "pinia";
import AuthService from "../services/authService";
import {computed, ref} from "vue";
import jwtDecode from "jwt-decode";
import {TOKEN_STORAGE_KEY} from "@/constants/storage_keys";
import router from "@/router";

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

const UserDataNull = {
  id:null,
  username:null,
  email:null,
  roles:[],
  token:null,
}

export const userAuthStore = defineStore("auth",()=>{
  const UserData = ref(UserDataNull);
  const isLogged = computed(() => !!UserData.value.token);

  function tryLogin() {
    const token = localStorage.getItem(TOKEN_STORAGE_KEY);
    if (!token) return;
    const decoded = checkToken(token);
    if( !decoded ){
      localStorage.removeItem(TOKEN_STORAGE_KEY);
      UserData.value = UserDataNull;
      return;
    }
    UserData.value = { ...decoded, token };
  }

  async function login(username, password){
    if (!username || !password){
      return;
    }

    const res = await AuthService.login(username,password)
    if (res && res?.token) {
      console.log(res.token)
      const decoded = checkToken(res.token)
      if (decoded){
        localStorage.setItem(TOKEN_STORAGE_KEY, res.token)
        UserData.value = { ...decoded, token: res.token}
        return true
      }
    }
    return false
  }

  function logout() {
    localStorage.removeItem(TOKEN_STORAGE_KEY);
    UserData.value = UserDataNull;
    router.push({ name: "homeview" });
  }

  return {login, logout, isLogged,UserData, tryLogin}
})
