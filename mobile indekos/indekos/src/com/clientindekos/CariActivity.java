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

public class CariActivity extends ListActivity {
	
	private LocalDatabase mDbHelper;
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.cari);
		mDbHelper = new LocalDatabase(this);
		mDbHelper.open();
		fillData();
		getListView();
	}
	
	private void fillData() {
		// TODO Auto-generated method stub
		Cursor provCursor = mDbHelper.select_all_provinsi();
		startManagingCursor(provCursor);
		String[] from = new String[] {LocalDatabase.KEY_PROVINSI_NAMA};
		int[] to = new int[]{R.id.tvprovinsirows};
		SimpleCursorAdapter provinsi = new SimpleCursorAdapter(this, R.layout.tvprovinsirows, provCursor, from, to);
		setListAdapter(provinsi);
	}
	
	protected void onListItemClick(ListView l, View v, int position, long id){
		super.onListItemClick(l, v, position, id);
		try{
			Intent i = new Intent(this, ListKota.class);
			i.putExtra(LocalDatabase.KEY_PROVINSI_ID, id);
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
