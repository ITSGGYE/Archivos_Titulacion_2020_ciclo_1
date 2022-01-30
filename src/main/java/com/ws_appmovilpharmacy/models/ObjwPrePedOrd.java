package com.ws_appmovilpharmacy.models;

public class ObjwPrePedOrd {
	private int nro_docum;
	private String cod_tit;
	private String nom_tit;
	private String fec_doc;
	private String dir_tit;
	private String fec_entrega;
	private String dir_entrega;
	private double imp_tot_gen;
	private String observaciones;
	public int getNro_docum() {
		return nro_docum;
	}
	public void setNro_docum(int nro_docum) {
		this.nro_docum = nro_docum;
	}
	public String getCod_tit() {
		return cod_tit;
	}
	public void setCod_tit(String cod_tit) {
		this.cod_tit = cod_tit;
	}
	public String getNom_tit() {
		return nom_tit;
	}
	public void setNom_tit(String nom_tit) {
		this.nom_tit = nom_tit;
	}
	public String getFec_doc() {
		return fec_doc;
	}
	public void setFec_doc(String fec_doc) {
		this.fec_doc = fec_doc;
	}
	public String getDir_tit() {
		return dir_tit;
	}
	public void setDir_tit(String dir_tit) {
		this.dir_tit = dir_tit;
	}
	public String getFec_entrega() {
		return fec_entrega;
	}
	public void setFec_entrega(String fec_entrega) {
		this.fec_entrega = fec_entrega;
	}
	public String getDir_entrega() {
		return dir_entrega;
	}
	public void setDir_entrega(String dir_entrega) {
		this.dir_entrega = dir_entrega;
	}
	public double getImp_tot_gen() {
		return imp_tot_gen;
	}
	public void setImp_tot_gen(double imp_tot_gen) {
		this.imp_tot_gen = imp_tot_gen;
	}
	public String getObservaciones() {
		return observaciones;
	}
	public void setObservaciones(String observaciones) {
		this.observaciones = observaciones;
	}	
}
