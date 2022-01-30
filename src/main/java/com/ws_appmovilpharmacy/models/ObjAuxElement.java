package com.ws_appmovilpharmacy.models;

public class ObjAuxElement {
	private String parametro1;
	private String parametro2;
	private String parametro3;
	private int parametro4;
	private int parametro5;
	private int parametro6;
	private double parametro7;
	private double parametro8;
	private double parametro9;
	private String parametro10;
	
	public ObjAuxElement() {
		super();
	}

	public ObjAuxElement(String parametro1, String parametro2, String parametro3, int parametro4, int parametro5,
			int parametro6, double parametro7, double parametro8, double parametro9) {
		super();
		this.parametro1 = parametro1;
		this.parametro2 = parametro2;
		this.parametro3 = parametro3;
		this.parametro4 = parametro4;
		this.parametro5 = parametro5;
		this.parametro6 = parametro6;
		this.parametro7 = parametro7;
		this.parametro8 = parametro8;
		this.parametro9 = parametro9;
	}
	
	public ObjAuxElement(String parametro1, String parametro2, String parametro3, int parametro4, int parametro5,
			int parametro6, double parametro7, double parametro8, double parametro9 , String parametro10) {
		super();
		this.parametro1 = parametro1;
		this.parametro2 = parametro2;
		this.parametro3 = parametro3;
		this.parametro4 = parametro4;
		this.parametro5 = parametro5;
		this.parametro6 = parametro6;
		this.parametro7 = parametro7;
		this.parametro8 = parametro8;
		this.parametro9 = parametro9;
		this.parametro10 =parametro10;
	}
	
	public ObjAuxElement(String parametro1, String parametro2, String parametro3) {
		super();
		this.parametro1 = parametro1;
		this.parametro2 = parametro2;
		this.parametro3 = parametro3;
	}
	
	public ObjAuxElement(String parametro1, String parametro2, String parametro3, String parametro10) {
		super();
		this.parametro1 = parametro1;
		this.parametro2 = parametro2;
		this.parametro3 = parametro3;
		this.parametro10 =parametro10;
	}	

	public String getParametro1() {
		return parametro1;
	}

	public void setParametro1(String parametro1) {
		this.parametro1 = parametro1;
	}

	public String getParametro2() {
		return parametro2;
	}

	public void setParametro2(String parametro2) {
		this.parametro2 = parametro2;
	}

	public String getParametro3() {
		return parametro3;
	}

	public void setParametro3(String parametro3) {
		this.parametro3 = parametro3;
	}

	public int getParametro4() {
		return parametro4;
	}

	public void setParametro4(int parametro4) {
		this.parametro4 = parametro4;
	}

	public int getParametro5() {
		return parametro5;
	}

	public void setParametro5(int parametro5) {
		this.parametro5 = parametro5;
	}

	public int getParametro6() {
		return parametro6;
	}

	public void setParametro6(int parametro6) {
		this.parametro6 = parametro6;
	}

	public double getParametro7() {
		return parametro7;
	}

	public void setParametro7(double parametro7) {
		this.parametro7 = parametro7;
	}

	public double getParametro8() {
		return parametro8;
	}

	public void setParametro8(double parametro8) {
		this.parametro8 = parametro8;
	}

	public double getParametro9() {
		return parametro9;
	}

	public void setParametro9(double parametro9) {
		this.parametro9 = parametro9;
	}
	
	public void setParametro10(String parametro10) {
		this.parametro10 = parametro10;
	}
	
	public String getParametro10() {
		return parametro10;
	}
}
