package com.ws_appmovilpharmacy.controller;



import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.sql.SQLException;
import java.util.List;
import java.lang.reflect.Type;
import com.google.gson.reflect.TypeToken;
import javax.servlet.http.HttpServletResponse;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;
import com.google.gson.Gson;
import com.ws_appmovilpharmacy.methods.MethodsWs;
import com.ws_appmovilpharmacy.models.ObjArticle;
import com.ws_appmovilpharmacy.models.ObjAuxElement;
import com.ws_appmovilpharmacy.models.ObjCli;
import com.ws_appmovilpharmacy.models.ObjCliDirxVend;
import com.ws_appmovilpharmacy.models.ObjFormPag;
import com.ws_appmovilpharmacy.models.ObjLocation;
import com.ws_appmovilpharmacy.models.ObjModules;
import com.ws_appmovilpharmacy.models.ObjPreOrd;
import com.ws_appmovilpharmacy.models.ObjPreOrdReq;
import com.ws_appmovilpharmacy.models.ObjRequest;
import com.ws_appmovilpharmacy.models.ObjSchedule;
import com.ws_appmovilpharmacy.models.ObjTpVisit;
import com.ws_appmovilpharmacy.models.ObjUsrLg;
import com.ws_appmovilpharmacy.models.ObjVisit;


@RequestMapping("/ws_home")
@RestController
public class ws_services extends MethodsWs{
	Gson gson = new Gson();
	
