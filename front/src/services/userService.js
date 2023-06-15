import {API_URL} from "@/constants/urls";
import authHeader from "@/services/authHeader";

class UserService{

  async getAllUsers(){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}/users`,{
        headers: {
          "Content-Type": "application/json",
          ...authHeader()
        },
        method: "GET"
      })
      if(res.status === 200){
        return await res.json();
      }else{
        return false;
      }
    }
    catch (e) {
      console.error(e.message);
      return false
    }
  }

  async getSelfUser(id){
    try{
      const res = await fetch(`${API_URL}/users/${id}`, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          ...authHeader()
        }
      });
      if(res.status === 200){
        return await res.json();
      }else{
        return false;
      }
    }catch(e){
      console.error(e.message);
      return false;
    }
  }

  async getSingleUser(url){
    try{
      const res = await fetch(`${API_URL}${url}`, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          ...authHeader()
        }
      });
      if(res.status === 200){
        return await res.json();
      }else{
        return false;
      }
    }catch(e){
      console.error(e.message);
      return false;
    }
  }

  async updateUser(user){
    try {
      const res = await fetch(`${API_URL}/users/${user.id}`, {
        method: "PATCH",
        headers: {
          "Content-Type": "application/merge-patch+json",
          ...authHeader()
        },
        body: JSON.stringify(user)
      });

      return true;

    }
    catch (e)
    {
      console.error(e.message);
      return false
    }
  }

  async verifyAccount(payload){
    try{
      const res = await fetch(`${API_URL}/users/verify_email`, {
        method: "PATCH",
        headers: {
          "Content-Type": "application/merge-patch+json",
          ...authHeader()
        },
        body: JSON.stringify(payload)
      });
      if(res.status === 204){
        return true;
      }else{
        return false;
      }
    }catch(e){
      console.error(e.message);
      return false;
    }
  }
}

export default new UserService()
