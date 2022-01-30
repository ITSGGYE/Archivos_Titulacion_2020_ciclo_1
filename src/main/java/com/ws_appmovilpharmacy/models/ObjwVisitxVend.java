package com.ws_appmovilpharmacy.models;

public class ObjwVisitxVend {
	private String vend_cod;
	private String fec_ini;
	private String obs1;
	private String tit_cod;
	private String tit_nom;
	private int order_num;
	private double lattd;
	private double logtd;
	private String ord_cord_type;
	private String obs2;
	private String obs3;
	private String tipo1;
	private int onSite;
	private String tipo2;
	private int onComplete;
	private String fecSchedule;
	
	public ObjwVisitxVend() {
		super();
	}

	

	public ObjwVisitxVend(String vend_cod, String fec_ini, String obs1, String tit_cod, String tit_nom, int order_num,
			double lattd, double logtd, String ord_cord_type, String obs2, String obs3, String tipo1, int onSite,
			String tipo2) {
		super();
		this.vend_cod = vend_cod;
		this.fec_ini = fec_ini;
		this.obs1 = obs1;
		this.tit_cod = tit_cod;
		this.tit_nom = tit_nom;
		this.order_num = order_num;
		this.lattd = lattd;
		this.logtd = logtd;
		this.ord_cord_type = ord_cord_type;
		this.obs2 = obs2;
		this.obs3 = obs3;
		this.tipo1 = tipo1;
		this.onSite = onSite;
		this.tipo2 = tipo2;
	}



	public String getVend_cod() {
		return vend_cod;
	}

	public void setVend_cod(String vend_cod) {
		this.vend_cod = vend_cod;
	}

	public String getFec_ini() {
		return fec_ini;
	}

	public void setFec_ini(String fec_ini) {
		this.fec_ini = fec_ini;
	}

	public String getObs1() {
		return obs1;
	}

	public void setObs1(String obs1) {
		this.obs1 = obs1;
	}

	public String getTit_cod() {
		return tit_cod;
	}

	public void setTit_cod(String tit_cod) {
		this.tit_cod = tit_cod;
	}

	public int getOrder_num() {
		return order_num;
	}

	public void setOrder_num(int order_num) {
		this.order_num = order_num;
	}

	public double getLattd() {
		return lattd;
	}

	public void setLattd(double lattd) {
		this.lattd = lattd;
	}

	public double getLogtd() {
		return logtd;
	}

	public void setLogtd(double logtd) {
		this.logtd = logtd;
	}

	public String getOrd_cord_type() {
		return ord_cord_type;
	}

	public void setOrd_cord_type(String ord_cord_type) {
		this.ord_cord_type = ord_cord_type;
	}

	public String getObs2() {
		return obs2;
	}

	public void setObs2(String obs2) {
		this.obs2 = obs2;
	}

	public String getObs3() {
		return obs3;
	}

	public void setObs3(String obs3) {
		this.obs3 = obs3;
	}

	public String getTipo1() {
		return tipo1;
	}

	public void setTipo1(String tipo1) {
		this.tipo1 = tipo1;
	}

	public int getOnSite() {
		return onSite;
	}

	public void setOnSite(int onSite) {
		this.onSite = onSite;
	}

	public String getTipo2() {
		return tipo2;
	}

	public void setTipo2(String tipo2) {
		this.tipo2 = tipo2;
	}



	public String getTit_nom() {
		return tit_nom;
	}



	public void setTit_nom(String tit_nom) {
		this.tit_nom = tit_nom;
	}



	public int getOnComplete() {
		return onComplete;
	}



	public void setOnComplete(int onComplete) {
		this.onComplete = onComplete;
	}



	public String getFecSchedule() {
		return fecSchedule;
	}



	public void setFecSchedule(String fecSchedule) {
		this.fecSchedule = fecSchedule;
	}	
}
