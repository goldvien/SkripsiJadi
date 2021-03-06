package com.clientindekos;

import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;

public class FasilitasMaster extends ListActivity{

	private Long kab_kota_id;
	LocalDatabase mDbHelper;
	public void onCreate(Bundle savedInstanceState){
		super.onCreate(savedInstanceState);
		mDbHelper = new LocalDatabase(this);
		mDbHelper.open();
		setContentView(R.layout.cari);//fasilitasmaster
		kab_kota_id = savedInstanceState != null?savedInstanceState.getLong(LocalDatabase.KEY_KAB_KOTA_ID):null;
		
		if(kab_kota_id == null){
			Bundle extras = getIntent().getExtras();
			kab_kota_id = extras != null? extras.getLong(LocalDatabase.KEY_KAB_KOTA_ID):null;
		}
		
		getListFasilitasMaster();
		getListView();
	}
	
	private void getListFasilitasMaster() {
		// TODO Auto-generated method stub
		Cursor getFasilitasMaster = mDbHelper.get_fasilitas_master(kab_kota_id);
		startManagingCursor(getFasilitasMaster);
		String[] from = new String[] {LocalDatabase.KEY_FASILITAS_MASTER_NAMA};
		int[] to = new int[]{R.id.tvfasilitasmaster};
		
		SimpleCursorAdapter adapter = new SimpleCursorAdapter(this, R.layout.tvfasilitasmaster, getFasilitasMaster, from, to);
		setListAdapter(adapter);
	}

	protected void onListItemClick(ListView l, View v, int position, long id){
		super.onListItemClick(l, v, position, id);
		try{
			Intent i = new Intent(this, FasilitasEks.class);
			i.putExtra(LocalDatabase.KEY_FASILITAS_MASTER_ID, id);
			i.putExtra(LocalDatabase.KEY_KAB_KOTA_ID, kab_kota_id);
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
