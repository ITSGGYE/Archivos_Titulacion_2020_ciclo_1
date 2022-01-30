package com.ws_appmovilpharmacy.methods;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;
import java.sql.Types;
import java.util.ArrayList;
import java.util.List;

import org.springframework.stereotype.Service;

import com.google.gson.Gson;
import com.ws_appmovilpharmacy.database.DataBase;
import com.ws_appmovilpharmacy.models.ObjArticle;
import com.ws_appmovilpharmacy.models.ObjAuxElement;
import com.ws_appmovilpharmacy.models.ObjCli;
import com.ws_appmovilpharmacy.models.ObjCliDirxVend;
import com.ws_appmovilpharmacy.models.ObjLocation;
import com.ws_appmovilpharmacy.models.ObjwEmployee;
import com.ws_appmovilpharmacy.models.ObjUsrLg;
import com.ws_appmovilpharmacy.models.ObjwVisitxVend;
import com.ws_appmovilpharmacy.models.ObjwPrePedOrd;
import com.ws_appmovilpharmacy.models.ObjwPrePedOrdDet;

@Service
public class MethodsWsWebPack {
	private Connection connection;
	Gson gson = new Gson();
	
	public ObjUsrLg mt_qc_usr_lgn(ObjUsrLg objUsrLg) {
		CallableStatement cs = null;

		try {
			System.out.println("exec sp_lg_inisesion " + objUsrLg.getUsrNom() + "," + objUsrLg.getUsrClv());
			connection = DataBase.getConnectionAppPharmacys();
			cs = connection.prepareCall("{ call sp_wlg_inisesion(?,?,?,?,?,?,?,?,?,?,?,?) }");
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
	
	public List<ObjwPrePedOrd> mt_qc_all_ords(ObjUsrLg objUsrLg) {
		List<ObjwPrePedOrd> objwPrePedOrdList = new ArrayList<ObjwPrePedOrd>();
		ObjwPrePedOrd objwPrePedOrd = null;
		String sql = "";
		ResultSet rs = null;
		Statement st = null;
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_wlistOrd  '" + objUsrLg.getVendCod()+"'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objwPrePedOrd = new ObjwPrePedOrd();
				objwPrePedOrd.setNro_docum(rs.getInt(1));
				objwPrePedOrd.setCod_tit(rs.getString(2));
				objwPrePedOrd.setNom_tit(rs.getString(3));
				objwPrePedOrd.setFec_doc(rs.getString(4));
				objwPrePedOrd.setDir_tit(rs.getString(5));
				objwPrePedOrd.setFec_entrega(rs.getString(6));
				objwPrePedOrd.setDir_entrega(rs.getString(7));
				objwPrePedOrd.setImp_tot_gen(rs.getDouble(8));
				objwPrePedOrd.setObservaciones(rs.getString(9));
				objwPrePedOrdList.add(objwPrePedOrd);
			}
		} catch (Exception ex) {
			objwPrePedOrdList = new ArrayList<ObjwPrePedOrd>();
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_all_ords: " + ex.getMessage());
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
		return objwPrePedOrdList;
	}
	
	public List<ObjwPrePedOrd> mt_qc_all_ordsxvendrf(ObjAuxElement obj) {
		List<ObjwPrePedOrd> objwPrePedOrdList = new ArrayList<ObjwPrePedOrd>();
		ObjwPrePedOrd objwPrePedOrd = null;
		String sql = "";
		ResultSet rs = null;
		Statement st = null;
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_wlistOrdByVendFr  '" + obj.getParametro1()+"','"+obj.getParametro2()+"','"+obj.getParametro3()+"'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objwPrePedOrd = new ObjwPrePedOrd();
				objwPrePedOrd.setNro_docum(rs.getInt(1));
				objwPrePedOrd.setCod_tit(rs.getString(2));
				objwPrePedOrd.setNom_tit(rs.getString(3));
				objwPrePedOrd.setFec_doc(rs.getString(4));
				objwPrePedOrd.setDir_tit(rs.getString(5));
				objwPrePedOrd.setFec_entrega(rs.getString(6));
				objwPrePedOrd.setDir_entrega(rs.getString(7));
				objwPrePedOrd.setImp_tot_gen(rs.getDouble(8));
				objwPrePedOrd.setObservaciones(rs.getString(9));
				objwPrePedOrdList.add(objwPrePedOrd);
			}
		} catch (Exception ex) {
			objwPrePedOrdList = new ArrayList<ObjwPrePedOrd>();
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_all_ordsxvendrf: " + ex.getMessage());
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
		return objwPrePedOrdList;
	}
	
	
	public List<ObjwEmployee> mt_qc_all_vend() {
		List<ObjwEmployee> objEmployeesList = new ArrayList<ObjwEmployee>();
		ObjwEmployee objwEmployee = null;
		String sql = "";
		ResultSet rs = null;
		Statement st = null;
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_wlistallvend ";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objwEmployee = new ObjwEmployee();
				objwEmployee.setEmplCod(rs.getString(1));
				objwEmployee.setEmplNom(rs.getString(2));
				objwEmployee.setEmplTitl(rs.getString(3));
				objwEmployee.setTitCod(rs.getString(4));
				objwEmployee.setTitNom(rs.getString(5));
				objEmployeesList.add(objwEmployee);
			}
		} catch (Exception ex) {
			objEmployeesList = new ArrayList<ObjwEmployee>();
			try {
				connection.close();
			} catch (Exception ex1) {

			}
			try {
				rs.close();
			} catch (Exception ex1) {

			}
			System.out.println("error mt_qc_all_vend: " + ex.getMessage());
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
		return objEmployeesList;
	}
	
	public List<ObjCliDirxVend> mt_qc_get_addrxvend(ObjAuxElement obj) {
		List<ObjCliDirxVend> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjCliDirxVend objCliDirxVend = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_wlistaDirxVend  '" + obj.getParametro1()+"'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objCliDirxVend = new ObjCliDirxVend();
				objCliDirxVend.setTitCod(rs.getString(1).trim());
				objCliDirxVend.setCodZona(rs.getString(2).trim());				
				objCliDirxVend.setCodSuc(rs.getString(3).trim());				
				objCliDirxVend.setNomSuc(rs.getString(4));
				objCliDirxVend.setTitDir(rs.getString(5));
				objCliDirxVend.setCodPais(rs.getString(6));
				objCliDirxVend.setCodProv(rs.getString(7));
				objCliDirxVend.setCodCiud(rs.getString(8));
				objCliDirxVend.setTitTelf(rs.getString(9));
				objCliDirxVend.setCodVend(rs.getString(10));
				objCliDirxVend.setLattd(rs.getDouble(11));
				objCliDirxVend.setLogtd(rs.getDouble(12));
				objCliDirxVend.setTitPais(rs.getString(13));
				objCliDirxVend.setTitProv(rs.getString(14));
				objCliDirxVend.setTitCiud(rs.getString(15));
				objCliDirxVend.setTitNom(rs.getString(16));
				lista.add(objCliDirxVend);
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
	
	public List<ObjwVisitxVend> mt_qc_list_visit_vend(ObjAuxElement obj) {
		List<ObjwVisitxVend> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjwVisitxVend objVisitxVend = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_wlistaVisitxVend  '" + obj.getParametro1()+"','"+obj.getParametro2()+"','"+obj.getParametro3()+"'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objVisitxVend = new ObjwVisitxVend();
				objVisitxVend.setVend_cod(rs.getString(1));;
				objVisitxVend.setFec_ini(rs.getString(2));;				
				objVisitxVend.setObs1(rs.getString(3));				
				objVisitxVend.setTit_cod(rs.getString(4));
				objVisitxVend.setTit_nom(rs.getString(5));
				objVisitxVend.setOrder_num(rs.getInt(6));
				objVisitxVend.setLattd(rs.getDouble(7));
				objVisitxVend.setLogtd(rs.getDouble(8));;
				objVisitxVend.setOrd_cord_type(rs.getString(9));
				objVisitxVend.setObs1(rs.getString(10));
				objVisitxVend.setObs2(rs.getString(11));
				objVisitxVend.setTipo1(rs.getString(12));
				objVisitxVend.setOnSite(rs.getInt(13));
				objVisitxVend.setTipo2(rs.getString(14));
				objVisitxVend.setOnComplete(rs.getInt(15));
				objVisitxVend.setFecSchedule(rs.getString(16));
				lista.add(objVisitxVend);
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
			System.out.println("error mt_qc_list_visit_vend: " + ex.getMessage());
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
	
	public List<ObjCli> mt_qc_list_all_cli() {
		List<ObjCli> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjCli objCli = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_wlistaCli ";
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
			System.out.println("error mt_qc_list_all_cli: " + ex.getMessage());
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

	public List<ObjwPrePedOrdDet> mt_qc_ordDet(ObjAuxElement obj) {
		List<ObjwPrePedOrdDet> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjwPrePedOrdDet objwPrePedOrdDet = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_wCallOrdDet  '" + obj.getParametro1()+"','"+obj.getParametro2()+"'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objwPrePedOrdDet = new ObjwPrePedOrdDet();
				objwPrePedOrdDet.setNroTrans(rs.getInt(1));;
				objwPrePedOrdDet.setFecEntrega(rs.getString(2));			
				objwPrePedOrdDet.setCodArticulo(rs.getString(3));
				objwPrePedOrdDet.setCantVta(rs.getDouble(4));
				objwPrePedOrdDet.setCantTot(rs.getDouble(5));
				objwPrePedOrdDet.setPrecio(rs.getDouble(6));
				objwPrePedOrdDet.setCodTipoImpu1(rs.getString(7));
				objwPrePedOrdDet.setCodTasaImp1(rs.getString(8));
				objwPrePedOrdDet.setPorcImpu1(rs.getDouble(9));
				objwPrePedOrdDet.setImpImpu1(rs.getDouble(10));
				objwPrePedOrdDet.setImpMovMo(rs.getDouble(11));
				objwPrePedOrdDet.setLinea(rs.getInt(12));
				objwPrePedOrdDet.setPrecioLp(rs.getDouble(13));
				objwPrePedOrdDet.setNomFpago(rs.getString(14));
				objwPrePedOrdDet.setCantidad(rs.getDouble(15));
				objwPrePedOrdDet.setEspecificFactura(rs.getString(16));
				objwPrePedOrdDet.setPrecioMinimo(rs.getDouble(17));
				objwPrePedOrdDet.setCodGrupoIp(rs.getString(18));
				objwPrePedOrdDet.setPrecioApp(rs.getDouble(19));
				lista.add(objwPrePedOrdDet);
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
			System.out.println("error mt_qc_ordDet: " + ex.getMessage());
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

	public List<ObjLocation> mt_qc_callLocationsxvend(ObjAuxElement obj) {
		List<ObjLocation> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjLocation objLocation = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_wCallLocationsByVend  '" + obj.getParametro1()+"','"+obj.getParametro2()+"'";
			System.out.println("exec " + sql);
			st = connection.createStatement();
			st.execute(sql);
			rs = st.getResultSet();
			while (rs.next()) {
				objLocation = new ObjLocation();
				objLocation.setImeiID(rs.getString(1));
				objLocation.setFecReg(rs.getString(2));			
				objLocation.setLattd(rs.getDouble(3));
				objLocation.setLogtd(rs.getDouble(4));
				objLocation.setDateID(rs.getString(5));
				lista.add(objLocation);
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
			System.out.println("error mt_qc_callLocationsxvend: " + ex.getMessage());
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
	
	
	public List<ObjArticle> mt_qc_call_articlexvend( ObjAuxElement obj) {
		List<ObjArticle> lista = new ArrayList<>();
		connection = null;
		ResultSet rs = null;
		Statement st = null;
		ObjArticle objArticle = null;
		String sql = "";
		try {
			connection = DataBase.getConnectionAppPharmacys();
			sql = "sp_wlistaCli '"+obj.getParametro1()+"'";
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
			System.out.println("error wc_qc_call_articlexvend: " + ex.getMessage());
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
}
