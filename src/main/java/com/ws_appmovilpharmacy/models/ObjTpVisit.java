package com.ws_appmovilpharmacy.models;

public class ObjTpVisit {
	 private String vstTpCod;
	 private String vstTpNom;
	 
	public ObjTpVisit() {
		super();
	}

	public ObjTpVisit(String vstTpCod, String vstTpNom) {
		super();
		this.vstTpCod = vstTpCod;
		this.vstTpNom = vstTpNom;
	}

	public String getVstTpCod() {
		return vstTpCod;
	}

	public void setVstTpCod(String vstTpCod) {
		this.vstTpCod = vstTpCod;
	}

	public String getVstTpNom() {
		return vstTpNom;
	}

	public void setVstTpNom(String vstTpNom) {
		this.vstTpNom = vstTpNom;
	}
	 
	
	
}
