package com.clientindekos;

import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.SimpleCursorAdapter;
import android.widget.TextView;

public class DetailKamar extends ListActivity {

	private Long kamar_id;
	LocalDatabase mDbHelper;
	private TextView kamarnama, kamarisi, kamarukuranpanjang, kamarukuranlebar,
			kamarukuranjenis, kamarharga, kamarminkontrak, kamarsampaitanggal,
			kamarstatus, kamarminkontrakjenis;
	private Button btn;
	private String foto;
	private String URLimage = "http://www.indekos.daarelqurro.sch.id/assets/images/";

	// private String URLimage = "http://10.0.2.2/indekosserver/assets/images/";

	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.detailkamar);
		mDbHelper = new LocalDatabase(this);
		mDbHelper.open();
		// setContentView(R.layout.cari);//listindekos
		kamar_id = savedInstanceState != null ? savedInstanceState
				.getLong(LocalDatabase.KEY_KAMAR_ID) : null;

		if (kamar_id == null) {
			Bundle extras = getIntent().getExtras();
			kamar_id = extras != null ? extras
					.getLong(LocalDatabase.KEY_KAMAR_ID) : null;
		}
		kamarnama = (TextView) findViewById(R.id.kamarnama);
		kamarisi = (TextView) findViewById(R.id.kamarisi);
		kamarharga = (TextView) findViewById(R.id.kamarharga);
		kamarukuranpanjang = (TextView) findViewById(R.id.kamarukuranpanjang);
		kamarukuranlebar = (TextView) findViewById(R.id.kamarukuranlebar);
		kamarukuranjenis = (TextView) findViewById(R.id.kamarukuranjenis);
		kamarminkontrak = (TextView) findViewById(R.id.kamarminkontrak);
		kamarminkontrakjenis = (TextView) findViewById(R.id.kamarminkontrakjenis);
		kamarstatus = (TextView) findViewById(R.id.kamarstatus);
		kamarsampaitanggal = (TextView) findViewById(R.id.kamarsampaitanggal);
		btn = (Button) findViewById(R.id.btn_lihat_foto);
		detailkamar();
		btn.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				// TODO Auto-generated method stub
				// Bitmap bitmap = DownloadImage(URLimage + foto);
				try {
					Intent intent = new Intent(DetailKamar.this,
							ImageFotoKamar.class);
					intent.putExtra("urlfoto", URLimage + foto);
					intent.putExtra("nama_kamar", kamarnama.getText()
							.toString());
					startActivity(intent);
				} catch (Exception e) {
					e.printStackTrace();
				}
				// kamarfoto.setImageBitmap(bitmap);

			}
		});
		/*
		 * Log.d("wkekwe", URLimage + foto); Bitmap bitmap =
		 * DownloadImage(URLimage + foto); kamarfoto.setImageBitmap(bitmap);
		 */
		getListView();
	}

	private void detailkamar() {
		// TODO Auto-generated method stub
		if (kamar_id != null) {
			Cursor getkamar = mDbHelper.detail_kamar(kamar_id);
			startManagingCursor(getkamar);
			kamarnama.setText(getkamar.getString(getkamar
					.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_NAMA)));
			kamarisi.setText(getkamar.getString(getkamar
					.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_ISI)));
			kamarharga.setText(getkamar.getString(getkamar
					.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_HARGA)));
			foto = (getkamar.getString(getkamar
					.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_FOTO)));
			kamarukuranpanjang
					.setText(getkamar.getString(getkamar
							.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_UKURAN_PANJANG)));
			kamarukuranlebar
					.setText(getkamar.getString(getkamar
							.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_UKURAN_LEBAR)));
			kamarukuranjenis
					.setText(getkamar.getString(getkamar
							.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_UKURAN_JENIS)));
			kamarminkontrak
					.setText(getkamar.getString(getkamar
							.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_MINIMAL_KONTRAK)));
			kamarminkontrakjenis
					.setText(getkamar.getString(getkamar
							.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_MINIMAL_KONTRAK_JENIS)));
			kamarstatus
					.setText(getkamar.getString(getkamar
							.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_KONTRAK_STATUS)));
			kamarsampaitanggal
					.setText(getkamar.getString(getkamar
							.getColumnIndexOrThrow(LocalDatabase.KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL)));
			stopManagingCursor(getkamar);
			Cursor fasilitasint = mDbHelper.get_detail_kamar(kamar_id);
			startManagingCursor(fasilitasint);
			String[] from = new String[] { LocalDatabase.KEY_FASILITAS_INT_NAMA };
			int[] to = new int[] { R.id.fasilitasintnama };

			SimpleCursorAdapter adapter = new SimpleCursorAdapter(this,
					R.layout.tvlistfasilitasint, fasilitasint, from, to);
			setListAdapter(adapter);
		}
	}
}
