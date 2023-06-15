import authHeader from "@/services/authHeader";
import {API_URL} from "@/constants/urls";

class ListeTachesService{

  async getAllListeTache(){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}/liste_taches`,{
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

  async getSingleListeTache(id){
    try {
      const bearer = authHeader()
      const res= await fetch(`${API_URL}/liste_taches/${id}`,{
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

  async updateListeTache(listeTache){
    try {
      const res = await fetch(`${API_URL}/liste_taches/${listeTache.id}`, {
        method: "PATCH",
        headers: {
          "Content-Type": "application/merge-patch+json",
          ...authHeader()
        },
        body: JSON.stringify(listeTache)
      });

      return true;

    }
    catch (e)
    {
      console.error(e.message);
      return false
    }
  }

  async deleteListeTache(id){
    try {
      const res = await fetch(`${API_URL}/liste_taches/${id}`, {
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

  async newListeTache(ListeTache){
    try {
      const res= await fetch(`${API_URL}/liste_taches`,{
        method:"POST",
        headers:{
          "Content-Type": "application/json",
          ...authHeader()
        },
        body: JSON.stringify(ListeTache)
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

export default new ListeTachesService()
