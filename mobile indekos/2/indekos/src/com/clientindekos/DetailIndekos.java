package com.clientindekos;

import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;
import android.widget.TextView;

public class DetailIndekos extends ListActivity {

	private Long indekos_id;
	LocalDatabase mDbHelper;
	private TextView indekosnama, indekosuntuk, indekosketerangan;
	private Button btnrute;
	String number, toDial;
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.detailindekos);
		mDbHelper = new LocalDatabase(this);
		mDbHelper.open();
		setContentView(R.layout.detailindekos);// terdekat
		indekos_id = savedInstanceState != null ? savedInstanceState
				.getLong(LocalDatabase.KEY_INDEKOS_ID) : null;

		if (indekos_id == null) {
			Bundle extras = getIntent().getExtras();
			indekos_id = extras != null ? extras
					.getLong(LocalDatabase.KEY_INDEKOS_ID) : null;
		}
		
		indekosnama = (TextView) findViewById(R.id.indekosnama);
		indekosuntuk = (TextView) findViewById(R.id.indekosuntuk);
		indekosketerangan = (TextView) findViewById(R.id.indekosketerangan);
		btnrute = (Button)findViewById(R.id.btn_rute_indekos);
		btnrute.setOnClickListener(new OnClickListener() {
			
			public void onClick(View v) {
				// TODO Auto-generated method stub
				try{
					Intent intent = new Intent(DetailIndekos.this, RuteIndekos.class);
					intent.putExtra(LocalDatabase.KEY_INDEKOS_ID, indekos_id);
					startActivity(intent);
				}catch(Exception e){
					e.printStackTrace();
				}
			}
		});
		getListKamar();
		getListView();
	}

	private void getListKamar() {
		// TODO Auto-generated method stub
		if (indekos_id != null) {
			Cursor detailIndekos = mDbHelper.get_detail_indekos(indekos_id);
			startManagingCursor(detailIndekos);
			indekosnama.setText(detailIndekos.getString(detailIndekos.getColumnIndexOrThrow(LocalDatabase.KEY_INDEKOS_NAMA)));
			indekosuntuk.setText(detailIndekos.getString(detailIndekos.getColumnIndexOrThrow(LocalDatabase.KEY_INDEKOS_UNTUK)));
			indekosketerangan.setText(detailIndekos.getString(detailIndekos.getColumnIndexOrThrow(LocalDatabase.KEY_INDEKOS_KETERANGAN)));
			number = detailIndekos.getString(detailIndekos.getColumnIndexOrThrow(LocalDatabase.KEY_PEMILIK_NO_HP));
			stopManagingCursor(detailIndekos);
			Cursor listKamar = mDbHelper.get_list_kamar(indekos_id);
			startManagingCursor(listKamar);
			String[] from = new String[] { LocalDatabase.KEY_KAMAR_NAMA,
					LocalDatabase.KEY_KAMAR_MINIMAL_KONTRAK,
					LocalDatabase.KEY_KAMAR_MINIMAL_KONTRAK_JENIS,
					LocalDatabase.KEY_KAMAR_HARGA, LocalDatabase.KEY_KAMAR_ISI,
					LocalDatabase.KEY_KAMAR_UKURAN_PANJANG,
					LocalDatabase.KEY_KAMAR_UKURAN_LEBAR,
					LocalDatabase.KEY_KAMAR_UKURAN_JENIS };
			int[] to = new int[] { R.id.kamarnama, R.id.kamarminkontrak,
					R.id.kamarminkontrakjenis, R.id.kamarharga, R.id.kamarisi,
					R.id.kamarukuranpanjang, R.id.kamarukuranlebar,
					R.id.kamarukuranjenis };

			SimpleCursorAdapter adapter = new SimpleCursorAdapter(this,
					R.layout.tvlistkamar, listKamar, from, to);
			setListAdapter(adapter);
		}
	}

	protected void onListItemClick(ListView l, View v, int position, long id) {
		super.onListItemClick(l, v, position, id);
		try {
			Intent i = new Intent(this, DetailKamar.class);
			i.putExtra(LocalDatabase.KEY_KAMAR_ID,id);
			startActivity(i);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	public boolean onCreateOptionsMenu(Menu menu) {
		MenuInflater inflater = getMenuInflater();
		inflater.inflate(R.menu.rute, menu);
		return true;
	}

	public boolean onOptionsItemSelected(MenuItem item) {
		switch (item.getItemId()) {
		case R.id.menu_telpon:
			toDial = "tel:"+number.toString();
			Log.d("No HP", toDial);
			startActivity(new Intent(Intent.ACTION_DIAL,Uri.parse(toDial)));
			break;
		case R.id.kembali:
			finish();
			break;
		case R.id.rute:
			try{
				Intent intent = new Intent(this, RuteIndekos.class);
				intent.putExtra(LocalDatabase.KEY_INDEKOS_ID, indekos_id);
				startActivity(intent);
			}catch(Exception e){
				e.printStackTrace();
			}
			break;
		}
		return false;
	}

}
