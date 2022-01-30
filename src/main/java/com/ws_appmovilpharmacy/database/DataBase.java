package com.ws_appmovilpharmacy.database;


import java.sql.Connection;
import java.sql.SQLException;


import com.microsoft.sqlserver.jdbc.SQLServerConnectionPoolDataSource;;

public class DataBase {
	private static Connection connection = null;
	private static SQLServerConnectionPoolDataSource pool = null;

	public static Connection getConnectionAppPharmacys() {
		try {
			pool = new SQLServerConnectionPoolDataSource();
			String dbURL = "jdbc:sqlserver://192.168.100.7;databaseName=APP_PHARMACYS";
			String user = "sa";
			String pass = "Server2020";

			pool.setUser(user);
			pool.setPassword(pass);
			pool.setURL(dbURL);
			pool.setLockTimeout(30000);
			connection = pool.getConnection();

			if (connection != null) {
				System.out.println("getConeccionMaster: Conexion abierta PHARMONITOR");
			} else {
				System.out.println("getConeccionMaster: Problemas de conexion PHARMONITOR");
			}
		} catch (Exception ex) {
			System.out.println("getConeccionMaster: " + ex.toString());
		}
		return connection;
	}

	public static Connection getConnectionAppProduccion() {
		try {
			pool = new SQLServerConnectionPoolDataSource();
			String dbURL = "jdbc:sqlserver://10.242.2.1;databaseName=APP_PRODUCCION";
			String user = "sa";
			String pass = "Server2020*";

			pool.setUser(user);
			pool.setPassword(pass);
			pool.setURL(dbURL);
			pool.setLockTimeout(30000);
			connection = pool.getConnection();

			if (connection != null) {
				System.out.println("getConeccionMaster: Conexion abierta APP_PRODUCCION");
			} else {
				System.out.println("getConeccionMaster: Problemas de conexion APP_PRODUCCION");
			}
		} catch (Exception ex) {
			System.out.println("getConeccionMaster: " + ex.toString());
		}
		return connection;
	}	
	
	public static void closeConnection() {
		if (connection != null) {
			try {
				connection.close();
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
	}
	public static void main(String []args) {
		System.out.println(getConnectionAppPharmacys());
	}
}