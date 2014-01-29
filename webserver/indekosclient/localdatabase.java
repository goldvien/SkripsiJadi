package com.clientindekos;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.SQLException;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

public class LocalDatabase {
	/* === PEMILIK === */
	public static final String KEY_ROWID = "_id";
	public static final String KEY_PEMILIK_ID = "pemilik_id";
	/* === PROVINSI === */
	public static final String KEY_PROVINSI_ID = "provinsi_id";
	public static final String KEY_PROVINSI_NAMA = "provinsi_nama";
	public static final String KEY_PROVINSI_KODE = "provinsi_kode";
	/* === KOTA === */
	public static final String KEY_KAB_KOTA_ID = "kab_kota_id";
	public static final String KEY_KAB_KOTA_KODE = "kab_kota_kode";
	public static final String KEY_KAB_KOTA_NAMA = "kab_kota_nama";
	public static final String KEY_KAB_KOTA_LONG = "kab_kota_long";
	public static final String KEY_KAB_KOTA_LAT = "kab_kota_lat";
	/* === INDEKOS === */
	public static final String KEY_INDEKOS_ID = "indekos_id";
	public static final String KEY_INDEKOS_NAMA = "indekos_nama";
	public static final String KEY_INDEKOS_UNTUK = "indekos_untuk";
	public static final String KEY_INDEKOS_KETERANGAN = "indekos_keterangan";
	public static final String KEY_INDEKOS_LONG = "indekos_long";
	public static final String KEY_INDEKOS_LAT = "indekos_lat";
	/* === KAMAR === */
	public static final String KEY_KAMAR_ID = "kamar_id";
	public static final String KEY_KAMAR_NAMA = "kamar_nama";
	public static final String KEY_KAMAR_HARGA = "kamar_harga";
	public static final String KEY_KAMAR_ISI = "kamar_isi";
	public static final String KEY_KAMAR_UKURAN_PANJANG = "kamar_ukuran_panjang";
	public static final String KEY_KAMAR_UKURAN_LEBAR = "kamar_ukuran_lebar";
	public static final String KEY_KAMAR_UKURAN_JENIS = "kamar_ukuran_jenis";
	public static final String KEY_KAMAR_FOTO = "kamar_foto";
	public static final String KEY_KAMAR_MINIMAL_KONTRAK = "kamar_minimal_kontrak";
	public static final String KEY_KAMAR_MINIMAL_KONTRAK_JENIS = "kamar_minimal_kontrak_jenis";
	public static final String KEY_KAMAR_KONTRAK_STATUS = "kamar_kontrak_status";
	public static final String KEY_KAMAR_KONTRAK_DARI_TANGGAL = "kamar_kontrak_dari_tanggal";
	public static final String KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL = "kamar_kontrak_sampai_tanggal";
	/* === FASILITAS_MASTER === */
	public static final String KEY_FASILITAS_MASTER_ID = "fasilitas_master_id";
	public static final String KEY_FASILITAS_MASTER_NAMA = "fasilitas_master_nama";
	public static final String KEY_FASILITAS_MASTER_ICON = "fasilitas_master_icon";
	/* === FASILITAS_EKS === */
	public static final String KEY_FASILITAS_EKS_ID = "fasilitas_eks_id";
	public static final String KEY_FASILITAS_EKS_NAMA = "fasilitas_eks_nama";
	public static final String KEY_FASILITAS_EKS_LONG = "fasilitas_eks_long";
	public static final String KEY_FASILITAS_EKS_LAT = "fasilitas_eks_lat";
	/* === FASILITAS_INT === */
	public static final String KEY_FASILITAS_INT_ID = "fasilitas_int_id";
	public static final String KEY_FASILITAS_INT_NAMA = "fasilitas_int_nama";
	/* === INDEKOS_FASILITAS_EKS === */
	public static final String KEY_INDEKOS_FASILITAS_EKS_ID = "indekos_fasilitas_eks_id";
	/* === KAMAR_FASILITAS_INT === */
	public static final String KEY_KAMAR_FASILITAS_INT_ID = "kamar_fasilitas_int_id";

	private static final String TAG = "LocalDatabase";
	private DatabaseHelper mDbHelper;
	private SQLiteDatabase mDb;

