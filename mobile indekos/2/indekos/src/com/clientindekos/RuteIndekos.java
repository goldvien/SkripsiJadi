package com.clientindekos;

import android.app.Activity;
import android.content.Intent;
import android.database.Cursor;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.webkit.WebView;
import android.widget.Toast;

public class RuteIndekos extends Activity implements LocationListener {

	private Long indekos_id;
	LocalDatabase mDbHelper;
	private LocationManager locMgr;
	private String lt,lg, lt1,lg1;
	private WebView webrute;
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.ruteindekos);
		mDbHelper = new LocalDatabase(this);
		mDbHelper.open();
		locMgr = (LocationManager)getSystemService(LOCATION_SERVICE);
		Location loc = locMgr.getLastKnownLocation(LocationManager.GPS_PROVIDER);
		indekos_id = savedInstanceState != null ? savedInstanceState
				.getLong(LocalDatabase.KEY_INDEKOS_ID) : null;

		if (indekos_id == null) {
			Bundle extras = getIntent().getExtras();
			indekos_id = extras != null ? extras
					.getLong(LocalDatabase.KEY_INDEKOS_ID) : null;
		}
		ruteIndekos(loc);
	}

	private void detailIndekos() {
		// TODO Auto-generated method stub
		if (indekos_id != null) {
			Cursor detail = mDbHelper.get_detail_indekos(indekos_id);
			startManagingCursor(detail);
			lg = detail.getString(detail
					.getColumnIndexOrThrow(LocalDatabase.KEY_INDEKOS_LONG)).toString();
			lt = detail.getString(detail
					.getColumnIndexOrThrow(LocalDatabase.KEY_INDEKOS_LAT)).toString();
		}
	}

	public void onResume(){
		super.onResume();
		locMgr.requestLocationUpdates(LocationManager.GPS_PROVIDER, 2000, 1, this);
	}
	
	public void onPause(){
		super.onPause();
		locMgr.removeUpdates(this);
	}
	
	public void onLocationChanged(Location loc){
		ruteIndekos(loc);
	}
	
	public void onProviderDisabled(String provider){
		Toast.makeText(getApplicationContext(), "GPS Tidak aktif, tidak bisa melihat rute jalan indekos",Toast.LENGTH_SHORT).show();
		finish();
	}
	
	public void onStatusChanged(String provider, int status, Bundle extras){
		
	}
	
	private void ruteIndekos(Location loc){
		detailIndekos();
		if(loc!= null){
			lt1 = String.valueOf(loc.getLatitude()).toString();
			lg1 = String.valueOf(loc.getLongitude()).toString();
			
			webrute = (WebView)findViewById(R.id.webrute);
			webrute.getSettings().setJavaScriptEnabled(true);
			Log.d("Link", "http://maps.google.com/maps?saddr="+lt1+","+lg1+"&daddr="+lt+","+lg);
			String uri = "http://maps.google.com/maps?saddr="+lt1+","+lg1+"&daddr="+lt+","+lg;
			Intent intent = new Intent(android.content.Intent.ACTION_VIEW, Uri.parse(uri));
			intent.setClassName("com.google.android.apps.maps", "com.google.android.maps.MapsActivity");
			startActivity(intent);
			//webrute.loadUrl("http://maps.google.com/maps?saddr="+lt+","+lg+"&daddr="+lt1+","+lg1);
		}
	}

	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub
	}
}
