package com.ws_appmovilpharmacy.models;

public class ObjVisit {
	private String vstVendCod;
	private String vstFecReg;
	private String vstCliCod;
	private String vstTipe;
	private String vstObs;
	private int vstCliDirCod;
	private String vstCliDirNom;
	private String vstCliDirDet;
	private double vstLattd;
	private double vstLogtd;
	private double vstDistanceFromDir;
	private int vstOnSite;

	public ObjVisit() {
		super();
	}

	public ObjVisit(String vstVendCod, String vstFecReg, String vstCliCod, String vstTipe, String vstObs,
			int vstCliDirCod, String vstCliDirNom, String vstCliDirDet, double vstLattd, double vstLogtd,
			double vstDistanceFromDir, int vstOnSite) {
		super();
		this.vstVendCod = vstVendCod;
		this.vstFecReg = vstFecReg;
		this.vstCliCod = vstCliCod;
		this.vstTipe = vstTipe;
		this.vstObs = vstObs;
		this.vstCliDirCod = vstCliDirCod;
		this.vstCliDirNom = vstCliDirNom;
		this.vstCliDirDet = vstCliDirDet;
		this.vstLattd = vstLattd;
		this.vstLogtd = vstLogtd;
		this.vstDistanceFromDir = vstDistanceFromDir;
		this.vstOnSite = vstOnSite;
	}

	public String getVstVendCod() {
		return vstVendCod;
	}

	public void setVstVendCod(String vstVendCod) {
		this.vstVendCod = vstVendCod;
	}

	public String getVstFecReg() {
		return vstFecReg;
	}

	public void setVstFecReg(String vstFecReg) {
		this.vstFecReg = vstFecReg;
	}

	public String getVstCliCod() {
		return vstCliCod;
	}

	public void setVstCliCod(String vstCliCod) {
		this.vstCliCod = vstCliCod;
	}

	public String getVstTipe() {
		return vstTipe;
	}

	public void setVstTipe(String vstTipe) {
		this.vstTipe = vstTipe;
	}

	public String getVstObs() {
		return vstObs;
	}

	public void setVstObs(String vstObs) {
		this.vstObs = vstObs;
	}

	public int getVstCliDirCod() {
		return vstCliDirCod;
	}

	public void setVstCliDirCod(int vstCliDirCod) {
		this.vstCliDirCod = vstCliDirCod;
	}

	public String getVstCliDirNom() {
		return vstCliDirNom;
	}

	public void setVstCliDirNom(String vstCliDirNom) {
		this.vstCliDirNom = vstCliDirNom;
	}

	public String getVstCliDirDet() {
		return vstCliDirDet;
	}

	public void setVstCliDirDet(String vstCliDirDet) {
		this.vstCliDirDet = vstCliDirDet;
	}

	public double getVstLattd() {
		return vstLattd;
	}

	public void setVstLattd(double vstLattd) {
		this.vstLattd = vstLattd;
	}

	public double getVstLogtd() {
		return vstLogtd;
	}

	public void setVstLogtd(double vstLogtd) {
		this.vstLogtd = vstLogtd;
	}

	public double getVstDistanceFromDir() {
		return vstDistanceFromDir;
	}

	public void setVstDistanceFromDir(double vstDistanceFromDir) {
		this.vstDistanceFromDir = vstDistanceFromDir;
	}

	public int getVstOnSite() {
		return vstOnSite;
	}

	public void setVstOnSite(int vstOnSite) {
		this.vstOnSite = vstOnSite;
	}
}
