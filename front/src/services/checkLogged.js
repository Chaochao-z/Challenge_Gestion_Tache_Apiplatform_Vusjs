import {userAuthStore} from '@/stores/auth';

export function CheckLogged(){
  const UserAuth = userAuthStore();
  return UserAuth.isLogged;
}
