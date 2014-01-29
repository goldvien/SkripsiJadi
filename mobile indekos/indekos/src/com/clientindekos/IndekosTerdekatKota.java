package com.clientindekos;

import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.util.Log;
import android.view.ContextMenu;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ContextMenu.ContextMenuInfo;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;
import android.widget.AdapterView.AdapterContextMenuInfo;

public class IndekosTerdekatKota extends ListActivity{

	private static final int DETAIL = Menu.FIRST;
	private static final int RUTE = Menu.FIRST+1;
	private static final int BATAL = Menu.FIRST+2;
	
	private Long kab_kota_id;
	LocalDatabase mDbHelper;
	public void onCreate(Bundle savedInstanceState){
		super.onCreate(savedInstanceState);
		mDbHelper = new LocalDatabase(this);
		mDbHelper.open();
		setContentView(R.layout.cari);//terdekat
		kab_kota_id = savedInstanceState != null?savedInstanceState.getLong(LocalDatabase.KEY_KAB_KOTA_ID):null;
		
		if(kab_kota_id == null){
			Bundle extras = getIntent().getExtras();
			kab_kota_id = extras != null? extras.getLong(LocalDatabase.KEY_KAB_KOTA_ID):null;
		}
		
		getListTerdekat();
		registerForContextMenu(getListView());
	}

	private void getListTerdekat() {
		// TODO Auto-generated method stub
		if(kab_kota_id != null){
			Cursor listIndekosTerdekat = mDbHelper.get_detail_indekos_terdekat_kota(kab_kota_id);
			startManagingCursor(listIndekosTerdekat);
			String[] from = new String[] {LocalDatabase.KEY_INDEKOS_NAMA,LocalDatabase.KEY_INDEKOS_KAB_KOTA_JARAK,
					LocalDatabase.KEY_INDEKOS_UNTUK};
			int[] to = new int[]{R.id.tvlistindekosnama,R.id.tvlistindekosjarak,R.id.tvlistindekosuntuk};
			
			SimpleCursorAdapter adapter = new SimpleCursorAdapter(this, R.layout.tvlistindekos, listIndekosTerdekat, from, to);
			setListAdapter(adapter);
		}
	}

	public void onCreateContextMenu(ContextMenu menu, View v, ContextMenuInfo menuInfo){
		super.onCreateContextMenu(menu, v, menuInfo);
		menu.add(0,DETAIL,0,"DETAIL INDEKOS");
		menu.add(0,RUTE,0,"RUTE JALAN INDEKOS");
		menu.add(0,BATAL,0,"BATAL");
	}
	
	public boolean onContextItemSelected(MenuItem item){
		switch(item.getItemId()){
		case DETAIL:
			AdapterContextMenuInfo detailindekos = (AdapterContextMenuInfo)item.getMenuInfo();
			Intent i = new Intent(this, DetailIndekos.class);
			i.putExtra(LocalDatabase.KEY_INDEKOS_ID, detailindekos.id);
			startActivity(i);
			return true;
		case RUTE:
			AdapterContextMenuInfo ruteindekos = (AdapterContextMenuInfo)item.getMenuInfo();
			i = new Intent(this, RuteIndekos.class);
			i.putExtra(LocalDatabase.KEY_INDEKOS_ID, ruteindekos.id);
			startActivity(i);
			return true;
		case BATAL:
			return true;
		}
		return super.onContextItemSelected(item);
	}

	protected void onListItemClick(ListView l, View v, int position, long id){
		super.onListItemClick(l, v, position, id);
		try{
			Log.d("ID INDEKOS", String.valueOf(id).toString());
			Intent i = new Intent(this, DetailIndekos.class);
			i.putExtra(LocalDatabase.KEY_INDEKOS_ID, id);
			startActivity(i);
		}catch(Exception e){
			e.printStackTrace();
		}
	}

	public boolean onCreateOptionsMenu(Menu menu){
		MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.kembali, menu);
        return true;
	}
	
	public boolean onOptionsItemSelected(MenuItem item) {
    	switch(item.getItemId()){
    	case R.id.menu_kembali:
    		finish();
    		break;
    	}
		return false;
    }
	
}
