package com.ws_appmovilpharmacy.models;

public class ObjLocation {
	private String imeiID;
	private String fecReg;
	private double lattd;
	private double logtd;
	private String dateID;

	public ObjLocation() {
	}

	public ObjLocation(String imeiID, String fecReg, double lattd, double logtd, String dateID) {
		this.imeiID = imeiID;
		this.fecReg = fecReg;
		this.lattd = lattd;
		this.logtd = logtd;
		this.dateID = dateID;
	}

	public String getImeiID() {
		return imeiID;
	}

	public void setImeiID(String imeiID) {
		this.imeiID = imeiID;
	}

	public String getFecReg() {
		return fecReg;
	}

	public void setFecReg(String fecReg) {
		this.fecReg = fecReg;
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

	public String getDateID() {
		return dateID;
	}

	public void setDateID(String dateID) {
		this.dateID = dateID;
	}
}
