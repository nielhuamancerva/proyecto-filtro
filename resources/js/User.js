import Api from "./Api";

export default {

login(form) {
        return Api().post("/login", form);
  },

login(form) {
    return Api().post("/login", form);
},

filtroDocuments(page,siaf,expediente){
    /*axios.get('/api/normas?page='+page+'&ano='+this.ano+'&tipo_documento='+this.tipo_documento+'&searchtxt='+this.searchtxt)*/
  return Api().get('/filtroDocuments?siaf='+siaf+'&expediente='+expediente);
},
postFiltroDocuments(newdocumentos){
  return Api().post('/filtroDocuments', newdocumentos);
},
GetByIdFiltroDocuments(iduser){
  return Api().get('/filtroDocuments/'+iduser);
},
UpdateFiltroDocuments(iduser){
  return Api().patch('/filtroDocuments/'+iduser.id,iduser);
},
postDocumentsDetalle(documentosdetalle){
  return Api().post('/documentsDetalle', documentosdetalle);
},
GetByIdDetalleDocuments(iduser){
  return Api().get('/documentsDetalle/'+iduser);
},
InactiveDetalleDocuments(iduser){
  return Api().delete('/documentsDetalle/'+iduser);
},

filtroDocumentsGaf(page,siaf,expediente){
  /*axios.get('/api/normas?page='+page+'&ano='+this.ano+'&tipo_documento='+this.tipo_documento+'&searchtxt='+this.searchtxt)*/
return Api().get('/filtrodocumentsgaf?siaf='+siaf+'&expediente='+expediente);
},
postFiltroDocumentsGaf(newdocumentos){
  return Api().post('/filtrodocumentsgaf', newdocumentos);
},
GetByIdFiltroDocumentsGaf(iduser){
  return Api().get('/filtrodocumentsgaf/'+iduser);
},
UpdateFiltroDocumentsGaf(iduser){
  return Api().patch('/filtrodocumentsgaf/'+iduser.id,iduser);
},

postDocumentsDetalleGaf(documentosdetalle){
  return Api().post('/documentsDetalleGaf', documentosdetalle);
},

GetByIdDetalleDocumentsGaf(iduser){
  return Api().get('/documentsDetalleGaf/'+iduser);
},



register(form) {
        //return Api().post("/register", form);
        return Api().post("/users", form); 
  },

logout() {
    localStorage.removeItem("auth-token");
    return Api().post("/logout");
  },

auth() {
    return Api().get("/user");
  },

GetUserAll(page){
    return Api().get('/users?page='+page);
  },
GetByIdUser(iduser){
  return Api().get('/users/'+iduser);
},
UpdateUser(iduser){
  return Api().patch('/users/'+iduser.id,iduser);
},

GetNoticias(page){
    return Api().get('/noticias?page='+page);
  },

PostNoticias(noticia){
    return Api().post('/noticias', noticia);
  },

getGat(){
    return Api().get('/gat');
  },

Normatividad(){
    return Api().get('/normatividad?page=');
  },

getNormatividad(page){
    return Api().get('/normatividad?page='+page);
  },

PostNormatividad(data){
    return Api().post('/normatividad',data);
  },

PostCas(datacas){
    return Api().post('/gestorcas',datacas);
  },

botones(id){
    return Api().post("/botones", id);
  }





};