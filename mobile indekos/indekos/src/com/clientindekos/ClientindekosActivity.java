package com.clientindekos;

import android.app.ListActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;

public class ClientindekosActivity extends ListActivity {
	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle icicle) {
		super.onCreate(icicle);
		// setContentView(R.layout.main);
		String[] menu = new String[] { "Cari Indekos", "Indekos Terdekat","Sinkronisasi Data",
				"Keluar" };
		this.setListAdapter(new ArrayAdapter<String>(this,
				android.R.layout.simple_list_item_1, menu));

	}

	@Override
	protected void onListItemClick(ListView l, View v, int position, long id) {
		super.onListItemClick(l, v, position, id);

		Object o = this.getListAdapter().getItem(position);
		String pilihan = o.toString();
		tampilkanMenu(pilihan);
	}

	protected void tampilkanMenu(String pilihan) {
		Intent i = null;
		try {
			if (pilihan.equals("Cari Indekos")) {
				i = new Intent(this, CariActivity.class);
			}else if (pilihan.equals("Sinkronisasi Data")) {
				i = new Intent(this, SinkronisasiActivity.class);
			}else if(pilihan.equals("Indekos Terdekat")){
				i = new Intent(this, IndekosTerdekat.class);
			}else if (pilihan.equals("Keluar")) {
				//finish();
				System.exit(0);
			}
			startActivity(i);
		} catch (Exception e) {
			// TODO: handle exception
			e.printStackTrace();
		}
	}
}