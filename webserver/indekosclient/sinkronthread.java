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

import android.database.Cursor;

public class SinkronisasiThread extends Thread implements Runnable {
	private boolean RunSync = false;
	private LocalDatabase mDbHelper;
	private long sleeptime;

	public void setDatabase(LocalDatabase mDbHelper) {
		this.mDbHelper = mDbHelper;
	}

	public void setRun(boolean set) {
		RunSync = set;
	}

	public void setDelay(long delay) {
		sleeptime = delay;
	}

	public void run() {
		while (RunSync) {
			String[] serverprovinsi_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=provinsi_id");
			String[] serverprovinsi_kode = fetch("http://10.0.2.2/indekosclient/android.php/?act=provinsi_kode");
			String[] serverprovinsi_nama = fetch("http://10.0.2.2/indekosclient/android.php/?act=provinsi_nama");
			String[] serverkab_kota_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=kab_kota_id");
			String[] serverkab_kota_id_relasi_provinsi_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=kab_kota_id_relasi_provinsi_id");
			String[] serverkab_kota_kode = fetch("http://10.0.2.2/indekosclient/android.php/?act=kab_kota_kode");
			String[] serverkab_kota_nama = fetch("http://10.0.2.2/indekosclient/android.php/?act=kab_kota_nama");
			String[] serverkab_kota_long = fetch("http://10.0.2.2/indekosclient/android.php/?act=kab_kota_long");
			String[] serverkab_kota_lat = fetch("http://10.0.2.2/indekosclient/android.php/?act=kab_kota_lat");
			String[] serverindekos_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_id");
			String[] serverindekos_id_relasi_pemilik_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_id_relasi_pemilik_id");
			String[] serverindekos_id_relasi_kab_kota_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_id_relasi_kab_kota_id");
			String[] serverindekos_nama = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_nama");
			String[] serverindekos_untuk = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_untuk");
			String[] serverindekos_keterangan = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_keterangan");
			String[] serverindekos_long = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_long");
			String[] serverindekos_lat = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_lat");
			String[] serverkamar_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_id");
			String[] serverkamar_id_relasi_indekos_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_id_relasi_indekos_id");
			String[] serverkamar_nama = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_nama");
			String[] serverkamar_harga = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_harga");
			String[] serverkamar_isi = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_isi");
			String[] serverkamar_ukuran_panjang = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_ukuran_panjang");
			String[] serverkamar_ukuran_lebar = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_ukuran_lebar");
			String[] serverkamar_ukuran_jenis = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_ukuran_jenis");
			String[] serverkamar_foto = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_foto");
			String[] serverkamar_minimal_kontrak = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_minimal_kontrak");
			String[] serverkamar_minimal_kontrak_jenis = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_minimal_kontrak_jenis");
			String[] serverkamar_kontrak_status = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_kontrak_status");
			String[] serverkamar_kontrak_dari_tanggal = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_kontrak_dari_tanggal");
			String[] serverkamar_kontrak_sampai_tanggal = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_kontrak_sampai_tanggal");
			String[] serverfasilitas_master_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_master_id");
			String[] serverfasilitas_master_nama = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_master_nama");
			String[] serverfasilitas_master_icon = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_master_icon");
			String[] serverfasilitas_eks_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_eks_id");
			String[] serverfasilitas_eks_id_relasi_fasilitas_master_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_eks_id_relasi_fasilitas_master_id");
			String[] serverfasilitas_eks_id_relasi_kab_kota_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_eks_id_relasi_kab_kota_id");
			String[] serverfasilitas_eks_nama = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_eks_nama");
			String[] serverfasilitas_eks_long = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_eks_long");
			String[] serverfasilitas_eks_lat = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_eks_lat");
			String[] serverfasilitas_int_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_int_id");
			String[] serverfasilitas_int_id_relasi_pemilik_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_int_id_relasi_pemilik_id");
			String[] serverfasilitas_int_nama = fetch("http://10.0.2.2/indekosclient/android.php/?act=fasilitas_int_nama");
			String[] serverindekos_fasilitas_eks_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_fasilitas_eks_id");
			String[] serverindekos_fasilitas_eks_id_relasi_indekos_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_fasilitas_eks_id_relasi_indekos_id");
			String[] serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=indekos_fasilitas_eks_id_relasi_fasilitas_eks_id");
			String[] serverkamar_fasilitas_int_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_fasilitas_int_id");
			String[] serverkamar_fasilitas_int_id_relasi_kamar_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_fasilitas_int_id_relasi_kamar_id");
			String[] serverkamar_fasilitas_int_id_relasi_fasilitas_int_id = fetch("http://10.0.2.2/indekosclient/android.php/?act=kamar_fasilitas_int_id_relasi_fasilitas_int_id");
			String[] clientprovinsi_id = selectProvinsi(0);
			for (int i = 1; i < serverprovinsi_id.length; i++) {
				for (int j = 0; j < clientprovinsi_id.length; j++) {
					if (serverprovinsi_id[i]
							.equalsIgnoreCase(clientprovinsi_id[j])) {
						mDbHelper.updateProvinsi(
								Long.parseLong(serverprovinsi_id[j]),
								Long.parseLong(serverprovinsi_kode[i]),
								serverprovinsi_nama[i]);
						break;
					} else if (j == clientprovinsi_id.length - 1) {
						mDbHelper.insertProvinsi(
								Long.parseLong(serverprovinsi_id[i]),
								Long.parseLong(serverprovinsi_kode[i]),
								serverprovinsi_nama[i]);
					}
				}
			}

			String[] clientkab_kota_id = selectKabKota(0);
			for (int i = 1; i < serverkab_kota_id.length; i++) {
				for (int j = 0; j < clientkab_kota_id.length; j++) {
					if (serverkab_kota_id[i]
							.equalsIgnoreCase(clientkab_kota_id[j])) {
						mDbHelper
								.updateKabKota(
										Long.parseLong(serverkab_kota_id[j]),
										Long.parseLong(serverkab_kota_id_relasi_provinsi_id[i]),
										Long.parseLong(serverkab_kota_kode[i]),
										serverkab_kota_nama[i],
										serverkab_kota_long[i],
										serverkab_kota_lat[i]);
						break;
					} else if (j == clientkab_kota_id.length - 1) {
						mDbHelper
								.insertKabKota(
										Long.parseLong(serverkab_kota_id[i]),
										Long.parseLong(serverkab_kota_id_relasi_provinsi_id[i]),
										Long.parseLong(serverkab_kota_kode[i]),
										serverkab_kota_nama[i],
										serverkab_kota_long[i],
										serverkab_kota_lat[i]);
					}
				}
			}

			String[] clientindekos_id = selectIndekos(0);
			for (int i = 1; i < serverindekos_id.length; i++) {
				for (int j = 0; j < clientindekos_id.length; j++) {
					if (serverindekos_id[i]
							.equalsIgnoreCase(clientindekos_id[j])) {
						mDbHelper
								.updateIndekos(
										Long.parseLong(serverindekos_id[j]),
										Long.parseLong(serverindekos_id_relasi_pemilik_id[i]),
										Long.parseLong(serverindekos_id_relasi_kab_kota_id[i]),
										serverindekos_nama[i],
										serverindekos_untuk[i],
										serverindekos_keterangan[i],
										serverindekos_long[i],
										serverindekos_lat[i]);
						break;
					} else if (j == clientindekos_id.length - 1) {
						mDbHelper
								.insertIndekos(
										Long.parseLong(serverindekos_id[i]),
										Long.parseLong(serverindekos_id_relasi_pemilik_id[i]),
										Long.parseLong(serverindekos_id_relasi_kab_kota_id[i]),
										serverindekos_nama[i],
										serverindekos_untuk[i],
										serverindekos_keterangan[i],
										serverindekos_long[i],
										serverindekos_lat[i]);
					}
				}
			}

			// sudah benar
			String[] clientkamar_id = selectKamar(0);
			for (int i = 1; i < serverkamar_id.length; i++) {
				for (int j = 0; j < clientkamar_id.length; j++) {
					if (serverkamar_id[i].equalsIgnoreCase(clientkamar_id[j])) {
						mDbHelper
								.updateKamar(
										Long.parseLong(serverkamar_id[j]),
										Long.parseLong(serverkamar_id_relasi_indekos_id[i]),
										serverkamar_nama[i],
										Long.parseLong(serverkamar_harga[i]),
										Long.parseLong(serverkamar_isi[i]),
										Long.parseLong(serverkamar_ukuran_panjang[i]),
										Long.parseLong(serverkamar_ukuran_lebar[i]),
										serverkamar_ukuran_jenis[i],
										serverkamar_foto[i],
										Long.parseLong(serverkamar_minimal_kontrak[i]),
										serverkamar_minimal_kontrak_jenis[i],
										serverkamar_kontrak_status[i],
										serverkamar_kontrak_dari_tanggal[i],
										serverkamar_kontrak_sampai_tanggal[i]);
						break;
					} else if (j == clientkamar_id.length - 1) {
						mDbHelper
								.insertKamar(
										Long.parseLong(serverkamar_id[i]),
										Long.parseLong(serverkamar_id_relasi_indekos_id[i]),
										serverkamar_nama[i],
										Long.parseLong(serverkamar_harga[i]),
										Long.parseLong(serverkamar_isi[i]),
										Long.parseLong(serverkamar_ukuran_panjang[i]),
										Long.parseLong(serverkamar_ukuran_lebar[i]),
										serverkamar_ukuran_jenis[i],
										serverkamar_foto[i],
										Long.parseLong(serverkamar_minimal_kontrak[i]),
										serverkamar_minimal_kontrak_jenis[i],
										serverkamar_kontrak_status[i],
										serverkamar_kontrak_dari_tanggal[i],
										serverkamar_kontrak_sampai_tanggal[i]);
					}
				}
			}

			// sudah benar
			String[] clientfasilitas_master_id = selectFasilitasMaster(0);
			for (int i = 1; i < serverfasilitas_master_id.length; i++) {
				for (int j = 0; j < clientfasilitas_master_id.length; j++) {
					if (serverfasilitas_master_id[i]
							.equalsIgnoreCase(clientfasilitas_master_id[j])) {
						mDbHelper.updateFasilitasMaster(
								Long.parseLong(serverfasilitas_master_id[j]),
								serverfasilitas_master_nama[i],
								serverfasilitas_master_icon[i]);
						break;
					} else if (j == clientfasilitas_master_id.length - 1) {
						mDbHelper.insertFasilitasMaster(
								Long.parseLong(serverfasilitas_master_id[i]),
								serverfasilitas_master_nama[i],
								serverfasilitas_master_icon[i]);
					}
				}
			}

			// sudah benar
			String[] clientfasilitas_eks_id = selectFasilitasEks(0);
			for (int i = 1; i < serverfasilitas_eks_id.length; i++) {
				for (int j = 0; j < clientfasilitas_eks_id.length; j++) {
					if (serverfasilitas_eks_id[i]
							.equalsIgnoreCase(clientfasilitas_eks_id[j])) {
						mDbHelper
								.updateFasilitasEks(
										Long.parseLong(serverfasilitas_eks_id[j]),
										Long.parseLong(serverfasilitas_eks_id_relasi_fasilitas_master_id[i]),
										Long.parseLong(serverfasilitas_eks_id_relasi_kab_kota_id[i]),
										serverfasilitas_eks_nama[i],
										serverfasilitas_eks_long[i],
										serverfasilitas_eks_lat[i]);
						break;
					} else if (j == clientfasilitas_eks_id.length - 1) {
						mDbHelper
								.insertFasilitasEks(
										Long.parseLong(serverfasilitas_eks_id[i]),
										Long.parseLong(serverfasilitas_eks_id_relasi_fasilitas_master_id[i]),
										Long.parseLong(serverfasilitas_eks_id_relasi_kab_kota_id[i]),
										serverfasilitas_eks_nama[i],
										serverfasilitas_eks_long[i],
										serverfasilitas_eks_lat[i]);
					}
				}
			}

			// sudah benar
			String[] clientfasilitas_int_id = selectFasilitasInt(0);
			for (int i = 1; i < serverfasilitas_int_id.length; i++) {
				for (int j = 0; j < clientfasilitas_int_id.length; j++) {
					if (serverfasilitas_int_id[i]
							.equalsIgnoreCase(clientfasilitas_int_id[j])) {
						mDbHelper
								.updateFasilitasInt(
										Long.parseLong(serverfasilitas_int_id[j]),
										Long.parseLong(serverfasilitas_int_id_relasi_pemilik_id[i]),
										serverfasilitas_int_nama[i]);
						break;
					} else if (j == clientfasilitas_int_id.length - 1) {
						mDbHelper
								.insertFasilitasInt(
										Long.parseLong(serverfasilitas_int_id[i]),
										Long.parseLong(serverfasilitas_int_id_relasi_pemilik_id[i]),
										serverfasilitas_int_nama[i]);
					}
				}
			}

			String[] clientindekos_fasilitas_eks_id = selectIndekosFasilitasEks(0);
			for (int i = 1; i < serverindekos_fasilitas_eks_id.length; i++) {
				for (int j = 0; j < clientindekos_fasilitas_eks_id.length; j++) {
					if (serverindekos_fasilitas_eks_id[i]
							.equalsIgnoreCase(clientindekos_fasilitas_eks_id[j])) {
						mDbHelper
								.updateIndekosFasilitasEks(
										Long.parseLong(serverindekos_fasilitas_eks_id[j]),
										Long.parseLong(serverindekos_fasilitas_eks_id_relasi_indekos_id[i]),
										Long.parseLong(serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i]));
						break;
					} else if (j == clientindekos_fasilitas_eks_id.length - 1) {
						mDbHelper
								.insertIndekosFasilitasEks(
										Long.parseLong(serverindekos_fasilitas_eks_id[i]),
										Long.parseLong(serverindekos_fasilitas_eks_id_relasi_indekos_id[i]),
										Long.parseLong(serverindekos_fasilitas_eks_id_relasi_fasilitas_eks_id[i]));
					}
				}
			}

			// sudah benar
			String[] clientkamar_fasilitas_int_id = selectKamarFasilitasInt(0);
			for (int i = 1; i < serverkamar_fasilitas_int_id.length; i++) {
				for (int j = 0; j < clientkamar_fasilitas_int_id.length; j++) {
					if (serverkamar_fasilitas_int_id[i]
							.equalsIgnoreCase(clientkamar_fasilitas_int_id[j])) {
						mDbHelper
								.updateKamarFasilitasInt(
										Long.parseLong(serverkamar_fasilitas_int_id[j]),
										Long.parseLong(serverkamar_fasilitas_int_id_relasi_kamar_id[i]),
										Long.parseLong(serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]));
						break;
					} else if (j == clientkamar_fasilitas_int_id.length - 1) {
						mDbHelper
								.insertKamarFasilitasInt(
										Long.parseLong(serverkamar_fasilitas_int_id[i]),
										Long.parseLong(serverkamar_fasilitas_int_id_relasi_kamar_id[i]),
										Long.parseLong(serverkamar_fasilitas_int_id_relasi_fasilitas_int_id[i]));
					}
				}
			}
			
			try {
				sleep(sleeptime);
				
			} catch (InterruptedException e) {
				// TODO: handle exception
				break;
			}
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

	/* === DATA LOKAL === */
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
