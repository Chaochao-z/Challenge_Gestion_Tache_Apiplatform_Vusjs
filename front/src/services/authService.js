import {API_URL} from "@/constants/urls";

class AuthService {
  async login(username, password){
    try {
      const res = await fetch(`${API_URL}/authentication_token`,{
        headers: {
          "Content-Type" : "application/json",
        },
        method:"POST",
        body: JSON.stringify({username,password})
      })
      console.log(res)
      if (res.status === 200){
        console.log(res)
        return res.json();
      }else {
        return false;
      }
    }catch (e) {
      console.error(e.message);
      return false;
    }
  }
}

export default new AuthService()