	/*
	 * private static final String DATABASE_CREATE =
	 * "create table provinsi(provinsi_id integer primary key,provinsi_kode integer, provinsi_nama text);"
	 * +
	 * "create table kab_kota(kab_kota_id integer primary key, provinsi_id integer not null, kab_kota_kode integer, kab_kota_nama text, kab_kota_long text, kab_kota_lat text);"
	 * +
	 * "create table indekos(indekos_id integer primary key, pemilik_id integer not null, kab_kota_id integer not null,indekos_nama text,indekos_untuk text, indekos_keterangan text, indekos_long text, indekos_lat text);"
	 * +
	 * "create table kamar(kamar_id integer primary key, indekos_id integer not null, kamar_nama text, kamar_harga integer, kamar_isi integer,kamar_ukuran_panjang integer, kamar_ukuran_lebar integer, kamar_ukuran_jenis text,"
	 * +
	 * "kamar_foto text, kamar_minimal_kontrak integer, kamar_minimal_kontrak_jenis text,kamar_kontrak_status text,kamar_kontrak_dari_tanggal text,kamar_kontrak_sampai_tanggal text);"
	 * +
	 * "create table fasilitas_master(fasilitas_master_id integer primary key, fasilitas_master_nama text, fasilitas_master_icon text);"
	 * +
	 * "create table fasilitas_eks(fasilitas_eks_id integer primary key, fasilitas_master_id integer not null, kab_kota_id integer not null, fasilitas_eks_nama text, fasilitas_eks_long text, fasilitas_eks_lat text);"
	 * +
	 * "create table fasilitas_int(fasilitas_int_id integer primary key, pemilik_id integer not null, fasilitas_int_nama text);"
	 * +
	 * "create table indekos_fasilitas_eks(indekos_fasilitas_eks_id integer primary key, indekso_id integer not null, fasilitas_eks_id integer not null);"
	 * +
	 * "create table kamar_fasilitas_int(kamar_fasilitas_int_id integer primary key, kamar_id integer not null, fasilitas_int_id integer not null);"
	 * ;
	 */
	private static final String DATABASE_NAMA = "db_indekos";
	private static final String TABEL_PROVINSI = "provinsi";
	private static final String TABEL_KAB_KOTA = "kab_kota";
	private static final String TABEL_INDEKOS = "indekos";
	private static final String TABEL_KAMAR = "kamar";
	private static final String TABEL_FASILITAS_MASTER = "fasilitas_master";
	private static final String TABEL_FASILITAS_EKS = "fasilitas_eks";
	private static final String TABEL_FASILITAS_INT = "fasilitas_int";
	private static final String TABEL_INDEKOS_FASILITAS_EKS = "indekos_fasilitas_eks";
	private static final String TABEL_KAMAR_FASILITAS_INT = "kamar_fasilitas_int";
	private static final int DATABASE_VERSI = 2;
	private final Context mCtx;

	private static class DatabaseHelper extends SQLiteOpenHelper {

		DatabaseHelper(Context context) {
			// TODO Auto-generated constructor stub
			super(context, DATABASE_NAMA, null, DATABASE_VERSI);

		}

		@Override
		public void onCreate(SQLiteDatabase db) {
			// TODO Auto-generated method stub
			db.execSQL("CREATE TABLE provinsi(provinsi_id integer primary key,provinsi_kode integer, provinsi_nama text);");
			db.execSQL("CREATE TABLE kab_kota(kab_kota_id integer primary key, provinsi_id integer, kab_kota_kode integer,kab_kota_nama text, kab_kota_long text, kab_kota_lat text);");
			db.execSQL("CREATE TABLE indekos(indekos_id integer primary key, pemilik_id integer,kab_kota_id integer,indekos_nama text, indekos_untuk text, indekos_keterangan text,indekos_long text, indekos_lat text);");
			db.execSQL("CREATE TABLE kamar(kamar_id integer primary key, indekos_id integer, kamar_nama text, kamar_harga text, kamar_isi text,kamar_ukuran_panjang text, kamar_ukuran_lebar text, kamar_ukuran_jenis text ,kamar_foto text, kamar_minimal_kontrak text, kamar_minimal_kontrak_jenis text,kamar_kontrak_status text,kamar_kontrak_dari_tanggal text,kamar_kontrak_sampai_tanggal text);");
			db.execSQL("CREATE TABLE fasilitas_master(fasilitas_master_id integer primary key, fasilitas_master_nama text,fasilitas_master_icon text);");
			db.execSQL("CREATE TABLE fasilitas_eks(fasilitas_eks_id integer primary key,fasilitas_master_id integer,kab_kota_id integer, fasilitas_eks_nama text,fasilitas_eks_long text,fasilitas_eks_lat text);");
			db.execSQL("CREATE TABLE fasilitas_int(fasilitas_int_id integer primary key, pemilik_id integer, fasilitas_int_nama text);");
			db.execSQL("CREATE TABLE indekos_fasilitas_eks(indekos_fasilitas_eks_id integer primary key, indekos_id integer, fasilitas_eks_id integer);");
			db.execSQL("CREATE TABLE kamar_fasilitas_int(kamar_fasilitas_int_id integer primary key, kamar_id integer, fasilitas_int_id integer);");
		}

