import authHeader from "@/services/authHeader";
import {API_URL} from "@/constants/urls";
class UserTacheService{

  async getUserTacheSingle(url){
    try {
      const res= await fetch(`${API_URL}${url}`,{
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

  async getAllUserTacheAuteurByIdTache(id,auteur){
    try {
      const res= await fetch(`${API_URL}/user_taches?tache=${id}&role=${auteur}`,{
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

  async updateUserTache(userTache){
    try {
      const res = await fetch(`${API_URL}/user_taches/${userTache.id}`, {
        method: "PATCH",
        headers: {
          "Content-Type": "application/merge-patch+json",
          ...authHeader()
        },
        body: JSON.stringify(userTache)
      });

      return true;

    }
    catch (e)
    {
      console.error(e.message);
      return false
    }
  }

  async getAllUserTacheObservateurByIdTache(id,observateur){
    try {
      const res= await fetch(`${API_URL}/user_taches?tache=${id}&role=${observateur}`,{
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

  async newUserTache(tache){
    try {
      const res= await fetch(`${API_URL}/user_taches/new`,{
        method:"POST",
        headers:{
          "Content-Type": "application/json",
          ...authHeader()
        },
        body: JSON.stringify(tache)
      })

      if(res === 201)
      {
        return true
      }
      else {
        return false
      }

    }
    catch (e){
      console.error(e.message)
      return false
    }

  }

  async GetAllByUserId(id){
    try {
      const res= await fetch(`${API_URL}/user_taches?user_id=/users/${id}`,{
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

  async DashboardUserTache(information){
    try {
      const res= await fetch(`${API_URL}/user_taches/dashboard/new`,{
        method:"POST",
        headers:{
          "Content-Type": "application/json",
          ...authHeader()
        },
        body: JSON.stringify(information)
      })

      if(res === 201)
      {
        return true
      }
      else {
        return false
      }

    }
    catch (e){
      console.error(e.message)
      return false
    }
  }


}

export default new UserTacheService()
