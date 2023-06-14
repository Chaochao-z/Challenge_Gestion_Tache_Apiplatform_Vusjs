import authHeader from "@/services/authHeader";
import {API_URL} from "@/constants/urls";


class TacheService{
  async getAllTache(){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}/tache`,{
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
}

export default new TacheService()
