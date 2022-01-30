package com.ws_appmovilpharmacy.models;

public class ObjRequest<T> {
	private String apiKey;
	private T obj;
	
	public ObjRequest(String apiKey, T obj) {
		super();
		this.apiKey = apiKey;
		this.obj = obj;
	}

	public ObjRequest() {
		super();
	}

	public String getApiKey() {
		return apiKey;
	}

	public void setApiKey(String apiKey) {
		this.apiKey = apiKey;
	}

	public T getObj() {
		return obj;
	}

	public void setObj(T obj) {
		this.obj = obj;
	}
	
	
}
