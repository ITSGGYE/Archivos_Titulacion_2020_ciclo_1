package com.ws_appmovilpharmacy.methods;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Types;
import java.util.ArrayList;
import java.util.List;

import org.apache.tomcat.util.json.JSONParser;
import org.springframework.stereotype.Service;

import com.google.gson.Gson;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.google.gson.internal.bind.JsonTreeReader;
import com.ws_appmovilpharmacy.database.DataBase;
import com.ws_appmovilpharmacy.models.ObjArticle;
import com.ws_appmovilpharmacy.models.ObjAuxElement;
import com.ws_appmovilpharmacy.models.ObjCli;
import com.ws_appmovilpharmacy.models.ObjCliDirxVend;
import com.ws_appmovilpharmacy.models.ObjFormPag;
import com.ws_appmovilpharmacy.models.ObjLocation;
import com.ws_appmovilpharmacy.models.ObjModules;
import com.ws_appmovilpharmacy.models.ObjPreOrd;
import com.ws_appmovilpharmacy.models.ObjPreOrdDet;
import com.ws_appmovilpharmacy.models.ObjProductos;
import com.ws_appmovilpharmacy.models.ObjSchedule;
import com.ws_appmovilpharmacy.models.ObjTpVisit;
import com.ws_appmovilpharmacy.models.ObjUsrLg;
import com.ws_appmovilpharmacy.models.ObjVisit;

@Service
public class MethodsWs {

	private Connection connection;
	Gson gson = new Gson();

	public List<Object> obtenListaProductos() throws SQLException {
		List<Object> lista = new ArrayList<>();
		Connection cn = null;
		ResultSet rs = null;
		String sql = "";
		ObjProductos objProductos = null;
		try {
			sql = "sp_app_consulta_lista_productos";
			cn = DataBase.getConnectionAppPharmacys();
			Statement st = cn.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objProductos = new ObjProductos();
				objProductos.setCodigo_producto(rs.getString(1));
				objProductos.setNombre_producto(rs.getString(2));
				objProductos.setOtros(rs.getString(3));
				lista.add(objProductos);
			}
		} catch (Exception ex) {
		} finally {
			try {
				rs.close();
			} catch (Exception e) {
			}
			try {
				cn.close();
			} catch (Exception e) {
			}
		}