		@Override
		public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
			// TODO Auto-generated method stub
			Log.w(TAG, "Upgrading database dari " + oldVersion + " ke "
					+ newVersion
					+ ", upgrading akan menghapus semua data yang ada.");
			db.execSQL("Drop table if exists friend");
			onCreate(db);
		}

	}
	
	public LocalDatabase(Context ctx) {
		this.mCtx = ctx;
	}

	public LocalDatabase open() throws SQLException {

		mDbHelper = new DatabaseHelper(mCtx);
		mDb = mDbHelper.getWritableDatabase();
		return this;
	}

	public void close() {
		mDbHelper.close();
	}

	/* === AMBIL DATA UNTUK SINKRONISASI === */
	public Cursor select_all_provinsi() {
		return mDb.query(TABEL_PROVINSI, new String[] { KEY_PROVINSI_ID,
				KEY_PROVINSI_KODE, KEY_PROVINSI_NAMA }, null, null, null, null,
				KEY_PROVINSI_NAMA);
	}

	public Cursor select_all_kab_kota() {
		Cursor select = mDb.query(TABEL_KAB_KOTA, new String[] {
				KEY_KAB_KOTA_ID, KEY_PROVINSI_ID, KEY_KAB_KOTA_KODE,
				KEY_KAB_KOTA_NAMA, KEY_KAB_KOTA_LONG, KEY_KAB_KOTA_LAT }, null,
				null, null, null, KEY_KAB_KOTA_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_indekos() {
		Cursor select = mDb.query(TABEL_INDEKOS, new String[] { KEY_INDEKOS_ID,
				KEY_PEMILIK_ID, KEY_KAB_KOTA_ID, KEY_INDEKOS_NAMA,
				KEY_INDEKOS_UNTUK, KEY_INDEKOS_KETERANGAN, KEY_INDEKOS_LONG,
				KEY_INDEKOS_LAT }, null, null, null, null, KEY_INDEKOS_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_kamar() {
		Cursor select = mDb.query(TABEL_KAMAR, new String[] { KEY_KAMAR_ID,
				KEY_INDEKOS_ID, KEY_KAMAR_NAMA, KEY_KAMAR_HARGA, KEY_KAMAR_ISI,
				KEY_KAMAR_UKURAN_PANJANG, KEY_KAMAR_UKURAN_LEBAR,
				KEY_KAMAR_UKURAN_JENIS, KEY_KAMAR_FOTO,
				KEY_KAMAR_MINIMAL_KONTRAK, KEY_KAMAR_MINIMAL_KONTRAK_JENIS,
				KEY_KAMAR_KONTRAK_STATUS, KEY_KAMAR_KONTRAK_DARI_TANGGAL,
				KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL }, null, null, null, null,
				KEY_KAMAR_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_fasilitas_master() {
		Cursor select = mDb.query(TABEL_FASILITAS_MASTER, new String[] {
				KEY_FASILITAS_MASTER_ID, KEY_FASILITAS_MASTER_NAMA,
				KEY_FASILITAS_MASTER_ICON }, null, null, null, null,
				KEY_FASILITAS_MASTER_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_fasilitas_eks() {
		Cursor select = mDb.query(TABEL_FASILITAS_EKS, new String[] {
				KEY_FASILITAS_EKS_ID, KEY_FASILITAS_MASTER_ID, KEY_KAB_KOTA_ID,
				KEY_FASILITAS_EKS_NAMA, KEY_FASILITAS_EKS_LONG,
				KEY_FASILITAS_EKS_LAT }, null, null, null, null,
				KEY_FASILITAS_EKS_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_fasilitas_int() {
		Cursor select = mDb.query(TABEL_FASILITAS_INT, new String[] {
				KEY_FASILITAS_INT_ID, KEY_PEMILIK_ID, KEY_FASILITAS_INT_NAMA },
				null, null, null, null, KEY_FASILITAS_INT_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_indekos_fasilitas_eks() {
		Cursor select = mDb.query(TABEL_INDEKOS_FASILITAS_EKS, new String[] {
				KEY_INDEKOS_FASILITAS_EKS_ID, KEY_INDEKOS_ID,
				KEY_FASILITAS_EKS_ID }, null, null, null, null,
				KEY_INDEKOS_FASILITAS_EKS_ID);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_kamar_fasilitas_int() {
		Cursor select = mDb.query(TABEL_KAMAR_FASILITAS_INT,
				new String[] { KEY_KAMAR_FASILITAS_INT_ID, KEY_KAMAR_ID,
						KEY_FASILITAS_INT_ID }, null, null, null, null,
				KEY_KAMAR_FASILITAS_INT_ID);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	/* === END AMBIL DATA SINKRONISASI === */
	// Update sinkronisasi data.

	public boolean updateProvinsi(String provinsi_id, String provinsi_kode,
			String provinsi_nama) {
		ContentValues args = new ContentValues();
		args.put(KEY_PROVINSI_ID, provinsi_id);
		args.put(KEY_PROVINSI_KODE, provinsi_kode);
		args.put(KEY_PROVINSI_NAMA, provinsi_nama);
		return mDb.update(TABEL_PROVINSI, args, KEY_PROVINSI_ID + "="
				+ provinsi_id, null) > 0;
	}

	public boolean updateKabKota(String kab_kota_id, String provinsi_id,
			String kab_kota_kode, String kab_kota_nama, String kab_kota_long,
			String kab_kota_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_PROVINSI_ID, provinsi_id);
		args.put(KEY_KAB_KOTA_KODE, kab_kota_kode);
		args.put(KEY_KAB_KOTA_NAMA, kab_kota_nama);
		args.put(KEY_KAB_KOTA_LONG, kab_kota_long);
		args.put(KEY_KAB_KOTA_LAT, kab_kota_lat);
		return mDb.update(TABEL_KAB_KOTA, args, KEY_KAB_KOTA_ID + "="
				+ kab_kota_id, null) > 0;
	}

	public boolean updateIndekos(String indekos_id, String pemilik_id,
			String kab_kota_id, String indekos_nama, String indekos_untuk,
			String indekos_keterangan, String indekos_long, String indekos_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_INDEKOS_NAMA, indekos_nama);
		args.put(KEY_INDEKOS_UNTUK, indekos_untuk);
		args.put(KEY_INDEKOS_KETERANGAN, indekos_keterangan);
		args.put(KEY_INDEKOS_LONG, indekos_long);
		args.put(KEY_INDEKOS_LAT, indekos_lat);
		return mDb.update(TABEL_INDEKOS, args, KEY_INDEKOS_ID + "="
				+ indekos_id, null) > 0;
	}

	public boolean updateKamar(String kamar_id, String indekos_id,
			String kamar_nama, String kamar_harga, String kamar_isi,
			String kamar_ukuran_panjang, String kamar_ukuran_lebar,
			String kamar_ukuran_jenis, String kamar_foto,
			String kamar_minimal_kontrak, String kamar_minimal_kontrak_jenis,
			String kamar_kontrak_status, String kamar_kontrak_dari_tanggal,
			String kamar_kontrak_sampai_tanggal) {
		ContentValues args = new ContentValues();
		args.put(KEY_KAMAR_ID, kamar_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_KAMAR_NAMA, kamar_nama);
		args.put(KEY_KAMAR_HARGA, kamar_harga);
		args.put(KEY_KAMAR_ISI, kamar_isi);
		args.put(KEY_KAMAR_UKURAN_PANJANG, kamar_ukuran_panjang);
		args.put(KEY_KAMAR_UKURAN_LEBAR, kamar_ukuran_lebar);
		args.put(KEY_KAMAR_UKURAN_JENIS, kamar_ukuran_jenis);
		args.put(KEY_KAMAR_FOTO, kamar_foto);
		args.put(KEY_KAMAR_MINIMAL_KONTRAK, kamar_minimal_kontrak);
		args.put(KEY_KAMAR_MINIMAL_KONTRAK_JENIS, kamar_minimal_kontrak_jenis);
		args.put(KEY_KAMAR_KONTRAK_STATUS, kamar_kontrak_status);
		args.put(KEY_KAMAR_KONTRAK_DARI_TANGGAL, kamar_kontrak_dari_tanggal);
		args.put(KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL, kamar_kontrak_sampai_tanggal);
		return mDb.update(TABEL_KAMAR, args, KEY_KAMAR_ID + "=" + kamar_id,
				null) > 0;
	}

	public boolean updateFasilitasMaster(String fasilitas_master_id,
			String fasilitas_master_nama, String fasilitas_master_icon) {
		ContentValues args = new ContentValues();
		args.put(KEY_FASILITAS_MASTER_ID, fasilitas_master_id);
		args.put(KEY_FASILITAS_MASTER_NAMA, fasilitas_master_nama);
		args.put(KEY_FASILITAS_MASTER_ICON, fasilitas_master_icon);
		return mDb.update(TABEL_FASILITAS_MASTER, args, KEY_FASILITAS_MASTER_ID
				+ "=" + fasilitas_master_id, null) > 0;
	}

	public boolean updateFasilitasEks(String fasilitas_eks_id,
			String fasilitas_master_id, String kab_kota_id,
			String fasilitas_eks_nama, String fasilitas_eks_long,
			String fasilitas_eks_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_FASILITAS_EKS_ID, fasilitas_eks_id);
		args.put(KEY_FASILITAS_MASTER_ID, fasilitas_master_id);
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_FASILITAS_EKS_NAMA, fasilitas_eks_nama);
		args.put(KEY_FASILITAS_EKS_LONG, fasilitas_eks_long);
		args.put(KEY_FASILITAS_EKS_LAT, fasilitas_eks_lat);
		return mDb.update(TABEL_FASILITAS_EKS, args, KEY_FASILITAS_EKS_ID + "="
				+ fasilitas_eks_id, null) > 0;
	}

	public boolean updateFasilitasInt(String fasilitas_int_id, String pemilik_id,
			String fasilitas_int_nama) {
		ContentValues args = new ContentValues();
		args.put(KEY_FASILITAS_INT_ID, fasilitas_int_id);
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_FASILITAS_INT_NAMA, fasilitas_int_nama);
		return mDb.update(TABEL_FASILITAS_INT, args, KEY_FASILITAS_INT_ID + "="
				+ fasilitas_int_id, null) > 0;
	}

	public boolean updateIndekosFasilitasEks(String indekos_fasilitas_eks_id,
			String indekos_id, String fasilitas_eks_id) {
		ContentValues args = new ContentValues();
		args.put(KEY_INDEKOS_FASILITAS_EKS_ID, indekos_fasilitas_eks_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_FASILITAS_EKS_ID, fasilitas_eks_id);
		return mDb.update(TABEL_INDEKOS_FASILITAS_EKS, args,
				KEY_INDEKOS_FASILITAS_EKS_ID + "=" + indekos_fasilitas_eks_id,
				null) > 0;
	}

	public boolean updateKamarFasilitasInt(String kamar_fasilitas_int_id,
			String kamar_id, String fasilitas_int_id) {
		ContentValues args = new ContentValues();
		args.put(KEY_KAMAR_FASILITAS_INT_ID, kamar_fasilitas_int_id);
		args.put(KEY_KAMAR_ID, kamar_id);
		args.put(KEY_FASILITAS_INT_ID, fasilitas_int_id);
		return mDb
				.update(TABEL_KAMAR_FASILITAS_INT, args,
						KEY_KAMAR_FASILITAS_INT_ID + "="
								+ kamar_fasilitas_int_id, null) > 0;
	}

	// Insert sinkronisasi data.

	public long insertProvinsi(String provinsi_id, String provinsi_kode,
			String provinsi_nama) {
		ContentValues args = new ContentValues();
		args.put(KEY_PROVINSI_ID, provinsi_id);
		args.put(KEY_PROVINSI_KODE, provinsi_kode);
		args.put(KEY_PROVINSI_NAMA, provinsi_nama);
		return mDb.insert(TABEL_PROVINSI, null, args);
	}

	public long insertKabKota(String kab_kota_id, String provinsi_id,
			String kab_kota_kode, String kab_kota_nama, String kab_kota_long,
			String kab_kota_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_PROVINSI_ID, provinsi_id);
		args.put(KEY_KAB_KOTA_KODE, kab_kota_kode);
		args.put(KEY_KAB_KOTA_NAMA, kab_kota_nama);
		args.put(KEY_KAB_KOTA_LONG, kab_kota_long);
		args.put(KEY_KAB_KOTA_LAT, kab_kota_lat);
		return mDb.insert(TABEL_KAB_KOTA, null, args);
	}

	public long insertIndekos(String indekos_id, String pemilik_id,
			String kab_kota_id, String indekos_nama, String indekos_untuk,
			String indekos_keterangan, String indekos_long, String indekos_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_INDEKOS_NAMA, indekos_nama);
		args.put(KEY_INDEKOS_UNTUK, indekos_untuk);
		args.put(KEY_INDEKOS_KETERANGAN, indekos_keterangan);
		args.put(KEY_INDEKOS_LONG, indekos_long);
		args.put(KEY_INDEKOS_LAT, indekos_lat);
		return mDb.insert(TABEL_INDEKOS, null, args);
	}

	public long insertKamar(String kamar_id, String indekos_id, String kamar_nama,
			String kamar_harga, String kamar_isi, String kamar_ukuran_panjang,
			String kamar_ukuran_lebar, String kamar_ukuran_jenis,
			String kamar_foto, String kamar_minimal_kontrak,
			String kamar_minimal_kontrak_jenis, String kamar_kontrak_status,
			String kamar_kontrak_dari_tanggal,
			String kamar_kontrak_sampai_tanggal) {
		ContentValues args = new ContentValues();
		args.put(KEY_KAMAR_ID, kamar_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_KAMAR_NAMA, kamar_nama);
		args.put(KEY_KAMAR_HARGA, kamar_harga);
		args.put(KEY_KAMAR_ISI, kamar_isi);
		args.put(KEY_KAMAR_UKURAN_PANJANG, kamar_ukuran_panjang);
		args.put(KEY_KAMAR_UKURAN_LEBAR, kamar_ukuran_lebar);
		args.put(KEY_KAMAR_UKURAN_JENIS, kamar_ukuran_jenis);
		args.put(KEY_KAMAR_FOTO, kamar_foto);
		args.put(KEY_KAMAR_MINIMAL_KONTRAK, kamar_minimal_kontrak);
		args.put(KEY_KAMAR_MINIMAL_KONTRAK_JENIS, kamar_minimal_kontrak_jenis);
		args.put(KEY_KAMAR_KONTRAK_STATUS, kamar_kontrak_status);
		args.put(KEY_KAMAR_KONTRAK_DARI_TANGGAL, kamar_kontrak_dari_tanggal);
		args.put(KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL, kamar_kontrak_sampai_tanggal);
		return mDb.insert(TABEL_KAMAR, null, args);
	}

	public long insertFasilitasMaster(String fasilitas_master_id,
			String fasilitas_master_nama, String fasilitas_master_icon) {
		ContentValues args = new ContentValues();
		args.put(KEY_FASILITAS_MASTER_ID, fasilitas_master_id);
		args.put(KEY_FASILITAS_MASTER_NAMA, fasilitas_master_nama);
		args.put(KEY_FASILITAS_MASTER_ICON, fasilitas_master_icon);
		return mDb.insert(TABEL_FASILITAS_MASTER, null, args);
	}

	public long insertFasilitasEks(String fasilitas_eks_id,
			String fasilitas_master_id, String kab_kota_id,
			String fasilitas_eks_nama, String fasilitas_eks_long,
			String fasilitas_eks_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_FASILITAS_EKS_ID, fasilitas_eks_id);
		args.put(KEY_FASILITAS_MASTER_ID, fasilitas_master_id);
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_FASILITAS_EKS_NAMA, fasilitas_eks_nama);
		args.put(KEY_FASILITAS_EKS_LONG, fasilitas_eks_long);
		args.put(KEY_FASILITAS_EKS_LAT, fasilitas_eks_lat);
		return mDb.insert(TABEL_FASILITAS_EKS, null, args);
	}

	public long insertFasilitasInt(String fasilitas_int_id, String pemilik_id,
			String fasilitas_int_nama) {
		ContentValues args = new ContentValues();
		args.put(KEY_FASILITAS_INT_ID, fasilitas_int_id);
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_FASILITAS_INT_NAMA, fasilitas_int_nama);
		return mDb.insert(TABEL_FASILITAS_INT, null, args);
	}

	public long insertIndekosFasilitasEks(String indekos_fasilitas_eks_id,
			String indekos_id, String fasilitas_eks_id) {
		ContentValues args = new ContentValues();
		args.put(KEY_INDEKOS_FASILITAS_EKS_ID, indekos_fasilitas_eks_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_FASILITAS_EKS_ID, fasilitas_eks_id);
		return mDb.insert(TABEL_INDEKOS_FASILITAS_EKS, null, args);
	}

	public long insertKamarFasilitasInt(String kamar_fasilitas_int_id,
			String kamar_id, String fasilitas_int_id) {
		ContentValues args = new ContentValues();
		args.put(KEY_KAMAR_FASILITAS_INT_ID, kamar_fasilitas_int_id);
		args.put(KEY_KAMAR_ID, kamar_id);
		args.put(KEY_FASILITAS_INT_ID, fasilitas_int_id);
		return mDb.insert(TABEL_KAMAR_FASILITAS_INT, null, args);
	}

}

/*SELECT indekos.indekos_id, indekos.indekos_nama, kab_kota.kab_kota_id, kab_kota.kab_kota_long,indekos.indekos_long, kab_kota.kab_kota_lat,indekos.indekos_lat,
( 6371 * acos( 
	cos( radians(37) ) * 
	cos( radians(indekos.indekos_lat) ) * 
	cos( radians( indekos.indekos_long) - radians(kab_kota.kab_kota_long) ) + 
	sin( radians(kab_kota.kab_kota_lat) ) * 
	sin( radians( indekos.indekos_lat) )
	)
) AS jarak FROM indekos,kab_kota WHERE indekos.kab_kota_id=kab_kota.kab_kota_id AND kab_kota.kab_kota_id=246 ORDER BY jarak*/

/*SELECT indekos.indekos_id, indekos.indekos_nama, fasilitas_eks.fasilitas_eks_id, fasilitas_eks.fasilitas_eks_long,indekos.indekos_long, fasilitas_eks.fasilitas_eks_lat,indekos.indekos_lat,
( 6371 * acos( 
	cos( radians(37) ) * 
	cos( radians(indekos.indekos_lat) ) * 
	cos( radians( indekos.indekos_long) - radians(fasilitas_eks.fasilitas_eks_long) ) + 
	sin( radians(fasilitas_eks.fasilitas_eks_lat) ) * 
	sin( radians( indekos.indekos_lat) )
	)
) AS jarak,count(kamar.kamar_id) as jumlah FROM indekos,fasilitas_eks, indekos_fasilitas_eks,kamar WHERE indekos_fasilitas_eks.indekos_id=indekos.indekos_id AND indekos_fasilitas_eks.fasilitas_eks_id=fasilitas_eks.fasilitas_eks_id AND 
indekos.indekos_id=kamar.indekos_id AND kamar.kamar_kontrak_status='kosong' AND
indekos_fasilitas_eks.fasilitas_eks_id=3 GROUP BY indekos.indekos_id ORDER BY jarak


(6371 * Math
	.acos(FloatMath.cos((float) Math
			.toRadians(37))
			* FloatMath.cos((float) Math.toRadians(Double
					.valueOf("indekos.indekos_lat")))
			* FloatMath.cos((float) Math.toRadians(Double
					.valueOf("indekos.indekos_long"))
					- (float) Math
							.toRadians(Double
									.valueOf("fasilitas_eks.fasilitas_eks_long")))
			+ FloatMath.sin((float) Math.toRadians(Double
					.valueOf("fasilitas_eks.fasilitas_eks_lat")))
			* FloatMath.sin((float) Math.toRadians(Double
					.valueOf("indekos.indekos_lat")))))

*/