	@RequestMapping(value = "/qc_usr_lgn",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_usr_lgn(@RequestBody String data){
		System.out.println("data from JsonString  qc_usr_lgn : "+data);
		Type tipo = new TypeToken<ObjRequest<ObjUsrLg>>() {}.getType();
		ObjRequest<ObjUsrLg> obj = gson.fromJson(data, tipo);
		ObjUsrLg objUsrLg = (ObjUsrLg) obj.getObj(); 
		objUsrLg = mt_qc_usr_lgn(objUsrLg);
		System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objUsrLg));
		return gson.toJson(objUsrLg);
	}	

	@RequestMapping(value = "/qc_get_all_cli",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_get_all_cli(@RequestBody String data){
		System.out.println("data from JsonString qc_get_all_cli : "+data);
		//Type userListType = new TypeToken<ArrayList<ObjLogin>>() {}.getType();
		Type tipo = new TypeToken<ObjRequest<ObjUsrLg>>() {}.getType();
		ObjRequest<ObjUsrLg> obj = gson.fromJson(data, tipo);
		ObjUsrLg objUsrLg = (ObjUsrLg) obj.getObj(); 
		List<ObjCli>  lista = mt_qc_get_all_cli(objUsrLg);
		return gson.toJson(lista);
	}
	
	@RequestMapping(value = "/qc_get_addrxvend",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_get_addrxvend(@RequestBody String data){
		System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		//Type userListType = new TypeToken<ArrayList<ObjLogin>>() {}.getType();
		Type tipo = new TypeToken<ObjRequest<ObjUsrLg>>() {}.getType();
		ObjRequest<ObjUsrLg> obj = gson.fromJson(data, tipo);
		ObjUsrLg objUsrLg = (ObjUsrLg) obj.getObj(); 
		List<ObjCliDirxVend>  lista = mt_qc_get_addrxvend(objUsrLg);
		return gson.toJson(lista);
	}	
	
	@RequestMapping(value = "/qc_usr_modules",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_usr_modules(@RequestBody String data){
		System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		//Type userListType = new TypeToken<ArrayList<ObjLogin>>() {}.getType();
		Type tipo = new TypeToken<ObjRequest<ObjUsrLg>>() {}.getType();
		ObjRequest<ObjUsrLg> obj = gson.fromJson(data, tipo);
		ObjUsrLg objUsrLg = (ObjUsrLg) obj.getObj(); 
		List<ObjModules>  lista = mt_qc_usr_modules(objUsrLg);
		return gson.toJson(lista);
	}	

	@RequestMapping(value = "/qc_articles",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_articles(@RequestBody String data){
		System.out.println("data from JsonString qc_articles : "+data);
		//Type userListType = new TypeToken<ArrayList<ObjLogin>>() {}.getType();
		Type tipo = new TypeToken<ObjRequest<ObjUsrLg>>() {}.getType();
		ObjRequest<ObjUsrLg> obj = gson.fromJson(data, tipo);
		ObjUsrLg objUsrLg = (ObjUsrLg) obj.getObj(); 
		List<ObjArticle>  lista = mt_qc_articles(objUsrLg);
		return gson.toJson(lista);
	}	
	
	@RequestMapping(value = "/qc_get_formpag",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_get_formpag(@RequestBody String data){
		System.out.println("data from JsonString qc_articles : "+data);
		//Type userListType = new TypeToken<ArrayList<ObjLogin>>() {}.getType();
		Type tipo = new TypeToken<ObjRequest<ObjUsrLg>>() {}.getType();
		ObjRequest<ObjUsrLg> obj = gson.fromJson(data, tipo);
		ObjUsrLg objUsrLg = (ObjUsrLg) obj.getObj(); 
		List<ObjFormPag>  lista = mt_qc_get_formpag(objUsrLg);
		return gson.toJson(lista);
	}	
	
	@RequestMapping(value = "/qc_get_tpvisita",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_get_tipoVisita(@RequestBody String data){
		System.out.println("data from JsonString qc_articles : "+data);
		//Type userListType = new TypeToken<ArrayList<ObjLogin>>() {}.getType();
		Type tipo = new TypeToken<ObjRequest<ObjUsrLg>>() {}.getType();
		ObjRequest<ObjUsrLg> obj = gson.fromJson(data, tipo);
		ObjUsrLg objUsrLg = (ObjUsrLg) obj.getObj(); 
		List<ObjTpVisit>  lista = mt_qc_get_tipoVisita(objUsrLg);
		return gson.toJson(lista);
	}	
	
	@RequestMapping(value = "/qc_up_ord",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_up_ord(@RequestBody String data){
		System.out.println("data from JsonString qc_articles : "+data);
		//Type userListType = new TypeToken<ArrayList<ObjLogin>>() {}.getType();
		Type tipo = new TypeToken<ObjRequest<ObjPreOrdReq>>() {}.getType();
		ObjRequest<ObjPreOrdReq> obj = gson.fromJson(data, tipo);
		ObjPreOrdReq objPreOrdReq = (ObjPreOrdReq) obj.getObj(); 
		ObjPreOrd objPreOrd= mt_ws_qc_up_ord(objPreOrdReq.getObjPreOrd(),objPreOrdReq.getObjPreOrdDet());
		System.out.println("retorna de la orden : "+gson.toJson(objPreOrd));
		return gson.toJson(objPreOrd);
	}
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_list_visit",method = RequestMethod.POST , produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_list_visit(@RequestBody String data){
		System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		Type tipo = new TypeToken<ObjRequest<ObjAuxElement>>() {}.getType();
		ObjRequest<ObjAuxElement> obj = gson.fromJson(data, tipo);
		ObjAuxElement objAuxElement= (ObjAuxElement) obj.getObj();  
		List<ObjVisit> objVisits = mt_qc_list_visit(objAuxElement);
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(objVisits);
	}
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_insertLocation",method = RequestMethod.POST , produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_insertLocation(@RequestBody List<ObjLocation> data){
		System.out.println("data from JsonString qc_get_all_dir_cli : "+gson.toJson(data));
		//Type tipo = new TypeToken<ObjLocation>() {}.getType();
		//ObjRequest<ObjAuxElement> obj = gson.fromJson(data, tipo);
		//ObjAuxElement objAuxElement= (ObjAuxElement) obj.getObj();  
		 mt_qc_insertLocation(data);
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(data.get(0));
	}	
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_up_schedule",method = RequestMethod.POST , consumes = MediaType.APPLICATION_JSON_VALUE ,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_up_schedule(@RequestBody String data){
		System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		Type tipo = new TypeToken<ObjRequest<List<ObjSchedule>>>() {}.getType();
		ObjRequest<ObjSchedule> obj = gson.fromJson(data, tipo);
		List<ObjSchedule> objSchedule= (List<ObjSchedule>) obj.getObj();  
		mt_qc_up_schedule(objSchedule);
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson("correcto");
	}
	
	@RequestMapping(value = "/obtenimagen",method = RequestMethod.GET,produces = MediaType.IMAGE_PNG_VALUE)
	public @ResponseBody byte[] obtenerImagen(){
		
		InputStream in = getClass().getResourceAsStream("\\src\\main\\resources\\images\\image.png");

		return in.toString().getBytes();
	}
	
	@RequestMapping(value= "/saludar",method = RequestMethod.GET,produces = MediaType.TEXT_PLAIN_VALUE)
	public String Saludar() {		
		return "hola mundo";
	}
	/*@RequestMapping(value = "/getImage", method = RequestMethod.GET,produces = MediaType.IMAGE_PNG_VALUE)
	public void getImage(HttpServletResponse response) throws IOException {
	    File file = new File("C:\\Users\\Administrador\\Documents\\workspace-spring-tool-suite-4-4.7.0.RELEASE\\ws_appmovilpharmacy\\src\\main\\resources\\images\\image.png");
	    if(file.exists()) {
	        String contentType = "application/octet-stream";
	        response.setContentType(contentType);
	        OutputStream out = response.getOutputStream();
	        FileInputStream in = new FileInputStream(file);
	        // copy from in to out
	        IOUtils.copy(in, out);
	        out.close();
	        in.close();
	    }else {
	        throw new FileNotFoundException();
	    }
	}*/
	@RequestMapping(value = "/getImage/{nombre_imagen}", method = RequestMethod.GET,produces = MediaType.IMAGE_PNG_VALUE)
	public void getImage(HttpServletResponse response,@PathVariable("nombre_imagen") String nombre_imagen) throws IOException {
	    File file = new File("C:\\Users\\Administrador\\Documents\\workspace-spring-tool-suite-4-4.7.0.RELEASE\\ws_appmovilpharmacy\\src\\main\\resources\\images\\"+nombre_imagen);
	    if(file.exists()) {
	        String contentType = "image/png";
	        response.setContentType(contentType);
	        OutputStream out = response.getOutputStream();
	        FileInputStream in = new FileInputStream(file);
	        BufferedInputStream bin = new BufferedInputStream(in);
	        BufferedOutputStream bout = new BufferedOutputStream(out);
	        // copy from in to out
	        int ch =0; ;
	        while((ch=bin.read())!=-1)
	            bout.write(ch);
	        
	        bin.close();
	        in.close();
	        bout.close();
	        out.close();
	    }else {
	        throw new FileNotFoundException();
	    }
	}
	
	@RequestMapping(value = "/uploadImg", method = RequestMethod.POST,consumes = MediaType.IMAGE_JPEG_VALUE,produces = MediaType.TEXT_PLAIN_VALUE)
	public void postImage(@RequestBody String data) throws IOException {
		System.out.println(data);
	}	
	
	@RequestMapping(value = "/obten_lista_productos",method = RequestMethod.GET,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody ResponseEntity<?> ws_obtenListaProductos() throws SQLException {
		List<?> lista = obtenListaProductos();		
		return ResponseEntity.ok(gson.toJson(lista));
	}
    /*Fin administracion
    private JsonObject ConverObjJson(String data) {
        JsonReader jsonReader = Json.createReader(new StringReader(data));
        JsonObject objsonf = jsonReader.readObject();
        return objsonf;
    }

    private String response(List array) {
        JSONArray lista = new JSONArray();
        lista.put(array);
        String resp = lista.toString().substring(1, lista.toString().length() - 1);

        return resp;
    }

    private String response(String data) throws JSONException {
        JSONObject obj = new JSONObject();
        obj.put("respuesta", data);
        return obj.toString();
    }

    private JSONObject response(int data) throws JSONException {
        JSONObject obj = new JSONObject();
        obj.put("respuesta", data);
        return obj;
    }

    private Response.ResponseBuilder responses(String myXMLString) {
        Response.ResponseBuilder builder = new ResponseBuilderImpl();
        builder.entity(myXMLString);
        return builder;
    }*/

}
