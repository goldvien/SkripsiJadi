package com.clientindekos;

import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpRequestBase;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.database.Cursor;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.StrictMode;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;

public class SinkronisasiActivity extends Activity {

	private Button mulai_sinkron, kembali;
	private LocalDatabase mDbHelper;
	ProsesSink proses;
	public Handler mHandler;
	//private String URL = "http://www.android.daarelqurro.sch.id/android.php";
	private String URL = "http://10.0.2.2/indekosclient/android.php";
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
				.permitAll().build();
		StrictMode.setThreadPolicy(policy);
		mDbHelper = new LocalDatabase(this);

		mDbHelper.open();
		setContentView(R.layout.sinkron);
		mulai_sinkron = (Button) findViewById(R.id.sinkron_mulai);
		mulai_sinkron.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				// TODO Auto-generated method stub
				proses = new ProsesSink();
				proses.execute();
			}
		});
		kembali = (Button) findViewById(R.id.sinkron_kembali);
		kembali.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				// TODO Auto-generated method stub
				finish();
			}
		});
	}

	class ProsesSink extends AsyncTask<Void, Integer, Void> {

		Dialog dialog;
		ProgressBar progressBar;
		TextView tvLoading, tvPer;
		Button btnCancel;

		protected void onPreExecute() {
			super.onPreExecute();
			dialog = new Dialog(SinkronisasiActivity.this);
			dialog.setCancelable(false);
			dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
			dialog.setContentView(R.layout.proses_sink);

			progressBar = (ProgressBar) dialog.findViewById(R.id.progressBar1);
			tvLoading = (TextView) dialog.findViewById(R.id.tv1);
			tvPer = (TextView) dialog.findViewById(R.id.tvper);
			btnCancel = (Button) dialog.findViewById(R.id.btncancel);

			btnCancel.setOnClickListener(new OnClickListener() {

				public void onClick(View v) {
					proses.cancel(true);
					dialog.dismiss();
				}
			});

			dialog.show();
		}

		@Override
		protected Void doInBackground(Void... params) {
			// TODO Auto-generated method stub
			String[] serverprovinsi_id 										= fetch(URL+"?act=provinsi_id");
			String[] serverprovinsi_kode									= fetch(URL+"?act=provinsi_kode");
			String[] serverprovinsi_nama 									= fetch(URL+"?act=provinsi_nama");
			String[] serverpemilik_id										= fetch(URL+"?act=pemilik_id");
			String[] serverpemilik_no_hp									= fetch(URL+"?act=pemilik_no_hp");
			String[] serverkab_kota_id										= fetch(URL+"?act=kab_kota_id");
			String[] serverkab_kota_id_relasi_provinsi_id					= fetch(URL+"?act=kab_kota_id_relasi_provinsi_id");
			String[] serverkab_kota_kode 									= fetch(URL+"?act=kab_kota_kode");
			String[] serverkab_kota_nama 									= fetch(URL+"?act=kab_kota_nama");
			String[] serverkab_kota_long 									= fetch(URL+"?act=kab_kota_long");
			String[] serverkab_kota_lat 									= fetch(URL+"?act=kab_kota_lat");
			String[] serverindekos_id 										= fetch(URL+"?act=indekos_id");
			String[] serverindekos_id_relasi_pemilik_id 					= fetch(URL+"?act=indekos_id_relasi_pemilik_id");
			String[] serverindekos_id_relasi_kab_kota_id 					= fetch(URL+"?act=indekos_id_relasi_kab_kota_id");
			String[] serverindekos_nama 									= fetch(URL+"?act=indekos_nama");
			String[] serverindekos_untuk 									= fetch(URL+"?act=indekos_untuk");
			String[] serverindekos_keterangan 								= fetch(URL+"?act=indekos_keterangan");
			String[] serverindekos_long 									= fetch(URL+"?act=indekos_long");
			String[] serverindekos_lat 										= fetch(URL+"?act=indekos_lat");
			String[] serverindekos_kab_kota_jarak							= fetch(URL+"?act=indekos_kab_kota_jarak");
			String[] serverkamar_id 										= fetch(URL+"?act=kamar_id");
			String[] serverkamar_id_relasi_indekos_id 						= fetch(URL+"?act=kamar_id_relasi_indekos_id");
			String[] serverkamar_nama										= fetch(URL+"?act=kamar_nama");
			String[] serverkamar_harga 										= fetch(URL+"?act=kamar_harga");
			String[] serverkamar_isi 										= fetch(URL+"?act=kamar_isi");
			String[] serverkamar_ukuran_panjang 							= fetch(URL+"?act=kamar_ukuran_panjang");
			String[] serverkamar_ukuran_lebar								= fetch(URL+"?act=kamar_ukuran_lebar");
			String[] serverkamar_ukuran_jenis 								= fetch(URL+"?act=kamar_ukuran_jenis");
			String[] serverkamar_foto 										= fetch(URL+"?act=kamar_foto");
			String[] serverkamar_minimal_kontrak							= fetch(URL+"?act=kamar_minimal_kontrak");
			String[] serverkamar_minimal_kontrak_jenis 						= fetch(URL+"?act=kamar_minimal_kontrak_jenis");
			String[] serverkamar_kontrak_status								= fetch(URL+"?act=kamar_kontrak_status");
			String[] serverkamar_kontrak_dari_tanggal						= fetch(URL+"?act=kamar_kontrak_dari_tanggal");
			String[] serverkamar_kontrak_sampai_tanggal						= fetch(URL+"?act=kamar_kontrak_sampai_tanggal");
			String[] serverfasilitas_master_id								= fetch(URL+"?act=fasilitas_master_id");
			String[] serverfasilitas_master_nama							= fetch(URL+"?act=fasilitas_master_nama");
			String[] serverfasilitas_master_icon 							= fetch(URL+"?act=fasilitas_master_icon");
			String[] serverfasilitas_eks_id 								= fetch(URL+"?act=fasilitas_eks_id");
			String[] serverfasilitas_eks_id_relasi_fasilitas_master_id 		= fetch(URL+"?act=fasilitas_eks_id_relasi_fasilitas_master_id");
			String[] serverfasilitas_eks_id_relasi_kab_kota_id 				= fetch(URL+"?act=fasilitas_eks_id_relasi_kab_kota_id");
			String[] serverfasilitas_eks_nama 								= fetch(URL+"?act=fasilitas_eks_nama");
			String[] serverfasilitas_eks_long 								= fetch(URL+"?act=fasilitas_eks_long");
			String[] serverfasilitas_eks_lat 								= fetch(URL+"?act=fasilitas_eks_lat");
			String[] serverfasilitas_int_id 								= fetch(URL+"?act=fasilitas_int_id");
			String[] serverfasilitas_int_id_relasi_pemilik_id 				= fetch(URL+"?act=fasilitas_int_id_relasi_pemilik_id");
			String[] serverfasilitas_int_nama 								= fetch(URL+"?act=fasilitas_int_nama");
			String[] serverindekos_fasilitas_eks_id 						= fetch(URL+"?act=indekos_fasilitas_eks_id");
			String[] serverindekos_fasilitas_eks_id_relasi_indekos_id 		= fetch(URL+"?act=indekos_fasilitas_eks_id_relasi_indekos_id");
			String[] serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id	= fetch(URL+"?act=indekos_fasilitas_eks_id_relasi_fasilitas_eks_id");
			String[] serverindekos_fasilitas_eks_jarak						= fetch(URL+"?act=indekos_fasilitas_eks_jarak");
			String[] serverkamar_fasilitas_int_id							= fetch(URL+"?act=kamar_fasilitas_int_id");
			String[] serverkamar_fasilitas_int_id_relasi_kamar_id			= fetch(URL+"?act=kamar_fasilitas_int_id_relasi_kamar_id");
			String[] serverkamar_fasilitas_int_id_relasi_fasilitas_int_id	= fetch(URL+"?act=kamar_fasilitas_int_id_relasi_fasilitas_int_id");
			
			String[] clientprovinsi_id = selectProvinsi(1);
			if(serverprovinsi_id.length >= clientprovinsi_id.length){
				for (int i = 0; i < serverprovinsi_id.length; i++) {
					Cursor provinsi = mDbHelper.select_provinsi(serverprovinsi_id[i]);
					if(provinsi.getCount()==0){
						mDbHelper.insertProvinsi(serverprovinsi_id[i],
								serverprovinsi_kode[i], serverprovinsi_nama[i]);
					}else if(provinsi.getCount()==1){
						mDbHelper.updateProvinsi(serverprovinsi_id[i],
								serverprovinsi_kode[i], serverprovinsi_nama[i]);
					}else{
						mDbHelper.deleteProvinsi(serverprovinsi_id[i]);
						mDbHelper.insertProvinsi(serverprovinsi_id[i],
								serverprovinsi_kode[i], serverprovinsi_nama[i]);
					}
				}
			}else{
				for(int i=0;i<clientprovinsi_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("provinsi_id",clientprovinsi_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=provinsi",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
		    				mDbHelper.deleteProvinsi(clientprovinsi_id[i]);
		    			}else{
		    				mDbHelper.updateProvinsi(serverprovinsi_id[i],
									serverprovinsi_kode[i], serverprovinsi_nama[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			//======
			String[] clientpemilik_id = selectPemilik(1);
			if(serverpemilik_id.length >= clientpemilik_id.length){
				for (int i = 0; i < serverpemilik_id.length; i++) {
					Cursor pemilik = mDbHelper.select_pemilik(serverpemilik_id[i]);
					if(pemilik.getCount()==0){
						mDbHelper.insertPemilik(serverpemilik_id[i], serverpemilik_no_hp[i]);
					}else if(pemilik.getCount()==1){
						mDbHelper.updatePemilik(serverpemilik_id[i], serverpemilik_no_hp[i]);
					}else{
						mDbHelper.deletePemilik(serverpemilik_id[i]);
						mDbHelper.insertPemilik(serverpemilik_id[i], serverpemilik_no_hp[i]);
					}
				}
			}else{
				for(int i=0;i<clientpemilik_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("provinsi_id",clientpemilik_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=pemilik",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
							mDbHelper.deletePemilik(serverpemilik_id[i]);
		    			}else{
							mDbHelper.updatePemilik(serverpemilik_id[i], serverpemilik_no_hp[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			//========
			String[] clientkab_kota_id = selectKabKota(1);
			if(serverkab_kota_id.length >= clientkab_kota_id.length){
				for (int i = 0; i < serverkab_kota_id.length; i++) {
					Cursor kabkota = mDbHelper.select_kab_kota(serverkab_kota_id[i]);
					if(kabkota.getCount()==0){
						mDbHelper.insertKabKota(
								serverkab_kota_id[i],
								serverkab_kota_id_relasi_provinsi_id[i],
								serverkab_kota_kode[i], serverkab_kota_nama[i],
								serverkab_kota_long[i], serverkab_kota_lat[i]);
					}else if(kabkota.getCount()==1){
						mDbHelper
						.updateKabKota(
								serverkab_kota_id[i],
								serverkab_kota_id_relasi_provinsi_id[i],
								serverkab_kota_kode[i], serverkab_kota_nama[i],
								serverkab_kota_long[i], serverkab_kota_lat[i]);
					}else{
						mDbHelper.deleteKabkota(serverkab_kota_id[i]);
						mDbHelper
						.updateKabKota(
								serverkab_kota_id[i],
								serverkab_kota_id_relasi_provinsi_id[i],
								serverkab_kota_kode[i], serverkab_kota_nama[i],
								serverkab_kota_long[i], serverkab_kota_lat[i]);
					}
				}
			}else{
				for(int i=0;i<clientkab_kota_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("kab_kota_id",clientkab_kota_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=kab_kota",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
		    				mDbHelper.deleteKabkota(clientkab_kota_id[i]);
		    			}else{
		    				mDbHelper
							.updateKabKota(
									serverkab_kota_id[i],
									serverkab_kota_id_relasi_provinsi_id[i],
									serverkab_kota_kode[i], serverkab_kota_nama[i],
									serverkab_kota_long[i], serverkab_kota_lat[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			
			String[] clientindekos_id = selectIndekos(1);
			if(serverindekos_id.length >= clientindekos_id.length){
				for (int i = 0; i < serverindekos_id.length; i++) {
					Cursor indekos = mDbHelper.select_indekos(serverindekos_id[i]);
					if(indekos.getCount()==0){
						mDbHelper.insertIndekos(
								serverindekos_id[i],
								serverindekos_id_relasi_pemilik_id[i],
								serverindekos_id_relasi_kab_kota_id[i],
								serverindekos_nama[i], serverindekos_untuk[i],
								serverindekos_keterangan[i], serverindekos_long[i],
								serverindekos_lat[i],serverindekos_kab_kota_jarak[i]);
					}else if(indekos.getCount()==1){
						mDbHelper
						.updateIndekos(
								serverindekos_id[i],
								serverindekos_id_relasi_pemilik_id[i],
								serverindekos_id_relasi_kab_kota_id[i],
								serverindekos_nama[i], serverindekos_untuk[i],
								serverindekos_keterangan[i], serverindekos_long[i],
								serverindekos_lat[i],serverindekos_kab_kota_jarak[i]);
					}else{
						mDbHelper.deleteIndekos(serverindekos_id[i]);
						mDbHelper
						.updateIndekos(
								serverindekos_id[i],
								serverindekos_id_relasi_pemilik_id[i],
								serverindekos_id_relasi_kab_kota_id[i],
								serverindekos_nama[i], serverindekos_untuk[i],
								serverindekos_keterangan[i], serverindekos_long[i],
								serverindekos_lat[i],serverindekos_kab_kota_jarak[i]);
					}
				}
			}else{
				for(int i=0;i<clientindekos_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("indekos_id",clientindekos_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=indekos",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
		    				mDbHelper.deleteIndekos(clientindekos_id[i]);
		    			}else{
							mDbHelper
							.updateIndekos(
									serverindekos_id[i],
									serverindekos_id_relasi_pemilik_id[i],
									serverindekos_id_relasi_kab_kota_id[i],
									serverindekos_nama[i], serverindekos_untuk[i],
									serverindekos_keterangan[i], serverindekos_long[i],
									serverindekos_lat[i],serverindekos_kab_kota_jarak[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			
			//sudah benar
			String[] clientkamar_id = selectKamar(1);
			if(serverkamar_id.length >= clientkamar_id.length){
				for (int i = 0; i < serverkamar_id.length; i++) {
					Cursor kamar = mDbHelper.select_kamar(serverkamar_id[i]);
					if(kamar.getCount()==0){
						mDbHelper.insertKamar(serverkamar_id[i],
								serverkamar_id_relasi_indekos_id[i],
								serverkamar_nama[i],serverkamar_harga[i],
								serverkamar_isi[i],
								serverkamar_ukuran_panjang[i],
								serverkamar_ukuran_lebar[i],
								serverkamar_ukuran_jenis[i],
								serverkamar_foto[i],
								serverkamar_minimal_kontrak[i],
								serverkamar_minimal_kontrak_jenis[i],
								serverkamar_kontrak_status[i],
								serverkamar_kontrak_dari_tanggal[i],
								serverkamar_kontrak_sampai_tanggal[i]);
					}else if(kamar.getCount()==1){
						mDbHelper
						.updateKamar(serverkamar_id[i],
								serverkamar_id_relasi_indekos_id[i],
								serverkamar_nama[i],serverkamar_harga[i],
								serverkamar_isi[i],
								serverkamar_ukuran_panjang[i],
								serverkamar_ukuran_lebar[i],
								serverkamar_ukuran_jenis[i],
								serverkamar_foto[i],
								serverkamar_minimal_kontrak[i],
								serverkamar_minimal_kontrak_jenis[i],
								serverkamar_kontrak_status[i],
								serverkamar_kontrak_dari_tanggal[i],
								serverkamar_kontrak_sampai_tanggal[i]);
					}else{
						mDbHelper.deleteKamar(serverkamar_id[i]);
						mDbHelper
						.updateKamar(serverkamar_id[i],
								serverkamar_id_relasi_indekos_id[i],
								serverkamar_nama[i],serverkamar_harga[i],
								serverkamar_isi[i],
								serverkamar_ukuran_panjang[i],
								serverkamar_ukuran_lebar[i],
								serverkamar_ukuran_jenis[i],
								serverkamar_foto[i],
								serverkamar_minimal_kontrak[i],
								serverkamar_minimal_kontrak_jenis[i],
								serverkamar_kontrak_status[i],
								serverkamar_kontrak_dari_tanggal[i],
								serverkamar_kontrak_sampai_tanggal[i]);
					}
				}
			}else{
				for(int i=0;i<clientkamar_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("kamar_id",clientkamar_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=kamar",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
		    				mDbHelper.deleteKamar(clientkamar_id[i]);
		    			}else{
		    				mDbHelper
							.updateKamar(serverkamar_id[i],
									serverkamar_id_relasi_indekos_id[i],
									serverkamar_nama[i],serverkamar_harga[i],
									serverkamar_isi[i],
									serverkamar_ukuran_panjang[i],
									serverkamar_ukuran_lebar[i],
									serverkamar_ukuran_jenis[i],
									serverkamar_foto[i],
									serverkamar_minimal_kontrak[i],
									serverkamar_minimal_kontrak_jenis[i],
									serverkamar_kontrak_status[i],
									serverkamar_kontrak_dari_tanggal[i],
									serverkamar_kontrak_sampai_tanggal[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			
			//sudah benar
			String[] clientfasilitas_master_id = selectFasilitasMaster(1);
			if(serverfasilitas_master_id.length >= clientfasilitas_master_id.length){
				for (int i = 0; i < serverfasilitas_master_id.length; i++) {
					Cursor fasilitasmaster = mDbHelper.select_fasilitas_master(serverfasilitas_master_id[i]);
					if(fasilitasmaster.getCount()==0){
						mDbHelper.insertFasilitasMaster(
								serverfasilitas_master_id[i],
								serverfasilitas_master_nama[i],
								serverfasilitas_master_icon[i]);
					}else if(fasilitasmaster.getCount()==1){
						mDbHelper.updateFasilitasMaster(
								serverfasilitas_master_id[i],
								serverfasilitas_master_nama[i],
								serverfasilitas_master_icon[i]);
					}else{
						mDbHelper.deleteFasilitasMaster(serverfasilitas_master_id[i]);
						mDbHelper.updateFasilitasMaster(
								serverfasilitas_master_id[i],
								serverfasilitas_master_nama[i],
								serverfasilitas_master_icon[i]);
					}
				}
			}else{
				for(int i=0;i<clientfasilitas_master_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("fasilitas_master_id",clientfasilitas_master_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=fasilitas_master",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
		    				mDbHelper.deleteFasilitasMaster(clientfasilitas_master_id[i]);
		    			}else{
		    				mDbHelper.updateFasilitasMaster(
									serverfasilitas_master_id[i],
									serverfasilitas_master_nama[i],
									serverfasilitas_master_icon[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			
			//sudah benar
			String[] clientfasilitas_eks_id = selectFasilitasEks(1);
			if(serverfasilitas_eks_id.length >= clientfasilitas_eks_id.length){
				for (int i = 0; i < serverfasilitas_eks_id.length; i++) {
					Cursor fasilitaseks = mDbHelper.select_fasilitas_eks(serverfasilitas_eks_id[i]);
					if(fasilitaseks.getCount()==0){
						mDbHelper
						.insertFasilitasEks(
								serverfasilitas_eks_id[i],
								serverfasilitas_eks_id_relasi_fasilitas_master_id[i],
								serverfasilitas_eks_id_relasi_kab_kota_id[i],
								serverfasilitas_eks_nama[i],
								serverfasilitas_eks_long[i],
								serverfasilitas_eks_lat[i]);
					}else if(fasilitaseks.getCount()==1){
						mDbHelper
						.updateFasilitasEks(
								serverfasilitas_eks_id[i],
								serverfasilitas_eks_id_relasi_fasilitas_master_id[i],
								serverfasilitas_eks_id_relasi_kab_kota_id[i],
								serverfasilitas_eks_nama[i],
								serverfasilitas_eks_long[i],
								serverfasilitas_eks_lat[i]);
					}else{
						mDbHelper.deleteFasilitasEks(serverfasilitas_eks_id[i]);
						mDbHelper
						.updateFasilitasEks(
								serverfasilitas_eks_id[i],
								serverfasilitas_eks_id_relasi_fasilitas_master_id[i],
								serverfasilitas_eks_id_relasi_kab_kota_id[i],
								serverfasilitas_eks_nama[i],
								serverfasilitas_eks_long[i],
								serverfasilitas_eks_lat[i]);
					}
				}
			}else{
				for(int i=0;i<clientfasilitas_eks_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("fasilitas_eks_id",clientfasilitas_eks_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=fasilitas_eks",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
		    				mDbHelper.deleteFasilitasEks(clientfasilitas_eks_id[i]);
		    			}else{
		    				mDbHelper
							.updateFasilitasEks(
									serverfasilitas_eks_id[i],
									serverfasilitas_eks_id_relasi_fasilitas_master_id[i],
									serverfasilitas_eks_id_relasi_kab_kota_id[i],
									serverfasilitas_eks_nama[i],
									serverfasilitas_eks_long[i],
									serverfasilitas_eks_lat[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			
			//sudah benar
			String[] clientfasilitas_int_id = selectFasilitasInt(1);
			if(serverfasilitas_int_id.length >= clientfasilitas_int_id.length){
				for (int i = 0; i < serverfasilitas_int_id.length; i++) {
					Cursor fasilitasint = mDbHelper.select_fasilitas_int(serverfasilitas_int_id[i]);
					if(fasilitasint.getCount()==0){
						mDbHelper.insertFasilitasInt(
							serverfasilitas_int_id[i],
							serverfasilitas_int_id_relasi_pemilik_id[i],
							serverfasilitas_int_nama[i]);
					}else if(fasilitasint.getCount()==1){
						mDbHelper
						.updateFasilitasInt(
								serverfasilitas_int_id[i],
								serverfasilitas_int_id_relasi_pemilik_id[i],
								serverfasilitas_int_nama[i]);
					}else{
						mDbHelper.deleteFasilitasInt(serverfasilitas_int_id[i]);
						mDbHelper
						.updateFasilitasInt(
								serverfasilitas_int_id[i],
								serverfasilitas_int_id_relasi_pemilik_id[i],
								serverfasilitas_int_nama[i]);
					}
				}
			}else{
				for(int i=0;i<clientfasilitas_int_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("fasilitas_int_id",clientfasilitas_int_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=fasilitas_int",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
		    				mDbHelper.deleteFasilitasInt(clientfasilitas_int_id[i]);
		    			}else{
		    				mDbHelper
							.updateFasilitasInt(
									serverfasilitas_int_id[i],
									serverfasilitas_int_id_relasi_pemilik_id[i],
									serverfasilitas_int_nama[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			
			String[] clientindekos_fasilitas_eks_id = selectIndekosFasilitasEks(1);
			if(serverindekos_fasilitas_eks_id.length >= clientindekos_fasilitas_eks_id.length){
				for (int i = 0; i < serverindekos_fasilitas_eks_id.length; i++) {
					Cursor indekosfasilitaseks = mDbHelper.select_indekos_fasilitas_eks(serverindekos_fasilitas_eks_id[i]);
					if(indekosfasilitaseks.getCount()==0){
						mDbHelper.insertIndekosFasilitasEks(
								serverindekos_fasilitas_eks_id[i],
								serverindekos_fasilitas_eks_id_relasi_indekos_id[i],
								serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i],
								serverindekos_fasilitas_eks_jarak[i]);
					}else if(indekosfasilitaseks.getCount()==1){
						mDbHelper.updateIndekosFasilitasEks(
								serverindekos_fasilitas_eks_id[i],
								serverindekos_fasilitas_eks_id_relasi_indekos_id[i],
								serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i],
								serverindekos_fasilitas_eks_jarak[i]);
					}else{
						mDbHelper.deleteIndekosFasilitasEks(serverindekos_fasilitas_eks_id[i]);
						mDbHelper.updateIndekosFasilitasEks(
								serverindekos_fasilitas_eks_id[i],
								serverindekos_fasilitas_eks_id_relasi_indekos_id[i],
								serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i],
								serverindekos_fasilitas_eks_jarak[i]);
					}
				}
			}else{
				for(int i=0;i<clientindekos_fasilitas_eks_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("indekos_fasilitas_eks_id",clientindekos_fasilitas_eks_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=indekos_fasilitas_eks",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
		    				mDbHelper.deleteIndekosFasilitasEks(clientindekos_fasilitas_eks_id[i]);
		    			}else{
		    				mDbHelper.updateIndekosFasilitasEks(
									serverindekos_fasilitas_eks_id[i],
									serverindekos_fasilitas_eks_id_relasi_indekos_id[i],
									serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i],
									serverindekos_fasilitas_eks_jarak[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			
			//sudah benar
			String[] clientkamar_fasilitas_int_id = selectKamarFasilitasInt(1);
			if(serverkamar_fasilitas_int_id.length >= clientkamar_fasilitas_int_id.length){
				for (int i = 0; i < serverkamar_fasilitas_int_id.length; i++) {
					Cursor kamarfasilitasint = mDbHelper.select_kamar_fasilitas_int(serverkamar_fasilitas_int_id[i]);
					if(kamarfasilitasint.getCount()==0){
						mDbHelper
						.insertKamarFasilitasInt(
								serverkamar_fasilitas_int_id[i],
								serverkamar_fasilitas_int_id_relasi_kamar_id[i],
								serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
					}else if(kamarfasilitasint.getCount()==1){
						mDbHelper
						.updateKamarFasilitasInt(
								serverkamar_fasilitas_int_id[i],
								serverkamar_fasilitas_int_id_relasi_kamar_id[i],
								serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
					}else{
						mDbHelper.deleteKamarFasilitasInt(serverkamar_fasilitas_int_id[i]);
						mDbHelper
						.updateKamarFasilitasInt(
								serverkamar_fasilitas_int_id[i],
								serverkamar_fasilitas_int_id_relasi_kamar_id[i],
								serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
					}
				}
			}else{
				for(int i=0;i<clientkamar_fasilitas_int_id.length;i++){
					ArrayList<NameValuePair>postParameters=new ArrayList<NameValuePair>();
		    		postParameters.add(new BasicNameValuePair("kamar_fasilitas_int_id",clientkamar_fasilitas_int_id[i]));
		    		String res=null;
		    		try{
		    			res=CustomHttpClient.executeHttpPost(URL+"?act=kamar_fasilitas_int",postParameters);
		    			String rs=res.toString();
		    			rs=rs.trim();
		    			rs=rs.replaceAll("\\s+","");
		    			if(rs.equals("0")){
		    				mDbHelper.deleteKamarFasilitasInt(clientkamar_fasilitas_int_id[i]);
		    			}else{
		    				mDbHelper
							.updateKamarFasilitasInt(
									serverkamar_fasilitas_int_id[i],
									serverkamar_fasilitas_int_id_relasi_kamar_id[i],
									serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
		    			}
		    		}catch(Exception e){
		    			e.printStackTrace();
		    		}
				}
			}
			
			return null;
		}

		@Override
		protected void onProgressUpdate(Integer... values) {
			super.onProgressUpdate(values);
			progressBar.setProgress(values[0]);
			tvLoading.setText("Loading...  " + values[0] + " %");
			tvPer.setText(values[0] + " %");
		}
		
		@Override
		protected void onPostExecute(Void result) {
			super.onPostExecute(result);

			dialog.dismiss();

			AlertDialog alert = new AlertDialog.Builder(
					SinkronisasiActivity.this).create();

			alert.setTitle("Sinkronisasi selesai");
			alert.setMessage("Sinkronisasi data berhasil dilakukan");
			alert.setButton("Selesai", new DialogInterface.OnClickListener() {

				public void onClick(DialogInterface dialog, int which) {
					dialog.dismiss();

				}
			});
			alert.show();
		}
	}
	
	 public String LongData(String Data) {
		String LongData = "";
		for (int i = 0; i < Data.length(); i++) {
			if (Data.charAt(i) == ' ') {
				LongData += '~';
			} else {
				LongData += Data.charAt(i);
			}

		}
		return LongData;
	}

	public String[] selectProvinsi(int column) {
		Cursor provinsi = mDbHelper.select_all_provinsi();
		String result[] = new String[provinsi.getCount()];
		provinsi.moveToFirst();
		int i = 0;
		while (provinsi.isAfterLast() == false) {
			result[i++] = provinsi.getString(column);
			provinsi.moveToNext();
		}
		provinsi.close();
		return result;
	}

	public String[] selectPemilik(int column) {
		Cursor pemilik = mDbHelper.select_all_pemilik();
		String result[] = new String[pemilik.getCount()];
		pemilik.moveToFirst();
		int i = 0;
		while (pemilik.isAfterLast() == false) {
			result[i++] = pemilik.getString(column);
			pemilik.moveToNext();
		}
		pemilik.close();
		return result;
	}

	public String[] selectKabKota(int column) {
		Cursor kab_kota = mDbHelper.select_all_kab_kota();
		String result[] = new String[kab_kota.getCount()];
		kab_kota.moveToFirst();
		int i = 0;
		while (kab_kota.isAfterLast() == false) {
			result[i++] = kab_kota.getString(column);
			kab_kota.moveToNext();
		}
		kab_kota.close();
		return result;
	}

	public String[] selectIndekos(int column) {
		Cursor indekos = mDbHelper.select_all_indekos();
		String result[] = new String[indekos.getCount()];
		indekos.moveToFirst();
		int i = 0;
		while (indekos.isAfterLast() == false) {
			result[i++] = indekos.getString(column);
			indekos.moveToNext();
		}
		indekos.close();
		return result;
	}

	public String[] selectKamar(int column) {
		Cursor kamar = mDbHelper.select_all_kamar();
		String result[] = new String[kamar.getCount()];
		kamar.moveToFirst();
		int i = 0;
		while (kamar.isAfterLast() == false) {
			result[i++] = kamar.getString(column);
			kamar.moveToNext();
		}
		kamar.close();
		return result;
	}

	public String[] selectFasilitasMaster(int column) {
		Cursor fasilitas_master = mDbHelper.select_all_fasilitas_master();
		String result[] = new String[fasilitas_master.getCount()];
		fasilitas_master.moveToFirst();
		int i = 0;
		while (fasilitas_master.isAfterLast() == false) {
			result[i++] = fasilitas_master.getString(column);
			fasilitas_master.moveToNext();
		}
		fasilitas_master.close();
		return result;
	}

	public String[] selectFasilitasEks(int column) {
		Cursor fasilitas_eks = mDbHelper.select_all_fasilitas_eks();
		String result[] = new String[fasilitas_eks.getCount()];
		fasilitas_eks.moveToFirst();
		int i = 0;
		while (fasilitas_eks.isAfterLast() == false) {
			result[i++] = fasilitas_eks.getString(column);
			fasilitas_eks.moveToNext();
		}
		fasilitas_eks.close();
		return result;
	}

	public String[] selectFasilitasInt(int column) {
		Cursor fasilitas_int = mDbHelper.select_all_fasilitas_int();
		String result[] = new String[fasilitas_int.getCount()];
		fasilitas_int.moveToFirst();
		int i = 0;
		while (fasilitas_int.isAfterLast() == false) {
			result[i++] = fasilitas_int.getString(column);
			fasilitas_int.moveToNext();
		}
		fasilitas_int.close();
		return result;
	}

	public String[] selectIndekosFasilitasEks(int column) {
		Cursor indekos_fasilitas_eks = mDbHelper
				.select_all_indekos_fasilitas_eks();
		String result[] = new String[indekos_fasilitas_eks.getCount()];
		indekos_fasilitas_eks.moveToFirst();
		int i = 0;
		while (indekos_fasilitas_eks.isAfterLast() == false) {
			result[i++] = indekos_fasilitas_eks.getString(column);
			indekos_fasilitas_eks.moveToNext();
		}
		indekos_fasilitas_eks.close();
		return result;
	}

	public String[] selectKamarFasilitasInt(int column) {
		Cursor kamar_fasilitas_int = mDbHelper.select_all_kamar_fasilitas_int();
		String result[] = new String[kamar_fasilitas_int.getCount()];
		kamar_fasilitas_int.moveToFirst();
		int i = 0;
		while (kamar_fasilitas_int.isAfterLast() == false) {
			result[i++] = kamar_fasilitas_int.getString(column);
			kamar_fasilitas_int.moveToNext();
		}
		kamar_fasilitas_int.close();
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
}
