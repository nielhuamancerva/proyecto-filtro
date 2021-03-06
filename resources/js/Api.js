import axios from "axios";

let BaseApi = axios.create({
  baseURL: "/api"
});

let Api = function() {
  let token = localStorage.getItem("auth-token");

  if (token) {
    BaseApi.defaults.headers.common["Authorization"] = `Bearer ${token}`;
  }

  return BaseApi;
};

export default Api;