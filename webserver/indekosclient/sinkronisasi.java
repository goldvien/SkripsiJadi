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

import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.database.Cursor;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.StrictMode;
import android.util.Log;
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

			String[] serverprovinsi_id 										= fetch("http://10.0.2.2/indekosclient/android.php?act=provinsi_id");
			String[] serverprovinsi_kode									= fetch("http://10.0.2.2/indekosclient/android.php?act=provinsi_kode");
			String[] serverprovinsi_nama 									= fetch("http://10.0.2.2/indekosclient/android.php?act=provinsi_nama");
			String[] serverkab_kota_id										= fetch("http://10.0.2.2/indekosclient/android.php?act=kab_kota_id");
			String[] serverkab_kota_id_relasi_provinsi_id					= fetch("http://10.0.2.2/indekosclient/android.php?act=kab_kota_id_relasi_provinsi_id");
			String[] serverkab_kota_kode 									= fetch("http://10.0.2.2/indekosclient/android.php?act=kab_kota_kode");
			String[] serverkab_kota_nama 									= fetch("http://10.0.2.2/indekosclient/android.php?act=kab_kota_nama");
			String[] serverkab_kota_long 									= fetch("http://10.0.2.2/indekosclient/android.php?act=kab_kota_long");
			String[] serverkab_kota_lat 									= fetch("http://10.0.2.2/indekosclient/android.php?act=kab_kota_lat");
			String[] serverindekos_id 										= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_id");
			String[] serverindekos_id_relasi_pemilik_id 					= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_id_relasi_pemilik_id");
			String[] serverindekos_id_relasi_kab_kota_id 					= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_id_relasi_kab_kota_id");
			String[] serverindekos_nama 									= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_nama");
			String[] serverindekos_untuk 									= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_untuk");
			String[] serverindekos_keterangan 								= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_keterangan");
			String[] serverindekos_long 									= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_long");
			String[] serverindekos_lat 										= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_lat");
			String[] serverkamar_id 										= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_id");
			String[] serverkamar_id_relasi_indekos_id 						= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_id_relasi_indekos_id");
			String[] serverkamar_nama										= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_nama");
			String[] serverkamar_harga 										= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_harga");
			String[] serverkamar_isi 										= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_isi");
			String[] serverkamar_ukuran_panjang 							= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_ukuran_panjang");
			String[] serverkamar_ukuran_lebar								= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_ukuran_lebar");
			String[] serverkamar_ukuran_jenis 								= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_ukuran_jenis");
			String[] serverkamar_foto 										= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_foto");
			String[] serverkamar_minimal_kontrak							= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_minimal_kontrak");
			String[] serverkamar_minimal_kontrak_jenis 						= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_minimal_kontrak_jenis");
			String[] serverkamar_kontrak_status								= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_kontrak_status");
			String[] serverkamar_kontrak_dari_tanggal						= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_kontrak_dari_tanggal");
			String[] serverkamar_kontrak_sampai_tanggal						= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_kontrak_sampai_tanggal");
			String[] serverfasilitas_master_id								= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_master_id");
			String[] serverfasilitas_master_nama							= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_master_nama");
			String[] serverfasilitas_master_icon 							= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_master_icon");
			String[] serverfasilitas_eks_id 								= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_eks_id");
			String[] serverfasilitas_eks_id_relasi_fasilitas_master_id 		= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_eks_id_relasi_fasilitas_master_id");
			String[] serverfasilitas_eks_id_relasi_kab_kota_id 				= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_eks_id_relasi_kab_kota_id");
			String[] serverfasilitas_eks_nama 								= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_eks_nama");
			String[] serverfasilitas_eks_long 								= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_eks_long");
			String[] serverfasilitas_eks_lat 								= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_eks_lat");
			String[] serverfasilitas_int_id 								= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_int_id");
			String[] serverfasilitas_int_id_relasi_pemilik_id 				= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_int_id_relasi_pemilik_id");
			String[] serverfasilitas_int_nama 								= fetch("http://10.0.2.2/indekosclient/android.php?act=fasilitas_int_nama");
			String[] serverindekos_fasilitas_eks_id 						= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_fasilitas_eks_id");
			String[] serverindekos_fasilitas_eks_id_relasi_indekos_id 		= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_fasilitas_eks_id_relasi_indekos_id");
			String[] serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id	= fetch("http://10.0.2.2/indekosclient/android.php?act=indekos_fasilitas_eks_id_relasi_fasilitas_eks_id");
			String[] serverkamar_fasilitas_int_id							= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_fasilitas_int_id");
			String[] serverkamar_fasilitas_int_id_relasi_kamar_id			= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_fasilitas_int_id_relasi_kamar_id");
			String[] serverkamar_fasilitas_int_id_relasi_fasilitas_int_id	= fetch("http://10.0.2.2/indekosclient/android.php?act=kamar_fasilitas_int_id_relasi_fasilitas_int_id");
			
			String[] clientprovinsi_id = selectProvinsi(1);
			for (int i = 0; i < serverprovinsi_id.length; i++) {
				if(clientprovinsi_id.length == 0){
					Log.d("Insert Provinsi","Data Id ="+serverprovinsi_id[i]+" Kode ="+serverprovinsi_kode[i]+" Nama ="+serverprovinsi_nama[i]);
					mDbHelper.insertProvinsi(serverprovinsi_id[i],
							serverprovinsi_kode[i], serverprovinsi_nama[i]);
				}else if(clientprovinsi_id.length <= serverprovinsi_id.length){
					if (serverprovinsi_id[i]
							.equalsIgnoreCase(clientprovinsi_id[i])) {

						Log.d("Update Provinsi","Data Id ="+serverprovinsi_id[i]+" Kode ="+serverprovinsi_kode[i]+" Nama ="+serverprovinsi_nama[i]);
						mDbHelper.updateProvinsi(serverprovinsi_id[i],
								serverprovinsi_kode[i], serverprovinsi_nama[i]);
						break;
					} else if (i >= clientprovinsi_id.length+1) {
						Log.d("Insert Provinsi","Data Id ="+serverprovinsi_id[i]+" Kode ="+serverprovinsi_kode[i]+" Nama ="+serverprovinsi_nama[i]);
						mDbHelper.insertProvinsi(serverprovinsi_id[i],
								serverprovinsi_kode[i], serverprovinsi_nama[i]);
					}
				}
			}
			
			String[] clientkab_kota_id = selectKabKota(1);
			for (int i = 0; i < serverkab_kota_id.length; i++) {
				if(clientkab_kota_id.length==0){
					Log.d("Insert kota","Data id="+
							serverkab_kota_id[i]+" relasi provinsi ="+
							serverkab_kota_id_relasi_provinsi_id[i]+" kode ="+
							serverkab_kota_kode[i]+" nama ="+serverkab_kota_nama[i]+" long ="+
							serverkab_kota_long[i]+" lat ="+serverkab_kota_lat[i]);
					mDbHelper.insertKabKota(
							serverkab_kota_id[i],
							serverkab_kota_id_relasi_provinsi_id[i],
							serverkab_kota_kode[i], serverkab_kota_nama[i],
							serverkab_kota_long[i], serverkab_kota_lat[i]);
				}else if(clientkab_kota_id.length <= serverkab_kota_id.length){
					if (serverkab_kota_id[i].equalsIgnoreCase(clientkab_kota_id[i])) {
						Log.d("Update kota","Data id="+
								serverkab_kota_id[i]+" relasi provinsi ="+
								serverkab_kota_id_relasi_provinsi_id[i]+" kode ="+
								serverkab_kota_kode[i]+" nama ="+serverkab_kota_nama[i]+" long ="+
								serverkab_kota_long[i]+" lat ="+serverkab_kota_lat[i]);
						mDbHelper
								.updateKabKota(
										serverkab_kota_id[i],
										serverkab_kota_id_relasi_provinsi_id[i],
										serverkab_kota_kode[i], serverkab_kota_nama[i],
										serverkab_kota_long[i], serverkab_kota_lat[i]);
						break;
					} else if (i >= clientkab_kota_id.length+1) {
						Log.d("Insert kota","Data id="+
								serverkab_kota_id[i]+" relasi provinsi ="+
								serverkab_kota_id_relasi_provinsi_id[i]+" kode ="+
								serverkab_kota_kode[i]+" nama ="+serverkab_kota_nama[i]+" long ="+
								serverkab_kota_long[i]+" lat ="+serverkab_kota_lat[i]);
						mDbHelper.insertKabKota(
								serverkab_kota_id[i],
								serverkab_kota_id_relasi_provinsi_id[i],
								serverkab_kota_kode[i], serverkab_kota_nama[i],
								serverkab_kota_long[i], serverkab_kota_lat[i]);
					}
				}
			}

			String[] clientindekos_id = selectIndekos(1);
			for (int i = 0; i < serverindekos_id.length; i++) {
				if(clientindekos_id.length == 0){
					Log.d("Insert indekos","Data id="+
							serverindekos_id[i]+" relasi pemilik ="+
							serverindekos_id_relasi_pemilik_id[i]+" relasi kab kota ="+
							serverindekos_id_relasi_kab_kota_id[i]+" nama ="+
							serverindekos_nama[i]+" untuk="+serverindekos_untuk[i]+" keterangan ="+
							serverindekos_keterangan[i]+" Lat ="+serverindekos_long[i]+" Long ="+
							serverindekos_lat[i]);
					mDbHelper.insertIndekos(
							serverindekos_id[i],
							serverindekos_id_relasi_pemilik_id[i],
							serverindekos_id_relasi_kab_kota_id[i],
							serverindekos_nama[i], serverindekos_untuk[i],
							serverindekos_keterangan[i], serverindekos_long[i],
							serverindekos_lat[i]);
				}else if(clientindekos_id.length <= serverindekos_id.length){
					if (serverindekos_id[i].equalsIgnoreCase(clientindekos_id[i])) {
						Log.d("Update indekos","Data id="+
								serverindekos_id[i]+" relasi pemilik ="+
								serverindekos_id_relasi_pemilik_id[i]+" relasi kab kota ="+
								serverindekos_id_relasi_kab_kota_id[i]+" nama ="+
								serverindekos_nama[i]+" untuk="+serverindekos_untuk[i]+" keterangan ="+
								serverindekos_keterangan[i]+" Lat ="+serverindekos_long[i]+" Long ="+
								serverindekos_lat[i]);
						mDbHelper
								.updateIndekos(
										serverindekos_id[i],
										serverindekos_id_relasi_pemilik_id[i],
										serverindekos_id_relasi_kab_kota_id[i],
										serverindekos_nama[i], serverindekos_untuk[i],
										serverindekos_keterangan[i], serverindekos_long[i],
										serverindekos_lat[i]);
						break;
					} else if (i >= clientindekos_id.length+1) {
						Log.d("Insert indekos","Data id="+
								serverindekos_id[i]+" relasi pemilik ="+
								serverindekos_id_relasi_pemilik_id[i]+" relasi kab kota ="+
								serverindekos_id_relasi_kab_kota_id[i]+" nama ="+
								serverindekos_nama[i]+" untuk="+serverindekos_untuk[i]+" keterangan ="+
								serverindekos_keterangan[i]+" Lat ="+serverindekos_long[i]+" Long ="+
								serverindekos_lat[i]);
						mDbHelper.insertIndekos(
								serverindekos_id[i],
								serverindekos_id_relasi_pemilik_id[i],
								serverindekos_id_relasi_kab_kota_id[i],
								serverindekos_nama[i], serverindekos_untuk[i],
								serverindekos_keterangan[i], serverindekos_long[i],
								serverindekos_lat[i]);
					}
					
				}
			}
			
			//sudah benar
			String[] clientkamar_id = selectKamar(1);
			for (int i = 0; i < serverkamar_id.length; i++) {
				if(clientkamar_id.length == 0){
					Log.d("Insert kamar","Data id="+serverkamar_id[i]+" relasi indekos ="+
							serverkamar_id_relasi_indekos_id[i]+" nama ="+
							serverkamar_nama[i]+" harga ="+serverkamar_harga[i]+" isi ="+
							serverkamar_isi[i]+" panjang ="+
							serverkamar_ukuran_panjang[i]+" lebar ="+
							serverkamar_ukuran_lebar[i]+" jenis ukuran ="+
							serverkamar_ukuran_jenis[i]+" foto ="+
							serverkamar_foto[i]+" minimal kontrak="+
							serverkamar_minimal_kontrak[i]+" jenis kontrak ="+
							serverkamar_minimal_kontrak_jenis[i]+" status ="+
							serverkamar_kontrak_status[i]+" dari tanggal ="+
							serverkamar_kontrak_dari_tanggal[i]+" sampai tanggal ="+
							serverkamar_kontrak_sampai_tanggal[i]);
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
				}else if(clientkamar_id.length <= serverkamar_id.length){
					if (serverkamar_id[i].equalsIgnoreCase(clientkamar_id[i])) {
						Log.d("Update kamar","Data id="+serverkamar_id[i]+" relasi indekos ="+
								serverkamar_id_relasi_indekos_id[i]+" nama ="+
								serverkamar_nama[i]+" harga ="+serverkamar_harga[i]+" isi ="+
								serverkamar_isi[i]+" panjang ="+
								serverkamar_ukuran_panjang[i]+" lebar ="+
								serverkamar_ukuran_lebar[i]+" jenis ukuran ="+
								serverkamar_ukuran_jenis[i]+" foto ="+
								serverkamar_foto[i]+" minimal kontrak="+
								serverkamar_minimal_kontrak[i]+" jenis kontrak ="+
								serverkamar_minimal_kontrak_jenis[i]+" status ="+
								serverkamar_kontrak_status[i]+" dari tanggal ="+
								serverkamar_kontrak_dari_tanggal[i]+" sampai tanggal ="+
								serverkamar_kontrak_sampai_tanggal[i]);
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
						break;
					} else if (i >= clientkamar_id.length+1) {
						Log.d("Insert kamar","Data id="+serverkamar_id[i]+" relasi indekos ="+
								serverkamar_id_relasi_indekos_id[i]+" nama ="+
								serverkamar_nama[i]+" harga ="+serverkamar_harga[i]+" isi ="+
								serverkamar_isi[i]+" panjang ="+
								serverkamar_ukuran_panjang[i]+" lebar ="+
								serverkamar_ukuran_lebar[i]+" jenis ukuran ="+
								serverkamar_ukuran_jenis[i]+" foto ="+
								serverkamar_foto[i]+" minimal kontrak="+
								serverkamar_minimal_kontrak[i]+" jenis kontrak ="+
								serverkamar_minimal_kontrak_jenis[i]+" status ="+
								serverkamar_kontrak_status[i]+" dari tanggal ="+
								serverkamar_kontrak_dari_tanggal[i]+" sampai tanggal ="+
								serverkamar_kontrak_sampai_tanggal[i]);
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
					}
					
				}
			}
			
			//sudah benar
			String[] clientfasilitas_master_id = selectFasilitasMaster(1);
			for (int i = 0; i < serverfasilitas_master_id.length; i++) {
				if(clientfasilitas_master_id.length == 0){
					Log.d("Insert fasilitas master","Data id ="+
							serverfasilitas_master_id[i]+" nama ="+
							serverfasilitas_master_nama[i]+" icon ="+
							serverfasilitas_master_icon[i]);
					mDbHelper.insertFasilitasMaster(
							serverfasilitas_master_id[i],
							serverfasilitas_master_nama[i],
							serverfasilitas_master_icon[i]);
				}else if(clientfasilitas_master_id.length <= serverfasilitas_master_id.length){
					if (serverfasilitas_master_id[i]
							.equalsIgnoreCase(clientfasilitas_master_id[i])) {
						Log.d("Update fasilitas master","Data id ="+
								serverfasilitas_master_id[i]+" nama ="+
								serverfasilitas_master_nama[i]+" icon ="+
								serverfasilitas_master_icon[i]);
						mDbHelper.updateFasilitasMaster(
								serverfasilitas_master_id[i],
								serverfasilitas_master_nama[i],
								serverfasilitas_master_icon[i]);
						break;
					} else if (i >= clientfasilitas_master_id.length+1) {
						Log.d("Insert fasilitas master","Data id ="+
								serverfasilitas_master_id[i]+" nama ="+
								serverfasilitas_master_nama[i]+" icon ="+
								serverfasilitas_master_icon[i]);
						mDbHelper.insertFasilitasMaster(
								serverfasilitas_master_id[i],
								serverfasilitas_master_nama[i],
								serverfasilitas_master_icon[i]);
					}
				}
			}
			
			//sudah benar
			String[] clientfasilitas_eks_id = selectFasilitasEks(1);
			for (int i = 0; i < serverfasilitas_eks_id.length; i++) {
				if(clientfasilitas_eks_id.length == 0){
					Log.d("Insert fasilitas eks","Data id="+serverfasilitas_eks_id[i]+" relasi fasilitas master ="+
							serverfasilitas_eks_id_relasi_fasilitas_master_id[i]+" relasi kab kota id ="+
							serverfasilitas_eks_id_relasi_kab_kota_id[i]+" fasilitas eks nama ="+
							serverfasilitas_eks_nama[i]+" fasilitas eks long ="+
							serverfasilitas_eks_long[i]+" fasilitas eks lat ="+
							serverfasilitas_eks_lat[i]);
					mDbHelper
							.insertFasilitasEks(
									serverfasilitas_eks_id[i],
									serverfasilitas_eks_id_relasi_fasilitas_master_id[i],
									serverfasilitas_eks_id_relasi_kab_kota_id[i],
									serverfasilitas_eks_nama[i],
									serverfasilitas_eks_long[i],
									serverfasilitas_eks_lat[i]);
				}else if(clientfasilitas_eks_id.length <= serverfasilitas_eks_id.length){
					if (serverfasilitas_eks_id[i]
							.equalsIgnoreCase(clientfasilitas_eks_id[i])) {
						Log.d("Update fasilitas eks","Data id="+serverfasilitas_eks_id[i]+" relasi fasilitas master ="+
								serverfasilitas_eks_id_relasi_fasilitas_master_id[i]+" relasi kab kota id ="+
								serverfasilitas_eks_id_relasi_kab_kota_id[i]+" fasilitas eks nama ="+
								serverfasilitas_eks_nama[i]+" fasilitas eks long ="+
								serverfasilitas_eks_long[i]+" fasilitas eks lat ="+
								serverfasilitas_eks_lat[i]);
						mDbHelper
								.updateFasilitasEks(
										serverfasilitas_eks_id[i],
										serverfasilitas_eks_id_relasi_fasilitas_master_id[i],
										serverfasilitas_eks_id_relasi_kab_kota_id[i],
										serverfasilitas_eks_nama[i],
										serverfasilitas_eks_long[i],
										serverfasilitas_eks_lat[i]);
						break;
					} else if (i >= clientfasilitas_eks_id.length+1) {
						Log.d("Insert fasilitas eks","Data id="+serverfasilitas_eks_id[i]+" relasi fasilitas master ="+
								serverfasilitas_eks_id_relasi_fasilitas_master_id[i]+" relasi kab kota id ="+
								serverfasilitas_eks_id_relasi_kab_kota_id[i]+" fasilitas eks nama ="+
								serverfasilitas_eks_nama[i]+" fasilitas eks long ="+
								serverfasilitas_eks_long[i]+" fasilitas eks lat ="+
								serverfasilitas_eks_lat[i]);
						mDbHelper
								.insertFasilitasEks(
										serverfasilitas_eks_id[i],
										serverfasilitas_eks_id_relasi_fasilitas_master_id[i],
										serverfasilitas_eks_id_relasi_kab_kota_id[i],
										serverfasilitas_eks_nama[i],
										serverfasilitas_eks_long[i],
										serverfasilitas_eks_lat[i]);
					}
					
				}
			}
			
			//sudah benar
			String[] clientfasilitas_int_id = selectFasilitasInt(1);
			for (int i = 0; i < serverfasilitas_int_id.length; i++) {
				if(clientfasilitas_int_id.length == 0){
					Log.d("Insert fasilitas int","Data id="+serverfasilitas_int_id[i]+" relasi pemilik_id ="+
							serverfasilitas_int_id_relasi_pemilik_id[i]+" fasilitas int nama ="+
							serverfasilitas_int_nama[i]);
					mDbHelper.insertFasilitasInt(
							serverfasilitas_int_id[i],
							serverfasilitas_int_id_relasi_pemilik_id[i],
							serverfasilitas_int_nama[i]);
				}else if(clientfasilitas_int_id.length <= serverfasilitas_int_id.length){
					if (serverfasilitas_int_id[i]
							.equalsIgnoreCase(clientfasilitas_int_id[i])) {
						Log.d("Update fasilitas int","Data id="+serverfasilitas_int_id[i]+" relasi pemilik_id ="+
								serverfasilitas_int_id_relasi_pemilik_id[i]+" fasilitas int nama ="+
								serverfasilitas_int_nama[i]);
						mDbHelper
								.updateFasilitasInt(
										serverfasilitas_int_id[i],
										serverfasilitas_int_id_relasi_pemilik_id[i],
										serverfasilitas_int_nama[i]);
						break;
					} else if (i >= clientfasilitas_int_id.length+1) {
						Log.d("Insert fasilitas int","Data id="+serverfasilitas_int_id[i]+" relasi pemilik_id ="+
								serverfasilitas_int_id_relasi_pemilik_id[i]+" fasilitas int nama ="+
								serverfasilitas_int_nama[i]);
						mDbHelper.insertFasilitasInt(
								serverfasilitas_int_id[i],
								serverfasilitas_int_id_relasi_pemilik_id[i],
								serverfasilitas_int_nama[i]);
					}
				}
			}
			
			String[] clientindekos_fasilitas_eks_id = selectIndekosFasilitasEks(1);
			for (int i = 0; i < serverindekos_fasilitas_eks_id.length; i++) {
				if(clientindekos_fasilitas_eks_id.length == 0){
					Log.d("Insert indekos fasilitas eks","Data id ="+serverindekos_fasilitas_eks_id[i]+" relasi indekos_id ="+
							serverindekos_fasilitas_eks_id_relasi_indekos_id[i]+" relasi fasilitas_eks_id ="+
							serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i]);
					mDbHelper.insertIndekosFasilitasEks(
							serverindekos_fasilitas_eks_id[i],
							serverindekos_fasilitas_eks_id_relasi_indekos_id[i],
							serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i]);
				}else if(clientindekos_fasilitas_eks_id.length <= serverindekos_fasilitas_eks_id.length){
					if (serverindekos_fasilitas_eks_id[i]
							.equalsIgnoreCase(clientindekos_fasilitas_eks_id[i])) {
						Log.d("Update indekos fasilitas eks","Data id ="+serverindekos_fasilitas_eks_id[i]+" relasi indekos_id ="+
								serverindekos_fasilitas_eks_id_relasi_indekos_id[i]+" relasi fasilitas_eks_id ="+
								serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i]);
						mDbHelper.updateIndekosFasilitasEks(
								serverindekos_fasilitas_eks_id[i],
								serverindekos_fasilitas_eks_id_relasi_indekos_id[i],
								serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i]);
						break;
					} else if (i >= clientindekos_fasilitas_eks_id.length+1) {
						Log.d("Insert indekos fasilitas eks","Data id ="+serverindekos_fasilitas_eks_id[i]+" relasi indekos_id ="+
								serverindekos_fasilitas_eks_id_relasi_indekos_id[i]+" relasi fasilitas_eks_id ="+
								serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i]);
						mDbHelper.insertIndekosFasilitasEks(
								serverindekos_fasilitas_eks_id[i],
								serverindekos_fasilitas_eks_id_relasi_indekos_id[i],
								serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i]);
					}
				}
			}
			
			//sudah benar
			String[] clientkamar_fasilitas_int_id = selectKamarFasilitasInt(1);
			for (int i = 0; i < serverkamar_fasilitas_int_id.length; i++) {
				if(clientkamar_fasilitas_int_id.length == 0){
					Log.d("Insert kamar fasilitas int","Data id ="+serverkamar_fasilitas_int_id[i]+"relasi kamar_id ="+serverkamar_fasilitas_int_id_relasi_kamar_id[i]+" Relasi_fasilitas_int_id = "+serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
					mDbHelper
							.insertKamarFasilitasInt(
									serverkamar_fasilitas_int_id[i],
									serverkamar_fasilitas_int_id_relasi_kamar_id[i],
									serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
				}else if(clientkamar_fasilitas_int_id.length <= serverkamar_fasilitas_int_id.length){
					if (serverkamar_fasilitas_int_id[i]
							.equalsIgnoreCase(clientkamar_fasilitas_int_id[i])) {
						Log.d("Update kamar fasilitas int","Data id ="+serverkamar_fasilitas_int_id[i]+"relasi kamar_id ="+serverkamar_fasilitas_int_id_relasi_kamar_id[i]+" Relasi_fasilitas_int_id = "+serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
						mDbHelper
								.updateKamarFasilitasInt(
										serverkamar_fasilitas_int_id[i],
										serverkamar_fasilitas_int_id_relasi_kamar_id[i],
										serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
						break;
					} else if (i >= clientkamar_fasilitas_int_id.length+1) {
						Log.d("Insert kamar fasilitas int","Data id ="+serverkamar_fasilitas_int_id[i]+"relasi kamar_id ="+serverkamar_fasilitas_int_id_relasi_kamar_id[i]+" Relasi_fasilitas_int_id = "+serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
						mDbHelper
								.insertKamarFasilitasInt(
										serverkamar_fasilitas_int_id[i],
										serverkamar_fasilitas_int_id_relasi_kamar_id[i],
										serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]);
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

		@SuppressWarnings("deprecation")
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
