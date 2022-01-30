package com.ws_appmovilpharmacy.controller;

import java.lang.reflect.Type;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.http.MediaType;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestHeader;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.ws_appmovilpharmacy.methods.MethodsWsWebPack;
import com.ws_appmovilpharmacy.models.ObjwEmployee;
import com.ws_appmovilpharmacy.models.ObjArticle;
import com.ws_appmovilpharmacy.models.ObjAuxElement;
import com.ws_appmovilpharmacy.models.ObjCli;
import com.ws_appmovilpharmacy.models.ObjCliDirxVend;
import com.ws_appmovilpharmacy.models.ObjLocation;
import com.ws_appmovilpharmacy.models.ObjRequest;
import com.ws_appmovilpharmacy.models.ObjUsrLg;
import com.ws_appmovilpharmacy.models.ObjVisit;
import com.ws_appmovilpharmacy.models.ObjwVisitxVend;
import com.ws_appmovilpharmacy.models.ObjwPrePedOrd;
import com.ws_appmovilpharmacy.models.ObjwPrePedOrdDet;

@RequestMapping("/ws_webappmovil")
@RestController
public class ws_webappmovil extends MethodsWsWebPack{
	Gson gson = new Gson();
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_usr_lgn",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_usr_lgn(@RequestBody String data){
		System.out.println("data from JsonString  qc_usr_lgn : "+data);
		Type tipo = new TypeToken<ObjUsrLg>() {}.getType();
		ObjUsrLg objUsrLg = gson.fromJson(data, tipo); 
		objUsrLg = mt_qc_usr_lgn(objUsrLg);
		System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objUsrLg));
		return gson.toJson(objUsrLg);
	}
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_all_ords",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_all_ords(@RequestBody String data){
		System.out.println("data from JsonString  qc_usr_lgn : "+data);
		Type tipo = new TypeToken<ObjUsrLg>() {}.getType();
		ObjUsrLg objUsrLg = gson.fromJson(data, tipo); 
		List<ObjwPrePedOrd> objwPrePedOrdList = mt_qc_all_ords(objUsrLg);
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(objwPrePedOrdList);
	}
	
	@CrossOrigin 
	@RequestMapping(value = "/qc_all_ordsxvendrf",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_all_ordsxvendrf(@RequestBody String data){
		System.out.println("data from JsonString  qc_usr_lgn : "+data);
		Type tipo = new TypeToken<ObjAuxElement>() {}.getType();
		ObjAuxElement objAuxElement = gson.fromJson(data, tipo); 
		List<ObjwPrePedOrd> objwPrePedOrdList = mt_qc_all_ordsxvendrf(objAuxElement);
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(objwPrePedOrdList);
	}
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_all_vend",method = RequestMethod.GET , produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_all_vend(){
		//Type tipo = new TypeToken<ObjUsrLg>() {}.getType();
		//ObjUsrLg objUsrLg = gson.fromJson(data, tipo); 
		List<ObjwEmployee> objwPrePedOrdList = mt_qc_all_vend();
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(objwPrePedOrdList);
	}
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_get_addrxvend",method = RequestMethod.POST,consumes = MediaType.APPLICATION_JSON_VALUE,produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_get_addrxvend(@RequestBody String data){
		System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		//Type userListType = new TypeToken<ArrayList<ObjLogin>>() {}.getType();
		Type tipo = new TypeToken<ObjAuxElement>() {}.getType();
		ObjAuxElement obj = gson.fromJson(data, tipo);
		//ObjwEmployee objwEmployee = (ObjwEmployee) obj.getObj(); 
		List<ObjCliDirxVend>  lista = mt_qc_get_addrxvend(obj);
		return gson.toJson(lista);
	}
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_list_visit_vend",method = RequestMethod.POST , produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_list_visit_vend(@RequestBody String data){
		System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		Type tipo = new TypeToken<ObjAuxElement>() {}.getType();
		ObjAuxElement objAuxElement  = gson.fromJson(data, tipo); 
		List<ObjwVisitxVend> objVisitxVendList = mt_qc_list_visit_vend(objAuxElement);
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(objVisitxVendList);
	}	
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_ordDet",method = RequestMethod.POST , produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_ordDet(@RequestBody String data){
		System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		Type tipo = new TypeToken<ObjAuxElement>() {}.getType();
		ObjAuxElement objAuxElement  = gson.fromJson(data, tipo); 
		List<ObjwPrePedOrdDet> objwPrePedOrdDets = mt_qc_ordDet(objAuxElement);
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(objwPrePedOrdDets);
	}	
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_callLocationsxvend",method = RequestMethod.POST , produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_callLocationsxvend(@RequestBody String data){
		System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		Type tipo = new TypeToken<ObjAuxElement>() {}.getType();
		ObjAuxElement objAuxElement  = gson.fromJson(data, tipo); 
		List<ObjLocation> objLocations = mt_qc_callLocationsxvend(objAuxElement);
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(objLocations);
	}
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_list_all_cli",method = RequestMethod.GET , produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String ws_qc_list_all_cli(){
		//System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		//Type tipo = new TypeToken<ObjAuxElement>() {}.getType();
		//ObjAuxElement objAuxElement  = gson.fromJson(data, tipo); 
		List<ObjCli> objClis = mt_qc_list_all_cli();
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(objClis);
	}
	
	@CrossOrigin //("http://192.168.100.2:8080")
	@RequestMapping(value = "/qc_call_articlexvend",method = RequestMethod.POST , produces = MediaType.APPLICATION_JSON_VALUE)
	public @ResponseBody String wc_qc_call_articlexvend(@RequestBody String data){
		//System.out.println("data from JsonString qc_get_all_dir_cli : "+data);
		Type tipo = new TypeToken<ObjAuxElement>() {}.getType();
		ObjAuxElement objAuxElement  = gson.fromJson(data, tipo); 
		List<ObjArticle> objLocations = mt_qc_call_articlexvend(objAuxElement);
		//System.out.println("data to JsonString  qc_usr_lgn : "+ gson.toJson(objwPrePedOrdList));
		return gson.toJson(objLocations);
	}	
}
