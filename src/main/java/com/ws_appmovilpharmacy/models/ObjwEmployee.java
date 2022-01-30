package com.ws_appmovilpharmacy.models;

public class ObjwEmployee {
	private String emplCod;
	private String emplNom;
	private String emplTitl;
	private String titCod;
	private String titNom;
	
	public ObjwEmployee() {
		super();
	}

	public ObjwEmployee(String emplCod, String emplNom, String emplTitl, String titCod, String titNom) {
		super();
		this.emplCod = emplCod;
		this.emplNom = emplNom;
		this.emplTitl = emplTitl;
		this.titCod = titCod;
		this.titNom = titNom;
	}

	public String getEmplCod() {
		return emplCod;
	}

	public void setEmplCod(String emplCod) {
		this.emplCod = emplCod;
	}

	public String getEmplNom() {
		return emplNom;
	}

	public void setEmplNom(String emplNom) {
		this.emplNom = emplNom;
	}

	public String getEmplTitl() {
		return emplTitl;
	}

	public void setEmplTitl(String emplTitl) {
		this.emplTitl = emplTitl;
	}

	public String getTitCod() {
		return titCod;
	}

	public void setTitCod(String titCod) {
		this.titCod = titCod;
	}

	public String getTitNom() {
		return titNom;
	}

	public void setTitNom(String titNom) {
		this.titNom = titNom;
	}
}
