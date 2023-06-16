import authHeader from "@/services/authHeader";
import {API_URL} from "@/constants/urls";


class TacheService{
  async getAllTache(){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}/taches`,{
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

  async getAllTacheSearch(id){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}/taches?propid=${id}`,{
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

  async getTacheByListeId(id){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}/taches?listeTache=${id}&priotity=asc`,{
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

  async getSingleTache(id){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}/taches/${id}`,{
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

  async updateTache(tache){
    try {
      const res = await fetch(`${API_URL}/taches/${tache.id}`, {
        method: "PATCH",
        headers: {
          "Content-Type": "application/merge-patch+json",
          ...authHeader()
        },
        body: JSON.stringify(tache)
      });

      return true;

    }
    catch (e)
    {
      console.error(e.message);
      return false
    }
  }

  async deleteTache(id){
    try {
      const res = await fetch(`${API_URL}/taches/${id}`, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
          ...authHeader()
        },
      });

      if (res.status === 204){
        return true
      }
      if (res.status === 404)
      {return false
      }

    }catch (e) {
      console.error(e.message);
      return false
    }
  }

  async newTache(tache){
    try {
      const res= await fetch(`${API_URL}/taches`,{
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

  async getSingleTacheByUserTache(id){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}${id}`,{
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

  async getSingleTacheBySearch(titre){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}/taches?titre=${titre}`,{
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
