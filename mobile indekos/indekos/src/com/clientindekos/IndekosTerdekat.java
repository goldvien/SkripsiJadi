package com.clientindekos;

import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpRequestBase;
import org.apache.http.impl.client.DefaultHttpClient;

import android.app.ListActivity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.database.Cursor;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;
import android.widget.Toast;
import android.widget.AdapterView.AdapterContextMenuInfo;

public class IndekosTerdekat extends ListActivity implements LocationListener {

	private static final int DETAIL = Menu.FIRST;
	private static final int RUTE = Menu.FIRST + 1;
	private static final int BATAL = Menu.FIRST + 2;

	private double terdekatlong, terdekatlat;
	private LocationManager locMgr;
	private LocalDatabase mDbHelper;
	private JarakTerdekat jarakTerdekat;
	private String IndekosURL = "http://www.android.daarelqurro.sch.id/android.php";
	//private String IndekosURL = "http://10.0.2.2/indekosclient/android.php";

	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.cari);
		mDbHelper = new LocalDatabase(this);
		mDbHelper.open();
		locMgr = (LocationManager) getSystemService(LOCATION_SERVICE);
		Location loc = locMgr
				.getLastKnownLocation(LocationManager.GPS_PROVIDER);
		terdekat(loc);
		daftarTerdekat();
	}

	public void onResume() {
		super.onResume();
		locMgr.requestLocationUpdates(LocationManager.GPS_PROVIDER, 2000, 1,
				this);
	}

	public void onPause() {
		super.onPause();
		locMgr.removeUpdates(this);
	}

	public void onLocationChanged(Location loc) {
		//terdekat(loc);
	}

	public void onProviderDisabled(String provider) {
		Toast.makeText(getApplicationContext(),
				"GPS Tidak aktif, tidak bisa menentukan jarak terdekat.",
				Toast.LENGTH_SHORT).show();
		finish();
	}

	public void onStatusChanged(String provider, int status, Bundle extras) {

	}

	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub
	}

	private void terdekat(Location loc) {
		if(loc != null){
			registerForContextMenu(getListView());
			terdekatlat = loc.getLatitude();
			terdekatlong = loc.getLongitude();
			jarakTerdekat = new JarakTerdekat();
			jarakTerdekat.execute();
			//daftarTerdekat();
		}
	}

	private void daftarTerdekat() {
		Cursor jrk = mDbHelper.get_jarak_terdekat();
		startManagingCursor(jrk);
		String[] from = new String[] { LocalDatabase.KEY_INDEKOS_NAMA,
				LocalDatabase.KEY_JARAK, 
				LocalDatabase.KEY_INDEKOS_UNTUK };
		int[] to = new int[] { R.id.tvlistindekosnama, R.id.tvlistindekosjarak,
				R.id.tvlistindekosuntuk };

		SimpleCursorAdapter adapter = new SimpleCursorAdapter(this,
				R.layout.tvlistindekos, jrk, from, to);
		setListAdapter(adapter);
	}

	private class JarakTerdekat extends AsyncTask<Void, Integer, Void> {

		private ProgressDialog Dialog;

		protected void onPreExecute() {
			Dialog = new ProgressDialog(IndekosTerdekat.this);
			Dialog.setMessage("Loading terdekat");
			Dialog.show();
		}

		@Override
		protected Void doInBackground(Void... params) {
			// TODO Auto-generated method stub
			String[] serverterdekat_indekos_id = fetch(IndekosURL
					+ "?act=terdekat_indekos_id&lat=" + terdekatlat + "&lng="
					+ terdekatlong);
			String[] serverterdekat_jarak = fetch(IndekosURL
					+ "?act=terdekat_jarak&lat=" + terdekatlat + "&lng="
					+ terdekatlong);

			String[] clientterdekat = selectHasilTerdekat(1);
			Log.d("LATLNG", terdekatlat + " = " + terdekatlong);
			if (clientterdekat.length != 0) {
				for (int i = 0; i < clientterdekat.length; i++) {
					Log.d("Hapus", ">>>>>");
					mDbHelper.deleteJarakTerdekat(clientterdekat[i]);
				}
				for (int j = 0; j < serverterdekat_indekos_id.length; j++) {
					Log.d("LATLNG", terdekatlat + " = " + terdekatlong);
					Log.d("Insert", "indekos id ="
							+ serverterdekat_indekos_id[j] + ", jarak = "
							+ serverterdekat_jarak[j]);
					mDbHelper.insertJarakTerdekat(serverterdekat_indekos_id[j],
							serverterdekat_jarak[j]);
				}
			} else {
				for (int j = 0; j < serverterdekat_indekos_id.length; j++) {
					Log.d("LATLNG", terdekatlat + " = " + terdekatlong);
					Log.d("Insert", "indekos id ="
							+ serverterdekat_indekos_id[j] + ", jarak = "
							+ serverterdekat_jarak[j]);
					mDbHelper.insertJarakTerdekat(serverterdekat_indekos_id[j],
							serverterdekat_jarak[j]);
				}
			}
			return null;
		}

		protected void onPostExecute(Void result) {
			super.onPostExecute(result);
			Dialog.dismiss();
			AlertDialog alert = new AlertDialog.Builder(IndekosTerdekat.this)
					.create();

			alert.setTitle("Jarak Terdekat");
			alert.setMessage("Daftar jarak terdekat");
			alert.setButton("Lihat", new DialogInterface.OnClickListener() {

				public void onClick(DialogInterface dialog, int which) {
					// TODO Auto-generated method stub
					Dialog.dismiss();
					setContentView(R.layout.cari);
					daftarTerdekat();
				}
			});
			alert.show();
		}

	}

	public String[] selectHasilTerdekat(int column) {
		Cursor terdekat = mDbHelper.select_all_jarak_terdekat();
		String result[] = new String[terdekat.getCount()];
		terdekat.moveToFirst();
		int i = 0;
		while (terdekat.isAfterLast() == false) {
			result[i++] = terdekat.getString(column);
			terdekat.moveToNext();
		}
		terdekat.close();
		return result;
	}

	public String[] fetch(String url) {
		HttpClient httpclient = new DefaultHttpClient();
		HttpRequestBase httpRequest = null;
		HttpResponse httpResponse = null;
		InputStream inputStream = null;
		String response = "";
		StringBuffer buffer = new StringBuffer();
		httpRequest = new HttpGet(url);
		try {
			httpResponse = httpclient.execute(httpRequest);
		} catch (ClientProtocolException el) {
			el.printStackTrace();
		} catch (IOException el) {
			// TODO Auto-generated catch block
			el.printStackTrace();
		}
		try {
			inputStream = httpResponse.getEntity().getContent();
		} catch (IllegalStateException el) {
			el.printStackTrace();
		} catch (IOException el) {
			el.printStackTrace();
		}

		byte[] data = new byte[512];
		int len = 0;
		try {
			while (-1 != (len = inputStream.read(data))) {
				buffer.append(new String(data, 0, len));
			}
		} catch (IOException el) {
			el.printStackTrace();
		}
		try {
			inputStream.close();
		} catch (IOException el) {
			el.printStackTrace();
		}
		response = buffer.toString();
		StringParser parser = new StringParser();
		ArrayList<Object> output = parser.Parse(response);
		Object[] Output = output.toArray();
		String[] content = new String[Output.length];
		for (int i = 0; i < content.length; i++) {
			content[i] = Output[i].toString();
		}
		return content;
	}

	public boolean onContextItemSelected(MenuItem item) {
		switch (item.getItemId()) {
		case DETAIL:
			AdapterContextMenuInfo detailindekos = (AdapterContextMenuInfo) item
					.getMenuInfo();
			Intent i = new Intent(this, DetailIndekos.class);
			i.putExtra(LocalDatabase.KEY_INDEKOS_ID, detailindekos.id);
			startActivity(i);
			return true;
		case RUTE:
			AdapterContextMenuInfo ruteindekos = (AdapterContextMenuInfo) item
					.getMenuInfo();
			i = new Intent(this, RuteIndekos.class);
			i.putExtra(LocalDatabase.KEY_INDEKOS_ID, ruteindekos.id);
			startActivity(i);
			return true;
		case BATAL:
			return true;
		}
		return super.onContextItemSelected(item);
	}

	protected void onListItemClick(ListView l, View v, int position, long id) {
		super.onListItemClick(l, v, position, id);
		try {
			Log.d("ID INDEKOS", String.valueOf(id).toString());
			Intent i = new Intent(this, DetailIndekos.class);
			i.putExtra(LocalDatabase.KEY_INDEKOS_ID, id);
			startActivity(i);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	public boolean onCreateOptionsMenu(Menu menu) {
		MenuInflater inflater = getMenuInflater();
		inflater.inflate(R.menu.terdekat_kembali, menu);
		return true;
	}

	public boolean onOptionsItemSelected(MenuItem item) {
		switch (item.getItemId()) {
		case R.id.menu_terdekat:
			// Location loc;
			locMgr = (LocationManager) getSystemService(LOCATION_SERVICE);
			Location loc = locMgr
					.getLastKnownLocation(LocationManager.GPS_PROVIDER);
			terdekat(loc);
			break;
		case R.id.menu_kembali:
			finish();
			break;
		}
		return false;
	}

}

/*
 * package com.clientindekos;
 * 
 * import android.app.Activity; import android.location.Location; import
 * android.location.LocationListener; import android.location.LocationManager;
 * //import android.location.LocationProvider; import android.os.Bundle; import
 * android.widget.TextView; import android.widget.Toast;
 * 
 * public class IndekosTerdekat extends Activity implements LocationListener{
 * 
 * private static final String[] S =
 * {"Layanan tidak tersedia","Layanan untuk sementara tidak tersedia"
 * ,"Layanan Tersedia"}; private TextView sistem,lokasi,longitude,latitude;
 * private double terdekatlong, terdekatlat; private LocationManager locMgr;
 * //final int RQS_GooglePlayService = 1; public void onCreate(Bundle
 * savedInstanceState){ super.onCreate(savedInstanceState);
 * setContentView(R.layout.indekosterdekat); sistem =
 * (TextView)findViewById(R.id.sistem); lokasi =
 * (TextView)findViewById(R.id.lokasi); longitude =
 * (TextView)findViewById(R.id.longitude); latitude =
 * (TextView)findViewById(R.id.latitude); locMgr =
 * (LocationManager)getSystemService(LOCATION_SERVICE); Location loc =
 * locMgr.getLastKnownLocation(LocationManager.GPS_PROVIDER);
 * //printLocation(loc); terdekat(loc); }
 * 
 * public void onResume(){ super.onResume();
 * locMgr.requestLocationUpdates(LocationManager.GPS_PROVIDER, 2000, 1, this); }
 * 
 * public void onPause(){ super.onPause(); locMgr.removeUpdates(this); }
 * 
 * public void onLocationChanged(Location loc){ terdekat(loc); }
 * 
 * public void onProviderDisabled(String provider){
 * //sistem.setText("\nProvider Disabled :"+provider);
 * Toast.makeText(getApplicationContext(),
 * "GPS Tidak aktif, tidak bisa menentukan jarak terdekat."
 * ,Toast.LENGTH_SHORT).show(); finish(); }
 * 
 * public void onStatusChanged(String provider, int status, Bundle extras){
 * sistem
 * .setText("\nStatus provider berganti : "+provider+", Status: "+S[status]
 * +", Extras: "+extras); }
 * 
 * private void terdekat(Location loc){ terdekatlong = loc.getLongitude();
 * terdekatlat = loc.getLatitude(); Toast.makeText(getApplicationContext(),
 * "Long ="+terdekatlong+" lat ="+terdekatlat,Toast.LENGTH_SHORT).show(); }
 * 
 * public void onProviderEnabled(String provider) { // TODO Auto-generated
 * method stub sistem.setText("\nProvider Enabled : "+provider); } }
 */