		return lista;
	}

	public ObjUsrLg mt_qc_usr_lgn(ObjUsrLg objUsrLg) {
		CallableStatement cs = null;

		try {
			System.out.println("exec sp_lg_inisesion " + objUsrLg.getUsrNom() + "," + objUsrLg.getUsrClv());
			connection = DataBase.getConnectionAppPharmacys();
			cs = connection.prepareCall("{ call sp_lg_inisesion(?,?,?,?,?,?,?,?,?,?,?,?) }");
			cs.registerOutParameter(1, Types.VARCHAR);
			cs.registerOutParameter(2, Types.VARCHAR);
			cs.setString(1, objUsrLg.getUsrNom());
			cs.setString(2, objUsrLg.getUsrClv());
			cs.registerOutParameter(3, Types.VARCHAR);
			cs.registerOutParameter(4, Types.VARCHAR);
			cs.registerOutParameter(5, Types.VARCHAR);
			cs.registerOutParameter(6, Types.VARCHAR);
			cs.registerOutParameter(7, Types.VARCHAR);
			cs.registerOutParameter(8, Types.VARCHAR);
			cs.registerOutParameter(9, Types.VARCHAR);
			cs.registerOutParameter(10, Types.INTEGER);
			cs.registerOutParameter(11, Types.VARCHAR);
			cs.registerOutParameter(12, Types.VARCHAR);
			cs.execute();

			objUsrLg.setTitCod(cs.getString(3));
			objUsrLg.setTitNom(cs.getString(4));
			objUsrLg.setPrfCod(cs.getString(5));
			objUsrLg.setPrfNom(cs.getString(6));
			objUsrLg.setEmpCod(cs.getString(7));
			objUsrLg.setSucCod(cs.getString(8));
			objUsrLg.setVendCod(cs.getString(9));
			objUsrLg.setCtrl(cs.getInt(10));
			objUsrLg.setCtrlData(cs.getString(11));
			objUsrLg.setCtrlData1(cs.getString(12));

		} catch (Exception ex) {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				cs.close();
			} catch (Exception ex1) {

			}
			objUsrLg.setCtrl(0);
			objUsrLg.setCtrlData("error en metodo de sp");
			;
			objUsrLg.setCtrlData1("error: " + ex.getMessage());
		} finally {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				cs.close();
			} catch (Exception ex1) {

			}
		}

		return objUsrLg;
	}

	public List<ObjCli> mt_qc_get_all_cli(ObjUsrLg obj) {
		List<ObjCli> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjCli objCli = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_listaClixVend  '" + obj.getUsrNom() + "','" + obj.getTitCod() + "'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objCli = new ObjCli();
				objCli.setTitCod(rs.getString(1).trim());
				objCli.setTitNom(rs.getString(2).trim());
				objCli.setRazonSocial(rs.getString(3).trim());
				objCli.setTitDir(rs.getString(4));
				objCli.setCodPais(rs.getString(5));
				objCli.setCodProv(rs.getString(6));
				objCli.setCodCiud(rs.getString(7));
				objCli.setCodZona(rs.getString(8));
				objCli.setTitEmail(rs.getString(9));
				objCli.setTitTelf(rs.getString(10));
				objCli.setCodTipoTit(rs.getString(11));
				objCli.setCodMerc(rs.getString(12));
				objCli.setCodVend(rs.getString(13));
				objCli.setCodCob(rs.getString(14));
				lista.add(objCli);
			}
		} catch (Exception ex) {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_get_all_cli: " + ex.getMessage());
		} finally {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
		}
		return lista;
	}

	public List<ObjCliDirxVend> mt_qc_get_addrxvend(ObjUsrLg obj) {
		List<ObjCliDirxVend> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjCliDirxVend objDirxCli = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_listaDirxVend  '" + obj.getUsrNom() + "','" + obj.getTitCod() + "'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objDirxCli = new ObjCliDirxVend();
				objDirxCli.setTitCod(rs.getString(1).trim());
				objDirxCli.setCodZona(rs.getString(2).trim());				
				objDirxCli.setCodSuc(rs.getString(3).trim());				
				objDirxCli.setNomSuc(rs.getString(4));
				objDirxCli.setTitDir(rs.getString(5));
				objDirxCli.setCodPais(rs.getString(6));
				objDirxCli.setCodProv(rs.getString(7));
				objDirxCli.setCodCiud(rs.getString(8));
				objDirxCli.setTitTelf(rs.getString(9));
				objDirxCli.setCodVend(rs.getString(10));
				objDirxCli.setLattd(rs.getDouble(11));
				objDirxCli.setLogtd(rs.getDouble(12));
				objDirxCli.setTitPais(rs.getString(13));
				objDirxCli.setTitProv(rs.getString(14));
				objDirxCli.setTitCiud(rs.getString(15));
				objDirxCli.setTitNom(rs.getString(16));
				lista.add(objDirxCli);
			}
		} catch (Exception ex) {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_get_all_dir_cli: " + ex.getMessage());
		} finally {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
		}
		return lista;
	}

	public List<ObjModules> mt_qc_usr_modules(ObjUsrLg obj) {
		List<ObjModules> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjModules objModules = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_modprincipal  '" + obj.getUsrNom() + "','" + obj.getPrfCod() + "'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objModules = new ObjModules();
				objModules.setModCod(rs.getString(1).trim());
				objModules.setModNom(rs.getString(2).trim());
				objModules.setModPath(rs.getString(3));
				objModules.setModImg(rs.getString(4));
				objModules.setModSup(rs.getString(5));
				lista.add(objModules);
			}
		} catch (Exception ex) {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_usr_modules: " + ex.getMessage());
		} finally {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
		}
		return lista;
	}

	public List<ObjArticle> mt_qc_articles(ObjUsrLg obj) {
		List<ObjArticle> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjArticle objArticle = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_listaArt '" + obj.getUsrNom() + "','" + obj.getTitCod() + "','" + obj.getEmpCod() + "','"
					+ obj.getSucCod() + "'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objArticle = new ObjArticle();
				objArticle.setArtCodListPrec(rs.getString(1));
				objArticle.setArtCod(rs.getString(2));
				objArticle.setArtNom(rs.getString(3));
				objArticle.setArtPrecio(rs.getDouble(4));
				objArticle.setArtDep(rs.getString(5));
				objArticle.setArtCant(rs.getDouble(6));
				objArticle.setArtPorcImp(rs.getDouble(7));
				lista.add(objArticle);
			}
		} catch (Exception ex) {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_articles: " + ex.getMessage());
		} finally {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
		}
		return lista;
	}

	public List<ObjFormPag> mt_qc_get_formpag(ObjUsrLg obj) {
		List<ObjFormPag> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjFormPag objFormPag = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_listaFormsPagCli";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objFormPag = new ObjFormPag();
				objFormPag.setFormPagCod(rs.getString(1));
				objFormPag.setFormPagLabl(rs.getString(2));
				objFormPag.setCondVentCod(rs.getString(3));
				lista.add(objFormPag);
			}
		} catch (Exception ex) {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_get_formpag: " + ex.getMessage());
		} finally {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
		}
		return lista;
	}
	
	public List<ObjTpVisit> mt_qc_get_tipoVisita(ObjUsrLg obj) {
		List<ObjTpVisit> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjTpVisit objTpVisit = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_listaVisitaTipos";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objTpVisit = new ObjTpVisit();
				objTpVisit.setVstTpCod(rs.getString(1));
				objTpVisit.setVstTpNom(rs.getString(2));
				lista.add(objTpVisit);
			}
		} catch (Exception ex) {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_get_tipoVisita: " + ex.getMessage());
		} finally {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
		}
		return lista;
	}	

	public ObjPreOrd mt_ws_qc_up_ord(ObjPreOrd objPreOrd, List<ObjPreOrdDet> objPreOrdDetList) {
		CallableStatement cs = null;
		try {
			// System.out.println("exec sp_lg_inisesion " + objUsrLg.getUsrNom() + "," +
			// objUsrLg.getUsrClv());
			connection = DataBase.getConnectionAppPharmacys();
			cs = connection.prepareCall("{ call sp_insertOrders(?,?,?,?,?) }");
			cs.setNString(1, gson.toJson(objPreOrd));
			cs.setNString(2, gson.toJson(objPreOrdDetList));
			cs.registerOutParameter(3, Types.INTEGER);
			cs.registerOutParameter(4, Types.VARCHAR);
			cs.registerOutParameter(5, Types.NVARCHAR);
			cs.execute();
			objPreOrd.setCtrl(cs.getInt(3));
			objPreOrd.setCtrlData(cs.getString(4));
			objPreOrd.setCtrlData(cs.getString(5));
			JsonObject jsonObjectAlt = JsonParser.parseString(cs.getString(5)).getAsJsonObject();
			objPreOrd.setNroDocum(jsonObjectAlt.get("nro_docum").getAsInt());
			
		} catch (Exception ex) {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				cs.close();
			} catch (Exception ex1) {

			}
			
			System.out.println("error en mt_ws_qc_up_ord "+ex.getMessage());
		} finally {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				cs.close();
			} catch (Exception ex1) {

			}
		}
		return objPreOrd;
	}
	
	public List<ObjVisit> mt_qc_list_visit(ObjAuxElement obj) {
		List<ObjVisit> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjVisit objVisit = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_listaVisitas  '" + obj.getParametro1()+"','"+obj.getParametro2()+"','"+obj.getParametro3()+"','"+obj.getParametro10()+"'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objVisit = new ObjVisit();
				objVisit.setVstVendCod(rs.getString(1));
				objVisit.setVstFecReg(rs.getString(2));
				objVisit.setVstCliCod(rs.getString(3));
				objVisit.setVstTipe(rs.getString(4));
				objVisit.setVstObs(rs.getString(5));
				objVisit.setVstCliDirCod(rs.getInt(6));
				objVisit.setVstCliDirNom(rs.getString(7));
				objVisit.setVstCliDirDet(rs.getString(8));
				objVisit.setVstLattd(rs.getDouble(9));
				objVisit.setVstLogtd(rs.getDouble(10));
				objVisit.setVstDistanceFromDir(rs.getDouble(11));
				objVisit.setVstOnSite(rs.getInt(12));
				lista.add(objVisit);
			}
		} catch (Exception ex) {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_list_visit: " + ex.getMessage());
		} finally {
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
		}
		return lista;
	}

	public void mt_qc_insertLocation(List<ObjLocation> data) {
		List<ObjVisit> lista = new ArrayList<>();
		CallableStatement cs = null;
		connection = null;
		Statement st = null;
		ObjVisit objVisit = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			cs = connection.prepareCall("{ call sp_insertVendLocations(?) }");
			cs.setNString(1, gson.toJson(data));
			cs.execute();
		} catch (Exception ex) {
			try {
				cs.close();
			} catch (Exception ex1) {

			}			
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_insertLocation: " + ex.getMessage());
		} finally {
			try {
				cs.close();
			} catch (Exception ex1) {

			}
			try {
				connection.close();
			} catch (Exception ex1) {

			}
		}
	}
	
	public void mt_qc_up_schedule(List<ObjSchedule> data) {
		//List<ObjVisit> lista = new ArrayList<>();
		CallableStatement cs = null;
		connection = null;
		Statement st = null;
		//ObjVisit objVisit = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			cs = connection.prepareCall("{ call sp_insertAgenda(?) }");
			cs.setNString(1, gson.toJson(data));
			cs.execute();
		} catch (Exception ex) {
			try {
				cs.close();
			} catch (Exception ex1) {

			}			
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_up_schedule: " + ex.getMessage());
		} finally {
			try {
				cs.close();
			} catch (Exception ex1) {

			}
			try {
				connection.close();
			} catch (Exception ex1) {

			}
		}
	}
	
}
