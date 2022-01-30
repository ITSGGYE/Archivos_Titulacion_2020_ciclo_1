package com.ws_appmovilpharmacy.models;

public class ObjwPrePedOrdDet {
	
	private int nroTrans;
	private String fecEntrega;
	private String codArticulo;
	private double cantVta;
	private double cantTot;
	private double precio;
	private String codTipoImpu1;
	private String codTasaImp1;
	private double porcImpu1;
	private double impImpu1;
	private double impMovMo;
	private int linea;
	private double precioLp;
	private String nomFpago;
	private double cantidad;
	private String especificFactura;
	private double precioMinimo;
	private String codGrupoIp;
	private double precioApp;
	
	public ObjwPrePedOrdDet() {
		super();
	}

	public ObjwPrePedOrdDet(int nroTrans, String fecEntrega, String codArticulo, double cantVta, double cantTot,
			double precio, String codTipoImpu1, String codTasaImp1, double porcImpu1, double impImpu1, double impMovMo,
			int linea, double precioLp, String nomFpago, double cantidad, String especificFactura, double precioMinimo,
			String codGrupoIp, double precioApp) {
		super();
		this.nroTrans = nroTrans;
		this.fecEntrega = fecEntrega;
		this.codArticulo = codArticulo;
		this.cantVta = cantVta;
		this.cantTot = cantTot;
		this.precio = precio;
		this.codTipoImpu1 = codTipoImpu1;
		this.codTasaImp1 = codTasaImp1;
		this.porcImpu1 = porcImpu1;
		this.impImpu1 = impImpu1;
		this.impMovMo = impMovMo;
		this.linea = linea;
		this.precioLp = precioLp;
		this.nomFpago = nomFpago;
		this.cantidad = cantidad;
		this.especificFactura = especificFactura;
		this.precioMinimo = precioMinimo;
		this.codGrupoIp = codGrupoIp;
		this.precioApp = precioApp;
	}

	public int getNroTrans() {
		return nroTrans;
	}

	public void setNroTrans(int nroTrans) {
		this.nroTrans = nroTrans;
	}

	public String getFecEntrega() {
		return fecEntrega;
	}

	public void setFecEntrega(String fecEntrega) {
		this.fecEntrega = fecEntrega;
	}

	public String getCodArticulo() {
		return codArticulo;
	}

	public void setCodArticulo(String codArticulo) {
		this.codArticulo = codArticulo;
	}

	public double getCantVta() {
		return cantVta;
	}

	public void setCantVta(double cantVta) {
		this.cantVta = cantVta;
	}

	public double getCantTot() {
		return cantTot;
	}

	public void setCantTot(double cantTot) {
		this.cantTot = cantTot;
	}

	public double getPrecio() {
		return precio;
	}

	public void setPrecio(double precio) {
		this.precio = precio;
	}

	public String getCodTipoImpu1() {
		return codTipoImpu1;
	}

	public void setCodTipoImpu1(String codTipoImpu1) {
		this.codTipoImpu1 = codTipoImpu1;
	}

	public String getCodTasaImp1() {
		return codTasaImp1;
	}

	public void setCodTasaImp1(String codTasaImp1) {
		this.codTasaImp1 = codTasaImp1;
	}

	public double getPorcImpu1() {
		return porcImpu1;
	}

	public void setPorcImpu1(double porcImpu1) {
		this.porcImpu1 = porcImpu1;
	}

	public double getImpImpu1() {
		return impImpu1;
	}

	public void setImpImpu1(double impImpu1) {
		this.impImpu1 = impImpu1;
	}

	public double getImpMovMo() {
		return impMovMo;
	}

	public void setImpMovMo(double impMovMo) {
		this.impMovMo = impMovMo;
	}

	public int getLinea() {
		return linea;
	}

	public void setLinea(int linea) {
		this.linea = linea;
	}

	public double getPrecioLp() {
		return precioLp;
	}

	public void setPrecioLp(double precioLp) {
		this.precioLp = precioLp;
	}

	public String getNomFpago() {
		return nomFpago;
	}

	public void setNomFpago(String nomFpago) {
		this.nomFpago = nomFpago;
	}

	public double getCantidad() {
		return cantidad;
	}

	public void setCantidad(double cantidad) {
		this.cantidad = cantidad;
	}

	public String getEspecificFactura() {
		return especificFactura;
	}

	public void setEspecificFactura(String especificFactura) {
		this.especificFactura = especificFactura;
	}

	public double getPrecioMinimo() {
		return precioMinimo;
	}

	public void setPrecioMinimo(double precioMinimo) {
		this.precioMinimo = precioMinimo;
	}

	public String getCodGrupoIp() {
		return codGrupoIp;
	}

	public void setCodGrupoIp(String codGrupoIp) {
		this.codGrupoIp = codGrupoIp;
	}

	public double getPrecioApp() {
		return precioApp;
	}

	public void setPrecioApp(double precioApp) {
		this.precioApp = precioApp;
	} 	
}
