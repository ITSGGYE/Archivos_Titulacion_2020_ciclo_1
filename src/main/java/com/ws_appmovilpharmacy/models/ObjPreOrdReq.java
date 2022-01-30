package com.ws_appmovilpharmacy.models;

import java.util.List;

public class ObjPreOrdReq {
	private ObjPreOrd objPreOrd;
	private List<ObjPreOrdDet> objPreOrdDet;
	
	public ObjPreOrd getObjPreOrd() {
		return objPreOrd;
	}
	public void setObjPreOrd(ObjPreOrd objPreOrd) {
		this.objPreOrd = objPreOrd;
	}
	public List<ObjPreOrdDet> getObjPreOrdDet() {
		return objPreOrdDet;
	}
	public void setObjPreOrdDet(List<ObjPreOrdDet> objPreOrdDet) {
		this.objPreOrdDet = objPreOrdDet;
	}
}
