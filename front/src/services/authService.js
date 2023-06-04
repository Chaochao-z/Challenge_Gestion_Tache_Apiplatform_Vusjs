import {API_URL} from "@/constants/urls";

class AuthService {
  async login(username, password){
    try {
      const res = await fetch(`${API_URL}/authentication_token`,{
        headers: {
          "Content-Type" : "application/json",
          'Access-Control-Allow-Origin': '*',
        },
        method:"POST",
        body: JSON.stringify({username,password})
      })
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

  async signup(payload){
    try{
      console.log(payload)
      const res = await fetch(`${API_URL}/register`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
      });
      if(res.status === 201){
        return true;
      }
      else{
        return false;
      }
    }catch(e){
      console.error(e.message);
      return false;
    }
  }
}

export default new AuthService()
