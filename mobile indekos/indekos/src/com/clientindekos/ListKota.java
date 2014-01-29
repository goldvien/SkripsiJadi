package com.clientindekos;

import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.view.ContextMenu;
import android.view.ContextMenu.ContextMenuInfo;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView.AdapterContextMenuInfo;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;

public class ListKota extends ListActivity{

	private static final int TERDEKAT = Menu.FIRST;
	private static final int FASILITAS_EKS = Menu.FIRST+1;
	private static final int BATAL = Menu.FIRST+2;
	private Long provinsi_id;
	LocalDatabase mDbHelper;
	
	public void onCreate(Bundle savedInstanceState){
		super.onCreate(savedInstanceState);
		mDbHelper = new LocalDatabase(this);
		mDbHelper.open();
		setContentView(R.layout.cari);//kota
		provinsi_id = savedInstanceState != null?savedInstanceState.getLong(LocalDatabase.KEY_PROVINSI_ID):null;
		
		if(provinsi_id == null){
			Bundle extras = getIntent().getExtras();
			provinsi_id = extras != null? extras.getLong(LocalDatabase.KEY_PROVINSI_ID):null;
		}
		
		getListKota();
		registerForContextMenu(getListView());
	}
	
	private void getListKota() {
		// TODO Auto-generated method stub
		if(provinsi_id != null){
			Cursor listKotaCursor = mDbHelper.get_data_kota_provinsi(provinsi_id);
			startManagingCursor(listKotaCursor);
			String[] from = new String[] {LocalDatabase.KEY_KAB_KOTA_NAMA};
			int[] to = new int[]{R.id.tvkotarows};
			
			SimpleCursorAdapter adapter = new SimpleCursorAdapter(this, R.layout.tvkotarows, listKotaCursor, from, to);
			setListAdapter(adapter);
		}
	}

	public void onCreateContextMenu(ContextMenu menu, View v, ContextMenuInfo menuInfo){
		super.onCreateContextMenu(menu, v, menuInfo);
		menu.add(0,TERDEKAT,0,"JARAK TERDEKAT");
		menu.add(0,FASILITAS_EKS,0,"TERDEKAT FASILITAS");
		menu.add(0,BATAL,0,"BATAL");
	}
	
	public boolean onContextItemSelected(MenuItem item){
		switch(item.getItemId()){
		case TERDEKAT:
			AdapterContextMenuInfo dataKota = (AdapterContextMenuInfo)item.getMenuInfo();
			Intent i = new Intent(this, IndekosTerdekatKota.class);//belum dibuat fungsinya
			i.putExtra(LocalDatabase.KEY_KAB_KOTA_ID, dataKota.id);
			startActivity(i);
			return true;
		case FASILITAS_EKS:
			AdapterContextMenuInfo fasilitasmaster = (AdapterContextMenuInfo)item.getMenuInfo();
			i = new Intent(this, FasilitasMaster.class);//belum dibuat fungsinya
			i.putExtra(LocalDatabase.KEY_KAB_KOTA_ID, fasilitasmaster.id);
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
			Intent i = new Intent(this, FasilitasMaster.class);
			i.putExtra(LocalDatabase.KEY_KAB_KOTA_ID, id);
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
